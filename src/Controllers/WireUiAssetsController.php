<?php

namespace WireUi\Controllers;

use Livewire\Controllers\CanPretendToBeAFile;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class WireUiAssetsController
{
    use CanPretendToBeAFile;

    public function scripts(): BinaryFileResponse
    {
        return $this->pretendResponseIsFile(__DIR__ . '/../../dist/wireui.js');
    }

    public function styles(): BinaryFileResponse
    {
        return $this->pretendResponseIsFile(__DIR__ . '/../../dist/wireui.css');
    }
}
