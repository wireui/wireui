<?php

namespace PH7JACK\LivewireUi;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use PH7JACK\LivewireUi\Components\DateTimePicker;

class LivewireUiServiceProvider extends ServiceProvider
{
    protected const PACKAGE_NAME       = 'livewire-ui';
    protected const PACKAGE_SHORT_NAME = 'lw-ui';

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', self::PACKAGE_NAME);

        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', self::PACKAGE_NAME);

        $this->mergeConfigFrom(
            __DIR__ . '/config/livewire-ui.php', self::PACKAGE_NAME
        );

        $this->registerComponents();

        $this->publishes([
            // Config
            __DIR__ . '/config/livewire-ui.php' => config_path('livewire-ui.php'),

            // Views
            __DIR__ . '/resources/views' => resource_path('views/vendor/' . self::PACKAGE_NAME),

            // Translations
            __DIR__ . '/resources/lang' => resource_path('lang/vendor/' . self::PACKAGE_NAME),
        ], self::PACKAGE_NAME);
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

                    @keyframes lwUiScaleUpAnimation {
                        0% {
                            transform: scale(0.5, 0.5);
                        }

                        100% {
                            transform: scale(1, 1);
                        }
                    }
                    .lw-ui-fade-hide {
                        opacity: 0;
                        visibility: hidden;
                        transition: visibility 0s linear 300ms, opacity 300ms;
                    }

                    .lw-ui-fade-show {
                        opacity: 1;
                        visibility: visible;
                        transition: visibility 0s linear 0s, opacity 300ms;
                    }
                    .lw-ui-fade-show .date-picker-modal {
                        animation: lwUiScaleUpAnimation 0.2s linear;
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

                    function $toggleClass(element, className, visibility = true) {
                        const hasClass = element.classList.value.includes(className)

                        if (visibility && hasClass) {
                            element.classList.remove(className)
                        } else if (!visibility && !hasClass) {
                            element.classList.add(className)
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
                                    title: options.title ?? __('livewire-ui::messages.confirm'),
                                    html: options.text ?? __('livewire-ui::messages.danger_alert'),
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: options.confirmText ?? __('livewire-ui::messages.yes'),
                                    cancelButtonColor: '#d33',
                                    cancelButtonText: options.cancelText ?? __('livewire-ui::messages.no'),
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
            Blade::component(self::PACKAGE_NAME . "::components.svg.{$icon}", self::PACKAGE_SHORT_NAME . ".icon.{$icon}");
        }

        foreach ($components as $component) {
            Blade::component(self::PACKAGE_NAME . "::components.{$component}", self::PACKAGE_SHORT_NAME . ".{$component}");
        }

        Livewire::component(self::PACKAGE_NAME . ':date-time-picker', DateTimePicker::class);
    }
}
