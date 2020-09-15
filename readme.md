# Livewire UI

Livewire UI is a components pack to [Livewire]. Mobile friendly and modern with [Tailwind]

#### Prerequisites

- [Laravel 7+]
- [Livewire 2+]
- [SweetAlert2 10+]
- [Tailwind]

#### Installation

- Install composer package `composer require ph7jack/livewire-ui`
- Import **Livewire UI** scripts into your base layout, ex: `resources/views/components/layouts/my-layout.blade.php`
  ```
  <html>
      <head>
         ...
          @livewireUiAssets
      </head>
      ...
  </html>
  ```

#### Langs

- En-US

#### Components

[Images](https://drive.google.com/drive/folders/16tziiT-8UnXSITomKCpq3SKY5_HMJsNh?usp=sharing)

- Date Time Picker - `<livewire:livewire-ui:date-time-picker />`

| Params       | Description                                             | Value           | Default            | Required                          |
| ------------ | ------------------------------------------------------- | --------------- | ------------------ | --------------------------------- |
| label        | Label of input                                          | any string      |                    | Yes                               |
| model        | Name of variable on parent component                    | any string      |                    | Yes                               |
| sync-input   | Define if input call livewire hooks                     | boolean         | false              | No                                |
| select-date  | Set if date is selectable                               | boolean         | true               | No                                |
| select-time  | Set if time is selectable                               | boolean         | true               | No                                |
| mode         | Set default mode                                        | time or date    | date               | No                                |
| placeholder  | Placeholder of input                                    | any string      | mm/dd/yyyy 12:30pm | No                                |
| date-format  | Format of date displayed                                | carbon format   | m/d/Y h:ia         | No                                |
| date         | Date to fill component when mount                       | any date string |                    | No                                |
| parse-format | Format to parse initial date when component was mounted | carbon format   |                    | Required if **date** was informed |
| emit-format  | Format of date when input is emitted                    | carbon format   | m/d/Y h:ia         | No                                |

#### How to use

In parent component, ex: **Form.php**, configure this to share values between components

- import dynamic component trait `App\Traits\Livewire\DynamicComponent`
- create method `getExtendedModels` to set all extended models to Livewire UI components
- If you use listeners, don't use the method `getListeners`, use `getRawListeners` or `$listeners` property

```
// Project/App/Http/Livewire/Calendar/Form.php

<?php

namespace App\Http\Livewire\Calendar;

use App\Traits\Livewire\DynamicComponent;
use Livewire\Component;

class Form extends Component
{
    use DynamicComponent;

    public $date;

    protected $listeners = [
        'event-form:resetForm' => 'resetForm',
    ];

    public function getRawListeners()
    {
        return [
            'event-form:set-date' => 'resetForm',
        ];
    }

    public function render()
    {
        return view('livewire.form');
    }

    protected function getExtendedModels(): array
    {
        return [
            'components.date-time-picker' => 'date', // if use more of one model in this component, put in array ['date1', 'date2']
        ];
    }

    public function setDateValue($date)
    {
        $this->date = $date;
        $this->refreshExtendedModel('date'); // refresh an specifc extended model
    }

    public function resetForm()
    {
        $this->date = null;
        $this->refreshExtendedModels(); // refresh all extended models
    }
}


// Project/resources/views/livewire/form.blade.php
<div>
    <livewire:livewire-ui:date-time-picker label="Date" model="date" />
</div>
```

#### Tip

Your can customize default values in env or publishing configs

```
    'time_format'                 => env('TIME_FORMAT', 'h:ia'),
    'date_format'                 => env('DATE_FORMAT', 'm/d/Y'),
    'datetime_format'             => env('DATETIME_FORMAT', 'm/d/Y h:ia'),
    'placeholder_datetime_format' => env('PLACEHOLDER_DATETIME_FORMAT', 'mm/dd/yyyy 12:30pm'),
```

You can publish assets (config, lang) and configure
`php artisan vendor:publish --tag=livewire-ui`

## License

MIT
**Free Software, Hell Yeah!**

[livewire]: https://laravel-livewire.com/
[livewire 2+]: https://laravel-livewire.com/
[laravel 7+]: https://laravel.com/
[sweetalert2 10+]: https://sweetalert2.github.io/
[tailwind]: https://tailwindcss.com/
