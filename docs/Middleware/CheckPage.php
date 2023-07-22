<?php

namespace WireUiDocs\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class CheckPage
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        $page = $request->page ?? config('wireui-docs.default-page');

        abort_unless($this->hasPage($page), Response::HTTP_NOT_FOUND);

        return $next($request);
    }

    /**
     * Check if the given page exists.
     */
    private function hasPage(string $page): bool
    {
        return File::exists(__DIR__."/../resources/views/docs/{$page}.blade.php");
    }
}
