<?php

namespace WireUi\Http\Controllers;

use Illuminate\Http\Response;
use Livewire\Drawer\Utils;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class WireUiAssetsController extends Controller
{
    public function scripts(): Response|BinaryFileResponse
    {
        return Utils::pretendResponseIsFile(__DIR__ . '/../../../dist/wireui.js', $mimeType = 'application/javascript');
    }

    public function styles(): Response|BinaryFileResponse
    {
        return Utils::pretendResponseIsFile(__DIR__ . '/../../../dist/wireui.css', $mimeType = 'text/css');
    }
}
