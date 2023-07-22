@props(['prop' => null, 'required' => null, 'default' => null, 'type' => null, 'available' => null])

<tr>
    <td class="p-2.5 font-mono text-xs text-primary-600 whitespace-nowrap">
        {{ $prop }}
    </td>
    <td class="p-2.5 font-mono text-xs text-secondary-600 dark:text-secondary-400 whitespace-nowrap">
        {{ $required }}
    </td>
    <td class="p-2.5 font-mono text-xs text-secondary-600 dark:text-secondary-400 whitespace-nowrap">
        {{ $default }}
    </td>
    <td class="p-2.5 font-mono text-xs text-secondary-600 dark:text-secondary-400 whitespace-nowrap">
        {{ $type }}
    </td>

    @if ($available ?? null)
        <td class="p-2.5 font-mono text-xs text-secondary-600 dark:text-secondary-400 whitespace-nowrap">
            {{ $available }}
        </td>
    @endif
</tr>
