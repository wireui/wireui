<?php

namespace WireUi\View\Compilers;

use Exception;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Factory;
use Throwable;
use WireUi\Support\SafeEval;

class BladeCompiler
{
    public function compile(string $html, array $data = []): string
    {
        $safeHtml = (new SafeEval())->evaluate($html);

        $blade = Blade::compileString($safeHtml);

        return $this->compileString($blade, $data);
    }

    private function compileString(string $blade, array $data): string
    {
        $data['__env'] = app(Factory::class);

        $obLevel = ob_get_level();

        ob_start();

        extract($data, EXTR_SKIP);

        try {
            eval("?> {$blade}");
        } catch (Exception $e) {
            while (ob_get_level() > $obLevel) {
                ob_end_clean();
            }

            throw $e;
        } catch (Throwable $e) {
            while (ob_get_level() > $obLevel) {
                ob_end_clean();
            }

            throw new Exception($e);
        }

        return ob_get_clean();
    }
}
