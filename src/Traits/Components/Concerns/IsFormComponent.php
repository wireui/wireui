<?php

namespace WireUi\Traits\Components\Concerns;

use WireUi\Support\WrapperData;

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

    protected function formable(array &$data): void
    {
        $this->mergeAttributes($data);

        $this->extractAttributes($data);

        $data['attrs'] = $data['attributes'];

        $data['wrapperData'] = (new WrapperData($data))->except($this->except());

        $data['value'] = $this->attributes->get('value', $this->attributes->wire('model')->value());
    }
}
