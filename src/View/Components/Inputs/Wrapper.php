<?php

namespace WireUi\View\Components\Inputs;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use WireUi\Support\Form\WrapperData;
use WireUi\Traits\Components\Concerns\{HasFillableProperties, InteractsWithErrors};

class Wrapper extends Component
{
    use HasFillableProperties;
    use InteractsWithErrors;

    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?string $label = null,
        public ?string $corner = null,
        public ?string $description = null,
        public ?string $prefix = null,
        public ?string $suffix = null,
        public ?string $icon = null,
        public ?string $rightIcon = null,
        public ?string $padding = null,
        public ?bool $invalidated = null,
        public ?bool $withErrorIcon = true,
        public ?bool $withValidationColors = null,
        public ?bool $disabled = null,
        public ?bool $readonly = null,
        public ?bool $errorless = null,
        public ?bool $borderless = null, // todo
        public ?bool $shadowless = null, // todo
        WrapperData $data = null,
    ) {
        // dd($data, $this);
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

    public function render(): View
    {
        return view('wireui::components.inputs.wrapper');
    }
}
