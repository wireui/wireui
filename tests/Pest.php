<?php

uses(Tests\Browser\BrowserTestCase::class)->in('Browser');
uses(Tests\Unit\UnitTestCase::class)->in('Unit');

if (! function_exists('livewire')) {
    function livewire(string $component, array $queryParams = []): Pest\Browser\Api\PendingAwaitablePage
    {
        $query = Illuminate\Support\Arr::query($queryParams);
        $url = '/livewire-dusk/'.urlencode($component).($query === '' ? '' : '?'.$query);

        return visit($url);
    }
}
