<?php

namespace WireUi\Support;

use Illuminate\Support\Str;
use Illuminate\View\ComponentAttributeBag;
use Livewire\Mechanisms\FrontendAssets\FrontendAssets;

class BladeDirectives
{
    public function scripts(bool $absolute = true, array $attributes = []): string
    {
        $route = route('wireui.assets.scripts', $parameters = [], $absolute);
        $this->getManifestVersion('wireui.js', $route);

        $attributes = new ComponentAttributeBag($attributes);

        return <<<HTML
        <script {$attributes->toHtml()}>{$this->hooksScript()}</script>
        <script src="{$route}" defer {$attributes->toHtml()}></script>
        HTML;
    }

    public function hooksScript(): string
    {
        $scripts = <<<JS
            window.Wireui = {
                hook(hook, callback) {
                    window.addEventListener(`wireui:\${hook}`, () => callback())
                },
                dispatchHook(hook) {
                    window.dispatchEvent(new Event(`wireui:\${hook}`))
                }
            }
        JS;

        return (fn () => (new $this())::minify($scripts))->call(new FrontendAssets());
    }

    public function styles(bool $absolute = true): string
    {
        $route = route('wireui.assets.styles', $parameters = [], $absolute);
        $this->getManifestVersion('wireui.css', $route);

        return "<link href=\"{$route}\" rel=\"stylesheet\" type=\"text/css\">";
    }

    public function getManifestVersion(string $file, ?string &$route = null): ?string
    {
        $manifestPath = dirname(__DIR__, 2) . '/dist/mix-manifest.json';

        if (!file_exists($manifestPath)) {
            return null;
        }

        $manifest = json_decode(file_get_contents($manifestPath), $assoc = true);
        $version  = last(explode('=', $manifest["/{$file}"]));

        if ($route) {
            $route .= "?id={$version}";
        }

        return $version;
    }

    public function confirmAction(string $expression): string
    {
        return "onclick=\"window.\$wireui.confirmAction($expression, '{{ \$__livewire->getId() }}')\"";
    }

    public function notify(string $expression): string
    {
        return "onclick=\"window.\$wireui.notify($expression, '{{ \$__livewire->getId() }}')\"";
    }

    public function boolean(string $value): string
    {
        return "<?= json_encode(filter_var($value, FILTER_VALIDATE_BOOLEAN)); ?>";
    }

    /**
     * This function overwrite the original entangle directive from Livewire
     */
    public function entangleable(mixed $expression): string
    {
        $fallback = (string) Str::of($expression)->after(',')->trim();
        $property = (string) Str::of($expression)->before(',')->trim();

        return <<<EOT
        <?php if (!isset(\$__livewire)): ?>
            <?php if (is_object({$fallback}) || is_array({$fallback})) { echo "JSON.parse(atob('".base64_encode(json_encode({$fallback}))."'))"; } elseif (is_string({$fallback})) { echo "'".str_replace("'", "\'", {$fallback})."'"; } else { echo json_encode({$fallback}); } ?>
        <?php elseif ((object) ({$property}) instanceof \Livewire\WireDirective && {$property}->hasModifier('blur')): ?>
            window.Livewire.find('{{ \$__livewire->getId() }}').entangle('{{ {$property}->value() }}').live
        <?php elseif ((object) ({$property}) instanceof \Livewire\WireDirective) : ?>
            window.Livewire.find('{{ \$__livewire->getId() }}').entangle('{{ {$property}->value() }}'){{ {$property}->hasModifier('live') ? '.live' : '' }}
        <?php else : ?>
            window.Livewire.find('{{ \$__livewire->getId() }}').entangle('{{ {$property} }}')
        <?php endif; ?>
        EOT;
    }

    public function toJs(mixed $expression): string
    {
        return <<<EOT
        <?php if (is_object({$expression}) || is_array({$expression})) { echo "JSON.parse(atob('".base64_encode(json_encode({$expression}))."'))"; } elseif (is_string({$expression})) { echo "'".str_replace("'", "\'", {$expression})."'"; } else { echo json_encode({$expression}); } ?>
        EOT;
    }
}
