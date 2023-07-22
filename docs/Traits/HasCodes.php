<?php

namespace WireUiDocs\Traits;

use WireUi\Traits\WireUiActions;

trait HasCodes
{
    use WireUiActions;

    public ?string $normalPicker = null;

    public ?string $customFormat = '12-05-2021 13:40';

    public ?string $displayFormat = '';

    public ?string $withoutTimezone = '';

    public ?string $mixAndMaxDates = null;

    public ?string $mixAndMaxTimes = null;

    public function mountHasCodes(): void
    {
        $this->addError('name', 'The name field is required');
        $this->addError('email', 'You must inform a valid email');
        $this->addError('address', 'This address is invalid');
        $this->addError('phone', 'The phone field is required');
    }

    public function sleeping(): void
    {
        sleep(2);
    }

    public function notify()
    {
        $this->notification()->success('Welcome to WireUI Docs!');
    }

    public function dialog()
    {
        $this->dialog()->id('custom')->show([
            'style' => 'center',
        ]);
    }

    public function openBlur(): void
    {
        $this->openModal('blurModal');
    }

    public function closeBlur(): void
    {
        $this->closeModal('blurModal');
    }
}
