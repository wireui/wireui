<?php

use WireUi\Support\Buttons\Sizes\{Common,Mini};

it('should return the default size', function () {
    expect((new Common\Base())->default())->toBe(
        (new Common\Base())->get(config('wireui.button.size')),
    );

    expect((new Common\Icon())->default())->toBe(
        (new Common\Icon())->get(config('wireui.button.size')),
    );

    expect((new Common\Base())->get('default'))->toBe(
        (new Common\Base())->get(config('wireui.button.size')),
    );

    expect((new Common\Icon())->get('default'))->toBe(
        (new Common\Icon())->get(config('wireui.button.size')),
    );
});

it('should return the default mini size', function () {
    expect((new Mini\Base())->default())->toBe(
        (new Mini\Base())->get(config('wireui.button.size')),
    );

    expect((new Mini\Icon())->default())->toBe(
        (new Mini\Icon())->get(config('wireui.button.size')),
    );
});
