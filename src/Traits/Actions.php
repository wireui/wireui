<?php

namespace PH7JACK\LivewireUi\Traits;

trait Actions
{
    public function confirmDelete(?string $method = null, $data = null): void
    {
        $this->confirmAction([
            'method' => $method ?? 'delete',
            'params' => $data,
            'title'  => 'Do you want to delete?',
        ]);
    }

    public function confirmAction(array $params): void
    {
        $method = $params['method'] ?? false;

        if (!$method) {
            return;
        }

        $this->emit('app:confirm', [
            'id'          => $this->id,
            'icon'        => $params['icon'] ?? 'warning',
            'title'       => $params['title'] ?? 'Are you sure?',
            'text'        => $params['text'] ?? "You won't be able to revert this!",
            'confirmText' => $params['confirmText'] ?? 'Yes',
            'method'      => $method,
            'params'      => $params['params'] ?? null,
            'callback'    => $params['callback'] ?? null,
        ]);
    }

    public function showModal(array $params): void
    {
        $this->emit('app:modal', [
            'icon'    => $params['icon'] ?? null,
            'title'   => $params['title'] ?? null,
            'text'    => $params['text'] ?? null,
            'timeout' => $params['timeout'] ?? null,
        ]);
    }

    public function showAlert(array $params): void
    {
        $this->emit('app:alert', [
            'icon'    => $params['icon'] ?? null,
            'title'   => $params['title'] ?? null,
            'timeout' => $params['timeout'] ?? null,
        ]);
    }
}
