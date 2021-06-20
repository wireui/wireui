<div class="fixed inset-0 overflow-y-auto {{ $zIndex }}"
x-data="{
    show: false,
    style: null,
    dialog: null,
    timeoutId: null,

    dismiss() {
        this.close()
        this.dialog.onDismiss()
    },
    close() {
        this.show = false
        clearTimeout(this.timeoutId)
        this.dialog.onClose()
        this.timeoutId = null
    },
    open() { this.show = true },
    processDialog(options) {
        this.dialog = options
        this.style  = options.style

        if (this.$refs.title) { this.$refs.title.innerHTML = null }
        if (this.$refs.description) { this.$refs.description.innerHTML = null }

        if (options.icon) {
            this.fillIconBackground(options.icon)
            this.fillDialogIcon(options.icon)
        }

        if (options.accept) {
            this.createAcceptButton(options.accept)
        }

        if (options.reject) {
            this.createRejectButton(options.reject)
        }

        if (options.title) {
            this.$refs.title.innerHTML = options.title
        }

        if (options.description) {
            this.$refs.description.innerHTML = options.description
        }

        this.$nextTick(() => this.open())

        if (this.dialog.timeout) {
            this.startCloseTimeout()
        }
    },
    showDialog({ options, componentId }) {
        this.processDialog($wireui.dialogs.parseDialog(options, componentId))
    },
    confirmDialog({ options, componentId }) {
        this.processDialog($wireui.dialogs.parseConfirmation(options, componentId))
    },
    fillIconBackground(icon) {
        this.$refs.iconContainer.className = icon?.background ?? ''
    },
    fillDialogIcon(icon) {
        const classes = ['w-10', 'h-10']

        if (icon?.color) {
            classes.push(...icon.color.split(' '))
        }

        if (this.style === 'inline') {
            classes.push('sm:w-6', 'sm:h-6')
        }

        fetch(`/wireui/icons/{{ config('wireui.icons.style') }}/${icon.name}`)
            .then(response => response.text())
            .then(text => {
                const svg = new DOMParser().parseFromString(text, 'image/svg+xml').documentElement
                svg.classList.add(...classes)
                this.$refs.iconContainer.replaceChildren(svg)
            })
    },
    makeButtonParams(options) {
        const buttonOptions = {
            label: options.label,
            color: options.color,
            size: options.size,
            rounded: options.rounded,
            squared: options.squared,
            bordered: options.bordered,
            flat: options.flat,
            icon: options.icon,
            rightIcon: options.rightIcon
        }

        Object.keys(buttonOptions).forEach(key => {
            if (buttonOptions[key] === undefined) {
                delete buttonOptions[key]
            }
        })

        return new URLSearchParams(buttonOptions)
    },
    createButton(options, action) {
        fetch(`/wireui/button?${this.makeButtonParams(options)}`)
            .then(response => response.text())
            .then(html => {
                const button = this.parseHtmlString(html)
                button.setAttribute('x-on:click', action)
                button.classList.add('w-full')

                this.$refs[action].replaceChildren(button)
            })
    },
    createAcceptButton(accept) {
        this.createButton(accept, 'accept')
    },
    createRejectButton(reject) {
        this.createButton(reject, 'reject')
    },
    parseHtmlString(html) {
        const div     = document.createElement('div')
        div.innerHTML = html

        return div.firstElementChild
    },
    startCloseTimeout() {
        this.timeoutId = setTimeout(() => {
            this.close()
            this.dialog.onTimeout()
        }, this.dialog.timeout)
    },
    accept() {
        this.close()
        this.dialog.accept.execute()
    },
    reject() {
        this.close()
        this.dialog.reject.execute()
    },
    handleEscape() {
        if (this.show) { this.dismiss() }
    }
}"
x-init="function() {
    Wireui.dispatchHook('{{ $dialog }}:load')
}"
x-show="show"
x-on:wireui:{{ $dialog }}.window="showDialog($event.detail)"
x-on:wireui:confirm-{{ $dialog }}.window="confirmDialog($event.detail)"
x-on:keydown.escape.window="handleEscape"
style="display: none">
    <div class="flex items-end sm:items-start sm:pt-16 min-h-screen justify-center">
        <div class="fixed inset-0 bg-gray-400 bg-opacity-60 transform transition-opacity {{ $dialog }}-backdrop"
            x-show="show"
            x-on:click="dismiss"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
        </div>

        <div class="w-full transform transition-all p-4 sm:max-w-lg"
            x-show="show"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <div class="relative shadow-md bg-white rounded-xl overflow-hidden space-y-4 p-4"
                :class="{
                    'sm:p-5 sm:pt-7': style === 'center',
                    'sm:p-0': style === 'inline',
                }">
                <div class="bg-gray-300 rounded-full transition-all duration-150 ease-linear absolute top-0 left-0"
                    style="height: 2px; width: 100%;"
                    x-ref="timeoutBar"
                    x-show="dialog?.timeoutBar !== false">
                </div>

                <div x-show="dialog?.closeButton" class="absolute right-2 -top-2">
                    <button class="{{ $dialog }}-button-close focus:outline-none p-1 focus:ring-2 focus:ring-gray-200 rounded-full text-gray-300"
                        x-on:click="close"
                        type="button">
                        <span class="sr-only">close</span>
                        <x-icon name="x" class="w-5 h-5" />
                    </button>
                </div>

                <div class="space-y-4" :class="{ 'sm:space-x-4 sm:flex sm:space-y-0 sm:px-5 sm:py-2': style === 'inline' }">
                    <div class="mx-auto flex items-center justify-center flex-shrink-0"
                        :class="{ 'sm:items-start sm:mx-0': style === 'inline' }"
                        x-show="dialog?.icon">
                        <div x-ref="iconContainer"></div>
                    </div>

                    <div class="mt-4" :class="{ 'sm:mt-5': style === 'center' }">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 text-center"
                            :class="{ 'sm:text-left': style === 'inline' }"
                            @unless($title) x-ref="title" @endunless>
                            {{ $title }}
                        </h3>

                        <p class="mt-2 text-sm text-gray-500 text-center"
                            :class="{ 'sm:text-left': style === 'inline' }"
                            @unless($description) x-ref="description" @endunless>
                            {{ $description }}
                        </p>

                        {{ $slot }}
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-y-2 sm:gap-x-3" :class="{
                        'sm:grid-cols-2 sm:gap-y-0': style === 'center',
                        'sm:p-4 sm:bg-gray-100 sm:grid-cols-none sm:flex sm:justify-end': style === 'inline',
                    }">
                    <div x-show="dialog?.accept" class="sm:order-last" x-ref="accept"></div>
                    <div x-show="dialog?.reject" x-ref="reject"></div>
                </div>
            </div>
        </div>
    </div>
</div>
