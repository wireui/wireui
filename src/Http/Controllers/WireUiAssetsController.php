<?php

namespace WireUi\Http\Controllers;

use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use WireUi\Support\Utils;

class WireUiAssetsController extends Controller
{
    public function scripts(): Response|BinaryFileResponse
    {
        return Utils::pretendResponseIsFile(__DIR__.'/../../../dist/wireui.js', 'application/javascript');
    }

    public function styles(): Response|BinaryFileResponse
    {
        return Utils::pretendResponseIsFile(__DIR__.'/../../../dist/wireui.css', 'text/css');
    }
}
