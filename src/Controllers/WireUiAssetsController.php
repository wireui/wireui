<?php

namespace WireUi\Controllers;

use Livewire\Controllers\CanPretendToBeAFile;

class WireUiAssetsController
{
    use CanPretendToBeAFile;

    public function scripts()
    {
        return $this->pretendResponseIsFile(__DIR__ . '/../../dist/wireui.js', $mimeType = 'application/javascript');
    }

    public function styles()
    {
        return $this->pretendResponseIsFile(__DIR__ . '/../../dist/wireui.css', $mimeType = 'text/css');
    }
}
