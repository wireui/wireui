<?php

namespace WireUi\View\Components\Wrapper;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use WireUi\Support\WrapperData;
use WireUi\Traits\Components\InteractsWithErrors;

class Base extends Component
{
    use InteractsWithErrors;

    public function __construct(
        ?WrapperData $data = null,
        public ?string $id = null,
        public ?string $icon = null,
        public ?string $name = null,
        public ?string $color = null,
        public ?string $label = null,
        public ?string $corner = null,
        public ?string $prefix = null,
        public ?string $shadow = null,
        public ?string $suffix = null,
        public ?bool $disabled = null,
        public ?bool $readonly = null,
        public ?string $padding = null,
        public ?string $rounded = null,
        public ?bool $errorless = null,
        public ?string $rightIcon = null,
        public ?bool $shadowless = null,
        public ?bool $invalidated = null,
        public ?string $description = null,
        public ?bool $withErrorIcon = true,
        public ?bool $withValidationColors = null,
        // Classes
        public mixed $colorClasses = null,
        public mixed $shadowClasses = null,
        public mixed $roundedClasses = null,
    ) {
        if ($data) {
            $this->fill($data->toArray());
        }

        $this->fillValidation($name);
    }

    public function fillValidation(?string $name): void
    {
        if ($this->invalidated === null) {
            $this->invalidated = $name && $this->errors()->has($this->name);
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
        return view('wireui::components.wrapper.base');
    }
}
