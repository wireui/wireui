<?php

namespace WireUi\View;

use Illuminate\Support\Arr;
use ReflectionClass;
use WireUi\Attributes\Finish;
use WireUi\Attributes\Mount;
use WireUi\Attributes\Process;

trait InteractsWithAttributes
{
    protected array $mount = [];

    protected array $process = [];

    protected array $finish = [];

    protected function bootAttributes(): void
    {
        $this->mount = $this->getFunctionsByAttribute(Mount::class);

        $this->process = $this->getFunctionsByAttribute(Process::class);

        $this->finish = $this->getFunctionsByAttribute(Finish::class);
    }

    private function getFunctionsByAttribute(string $name): array
    {
        $methods = [];

        $reflection = new ReflectionClass($this);

        foreach ($reflection->getMethods() as $method) {
            $attribute = Arr::first($method->getAttributes($name));

            if (! is_null($attribute)) {
                $instance = $attribute->newInstance();

                data_set($methods, $instance->priority, $method->getName());
            }
        }

        return Arr::sort($methods, fn ($value, $key) => $key);
    }
}
