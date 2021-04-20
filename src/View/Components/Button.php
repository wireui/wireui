<?php

namespace WireUi\View\Components;

class Button extends BaseButton
{
    protected function getOutlineColors(): array
    {
        return [
            'primary'   => 'ring-indigo-600 text-indigo-600 border border-indigo-600 hover:bg-indigo-50',
            'secondary' => 'ring-gray-600 text-gray-600 border border-gray-600 hover:bg-gray-100',
            'positive'  => 'ring-green-500 text-green-600 border border-green-600 hover:bg-green-50',
            'negative'  => 'ring-red-500 text-red-600 border border-red-600 hover:bg-red-50',
            'warning'   => 'ring-yellow-500 text-yellow-600 border border-yellow-600 hover:bg-yellow-50',
            'info'      => 'ring-blue-600 text-blue-800 border border-blue-800 hover:bg-blue-50',
            'dark'      => 'ring-gray-600 text-gray-800 border border-gray-800 hover:bg-gray-200',
        ];
    }

    protected function getFlatColors(): array
    {
        return [
            'primary'   => 'ring-indigo-600 text-indigo-600 hover:bg-indigo-100',
            'secondary' => 'ring-gray-600 text-gray-600 hover:bg-gray-100',
            'positive'  => 'ring-green-500 text-green-600 hover:bg-green-100',
            'negative'  => 'ring-red-600 text-red-600 hover:bg-red-100',
            'warning'   => 'ring-yellow-500 text-yellow-600 hover:bg-yellow-100',
            'info'      => 'ring-blue-600 text-blue-600 hover:bg-blue-100',
            'dark'      => 'ring-gray-600 text-gray-900 hover:bg-gray-200',
        ];
    }

    protected function getDefaultColors(): array
    {
        return [
            'primary'   => 'ring-indigo-600 text-white bg-indigo-500 hover:bg-indigo-600',
            'secondary' => 'ring-gray-600 text-white bg-gray-500 hover:bg-gray-600',
            'positive'  => 'ring-green-500 text-white bg-green-500 hover:bg-green-600',
            'negative'  => 'ring-red-600 text-white bg-red-500 hover:bg-red-600',
            'warning'   => 'ring-yellow-500 text-white bg-yellow-500 hover:bg-yellow-600',
            'info'      => 'ring-blue-600 text-white bg-blue-500 hover:bg-blue-600',
            'dark'      => 'ring-gray-600 text-white bg-gray-700 hover:bg-gray-900',
        ];
    }

    protected function getSizes(): array
    {
        return [
            'xs' => 'text-xs',
            'md' => 'text-md',
            'lg' => 'text-lg',
        ];
    }
}
