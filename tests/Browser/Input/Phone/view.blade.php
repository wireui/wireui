<?php

use function Livewire\Volt\{state};

state(['phone' => null, 'customPhone' => null]);

?>

<div>
    <h1>Phone Input test</h1>

    // test it_should_type_formatted_phone_number
    <span dusk="phone">{{ $phone }}</span>
    <x-input-phone
        label="Phone"
        wire:model.live="phone"
        emit-formatted
   />

   // test it_should_type_custom_masked_phone_number
    <span dusk="customPhone">{{ $customPhone }}</span>
    <x-input-phone
        label="Custom Phone"
        wire:model.live="customPhone"
        mask="['(##) ####-####', '(##) #####-####']"
        emit-formatted
   />
</div>
