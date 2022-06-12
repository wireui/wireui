<?php

namespace Tests\Unit\View\Components;

use Illuminate\View\ComponentAttributeBag;
use Tests\Unit\UnitTestCase;
use WireUi\View\Components\FormComponent;

class TestFormComponent extends FormComponent
{
    public string $name = 'Pedro Oliveira';

    protected function getView(): string
    {
        return 'fake-view';
    }

    protected function sharedAttributes(): array
    {
        return ['name', 'id'];
    }
}

class FormComponentTest extends UnitTestCase
{
    /** @test */
    public function it_should_inject_the_shared_attributes_from_class_and_from_the_attributes_bag()
    {
        $data = [
            'componentName' => 'TestFormComponent',
            'attributes'    => new ComponentAttributeBag(['id' => 'test-id']),
            'slot'          => null,
        ];

        $component = new TestFormComponent();

        $mergedData = $this->invokeMethod($component, 'mergeAttributes', [$data]);

        /** @var ComponentAttributeBag $attributes */
        $attributes = $mergedData['attributes'];

        $this->assertSame('Pedro Oliveira', $attributes->get('name'));
        $this->assertSame('test-id', $mergedData['id']);
    }
}
