<?php

namespace WireUi\Components\Wrapper;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use WireUi\Support\WrapperData;
use WireUi\Traits\Components\InteractsWithErrors;

class Switcher extends Component
{
    use InteractsWithErrors;

    public function __construct(
        ?WrapperData $data = null,
        public ?string $id = null,
        public ?string $name = null,
        public ?string $label = null,
        public ?bool $disabled = null,
        public ?bool $readonly = null,
        public ?bool $errorless = null,
        public ?bool $invalidated = null,
        public ?string $leftLabel = null,
        public ?string $description = null,
        public ?bool $withValidationColors = null,
    ) {
        if ($data) {
            $this->fill($data->toArray());
        }

        $this->fillValidation();
    }

    public function fillValidation(): void
    {
        if ($this->invalidated === null) {
            $this->invalidated = $this->name && $this->errors()->has($this->name);
        }
    }

    protected function fill(array $data): void
    {
        foreach ($data as $property => $value) {
            if (property_exists($this, $property) && $this->{$property} === null) {
                $this->{$property} = $value;
            }
        }
    }

    public function render(): View
    {
        return view('wireui-wrapper::switcher');
    }
}
