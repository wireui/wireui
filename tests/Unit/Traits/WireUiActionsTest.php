<?php

namespace Tests\Unit\Traits;

use Mockery\Mock;
use Tests\Unit\TestCase;
use Tests\Unit\TestComponent;
use WireUi\Enum\Icon;

test('it should emit a dialog event when the method dialog is called with a non empty array', function () {
    $event = 'wireui:dialog';

    $params = [
        'componentId' => 'fake-id',
        'options' => ['title' => 'WireUI is awesome!'],
    ];

    /** @var TestCase $this */
    $mock = $this->getMockBuilder(TestComponent::class)
        ->onlyMethods(['dispatch'])
        ->getMock();

    /** @var Mock|TestComponent $mock */
    $mock
        ->expects($this->once())
        ->method('dispatch')
        ->with($event, data_set($params, 'options.icon', Icon::INFO));

    $mock->dialog()->show($params['options']);
});

test('it should emit a notification event when the method notification is called with a non empty array', function () {
    $event = 'wireui:notification';

    $params = [
        'componentId' => 'fake-id',
        'options' => ['title' => 'WireUI is awesome!'],
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
