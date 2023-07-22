@props(['available' => true])

@php
    $width = $available ? 'w-1/5' : 'w-1/4';
@endphp

<div {{ $attributes->class('w-full mt-2 mb-6') }}>
    <h3 class="mb-1 text-sm font-semibold uppercase text-secondary-500">
        Options
    </h3>

    <div class="relative pb-2 mt-2 overflow-hidden bg-white border-2 rounded-lg shadow-md border-secondary-200 dark:bg-secondary-800 dark:border-secondary-600">
        <div class="overflow-y-auto soft-scrollbar">
            <table class="w-full text-left border-collapse">
                <thead class="border-b-2 dark:border-secondary-700">
                    <tr>
                        <th class="{{ $width }} text-sm font-semibold text-secondary-600 dark:text-secondary-400 bg-white dark:bg-secondary-800 p-2">
                            Prop
                        </th>
                        <th class="{{ $width }} text-sm font-semibold text-secondary-600 dark:text-secondary-400 bg-white dark:bg-secondary-800 p-2">
                            Required
                        </th>
                        <th class="{{ $width }} text-sm font-semibold text-secondary-600 dark:text-secondary-400 bg-white dark:bg-secondary-800 p-2">
                            Default
                        </th>
                        <th class="{{ $width }} text-sm font-semibold text-secondary-600 dark:text-secondary-400 bg-white dark:bg-secondary-800 p-2">
                            Type
                        </th>

                        @if ($available)
                            <th class="w-1/5 p-2 text-sm font-semibold bg-white text-secondary-600 dark:text-secondary-400 dark:bg-secondary-800">
                                Available
                            </th>
                        @endif
                    </tr>
                </thead>

                <tbody class="align-baseline">
                   {{ $slot }}
                </tbody>
            </table>
        </div>
    </div>
</div>
