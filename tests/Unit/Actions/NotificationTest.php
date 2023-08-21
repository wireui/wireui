<?php

use Mockery\Mock;
use Tests\Unit\{LivewireComponent, UnitTestCase};
use WireUi\Actions\Notification;

it('should emit a notification event', function () {
    $event  = 'wireui:notification';
    $params = [
        'options' => [
            'title' => 'WireUI is awesome!',
            'icon'  => Notification::SUCCESS,
        ],
        'componentId' => 'fake-id',
    ];

    $component = new LivewireComponent();

    $method = method_exists($component, 'dispatchBrowserEvent')
        ? 'dispatchBrowserEvent'
        : 'dispatch';

    /** @var UnitTestCase $this */
    $mock = $this->getMockBuilder(LivewireComponent::class)
        ->onlyMethods([$method])
        ->getMock();

    /** @var Mock|LivewireComponent $mock */
    $mock
        ->expects($this->once())
        ->method($method)
        ->with($event, $params);

    $mock->notification()->send($params['options']);
});

it('should emit a confirm notification event', function (?string $icon, string $expectedIcon) {
    $event  = 'wireui:confirm-notification';
    $params = [
        'options'     => ['title' => 'Sure Delete?', 'icon' => $icon],
        'componentId' => 'fake-id',
    ];

    $component = new LivewireComponent();

    $method = method_exists($component, 'dispatchBrowserEvent')
        ? 'dispatchBrowserEvent'
        : 'dispatch';

    /** @var UnitTestCase $this */
    $mock = $this->getMockBuilder(LivewireComponent::class)
        ->onlyMethods([$method])
        ->getMock();

    /** @var Mock|LivewireComponent $mock */
    $mock
        ->expects($this->once())
        ->method($method)
        ->with($event, [
            'options' => [
                'title' => 'Sure Delete?',
                'icon'  => $expectedIcon,
            ],
            'componentId' => 'fake-id',
        ]);

    $mock->notification()->confirm($params['options']);
})->with([
    ['home', 'home'],
    [null, Notification::QUESTION], // assert the default icon
]);

it('should emit the simple notification event', function (string $method) {
    $event = 'wireui:notification';

    $component = new LivewireComponent();

    $dispatchMethod = method_exists($component, 'dispatchBrowserEvent')
        ? 'dispatchBrowserEvent'
        : 'dispatch';

    /** @var UnitTestCase $this */
    $mock = $this->getMockBuilder(LivewireComponent::class)
        ->onlyMethods([$dispatchMethod])
        ->getMock();

    /** @var Mock|LivewireComponent $mock */
    $mock
        ->expects($this->once())
        ->method($dispatchMethod)
        ->with($event, [
            'options' => [
                'icon'        => $method,
                'title'       => $title = 'WireUI is awesome!',
                'description' => $description = 'WireUI is easy to use.',
            ],
            'componentId' => 'fake-id',
        ]);

    $mock->notification()->{$method}($title, $description);
})->with([
    'success',
    'error',
    'info',
    'warning',
]);
