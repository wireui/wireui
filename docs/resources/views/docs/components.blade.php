<x-docs-scope :page="$page">
    {{-- Section --}}
    <x-docs::title title="Components Customization" />

    <x-docs::text>
        You can disable, rename or extend all the WireUI components.
        <br><br>
        To perform customizations, you must publish the WireUI config. Run the command:
    </x-docs::text>

    <x-docs::code.block language="bash" :line-numbers="false">
        @verbatim
            php artisan vendor:publish --tag='wireui.config'
        @endverbatim
    </x-docs::code.block>

    <x-docs::text>
        Then, open the file
        <x-docs::mark>config/wireui.php</x-docs::mark>
        and rename the alias key with your preferred name.
        <br><br>
        After saving, you must clear the View Cache by running the following command:
    </x-docs::text>

    <x-docs::code.block language="bash" :line-numbers="false">
        @verbatim
            php artisan view:clear
        @endverbatim
    </x-docs::code.block>

    <x-alert class="mb-4" info>
        <x-slot name="title">
            Tip: It's advisable to run this command always after you make changes.
        </x-slot>
    </x-alert>

    <x-docs::text class="mt-6">
        The example below shows some customizations:
    </x-docs::text>

    <x-docs::code.block language="php">
        @verbatim
            ...
            'components' => [
                // rename the component
                'input'              => [
                    'class' => Components\Input::class,
                    'alias' => 'form.input', // rename this alias
                ],

                // disable the component
                // 'textarea'           => [
                //     'class' => Components\Textarea::class,
                //     'alias' => 'textarea',
                // ],

                // extends the component
                'button'             => [
                    'class' => App\Views\Components\MyButton::class,
                    'alias' => 'button',
                ],
            ]
            ...
        @endverbatim
    </x-docs::code.block>
</x-docs-scope>
