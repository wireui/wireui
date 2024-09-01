<?php

namespace WireUi\View;

use AllowDynamicProperties;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\HtmlString;
use Illuminate\View\Component;

#[AllowDynamicProperties]
abstract class WireUiComponent extends Component
{
    use InteractsWithAttributes;
    use InteractsWithProps;
    use InteractsWithVariables;

    abstract protected function blade(): View;

    public function render(): Closure
    {
        return function (array $data) {
            $attrs = $this->runWireUiComponent($data);

            return $this->blade()->with($attrs);
        };
    }

    public function resolveView(): Closure|View
    {
        $view = $this->render();

        if ($view instanceof View) {
            return $view;
        }

        $resolver = fn (View $view) => new HtmlString($view->render());

        return fn (array $data = []) => $resolver($view($data));
    }
}
