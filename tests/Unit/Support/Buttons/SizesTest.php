<?php

use WireUi\Support\Buttons\Sizes\Mini;
use WireUi\Support\Buttons\Sizes\{Base, Icon};

it('should return the default size', function () {
    expect((new Base())->default())->toBe(
        (new Base())->get(config('wireui.button.size'))
    );

    expect((new Icon())->default())->toBe(
        (new Icon())->get(config('wireui.button.size'))
    );

    expect((new Base())->get('default'))->toBe(
        (new Base())->get(config('wireui.button.size'))
    );

    expect((new Icon())->get('default'))->toBe(
        (new Icon())->get(config('wireui.button.size'))
    );
});

it('should return the default mini size', function () {
    expect((new Mini\Base())->default())->toBe(
        (new Mini\Base())->get(config('wireui.button.size'))
    );

    expect((new Mini\Icon())->default())->toBe(
        (new Mini\Icon())->get(config('wireui.button.size'))
    );
});
