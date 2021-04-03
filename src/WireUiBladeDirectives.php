<?php

namespace WireUi;

class WireUiBladeDirectives
{
    public function scripts(bool $absolute = true): string
    {
        $route = route('wireui.assets.scripts', $parameters = [], $absolute);
        $this->getManifestVersion('wireui.js', $route);

        return "<script src=\"{$route}\" defer></script>";
    }

    public function styles(bool $absolute = true): string
    {
        $route = route('wireui.assets.styles', $parameters = [], $absolute);
        $this->getManifestVersion('wireui.css', $route);

        return "<link href=\"{$route}\" rel=\"stylesheet\" type=\"text/css\">";
    }

    public function getManifestVersion(string $file, ?string &$route = null): ?string
    {
        $manifestPath = __DIR__ . '/../dist/mix-manifest.json';

        if (!file_exists($manifestPath)) {
            return null;
        }

        $manifest = json_decode(file_get_contents($manifestPath), $assoc = true);
        $version  = last(explode('=', $manifest["/{$file}"]));

        if ($route) {
            $route .= "?id={$version}";
        }

        return $version;
    }

    public static function confirmAction(string $expression): string
    {
        return "onclick=\"window.\$wireui.livewire.confirmAction($expression, '{{ \$_instance->id }}')\"";
    }
}
