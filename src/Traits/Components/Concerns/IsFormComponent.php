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

    protected function finished(array &$data): void
    {
        $this->mergeAttributes($data);

        $this->extractAttributes($data);

        $data['attrs'] = $data['attributes'];

        $data['wrapperData'] = (new WrapperData($data))->except($this->except());
    }
}
