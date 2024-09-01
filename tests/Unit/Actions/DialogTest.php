<?php

namespace Tests\Unit\Actions;

use Mockery\Mock;
use Tests\Unit\TestCase;
use Tests\Unit\TestComponent;
use WireUi\Actions\Dialog;

test('it should create the default dialog event name', function () {
    expect(Dialog::makeEventName())->toBe('dialog');
});

test('it should create the dialog event name', function () {
    expect(Dialog::makeEventName('foo'))->toBe('dialog:foo');
});

test('it should create the dialog event name to a custom dialog', function () {
    $dialog = new Dialog(new TestComponent);

    $dialog->id('foo');

    /** @var TestCase $this */
    $event = $this->invokeMethod($dialog, 'getEventName');

    $this->assertSame('dialog:foo', $event);
});

test('it should emit a dialog event', function (?string $icon, string $expectedIcon) {
    $event = 'wireui:dialog';

    $params = [
        'componentId' => 'fake-id',
        'options' => ['title' => 'WireUI is awesome!', 'icon' => $icon],
    ];

    /** @var TestCase $this */
    $mock = $this->getMockBuilder(TestComponent::class)
        ->onlyMethods(['dispatch'])
        ->getMock();

    /** @var Mock|TestComponent $mock */
    $mock
        ->expects($this->once())
        ->method('dispatch')
        ->with($event, data_set($params, 'options.icon', $expectedIcon));

    $mock->dialog()->show($params['options']);
})->with('dialog::event');

test('it should emit a confirm dialog event', function (?string $icon, string $expectedIcon) {
    $event = 'wireui:confirm-dialog';

    $params = [
        'componentId' => 'fake-id',
        'options' => ['title' => 'User created!', 'icon' => $icon],
    ];

    /** @var TestCase $this */
    $mock = $this->getMockBuilder(TestComponent::class)
        ->onlyMethods(['dispatch'])
        ->getMock();

    /** @var Mock|TestComponent $mock */
    $mock
        ->expects($this->once())
        ->method('dispatch')
        ->with($event, data_set($params, 'options.icon', $expectedIcon));

    $mock->dialog()->confirm($params['options']);
})->with('dialog::confirm::event');

test('it should emit the simple dialog event', function (string $method) {
    $event = 'wireui:dialog';

    /** @var TestCase $this */
    $mock = $this->getMockBuilder(TestComponent::class)
        ->onlyMethods(['dispatch'])
        ->getMock();

    /** @var Mock|TestComponent $mock */
    $mock
        ->expects($this->once())
        ->method('dispatch')
        ->with($event, [
            'componentId' => 'fake-id',
            'options' => [
                'title' => 'Test Title!',
                'icon' => $method,
                'description' => 'Test Description..',
            ],
        ]);

    $mock->dialog()->{$method}('Test Title!', 'Test Description..');
})->with('simple::dialog::event');
