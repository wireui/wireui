<?php

namespace Tests\Unit\Http\Controllers;

test('it should fetch an icon', function () {
    $this->getJson(route('wireui.icons', ['variant' => 'outline', 'icon' => 'user']))
        ->assertStatus(200)
        ->assertHeader('Content-Type', 'image/svg+xml; charset=utf-8')
        ->assertHeader('Cache-Control', 'max-age=31536000, only-if-cached, public')
        ->assertSee('<svg', escape: false);
});

test('it should return an 404 response when an icon is not found', function () {
    $this->getJson(route('wireui.icons', ['variant' => 'outline', 'icon' => 'invalid-icon-name']))
        ->assertStatus(404)
        ->assertHeader('Content-Type', 'application/json')
        ->assertHeader('Cache-Control', 'no-cache, private')
        ->assertExactJson([
            'message' => 'Icon "invalid-icon-name" for variant "outline" was not found.',
        ]);
});
