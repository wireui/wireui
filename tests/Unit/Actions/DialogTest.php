<?php

use Mockery\Mock;
use Tests\Unit\{LivewireComponent, UnitTestCase};
use WireUi\Actions\Dialog;

it('should create the default dialog event name')
    ->and(Dialog::makeEventName())
    ->toBe('dialog');

it('should create the dialog event name')
    ->and(Dialog::makeEventName('foo'))
    ->toBe('dialog:foo');

it('should create the dialog event name to a custom dialog', function () {
    $dialog = new Dialog(new LivewireComponent());

    $dialog->id('foo');

    /** @var UnitTestCase $this */
    $event = $this->invokeMethod($dialog, 'getEventName');

    $this->assertSame('dialog:foo', $event);
});

it('should emit a dialog event', function (?string $icon, string $expectedIcon) {
    $event  = 'wireui:dialog';
    $params = [
        'options' => [
            'title' => 'WireUI is awesome!',
            'icon'  => $icon,
        ],
        'componentId' => 'fake-id',
    ];

    /** @var UnitTestCase $this */
    $mock = $this->getMockBuilder(LivewireComponent::class)
        ->onlyMethods(['dispatchBrowserEvent'])
        ->getMock();

    /** @var Mock|LivewireComponent $mock */
    $mock
        ->expects($this->once())
        ->method('dispatchBrowserEvent')
        ->with($event, [
            'options' => [
                'title' => 'WireUI is awesome!',
                'icon'  => $expectedIcon,
            ],
            'componentId' => 'fake-id',
        ]);

    $mock->dialog()->show($params['options']);
})->with([
    ['home', 'home'],
    [null, Dialog::INFO], // assert the default icon
]);

it('should emit a confirm dialog event', function (?string $icon, string $expectedIcon) {
    $event  = 'wireui:confirm-dialog';
    $params = [
        'options'     => ['title' => 'User created!', 'icon' => $icon],
        'componentId' => 'fake-id',
    ];

    /** @var UnitTestCase $this */
    $mock = $this->getMockBuilder(LivewireComponent::class)
        ->onlyMethods(['dispatchBrowserEvent'])
        ->getMock();

    /** @var Mock|LivewireComponent $mock */
    $mock
        ->expects($this->once())
        ->method('dispatchBrowserEvent')
        ->with($event, [
            'options' => [
                'title' => 'User created!',
                'icon'  => $expectedIcon,
            ],
            'componentId' => 'fake-id',
        ]);

    $mock->dialog()->confirm($params['options']);
})->with([
    ['home', 'home'],
    [null, Dialog::QUESTION], // assert the default icon
]);

it('should emit the simple dialog event', function (string $method) {
    $event = 'wireui:dialog';

    /** @var UnitTestCase $this */
    $mock = $this->getMockBuilder(LivewireComponent::class)
        ->onlyMethods(['dispatchBrowserEvent'])
        ->getMock();

    /** @var Mock|LivewireComponent $mock */
    $mock
        ->expects($this->once())
        ->method('dispatchBrowserEvent')
        ->with($event, [
            'options' => [
                'title'       => 'Test Title!',
                'icon'        => $method,
                'description' => 'Test Description..',
            ],
            'componentId' => 'fake-id',
        ]);

    $mock->dialog()->{$method}('Test Title!', 'Test Description..');
})->with([
    'success',
    'error',
    'info',
    'warning',
]);
