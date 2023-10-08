<?php

namespace WireUi\View;

use Illuminate\View\ComponentAttributeBag;
use WireUi\Actions\{Dialog, Notification};

class BladeDirectives
{
    public const SAFE_LIVEWIRE_ID = '{{ isset($__livewire) ? "$__livewire->getId()" : null }}';

    public static function confirmAction(string $expression): string
    {
        $safeLivewireId = static::SAFE_LIVEWIRE_ID;

        return "onclick=\"window.\$wireui.confirmAction({$expression}, {$safeLivewireId})\"";
    }

    public static function notify(string $expression): string
    {
        $safeLivewireId = static::SAFE_LIVEWIRE_ID;

        return "onclick=\"window.\$wireui.notify({$expression}, {$safeLivewireId})\"";
    }

    public static function toJs(mixed $expression): string
    {
        return <<<EOT
        <?php
            if (is_object({$expression}) || is_array({$expression})) {
                echo "JSON.parse(atob('".base64_encode(json_encode({$expression}))."'))";
            } elseif (is_string({$expression})) {
                echo "'".str_replace("'", "\'", {$expression})."'";
            } else {
                echo json_encode({$expression});
            }
        ?>
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
        $dialogCalls = $this->makeDialogCalls();

        $notificationCalls = $this->makeNotificationCalls();

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

            {$dialogCalls}
            {$notificationCalls}
        JS;

        return $scripts;
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

    public function makeNotificationCalls(): string
    {
        $events = [];

        foreach (Notification::$dispatches as $event) {
            $base64 = base64_encode(json_encode($event->data));

            $events[] = <<<JS
                window.Wireui.hook('notifications:load}', () => {
                    window.dispatchEvent(new CustomEvent('{$event->name}', {
                        detail: JSON.parse(atob('{$base64}'))
                    }))
                })
            JS;
        }

        return implode("\n", $events);
    }

    public function makeDialogCalls(): string
    {
        $events = [];

        foreach (Dialog::$dispatches as $event) {
            $base64 = base64_encode(json_encode($event->data));

            $events[] = <<<JS
                window.Wireui.hook('{$event->id}', () => {
                    window.dispatchEvent(new CustomEvent('{$event->name}', {
                        detail: JSON.parse(atob('{$base64}'))
                    }))
                })
            JS;
        }

        return implode("\n", $events);
    }
}
