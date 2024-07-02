<?php

namespace WireUi\Http\Controllers;

use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use WireUi\Components\Icon\Index as Icon;

class IconsController extends Controller
{
    public function __invoke(?string $variant, string $icon): Response
    {
        try {
            $component = new Icon(name: $icon, variant: $variant);

            return response()
                ->view($component->render()->name(), ['attributes' => null])
                ->withHeaders([
                    'Content-Type' => 'image/svg+xml; charset=utf-8',
                    'Cache-Control' => 'public, only-if-cached, max-age=31536000',
                ]);
        } catch (Throwable $exception) {
            if ($this->shouldReportException($exception)) {
                report($exception);
            }

            abort(Response::HTTP_NOT_FOUND, "Icon \"{$icon}\" for variant \"{$variant}\" was not found.");
        }
    }

    private function shouldReportException(Throwable $exception): bool
    {
        return $exception instanceof InvalidArgumentException
            && ! str_starts_with($exception->getMessage(), 'View')
            && ! str_ends_with($exception->getMessage(), 'not found.');
    }
}
