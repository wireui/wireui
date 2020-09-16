<div class="w-full select-none">
    <label for="{{ $this->id }}-date-input"
           class="mb-1 block text-sm font-medium leading-5 text-gray-700">
        {{ $label }}
    </label>

    <div class="relative">
        <div>
            <input id="{{ $this->id }}-date-input"
                   wire:model.debounce.500ms="date"
                   wire:change="saveInput($event.target.value)"
                   autocomplete="disabled"
                   type="text"
                   class="w-full form-input block py-2 px-3 border border-gray-300 rounded-md shadow-sm
                        focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150
                        ease-in-out sm:text-sm sm:leading-5"
                   placeholder="{{ $placeholder }}">
        </div>

        <div onclick="$openDatePicker('{{ $this->id }}')"
             class="absolute cursor-pointer top-0 right-0 px-3"
             style="padding-top: 6px">
            <x-lw-ui.icon.spinner wire:loading color="#666" class="w-5 h-5 mr-1" />
            <x-lw-ui.icon.calendar wire:loading.remove class="h-6 w-6 text-gray-400" />
        </div>

        <x-lw-ui.error name="date" />

        <div id="{{ $this->id }}-date-picker-container"
            style="z-index: 999; backdrop-filter: blur(5px);"
            class="fixed inset-0 overflow-y-auto lw-ui-fade-hide">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div onclick="$closeDatePicker('{{ $this->id }}')" class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-black" style="opacity: 0.45"></div>
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;

                <div class="date-picker-modal inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden
                        lw-ui-shadow transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6"
                     role="dialog"
                     aria-modal="true"
                     aria-labelledby="modal-headline">
                    <div>
                        @if($mode === 'date')
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <div>
                                        <span class="text-lg font-bold text-gray-800">{{ $monthName }}</span>
                                        <span class="ml-1 text-lg text-gray-600 font-normal">
                                            <input wire:change="setYear($event.target.value)"
                                                   class="w-16 focus:outline-none"
                                                   type="number"
                                                   value="{{ $year }}">
                                        </span>
                                    </div>
                                    <div>
                                        <button wire:click="previousMonth"
                                                type="button"
                                                class="transition focus:outline-none ease-in-out duration-100 inline-flex
                                                cursor-pointer hover:bg-gray-200 p-1 rounded-full">
                                            <x-lw-ui.icon.chevron-left class="h-6 w-6 text-gray-500 inline-flex" />
                                        </button>

                                        <button wire:click="nextMonth"
                                                type="button"
                                                class="transition focus:outline-none ease-in-out duration-100 inline-flex
                                                cursor-pointer hover:bg-gray-200 p-1 rounded-full">
                                            <x-lw-ui.icon.chevron-right class="h-6 w-6 text-gray-500 inline-flex" />
                                        </button>
                                    </div>
                                </div>

                                <div class="flex flex-wrap mb-3 -mx-1">
                                    @foreach($dayNames as $name)
                                        <div style="width: 14.26%" class="px-1">
                                            <div class="text-gray-800 font-medium text-center text-xs">{{ $name }}</div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="flex flex-wrap -mx-1">
                                    @foreach($days as $day)
                                        <div wire:click="selectDate('{{ $day->date }}')" style="width: 14.28%" class="px-1 mb-1">
                                            <div class="{{ $this->isToday($day->date) ? 'border border-gray-500 font-semibold':'' }}
                                                {{ $this->isSelected($day->date) ? 'bg-blue-500 text-white':'' }}
                                                {{ $this->isActualMonth($day->month) ? '':'text-gray-500' }}
                                                hover:bg-blue-500 hover:text-white cursor-pointer text-center text-sm
                                                rounded-full leading-loose transition ease-in-out duration-100">
                                                {{ $day->number }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if($mode === 'time')
                            <div class="flex">
                                <div class="w-full">
                                    <div class="p-5 mx-auto">
                                        <div class="flex justify-center">
                                            <input id="{{ $this->id }}-hour-input"
                                                   class="w-10 text-center focus:outline-none"
                                                   placeholder="12"
                                                   type="text">

                                            <span class="text-xl mx-2">:</span>

                                            <input id="{{ $this->id }}-minutes-input"
                                                   class="w-10 text-center focus:outline-none"
                                                   placeholder="30"
                                                   type="text">

                                            <select id="{{ $this->id }}-period"
                                                    name="period"
                                                    class="bg-transparent appearance-none outline-none">
                                                <option value="am">am</option>
                                                <option value="pm">pm</option>
                                            </select>
                                        </div>
                                    </div>

                                    <button onclick="$saveTime('{{ $this->id }}')"
                                            type="button"
                                            class="w-full bg-blue-500 p-1 text-center items-center text-xs font-medium
                                                rounded-full text-white focus:outline-none ease-in-out duration-150">
                                            {{ __('livewire-ui::messages.save') }}
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@once
    <script type="text/javascript">
        function $openDatePicker(id) {
            const element = $getDatePickerContainer(id)
            element.classList.remove('lw-ui-fade-hide')
            element.classList.add('lw-ui-fade-show')
        }

        function $closeDatePicker(id) {
            const element = $getDatePickerContainer(id)
            element.classList.remove('lw-ui-fade-show')
            element.classList.add('lw-ui-fade-hide')
            $livewireCall(id, 'setDefaultMode')
        }

        function $getDatePickerContainer(id) {
            return $getElement(`${id}-date-picker-container`)
        }

        function $saveTime(id) {
            const hour    = document.getElementById(`${id}-hour-input`).value
            const minutes = document.getElementById(`${id}-minutes-input`).value
            const period  = document.getElementById(`${id}-period`).value

            if (hour > 12 || hour < 1 || hour.length !== 2) {
                return this.$livewireUi.alert({ icon: 'error', title: "{{ __('livewire-ui::messages.invalid_hour') }}" })
            }

            if (minutes > 59 || minutes < 0 || minutes.length !== 2) {
                return this.$livewireUi.alert({ icon: 'error', title: "{{ __('livewire-ui::messages.invalid_minutes') }}" })
            }

            const time = `${hour}:${minutes}${period}`

            if (time.length !== 7) {
                return this.$livewireUi.alert({ icon: 'error', title: "{{ __('livewire-ui::messages.invalid_time_format') }}" })
            }

            $livewireCall(id, 'selectTime', time)
        }

        document.addEventListener('livewire:load', () => {
            this.livewire.on('livewire-ui:date-time-picker:setVisibility', data => {
                if (data.status) {
                    $openDatePicker(data.id)
                }
            })

            this.livewire.on('livewire-ui:date-time-picker:setTimeInput', data => {
                document.getElementById(`${data.id}-hour-input`).value    = data.hour
                document.getElementById(`${data.id}-minutes-input`).value = data.minutes
                document.getElementById(`${data.id}-period`).value        = data.period
            })
        })
    </script>
@endonce
