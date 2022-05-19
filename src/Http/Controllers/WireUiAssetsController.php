<?php

namespace WireUi\Http\Controllers;

use Livewire\Controllers\CanPretendToBeAFile;

class WireUiAssetsController extends Controller
{
    use CanPretendToBeAFile;

    public function scripts()
    {
        return $this->pretendResponseIsFile(__DIR__ . '/../../../dist/wireui.js', $mimeType = 'application/javascript');
    }

    public function styles()
    {
        return $this->pretendResponseIsFile(__DIR__ . '/../../../dist/wireui.css', $mimeType = 'text/css');
    }
}
