<?php

use Illuminate\Foundation\{AliasLoader, Application};
use Illuminate\Support\Facades\{Blade, View};
use Illuminate\Support\{Arr, ServiceProvider};
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\{ComponentAttributeBag, Factory, FileViewFinder};
use Tests\Unit\TestCase;
use WireUi\Facades\WireUi;
use WireUi\View\Attribute;
use WireUi\View\Components\Icon;
use WireUi\WireUiServiceProvider;

it('should register the views paths', function () {
    /** @var Factory $view */
    $view = View::getFacadeRoot();

    /** @var FileViewFinder $finder */
    $finder = $view->getFinder();
    expect($finder->getHints())->toHaveKey('wireui');
    expect($finder->getHints()['wireui'][0])->toContain('src/resources/views');
});

it('should merge the wireui config', function () {
    expect(config('wireui'))->toHaveKeys([
        'icons',
        'modal',
        'components',
    ]);
});

test('the root dir function should create the correct path', function () {
    /** @var TestCase $this */
    $provider = new WireUiServiceProvider(new Application());

    expect($this->invokeMethod($provider, 'srcDir', ['config.php']))->toEndWith('/src/config.php');
    expect($this->invokeMethod($provider, 'srcDir', ['resources/views']))->toEndWith('/src/resources/views');
});

it('should add the publish groups', function () {
    $publishGroups = ServiceProvider::$publishGroups;

    expect($publishGroups)->toHaveKeys([
        'wireui.config',
        'wireui.views',
        'wireui.lang',
    ]);

    expect($publishGroups['wireui.config'])->toBeArray()->toHaveCount(1);
    expect($publishGroups['wireui.views'])->toBeArray()->toHaveCount(1);
    expect($publishGroups['wireui.lang'])->toBeArray()->toHaveCount(1);

    expect(array_key_first($publishGroups['wireui.config']))->toBeFile();
    expect(array_key_first($publishGroups['wireui.views']))->toBeDirectory();
    expect(array_key_first($publishGroups['wireui.lang']))->toBeDirectory();

    expect(array_values($publishGroups['wireui.config'])[0])->toEndWith('wireui.php');
    expect(array_values($publishGroups['wireui.views'])[0])->toEndWith('resources/views/vendor/wireui');
    expect(array_values($publishGroups['wireui.lang'])[0])->toEndWith('lang/vendor/wireui');
});

it('should register the blade components', function () {
    /** @var BladeCompiler $bladeCompiler */
    $bladeCompiler = resolve(BladeCompiler::class);

    expect($bladeCompiler->getClassComponentAliases())->toMatchArray(
        collect(config('wireui.components'))->pluck('class', 'alias')->toArray(),
    );
});

it('should register the icon component to wireui class', function () {
    /** @var BladeCompiler $bladeCompiler */
    $bladeCompiler = resolve(BladeCompiler::class);
    $aliases       = $bladeCompiler->getClassComponentAliases();

    $this->assertArrayHasKey('icon', $aliases, 'The {icon} should be registered');
    $this->assertSame($aliases['icon'], Icon::class);
});

it('should register the WireUi singleton', function () {
    $loader = AliasLoader::getInstance();

    expect($loader->getAliases())->toHaveKey('WireUi');
    expect($loader->getAliases()['WireUi'])->toBe(WireUi::class);
});

it('should register the blade directives', function () {
    $directives = Blade::getCustomDirectives();

    expect($directives)->toHaveKeyS([
        'confirmAction',
        'notify',
        'wireUiScripts',
        'wireUiStyles',
        'boolean',
    ]);
});

it('should register the component attributes bag macros', function () {
    /** @var TestCase $this */
    $macros = $this->invokeProperty(new ComponentAttributeBag(), 'macros');

    expect($macros)->toHaveKey('wireModifiers');
});

it('should register the attribute macro on ComponentAttributeBag', function () {
    /** @var TestCase $this */
    $macros = $this->invokeProperty(new ComponentAttributeBag(), 'macros');

    expect($macros)->toHaveKey('attribute');
});

it('should get the attribute with modifiers', function (string $attribute, array $modifiers) {
    /** @var ComponentAttributeBag $bag */
    $bag = new ComponentAttributeBag([
        'name'     => 'foo',
        $attribute => true,
        'docker'   => 'container',
        'sail'     => 'laravel',
    ]);

    /** @var Attribute $attribute */
    $attribute = $bag->attribute('spinner');

    expect($attribute->modifiers()->toArray())->toBe($modifiers);
})->with([
    ['spinner', []],
    ['spinner.lazy', ['lazy']],
    ['spinner.lazy.lazy', ['lazy']],
    ['spinner.lazy..bar', ['lazy', 'bar']],
    ['spinner.lazy.foo.', ['lazy', 'foo']],
]);
