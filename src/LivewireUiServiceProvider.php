<?php

namespace PH7JACK\LivewireUi;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use PH7JACK\LivewireUi\Components\DateTimePicker;

class LivewireUiServiceProvider extends ServiceProvider
{
    protected const PACKAGE_KEY = 'livewire-ui';

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', self::PACKAGE_KEY);

        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', self::PACKAGE_KEY);

        $this->mergeConfigFrom(
            __DIR__ . '/config/livewire-ui.php', self::PACKAGE_KEY
        );

        $this->registerComponents();

        $this->publishes([

        ], 'config');

        $this->publishes([

        ]);

        $this->publishes([
            // Config
            __DIR__ . '/config/livewire-ui.php' => config_path('livewire-ui.php'),

            // Views
            __DIR__ . '/resources/views' => resource_path('views/vendor/' . self::PACKAGE_KEY),

            // Translations
            __DIR__ . '/resources/lang' => resource_path('lang/vendor/' . self::PACKAGE_KEY),
        ], self::PACKAGE_KEY);
    }

    public function register()
    {
        $this->registerScripts();
    }

    private function registerScripts()
    {
        Blade::directive('livewireUiAssets', function () {
            return <<<'HTML'
                <style>
                    .lw-ui-shadow {
                        box-shadow: 3px 3px 16px #446b8d33;
                    }
                </style>

                <script>
                    function $getLivewireComponent(id) {
                        return window.livewire.components.findComponent(id)
                    }

                    function $livewireCall(id, method, ...params) {
                        $getLivewireComponent(id).call(method, ...params)
                    }

                    function $getElement(id) {
                        return document.getElementById(id)
                    }

                    function $toggleHiddenClass(element, visibility = true) {
                        const hasHiddenClass = element.classList.value.includes('hidden')

                        if (visibility && hasHiddenClass) {
                            element.classList.remove('hidden')
                        } else if (!visibility && !hasHiddenClass) {
                            element.classList.add('hidden')
                        }
                    }

                    window.$livewireUi = {
                        modal: options => {
                            Promise.prototype.onClose = Promise.prototype.then

                            const swal = Swal.fire({
                                icon: options.icon,
                                title: options.title,
                                html: options.text,
                                confirmButtonText: options.confirmText ?? 'Ok',
                            })

                            return new Promise(resolve => {
                                swal.then(() => {
                                    resolve()
                                })
                            })
                        },
                        alert: options => {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: options.timeout ?? 8000,
                                onOpen: toast => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: options.icon,
                                title: options.title,
                            })
                        },
                        confirm: options => {
                            return new Promise((resolve, reject) => {
                                Swal.fire({
                                    icon: options.icon ?? 'warning',
                                    title: options.title ?? 'Are you sure?',
                                    html: options.text ?? "You won't be able to revert this!",
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: options.confirmText ?? 'Yes',
                                    cancelButtonColor: '#d33',
                                    cancelButtonText: options.cancelText ?? 'No',
                                    reverseButtons: true,
                                }).then(result => {
                                    if (!result.value || result.dismiss) {
                                        return reject()
                                    }
                                    return resolve()
                                })
                            })
                        },
                        livewire: {
                            confirm: options => {
                                const component = this.livewire.components.findComponent(options.id)

                                $app.confirm(options).then(() => {
                                    if (component) {
                                        return component.call(options.method, options.params)
                                    }

                                    this.livewire.emit(options.method, options.params)
                                }).catch(() => {
                                    if (options.callback) {
                                        if (component) {
                                            return component.call(options.callback)
                                        }

                                        this.livewire.emit(options.callback)
                                    }
                                })
                            }
                        }
                    }
                </script>
            HTML;
        });
    }

    private function registerComponents()
    {
        $icons = [
            'calendar',
            'chevron-left',
            'chevron-right',
            'spinner',
        ];

        $components = [
            'error',
        ];

        foreach ($icons as $icon) {
            Blade::component(self::PACKAGE_KEY . "::components.svg.{$icon}", "lw-ui.icon.{$icon}");
        }

        foreach ($components as $component) {
            Blade::component(self::PACKAGE_KEY . "::components.{$component}", "lw-ui.{$component}");
        }

        Livewire::component('livewire-ui:date-time-picker', DateTimePicker::class);
    }
}
