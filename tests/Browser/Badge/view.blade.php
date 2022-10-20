<div>
    <h1>Badges test</h1>

    <x-badge label="Label" />
    <x-badge primary label="Primary" />
    <x-badge secondary label="Secondary" />
    <x-badge positive label="Positive" />
    <x-badge negative label="Negative" />
    <x-badge warning label="Warning" />
    <x-badge info label="Info" />
    <x-badge dark label="Dark" />

    <x-badge rounded label="Label" />
    <x-badge rounded primary label="Primary" />
    <x-badge rounded secondary label="Secondary" />
    <x-badge rounded positive label="Positive" />
    <x-badge rounded negative label="Negative" />
    <x-badge rounded warning label="Warning" />
    <x-badge rounded info label="Info" />
    <x-badge rounded dark label="Dark" />

    <x-badge squared label="Label" />
    <x-badge squared primary label="Primary" />
    <x-badge squared secondary label="Secondary" />
    <x-badge squared positive label="Positive" />
    <x-badge squared negative label="Negative" />
    <x-badge squared warning label="Warning" />
    <x-badge squared info label="Info" />
    <x-badge squared dark label="Dark" />

    <x-badge flat icon="home" label="Label" />
    <x-badge flat icon="home" primary label="Primary" />
    <x-badge flat icon="home" secondary label="Secondary" />
    <x-badge flat icon="home" positive label="Positive" />
    <x-badge flat icon="home" negative label="Negative" />
    <x-badge flat icon="home" warning label="Warning" />
    <x-badge flat icon="home" info label="Info" />
    <x-badge flat icon="home" dark label="Dark" />

    <x-badge outline right-icon="home" label="Label" />
    <x-badge outline right-icon="home" primary label="Primary" />
    <x-badge outline right-icon="home" secondary label="Secondary" />
    <x-badge outline right-icon="home" positive label="Positive" />
    <x-badge outline right-icon="home" negative label="Negative" />
    <x-badge outline right-icon="home" warning label="Warning" />
    <x-badge outline right-icon="home" info label="Info" />
    <x-badge outline right-icon="home" dark label="Dark" />

    <x-badge label="primary">
        <x-slot name="prepend">
            <b>prepend content</b>
        </x-slot>
    </x-badge>

    <x-badge label="primary">
        <x-slot name="prepend">
            <b>prepend content</b>
        </x-slot>

        My Label

        <x-slot name="append">
            <b>append content</b>
        </x-slot>
    </x-badge>

    <x-badge label="primary">
        <x-slot name="append">
            <b>append content</b>
        </x-slot>
    </x-badge>
</div>
