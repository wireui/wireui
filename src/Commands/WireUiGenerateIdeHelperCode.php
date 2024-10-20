<?php

namespace WireUi\Commands;

use Illuminate\Console\Command;

class WireUiGenerateIdeHelperCode extends Command
{
    protected $signature = 'wireui:generate-ide-helper-code';

    protected $description = 'Generate Laravel Idea helper code for WireUi components';

    public function handle(): void
    {
        $json = [
            '$schema' => 'https://laravel-ide.com/schema/laravel-ide-v2.json',
        ];

        $prefix = config('wireui.prefix');

        $list = [];

        foreach (config('wireui.components') as $component) {
            $list[] = [
                'name' => $prefix.$component['alias'],
                'className' => $component['class'],
            ];
        }

        $json['blade'] = [
            'components' => [
                'list' => $list,
            ],
        ];

        file_put_contents(
            __DIR__.'/../../ide.json',
            json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
        );
    }
}
