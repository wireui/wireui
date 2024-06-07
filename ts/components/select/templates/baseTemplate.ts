export default (slot: string) => `
<div
    class="
        py-2 px-3 border-0 outline-none transition-all ease-in-out duration-150 relative group
        text-secondary-600 dark:text-secondary-400 flex items-center justify-between snap-start
    "
    :class="{
        'cursor-pointer focus:bg-primary-100 focus:text-primary-800 hover:text-white dark:focus:bg-secondary-700': !option.readonly,
        'opacity-60 cursor-not-allowed': option.disabled,
        'font-semibold': option.isSelected,
        'hover:bg-negative-500 dark:hover:text-secondary-100': config.clearable && !option.readonly && option.isSelected,
        'hover:bg-primary-500 dark:hover:bg-secondary-700': !config.clearable || !option.readonly && !option.isSelected,
    }"
    :tabindex="!option.readonly && '0'"
    x-on:click="!option.readonly && select(option)"
    x-on:keydown.enter="!option.readonly && select(option)"
    select-option>
    ${slot}

    <template x-if="option.isSelected">
        <div class="flex-shrink-0">
            <svg class="w-5 h-5 text-primary-600 dark:text-secondary-500 group-hover:text-white group-focus:text-primary-600"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
        </div>
    </template>
</div>`
