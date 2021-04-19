<div>
    <h1>Phone Input test</h1>

    // test it_should_type_formatted_phone_number
    <span dusk="phone">{{ $phone }}</span>
    <x-inputs.phone
        label="Phone"
        wire:model="phone"
        emit-formatted
   />

   // test it_should_type_custom_masked_phone_number
    <span dusk="customPhone">{{ $customPhone }}</span>
    <x-inputs.phone
        label="Custom Phone"
        wire:model="customPhone"
        mask="['(##) ####-####', '(##) #####-####']"
        emit-formatted
   />
</div>
