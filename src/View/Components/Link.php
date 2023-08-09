<?php

namespace WireUi\View\Components;

use Illuminate\Support\Arr;
use WireUi\Traits\Components\{HasSetupColor, HasSetupSize, HasSetupUnderline};
use WireUi\WireUi\Link\{Colors, Sizes, Underlines};

class Link extends BaseComponent
{
    use HasSetupSize;
    use HasSetupColor;
    use HasSetupUnderline;

    public ?string $tag = null;

    public function __construct(
        public ?string $label = null,
    ) {
        $this->setSizeResolve(Sizes::class);
        $this->setColorResolve(Colors::class);
        $this->setUnderlineResolve(Underlines::class);
    }

    public function getRootClasses(): string
    {
        return Arr::toCssClasses([
            'font-semibold text-center inline-block',
            $this->underlineClasses,
            $this->colorClasses,
            $this->sizeClasses,
        ]);
    }

    public function getView(): string
    {
        return 'wireui::components.link';
    }

    /**
     * Setup to resolve the link type and tag.
     */
    protected function setupLink(array &$component): void
    {
        $this->tag = $this->getTag();

        $this->ensureLinkType();

        $component['tag'] = $this->tag;

        $this->smart(['tag']);
    }

    private function getTag(): string
    {
        return $this->data->missing('href') ? 'button' : 'a';
    }

    private function ensureLinkType(): void
    {
        if (!$this->data->has('href') && !$this->data->has('type')) {
            $this->data->offsetSet('type', 'button');
        }
    }
}
