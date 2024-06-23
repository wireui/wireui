<?php

namespace WireUi\View;

use AllowDynamicProperties;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\{HtmlString};
use Illuminate\View\Component;

/**
 * @method void mounted(array $data)
 * @method void processed(array $data)
 * @method void finished(array $data)
 */
#[AllowDynamicProperties]
abstract class WireUiComponent extends Component
{
    use ManageAttributes;
    use ManageProps;

    abstract protected function blade(): View;

    public function render(): Closure
    {
        return function (array $data) {
            return $this->blade()->with($this->runWireUiComponent($data));
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
