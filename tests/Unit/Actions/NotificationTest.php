<?php

namespace Tests\Unit\Actions;

use Mockery\Mock;
use Tests\Unit\TestCase;
use Tests\Unit\TestComponent;
use WireUi\Enum\Icon;

test('it should emit a notification event', function () {
    $event = 'wireui:notification';

    $params = [
        'componentId' => 'fake-id',
        'options' => [
            'icon' => Icon::SUCCESS,
            'title' => 'WireUI is awesome!',
        ],
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

test('it should emit a confirm notification event', function (?string $icon, string $expectedIcon) {
    $event = 'wireui:confirm-notification';

    $params = [
        'componentId' => 'fake-id',
        'options' => ['title' => 'Sure Delete?', 'icon' => $icon],
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

    $mock->notification()->confirm($params['options']);
})->with('notification::event');

test('it should emit the simple notification event', function (string $method) {
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
            'componentId' => 'fake-id',
            'options' => [
                'icon' => $method,
                'title' => $title = 'WireUI is awesome!',
                'description' => $description = 'WireUI is easy to use.',
            ],
        ]);

    $mock->notification()->{$method}($title, $description);
})->with('simple::notification::event');
