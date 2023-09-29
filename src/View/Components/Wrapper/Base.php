<?php

namespace WireUi\View\Components\Wrapper;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use WireUi\Support\WrapperData;
use WireUi\Traits\Components\Concerns\{HasFillableProperties, InteractsWithErrors};

class Base extends Component
{
    use HasFillableProperties;
    use InteractsWithErrors;

    public ?string $id = null;

    public ?string $icon = null;

    public ?string $name = null;

    public ?string $color = null;

    public ?string $label = null;

    public ?string $corner = null;

    public ?string $prefix = null;

    public ?string $shadow = null;

    public ?string $suffix = null;

    public ?bool $disabled = null;

    public ?bool $readonly = null;

    public ?string $rounded = null;

    public ?bool $errorless = null;

    public ?string $rightIcon = null;

    public ?bool $shadowless = null;

    public ?string $description = null;

    public ?bool $invalidated = null;

    public ?bool $withValidationColors = null;

    /**
     * Classes to be applied to the input element.
     */
    public mixed $colorClasses = null;

    public mixed $shadowClasses = null;

    public mixed $roundedClasses = null;

    public ?string $padding = null;

    public ?bool $withErrorIcon = true;

    // public function __construct(
    //     public ?string $id = null,
    //     public ?string $name = null,
    //     public ?string $label = null,
    //     public ?string $corner = null,
    //     public ?string $description = null,
    //     public ?string $prefix = null,
    //     public ?string $suffix = null,
    //     public ?string $icon = null,
    //     public ?string $rightIcon = null,
    //     public ?string $padding = null,
    //     public ?bool $invalidated = null,
    //     public ?bool $withErrorIcon = true,
    //     public ?bool $withValidationColors = null,
    //     public ?bool $disabled = null,
    //     public ?bool $readonly = null,
    //     public ?bool $errorless = null,
    //     public ?bool $borderless = null, // todo
    //     public ?bool $shadowless = null, // todo
    //     WrapperData $data = null,
    // ) {

    public function __construct(WrapperData $data)
    {
        // dd($data, $this);

        // if ($data) {
        //     $this->fill($data->toArray());
        // }

        // $this->fillValidation($name);

        $this->fill($data->toArray());

        $this->fillValidation();
    }

    public function fillValidation(): void
    {
        if ($this->invalidated === null) {
            $this->invalidated = $this->name && $this->errors()->has($this->name);
        }
    }

    public function render(): View
    {
        return view('wireui::components.wrapper.input.base');
    }
}
