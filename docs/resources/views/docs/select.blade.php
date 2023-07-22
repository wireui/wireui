<x-docs-scope :page="$page">
    {{-- Summary --}}
    <x-docs::summary>
        <x-docs::summary.header href="#select" label="Select">
            <x-docs::summary.item href="#async-search" label="Async Search" />
            <x-docs::summary.item href="#simple-options" label="Simple Options" />
            <x-docs::summary.item href="#multiselect" label="Multi Select" />
            <x-docs::summary.item href="#custom-options" label="Custom Options" />
            <x-docs::summary.item href="#option-with-description" label="Option With Description" />
            <x-docs::summary.item href="#slot-options" label="Slot Options" />
            <x-docs::summary.item href="#customizable-options" label="Customizable Options" />
        </x-docs::summary.header>

        <x-docs::summary.header href="#select-options" label="Select Options" />

        <x-docs::summary.header href="#default-options" label="Default Option" />

        <x-docs::summary.header href="#user-options" label="User Option" />

        <x-docs::summary.header href="#select-events" label="Select Events" />

        <x-docs::summary.header href="#after-options-slot" label="After Options Slot" />

        <x-docs::summary.header href="#select-slots" label="Select Slots" />
    </x-docs::summary>

    {{-- Section --}}
    <x-docs::title id="select" title="Select" />

    <x-docs::text>
        The Select component has support to render default html select with slot or options prop.
        You can customize the option component for one or all options. See Examples.
    </x-docs::text>

    <x-docs::subtitle id="async-search" title="Async Search" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm mx-auto">
            @verbatim
                <x-select label="Search a User" wire:model.defer="selectAsyncSearchUser" placeholder="Select some user"
                    :async-data="route('api.users.index')" option-label="name" option-value="id" />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::text.title title="How to Implement the async-search?" />

    <x-docs::text>
        WireUi will make a request with the
        <x-docs::mark>search</x-docs::mark> <b>parameter(string)</b>
        when the user types in the input.
        <br>
        When the component is initialized and has any selected value,
        the select will send a request with the
        <x-docs::mark>selected</x-docs::mark> <b>parameter(array)</b>
        to find the selected option.
        <br>
        You are free to create your API as you want, just apply these two scopes: search and selected.
    </x-docs::text>

    <x-docs::list>
        <x-docs::list.item>
            Create an API that returns an array in the response
        </x-docs::list.item>

        <x-docs::list.item>
            Set the <x-docs::mark>option-label</x-docs::mark> and <x-docs::mark>option-value</x-docs::mark> attributes
        </x-docs::list.item>

        <x-docs::list.item>
            Implement the
            <x-link href="https://github.com/wireui/docs/tree/main/app/Http/Controllers/Api/Users/Index.php#L17"
                target="_blank">
                search
            </x-link>
            scope
        </x-docs::list.item>

        <x-docs::list.item>
            Implement the
            <x-link href="https://github.com/wireui/docs/tree/main/app/Http/Controllers/Api/Users/Index.php#L23"
                target="_blank">
                selected
            </x-link>
            scope
        </x-docs::list.item>
    </x-docs::list>

    <x-alert class="my-6" info>
        <x-slot name="title">
            Tip: See these files to read more about the <b>API</b> implementation.
            <br>
            <x-link href="https://github.com/wireui/docs/tree/main/app/Http/Controllers/Api/Users/Index.php"
                target="_blank" info>
                Controller
            </x-link>,
            <x-link href="https://github.com/wireui/docs/tree/main/tests/Feature/Controllers/Api/Users/IndexTest.php"
                target="_blank" info>
                Test
            </x-link>.
        </x-slot>
    </x-alert>

    <x-docs::text>
        You can customize the asyncData prop to change the http method and add more data to the request.
    </x-docs::text>

    <x-docs::code.block language="js">
        @verbatim
            export type AsyncDataConfig = {
            api: string | null
            method: string
            params: any,
            credentials?: RequestCredentials,
            alwaysFetch: boolean
            }
        @endverbatim
    </x-docs::code.block>

    <x-docs::text.title title="How to Customize the async-data?" />

    <x-docs::text>
        The queryString params will be merged with the asyncData params.
    </x-docs::text>

    <x-docs::code.block language="blade">
        @verbatim
            <x-select ... :async-data="route('api.users.index', ['foo' => 'bar'])" />

            OR

            <x-select ... :async-data="[
                'api' => route('api.users.index'),
                'method' => 'POST', // default is GET
                'params' => ['ble' => 'baz'], // default is []
                'credentials' => 'include', // default is undefined
            ]" />
        @endverbatim
    </x-docs::code.block>

    <x-docs::subtitle id="simple-options" title="Simple Options" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm mx-auto">
            @verbatim
                <x-select label="Select Status" placeholder="Select one status" :options="['Active', 'Pending', 'Stuck', 'Done']"
                    wire:model.defer="select" />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="multiselect" title="Multi Select" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm mx-auto">
            @verbatim
                <x-select label="Select Statuses" placeholder="Select many statuses" multiselect :options="['Active', 'Pending', 'Stuck', 'Done']"
                    wire:model.defer="selectMultiple" />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="custom-options" title="Custom Options" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm mx-auto">
            @verbatim
                <x-select label="Select Status" placeholder="Select one status" :options="[
                    ['name' => 'Active', 'id' => 1],
                    ['name' => 'Pending', 'id' => 2],
                    ['name' => 'Stuck', 'id' => 3],
                    ['name' => 'Done', 'id' => 4],
                ]" option-label="name"
                    option-value="id" wire:model.defer="select" />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="option-with-description" title="Option With Description" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm mx-auto">
            @verbatim
                <x-select label="Order Status" placeholder="Select one status" :options="[
                    ['name' => 'Active', 'id' => 1, 'description' => 'The status is active'],
                    ['name' => 'Pending', 'id' => 2, 'description' => 'The status is pending'],
                    ['name' => 'Stuck', 'id' => 3, 'description' => 'The status is stuck'],
                    ['name' => 'Done', 'id' => 4, 'description' => 'The status is done'],
                ]" option-label="name"
                    option-value="id" wire:model.defer="select" />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="slot-options" title="Slot Options" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm mx-auto">
            @verbatim
                <x-select label="Select Status" placeholder="Select one status" wire:model.defer="select">
                    <x-select.option label="Pending" value="1" />
                    <x-select.option label="In Progress" value="2" />
                    <x-select.option label="Stuck" value="3" />
                    <x-select.option label="Done" value="4" />
                </x-select>
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="customizable-options" title="Customizable Options" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-lg mx-auto">
            @verbatim
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <x-select label="Select Relator" placeholder="Select relator" wire:model.defer="select">
                        <x-select.user-option :src="Vite::file('avatar/andre.jpeg')" label="André Luiz" value="1" />
                        <x-select.user-option :src="Vite::file('avatar/fernando.jpeg')" label="Fernando Gunther" value="2" />
                        <x-select.user-option :src="Vite::file('avatar/keithyellen.jpg')" label="Keithyellen Huhn" value="3" />
                        <x-select.user-option :src="Vite::file('avatar/pedro.jpg')" label="Pedro Henrique" value="4" />
                    </x-select>

                    <x-select label="Search a User" wire:model.defer="selectAsyncSearchRelator"
                        placeholder="Select some user" :async-data="route('api.users.index')" :template="[
                            'name' => 'user-option',
                            'config' => ['src' => 'profile_image'],
                        ]" option-label="name"
                        option-value="id" option-description="email" />
                </div>
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    {{-- Section --}}
    <x-docs::title id="select-options" title="Select Options" />

    <x-docs::table class="w-full mt-2 mb-6">
        <x-docs::table.row prop="label" required="false" default="none" type="string" available="*" />
        <x-docs::table.row prop="placeholder" required="false" default="none" type="string" available="*" />
        <x-docs::table.row prop="option-value" required="false" default="none" type="string" available="*" />
        <x-docs::table.row prop="option-label" required="false" default="none" type="string" available="*" />
        <x-docs::table.row prop="option-description" required="false" default="none" type="string" available="*" />
        <x-docs::table.row prop="options" required="false" default="none" type="Collection|array" available="*" />
        <x-docs::table.row prop="flip-options" required="false" default="false" type="boolean" />
        <x-docs::table.row prop="option-key-value" required="false" default="false" type="boolean" />
        <x-docs::table.row prop="clearable" required="false" default="true" type="boolean" available="boolean" />
        <x-docs::table.row prop="searchable" required="false" default="true" type="boolean" available="boolean" />
        <x-docs::table.row prop="multiselect" required="false" default="false" type="boolean" available="boolean" />
        <x-docs::table.row prop="icon" required="false" default="none" type="string" available="all heroicons" />
        <x-docs::table.row prop="rightIcon" required="false" default="selector" type="string" available="all heroicons" />
        <x-docs::table.row prop="async-data" required="false" default="none" type="string|AsyncDataConfig" available="all endpoints" />
        <x-docs::table.row prop="always-fetch" required="false" default="none" type="string" available="true|false" />
        <x-docs::table.row prop="template" required="false" default="default" type="string|array" available="default|user-option" />
        <x-docs::table.row prop="empty-message" required="false" default="trans('wireui::messages.empty_options')" type="string" available="*" />
        <x-docs::table.row prop="hide-empty-message" required="false" default="false" type="boolean" available="boolean" />
        <x-docs::table.row prop="min-items-for-search" required="false" default="11" type="int" available="*" />
    </x-docs::table>

    {{-- Section --}}
    <x-docs::title id="default-options" title="Select Options" />

    <x-docs::table class="w-full mt-2 mb-6" :available="false">
        <x-docs::table.row prop="description" required="false" default="none" type="string" />
        <x-docs::table.row prop="label" required="false" default="none" type="string|null" />
        <x-docs::table.row prop="value" required="true" default="none" type="ayn" />
        <x-docs::table.row prop="readonly" required="false" default="false" type="boolean" />
        <x-docs::table.row prop="disabled" required="false" default="false" type="boolean" />
        <x-docs::table.row prop="option" required="false" default="none" type="Model|stdClass|array|null" />
    </x-docs::table>

    {{-- Section --}}
    <x-docs::title id="user-options" title="Select Options" />

    <x-docs::table class="w-full mt-2 mb-6" :available="false">
        <x-docs::table.row prop="description" required="false" default="none" type="string" />
        <x-docs::table.row prop="label" required="true" default="none" type="string|null" />
        <x-docs::table.row prop="value" required="true" default="none" type="any" />
        <x-docs::table.row prop="readonly" required="false" default="false" type="boolean" />
        <x-docs::table.row prop="disabled" required="false" default="false" type="boolean" />
        <x-docs::table.row prop="src" required="true" default="none" type="string|null" />
        <x-docs::table.row prop="option" required="true" default="none" type="Model|stdClass|array|null" />
    </x-docs::table>

    {{-- Section --}}
    <x-docs::title id="select-events" title="Select Events" />

    <x-docs::code.block language="blade">
        @verbatim
            <x-select
                ...
                x-on:open="alert('openned select')"
                x-on:close="alert('closed select')"
                x-on:selected="alert('selected/unselected option')"
                x-on:clear="alert('cleared select')"
            >
                ...
            </x-select>
        @endverbatim
    </x-docs::code.block>

    {{-- Section --}}
    <x-docs::title id="after-options-slot" title="After Options Slot" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm mx-auto">
            @verbatim
                <x-select label="Search a User" wire:model.defer="asyncSearchUser" placeholder="Select some user"
                    :async-data="route('api.users.index')" option-label="name" option-value="id" hide-empty-message>
                    <x-slot name="afterOptions" class="flex justify-center p-2" x-show="displayOptions.length === 0">
                        <x-button class="w-full"
                            x-on:click="
                            close;
                            $wireui.notify({ title: 'Not implemented yet', icon: 'info' })
                        "
                            primary flat full>
                            <span x-html="`Create user <b>${search}</b>`"></span>
                        </x-button>
                    </x-slot>
                </x-select>
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    {{-- Section --}}
    <x-docs::title id="select-slots" title="Select Slots" />

    <x-docs::code.block language="blade">
        @verbatim
            <x-slot name="beforeOptions">
                // html code
            </x-slot>

            <x-slot name="afterOptions">
                // html code
            </x-slot>
        @endverbatim
    </x-docs::code.block>
</x-docs-scope>
