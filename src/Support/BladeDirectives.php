<?php

namespace WireUi\Support;

use Illuminate\View\ComponentAttributeBag;
use Livewire\Mechanisms\FrontendAssets\FrontendAssets;

class BladeDirectives
{
    public function confirmAction(string $expression): string
    {
        return "onclick=\"window.\$wireui.confirmAction({$expression}, '{{ \$__livewire->getId() }}')\"";
    }

    public function notify(string $expression): string
    {
        return "onclick=\"window.\$wireui.notify({$expression}, '{{ \$__livewire->getId() }}')\"";
    }

    public function boolean(string $value): string
    {
        return "<?= json_encode(filter_var({$value}, FILTER_VALIDATE_BOOLEAN)); ?>";
    }

    public function toJs(mixed $expression): string
    {
        return <<<EOT
        <?php if (is_object({$expression}) || is_array({$expression})) { echo "JSON.parse(atob('".base64_encode(json_encode({$expression}))."'))"; } elseif (is_string({$expression})) { echo "'".str_replace("'", "\'", {$expression})."'"; } else { echo json_encode({$expression}); } ?>
        EOT;
    }

    public function styles(bool $absolute = true): string
    {
        $route = route('wireui.assets.styles', [], $absolute);

        $this->getManifestVersion('wireui.css', $route);

        return "<link href=\"{$route}\" rel=\"stylesheet\" type=\"text/css\">";
    }

    public function scripts(bool $absolute = true, array $attributes = []): string
    {
        $route = route('wireui.assets.scripts', [], $absolute);

        $this->getManifestVersion('wireui.js', $route);

        $attributes = new ComponentAttributeBag($attributes);

        return <<<HTML
        <script {$attributes->toHtml()}>{$this->hooksScript()}</script>
        <script src="{$route}" defer {$attributes->toHtml()}></script>
        HTML;
    }

    public function hooksScript(): string
    {
        $scripts = <<<JS
            window.Wireui = {
                cache: {},
                hook(hook, callback) {
                    window.addEventListener(`wireui:\${hook}`, () => callback())
                },
                dispatchHook(hook) {
                    window.dispatchEvent(new Event(`wireui:\${hook}`))
                }
            }
        JS;

        return (fn () => (new $this())::minify($scripts))->call(new FrontendAssets());
    }

    public function getManifestVersion(string $file, ?string &$route = null): ?string
    {
        $manifestPath = dirname(__DIR__, 2) . '/dist/mix-manifest.json';

        if (!file_exists($manifestPath)) {
            return null;
        }

        $manifest = json_decode(file_get_contents($manifestPath), $assoc = true);

        $version = last(explode('=', $manifest["/{$file}"]));

        $route = $route ? "{$route}?id={$version}" : $route;

        return $version;
    }
}
