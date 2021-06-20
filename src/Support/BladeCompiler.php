<?php

namespace WireUi\Support;

use Exception;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Factory;
use Throwable;

class BladeCompiler
{
    public function compile(string $html, array $data = []): string
    {
        $blade = Blade::compileString($html);

        return $this->compileString($blade, $data);
    }

    private function compileString($__php, $__data): string
    {
        $__data['__env'] = app(Factory::class);
        $obLevel         = ob_get_level();
        ob_start();
        extract($__data, EXTR_SKIP);

        try {
            eval("?> {$__php}");
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
