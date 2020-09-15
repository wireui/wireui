<?php

namespace PH7JACK\LivewireUi\Components;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Livewire\Component;
use PH7JACK\LivewireUi\Traits\Actions;
use PH7JACK\LivewireUi\Traits\DynamicChildComponent;

class DateTimePicker extends Component
{
    use DynamicChildComponent, Actions;

    public $label;

    public $model;

    public $format;

    public $internalDateFormat = 'Y-m-d';

    public $internalTimeFormat;

    public $dateFormat;

    public $parseFormat;

    public $emitFormat;

    public $defaultMode;

    public $mode;

    public $date;

    public $time;

    public $selectDate;

    public $selectTime;

    public $placeholder;

    public $dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

    public $month;

    public $monthName;

    public $year;

    public $days;

    public function mount(
        $label,
        $model,
        $syncInput = false,
        $selectDate = true,
        $selectTime = true,
        $mode = 'date',
        $placeholder = null,
        $dateFormat = null,
        $date = null,
        $parseFormat = null,
        $emitFormat = null
    ) {
        if (!$dateFormat) {
            $dateFormat = config('livewire-ui.date_format');
        }

        $this->internalTimeFormat = config('livewire-ui.time_format');

        $timeFormat = $this->internalTimeFormat;
        $baseFormat = $dateFormat;

        if ($selectTime) {
            $baseFormat .= " {$timeFormat}";
            $baseFormat = trim($baseFormat);
        }

        $this->fill([
            'model'       => $model,
            'mode'        => $mode,
            'defaultMode' => $mode,
            'label'       => $label,
            'syncInput'   => $syncInput,
            'placeholder' => $placeholder ?? config('livewire-ui.placeholder_datetime_format'),
            'format'      => $baseFormat,
            'dateFormat'  => $dateFormat,
            'parseFormat' => $parseFormat,
            'selectDate'  => $selectDate,
            'selectTime'  => $selectTime,
            'emitFormat'  => $emitFormat,
        ]);

        if ($date) {
            $date = Carbon::createFromFormat($this->parseFormat, $date);
            $this->setDate($date);
        }

        $this->setCalendar(Carbon::now());
    }

    public function render()
    {
        $this->fillCalendar();

        return view('livewire-ui::date-time-picker');
    }

    protected function getModelName(): string
    {
        return $this->model;
    }

    protected function getInputValue(): ?string
    {
        if ($this->emitFormat) {
            $date = Carbon::createFromFormat($this->format, $this->date);

            return $date->format($this->emitFormat);
        }

        return $this->date;
    }

    protected function getInputName(): string
    {
        return 'date';
    }

    public function setDefaultMode()
    {
        $this->mode = $this->defaultMode;
    }

    public function saveInput($date): void
    {
        if (!$date) {
            $this->date = null;
            $this->time = null;
            $this->emitInput();

            return;
        }

        $this->validateDate();

        $date       = Carbon::createFromFormat($this->format, $date);
        $this->date = $date->format($this->format);
        $this->time = $date->format($this->internalTimeFormat);
        $this->emitInput();
    }

    public function validateDate()
    {
        $rules = ['date' => ['nullable', "date_format:$this->format"]];

        return $this->validateOnly('date', $rules);
    }

    public function updated()
    {
        $this->validateDate();
    }

    public function setDate($date)
    {
        if (!$date) {
            return;
        }

        $date       = Carbon::parse($date);
        $this->date = $date->format($this->format);

        if ($this->selectTime) {
            $this->time = $date->format($this->internalTimeFormat);
        }
    }

    public function setDatePickerVisibility($visibility)
    {
        $this->emit('livewire-ui:date-time-picker:setVisibility', [
            'id'     => $this->id,
            'status' => $visibility,
        ]);
    }

    public function isToday($date)
    {
        return Carbon::parse($date)->isToday();
    }

    public function isSelected($date)
    {
        $date = Carbon::parse($date)->format($this->dateFormat);

        return Str::contains($this->date, $date);
    }

    public function isActualMonth($month)
    {
        return $month == $this->month;
    }

    public function setYear($year)
    {
        if ($year > 1900) {
            $this->year = $year;
        }

        $this->setDatePickerVisibility(true);
    }

    public function previousMonth()
    {
        $this->month--;
        $this->setDatePickerVisibility(true);
    }

    public function nextMonth()
    {
        $this->month++;
        $this->setDatePickerVisibility(true);
    }

    public function setCalendar(Carbon $date)
    {
        $this->monthName = $date->format('F');
        $this->month     = $date->format('m');
        $this->year      = $date->format('Y');
    }

    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    public function emitTime(Carbon $time)
    {
        $this->emit('livewire-ui:date-time-picker:setTimeInput', [
            'id'      => $this->id,
            'hour'    => $time->format('h'),
            'minutes' => $time->format('i'),
            'period'  => $time->format('a'),
        ]);
    }

    public function selectDate($date)
    {
        $now        = Carbon::now();
        $date       = Carbon::parse($date . " " . $this->time ?? $now->format($this->internalTimeFormat));
        $visibility = false;

        if ($this->selectTime) {
            $time       = $this->time ? Carbon::createFromFormat($this->internalTimeFormat, $this->time) : $now;
            $this->mode = 'time';
            $visibility = true;
            $hour       = $time->format('H');
            $minutes    = $time->format('i');
            $date->setTime($hour, $minutes);
            $this->emitTime($time);
        }

        $this->setSelectedDate($date, $visibility);
    }

    public function selectTime($time)
    {
        $validator = Validator::make(['time' => $time], ['time' => "date_format:$this->internalTimeFormat"]);
        if ($validator->fails()) {
            $this->setDatePickerVisibility(true);

            return $this->showAlert([
                'icon'  => 'error',
                'title' => __('livewire-ui::messages.invalid_time_format'),
            ]);
        }

        $this->time = $time;
        $this->joinDateTime();
    }

    public function joinDateTime()
    {
        $date       = Carbon::createFromFormat($this->format, $this->date)->format($this->dateFormat);
        $this->date = "$date $this->time";
        $this->emitInput();
        $this->setDatePickerVisibility(false);
        $this->mode = 'date';
    }

    public function setSelectedDate(Carbon $date, $visibility = false)
    {
        $this->date = $date->format($this->format);
        $this->setCalendar($date);
        $this->setDatePickerVisibility($visibility);
        $this->validateDate();
        $this->emitInput();

        if ($this->selectTime) {
            $this->emitTime($date);
        }
    }

    public function fillCalendar()
    {
        $day  = 1;
        $date = Carbon::createFromDate($this->year, $this->month, $day);
        $this->setCalendar($date);

        $days      = [];
        $dayOfWeek = $date->dayOfWeek;
        $date->subDays($dayOfWeek);

        do {
            for ($i = 0; $i < 7; $i++) {
                $days[] = $this->formatDay($date);
                $date->addDay();
            }
        } while ($date->month == $this->month);

        $this->days = $days;
    }

    public function formatDay(Carbon $date): object
    {
        return (object)[
            'number' => $date->day,
            'month'  => $date->month,
            'date'   => $date->format($this->internalDateFormat),
        ];
    }
}
