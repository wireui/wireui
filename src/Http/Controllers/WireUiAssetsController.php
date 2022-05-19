<?php

namespace WireUi\Http\Controllers;

use Illuminate\Http\Response;
use Livewire\Controllers\CanPretendToBeAFile;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class WireUiAssetsController extends Controller
{
    use CanPretendToBeAFile;

    public function scripts(): Response|BinaryFileResponse
    {
        return $this->pretendResponseIsFile(__DIR__ . '/../../../dist/wireui.js', $mimeType = 'application/javascript');
    }

    public function styles(): Response|BinaryFileResponse
    {
        return $this->pretendResponseIsFile(__DIR__ . '/../../../dist/wireui.css', $mimeType = 'text/css');
    }
}
