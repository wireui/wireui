<?php

namespace WireUi\Traits\Components;

use Closure;
use Illuminate\Contracts\View\View;
use WireUi\Support\Form\WrapperData;
use WireUi\Traits\Components\Concerns\{
    HasAttributesExtraction,
    HasSharedAttributes,
    InteractsWithErrors,
};

trait IsFormComponent
{
    use HasAttributesExtraction;
    use HasSharedAttributes;
    use InteractsWithErrors;

    protected function except(): array
    {
        return [];
    }

    protected function sharedAttributes(): array
    {
        return WrapperData::shared();
    }

    protected function extractableAttributes(): array
    {
        return WrapperData::extractable();
    }

    public function render(): Closure
    {
        return function (array $data): string {
            $data = $this->mergeAttributes($data);
            $data = $this->extractAttributes($data);

            $data['wrapperData'] = (new WrapperData($data))->except($this->except());

            $data['attrs'] = $data['attributes'];

            // dd($data);

            return $this->blade()
                ->with($data)
                ->render();
        };
    }

    abstract protected function blade(): View;
}
