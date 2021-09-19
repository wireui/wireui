<?php

namespace WireUi;

use WireUi\Actions\Minify;

class WireUiBladeDirectives
{
    public function scripts(bool $absolute = true): string
    {
        return <<<HTML
        <script>{$this->hooksScript()}</script>
        HTML;
    }

    public function hooksScript(): string
    {
        $scripts = <<<JS
            window.Wireui = {
                hook(hook, callback) {
                    window.addEventListener(`wireui:\${hook}`, () => callback())
                },
                dispatchHook(hook) {
                    window.dispatchEvent(new Event(`wireui:\${hook}`))
                }
            }
        JS;

        return Minify::execute($scripts);
    }

    public function styles(bool $absolute = true): string
    {
        $route = route('wireui.assets.styles', $parameters = [], $absolute);

        return "<link href=\"{$route}\" rel=\"stylesheet\" type=\"text/css\">";
    }

    public function confirmAction(string $expression): string
    {
        return "onclick=\"window.\$wireui.confirmAction($expression, '{{ \$_instance->id }}')\"";
    }

    public function notify(string $expression): string
    {
        return "onclick=\"window.\$wireui.notify($expression, '{{ \$_instance->id }}')\"";
    }

    public function boolean(string $value): string
    {
        return "<?= json_encode(filter_var($value, FILTER_VALIDATE_BOOLEAN)); ?>";
    }
}
