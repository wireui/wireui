<div>
    <h1>Slider Input test</h1>

    // test it_should_render_an_input_slider_with_the_default_min_and_max_values
    <x-inputs.slider id="input1" name="test1" label="Test 1" corner-hint="corner-hint test 1" hint="hint-test-1" />

    // test it_should_render_an_input_slider_with_the_custom_min_and_max_values
    <x-inputs.slider id="input2" name="test2" label="Test 2" corner-hint="corner-hint test 2" hint="hint-test-2" min="5" max="6" step="0.1" />

    // test it_should_render_an_input_slider_without_tooltip
    <x-inputs.slider id="input3" md name="test3" label="Test 3" step="5" hide-tooltip />

    // test it_should_render_an_input_slider_with_stops
    <x-inputs.slider id="input4" lg name="test4" label="Test 4" value="20" step="20" show-stops />

    <h1>Slider Input Range test</h1>

    // test it_should_render_an_input_slider_range_with_the_default_min_and_max_values
    <x-inputs.slider range label="Test 5" corner-hint="corner-hint test 5" hint="hint-test-5">
        <x-slot:min id="input51" name="test5[0]"></x-slot:min>
        <x-slot:max id="input52" name="test5[1]"></x-slot:max>
    </x-inputs.slider>

    // test it_should_render_an_input_slider_range_with_the_custom_min_and_max_values
    <x-inputs.slider range label="Test 6" corner-hint="corner-hint test 6" hint="hint-test-6" min="5" max="6" step="0.1">
        <x-slot:min id="input61" name="test6[0]"></x-slot:min>
        <x-slot:max id="input62" name="test6[1]"></x-slot:max>
    </x-inputs.slider>

    // test it_should_render_an_input_slider_range_without_tooltip
    <x-inputs.slider range md label="Test 7" step="5" hide-tooltip>
        <x-slot:min id="input71" name="test7[0]"></x-slot:min>
        <x-slot:max id="input72" name="test7[1]"></x-slot:max>
    </x-inputs.slider>

    // test it_should_render_an_input_slider_range_with_stops
    <x-inputs.slider range lg label="Test 8" step="20" show-stops>
        <x-slot:min id="input81" name="test8[0]" value="20"></x-slot:min>
        <x-slot:max id="input82" name="test8[1]" value="60"></x-slot:max>
    </x-inputs.slider>
</div>
