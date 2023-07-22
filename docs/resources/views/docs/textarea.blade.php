<x-docs-scope :page="$page">
    {{-- Summary --}}
    <x-docs::summary>
        <x-docs::summary.header href="#textarea" label="Textarea">
            <x-docs::summary.item href="#textarea-input" label="Textarea Input" />
        </x-docs::summary.header>

        <x-docs::summary.header href="#textarea-options" label="Textarea Options" />

        <x-docs::summary.header href="#playground" label="Playground" />
    </x-docs::summary>

    {{-- Section --}}
    <x-docs::title id="textarea" title="Textarea" />

    <x-docs::text>
        The Textarea component is very useful to build forms.
        <br><br>
        You can set the attribute
        <x-docs::mark>wire:model</x-docs::mark>
        to automatically have the attributes
        <x-docs::mark>id</x-docs::mark>
        set to the MD5 of the model and
        <x-docs::mark>name</x-docs::mark>
        to the exact model. You must NOT pass the attributes id and name for this to work.
    </x-docs::text>

    <x-docs::code.block language="blade">
        @verbatim
            <x-textarea wire:model="comment" label="Comment" placeholder="Your comment" />
        @endverbatim
    </x-docs::code.block>

    <x-docs::subtitle id="textarea-input" title="Textarea Input" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm mx-auto">
            @verbatim
                <x-textarea label="Notes" placeholder="write your notes" />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    {{-- Section --}}
    <x-docs::title id="textarea-options" title="Textarea Options" />

    <x-docs::text>
        The textarea component has all
        <x-link href="{{ route('docs.index', 'inputs') }}#input-options">Inputs</x-link>
        options and slots.
    </x-docs::text>

    {{-- Playground --}}
    {{-- @livewire('playground.textarea') --}}
</x-docs-scope>
