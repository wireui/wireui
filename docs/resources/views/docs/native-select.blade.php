<x-docs-scope :page="$page">
    {{-- Summary --}}
    <x-docs::summary>
        <x-docs::summary.header href="#native-select" label="Native Select">
            <x-docs::summary.item href="#simple-options" label="Simple Options" />
            <x-docs::summary.item href="#custom-options" label="Custom Options" />
            <x-docs::summary.item href="#option-with-description" label="Option With Description" />
            <x-docs::summary.item href="#slot-options" label="Slot Options" />
        </x-docs::summary.header>

        <x-docs::summary.header href="#native-select-options" label="Native Select Options" />
    </x-docs::summary>

    {{-- Section --}}
    <x-docs::title id="native-select" title="Native Select" />

    <x-docs::text>
        The Native Select component has support to render default html select with slot or options prop. See Examples.
    </x-docs::text>

    <x-docs::subtitle id="simple-options" title="Simple Options" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm mx-auto">
            @verbatim
                <x-native-select label="Select Status" placeholder="Select one status" :options="['Active', 'Pending', 'Stuck', 'Done']"
                    wire:model.defer="model" />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="custom-options" title="Custom Options" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm mx-auto">
            @verbatim
                <x-native-select label="Select Status" :options="[
                    ['name' => 'Active', 'id' => 1],
                    ['name' => 'Pending', 'id' => 2],
                    ['name' => 'Stuck', 'id' => 3],
                    ['name' => 'Done', 'id' => 4],
                ]" option-label="name" option-value="id"
                    wire:model.defer="model" />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="option-with-description" title="Option With Description" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm mx-auto">
            @verbatim
                <x-native-select label="Order Status" placeholder="Select one status" :options="[
                    ['name' => 'Active', 'id' => 1, 'description' => 'The status is active'],
                    ['name' => 'Pending', 'id' => 2, 'description' => 'The status is pending'],
                    ['name' => 'Stuck', 'id' => 3, 'description' => 'The status is stuck'],
                    ['name' => 'Done', 'id' => 4, 'description' => 'The status is done'],
                ]" option-label="name"
                    option-value="id" wire:model.defer="model" />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="slot-options" title="Slot Options" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm mx-auto">
            @verbatim
                <x-native-select label="Select Status" wire:model.defer="model">
                    <option>Active</option>
                    <option>Pending</option>
                    <option>Stuck</option>
                    <option>Done</option>
                </x-native-select>
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    {{-- Section --}}
    <x-docs::title id="native-select-options" title="Native Select Options" />

    <x-docs::table class="w-full mt-2 mb-6" :available="false">
        <x-docs::table.row prop="label" required="false" default="none" type="string" />
        <x-docs::table.row prop="placeholder" required="false" default="none" type="string" />
        <x-docs::table.row prop="option-value" required="false" default="none" type="string" />
        <x-docs::table.row prop="option-label" required="false" default="none" type="string" />
        <x-docs::table.row prop="flip-options" required="false" default="false" type="boolean" />
        <x-docs::table.row prop="option-key-value" required="false" default="false" type="boolean" />
        <x-docs::table.row prop="options" required="false" default="none" type="Collection|array|null" />
        <x-docs::table.row prop="empty-message" required="false" default="trans('wireui::messages.empty_options')" type="string" />
        <x-docs::table.row prop="hide-empty-message" required="false" default="false" type="boolean" />
    </x-docs::table>
</x-docs-scope>
