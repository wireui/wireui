<?php

use Mockery\Mock;
use Tests\Unit\{TestCase, TestComponent};
use WireUi\Enum\Actions;

it('should emit a notification event', function () {
    $event  = 'wireui:notification';
    $params = [
        'options' => [
            'title' => 'WireUI is awesome!',
            'icon'  => Actions::SUCCESS,
        ],
        'componentId' => 'fake-id',
    ];

    /** @var TestCase $this */
    $mock = $this->getMockBuilder(TestComponent::class)
        ->onlyMethods(['dispatch'])
        ->getMock();

    /** @var Mock|TestComponent $mock */
    $mock
        ->expects($this->once())
        ->method('dispatch')
        ->with($event, $params);

    $mock->notification()->send($params['options']);
});

it('should emit a confirm notification event', function (?string $icon, string $expectedIcon) {
    $event  = 'wireui:confirm-notification';
    $params = [
        'options'     => ['title' => 'Sure Delete?', 'icon' => $icon],
        'componentId' => 'fake-id',
    ];

    /** @var TestCase $this */
    $mock = $this->getMockBuilder(TestComponent::class)
        ->onlyMethods(['dispatch'])
        ->getMock();

    /** @var Mock|TestComponent $mock */
    $mock
        ->expects($this->once())
        ->method('dispatch')
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
    [null, Actions::QUESTION], // assert the default icon
]);

it('should emit the simple notification event', function (string $method) {
    $event = 'wireui:notification';

    /** @var TestCase $this */
    $mock = $this->getMockBuilder(TestComponent::class)
        ->onlyMethods(['dispatch'])
        ->getMock();

    /** @var Mock|TestComponent $mock */
    $mock
        ->expects($this->once())
        ->method('dispatch')
        ->with($event, [
            'options' => [
                'icon'        => $method,
                'title'       => $title       = 'WireUI is awesome!',
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
