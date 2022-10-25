<div>
    <h1>Slider Input test</h1>

    // test it_should_render_an_input_slider_with_the_default_min_and_max_values
    <x-inputs.slider name="test1" label="Test 1" corner-hint="corner-hint test 1" hint="hint-test-1" />

    // test it_should_render_an_input_slider_with_the_custom_min_and_max_values
    <x-inputs.slider name="test2" label="Test 2" corner-hint="corner-hint test 2" hint="hint-test-2" min="5" max="6" step="0.1" />

    // test it_should_render_an_input_slider_without_tooltip
    <x-inputs.slider md name="test3" label="Test 3" step="5" hide-tooltip />

    // test it_should_render_an_input_slider_with_stops
    <x-inputs.slider lg name="test4" label="Test 4" value="40" step="20" show-stops />
</div>
