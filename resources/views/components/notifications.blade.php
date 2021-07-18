<div class="fixed {{ $zIndex }} inset-0 flex items-end justify-center px-4 py-6
            pointer-events-none sm:p-5 sm:pt-4 sm:items-start sm:justify-end"
    x-data="{
        notifications: [],

        proccessNotification(notification) {
            notification.id = $wireui.utils.uuid()

            if (notification.timeout) {
                notification.timer = $wireui.notifications.timer(
                    notification.timeout,
                    () => {
                        notification.onClose()
                        notification.onTimeout()
                        this.removeNotification(notification.id)
                    },
                    (percentage) => {
                        const progressBar = document.getElementById(`timeout.bar.${notification.id}`)

                        if (!progressBar) return

                        progressBar.style.width = `${percentage}%`
                    }
                )
            }

            this.notifications.push(notification)

            if (notification.icon) {
                this.$nextTick(() => {
                    this.fillNotificationIcon(notification)
                })
            }
        },
        addNotification({ options, componentId }) {
            const notification = $wireui.notifications.parseNotification(options, componentId)

            this.proccessNotification(notification)
        },
        addConfirmNotification({ options, componentId }) {
            const notification = $wireui.notifications.parseConfirmation(options, componentId)

            this.proccessNotification(notification)
        },
        fillNotificationIcon(notification) {
            const classes = `w-6 h-6 ${notification.icon.color}`.split(' ')

            fetch(`/wireui/icons/{{ config('wireui.icons.style') }}/${notification.icon.name}`)
                .then(response => response.text())
                .then(text => {
                    const svg = new DOMParser().parseFromString(text, 'image/svg+xml').documentElement

                    svg.classList.add(...classes)

                    document
                        .getElementById(`notification.${notification.id}`)
                        .querySelector('.notification-icon')
                        .replaceChildren(svg)
                })
        },
        removeNotification(id) {
            const index = this.notifications.findIndex(notification => notification.id === id)

            if (~index) { this.notifications.splice(index, 1) }
        },
        closeNotification(notification) {
            notification.onClose()
            notification.onDismiss()
            this.removeNotification(notification.id)
        },
        pauseNotification(notification) { notification.timer?.pause() },
        resumeNotification(notification) { notification.timer?.resume() },
        accept(notification) {
            notification.onClose()
            notification.accept.execute()
            this.removeNotification(notification.id)
        },
        reject(notification) {
            notification.onClose()
            notification.reject.execute()
            this.removeNotification(notification.id)
        }
    }"
    x-on:wireui:notification.window="addNotification($event.detail)"
    x-on:wireui:confirm-notification.window="addConfirmNotification($event.detail)"
    x-init="function() {
        Wireui.dispatchHook('notifications:load')
    }"
    wire:ignore>
    <div class="max-w-sm w-full space-y-2 pointer-events-auto flex flex-col-reverse">
        <template x-for="notification in notifications" :key="`notification-${notification.id}`">
            <div class="max-w-sm w-full bg-white shadow-lg rounded-lg ring-1 ring-black
                        ring-opacity-5 relative overflow-hidden pointer-events-auto
                        dark:bg-secondary-800 dark:border dark:border-secondary-700"
                :class="{ 'flex': notification.rightButtons }"
                :id="`notification.${notification.id}`"
                x-transition:enter="transform ease-out duration-300 transition"
                x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                x-on:mouseenter="pauseNotification(notification)"
                x-on:mouseleave="resumeNotification(notification)">
                <div class="bg-secondary-300 dark:bg-secondary-600 rounded-full transition-all duration-150 ease-linear absolute top-0 left-0"
                    style="height: 2px; width: 100%;"
                    :id="`timeout.bar.${notification.id}`"
                    x-show="Boolean(notification.timer) && notification.progressbar !== false">
                </div>
                <div :class="{
                        'pl-4': Boolean(notification.dense),
                        'p-4': !Boolean(notification.rightButtons),
                        'w-0 flex-1 flex items-center p-4': Boolean(notification.rightButtons),
                    }">
                    <div :class="{
                        'flex items-start': !Boolean(notification.rightButtons),
                        'w-full flex': Boolean(notification.rightButtons),
                    }">
                        <!-- notification icon|img -->
                        <template x-if="notification.icon || notification.img">
                            <div class="flex-shrink-0" :class="{
                                    'w-6': Boolean(notification.icon),
                                    'pt-0.5': Boolean(notification.img),
                                }">
                                <template x-if="notification.icon">
                                    <div class="notification-icon"></div>
                                </template>

                                <template x-if="notification.img">
                                    <img class="h-10 w-10 rounded-full" :src="notification.img" />
                                </template>
                            </div>
                        </template>

                        <div class="w-0 flex-1 pt-0.5" :class="{
                                'ml-3': Boolean(notification.icon || notification.img)
                            }">
                            <p class="text-sm font-medium text-secondary-900 dark:text-secondary-400"
                                x-show="notification.title"
                                x-text="notification.title">
                            </p>
                            <p class="text-sm text-secondary-500"
                                x-show="notification.description"
                                x-text="notification.description">
                            </p>

                            <!-- actions buttons -->
                            <template x-if="!notification.dense && !notification.rightButtons && (notification.accept || notification.reject)">
                                <div class="mt-3 flex gap-x-3">
                                    <button class="rounded-md text-sm font-medium focus:outline-none"
                                        :class="{
                                            'bg-white dark:bg-transparent text-primary-600 hover:text-primary-500': !Boolean(notification.accept?.style),
                                            [notification.accept?.style]: Boolean(notification.accept?.style),
                                            'px-3 py-2 border shadow-sm': Boolean(notification.accept?.solid),
                                        }"
                                        x-on:click="accept(notification)"
                                        x-show="notification.accept?.label"
                                        x-text="notification.accept?.label">
                                    </button>

                                    <button class="rounded-md text-sm font-medium focus:outline-none"
                                        :class="{
                                            'bg-white dark:bg-transparent text-secondary-700 dark:text-secondary-600 hover:text-secondary-500': !Boolean(notification.reject?.style),
                                            [notification.reject?.style]: Boolean(notification.reject?.style),
                                            'px-3 py-2 border border-secondary-300 shadow-sm': Boolean(notification.accept?.solid),
                                        }"
                                        x-on:click="reject(notification)"
                                        x-show="notification.reject?.label"
                                        x-text="notification.reject?.label">
                                    </button>
                                </div>
                            </template>
                        </div>

                        <div class="ml-4 flex-shrink-0 flex">
                            <!-- accept button -->
                            <button class="mr-4 flex-shrink-0 rounded-md text-sm font-medium focus:outline-none"
                                :class="{
                                    'text-primary-600 hover:text-primary-500': !Boolean(notification.accept?.style),
                                    [notification.accept?.style]: Boolean(notification.accept?.style)
                                }"
                                x-on:click="accept(notification)"
                                x-show="notification.dense && notification.accept"
                                x-text="notification.accept?.label">
                            </button>

                            <!-- close button -->
                            <button class="rounded-md inline-flex text-secondary-400 hover:text-secondary-500 focus:outline-none"
                                x-show="notification.closeButton"
                                x-on:click="closeNotification(notification)">
                                <span class="sr-only">Close</span>
                                <x-icon name="x" class="h-5 w-5" />
                            </button>
                        </div>
                    </div>
                </div>

                <!-- right actions buttons -->
                <template x-if="notification.rightButtons">
                    <div class="flex flex-col border-l border-secondary-200 dark:border-secondary-700">
                        <template x-if="notification.accept">
                            <div class="h-0 flex-1 flex" :class="{
                                'border-b border-secondary-200 dark:border-secondary-700': notification.reject
                            }">
                                <button class="w-full rounded-none rounded-tr-lg px-4 py-3 flex items-center
                                               justify-center text-sm font-medium focus:outline-none"
                                    :class="{
                                        'text-primary-600 hover:text-primary-500 hover:bg-secondary-50 dark:hover:bg-secondary-700': !Boolean(notification.accept.style),
                                        [notification.accept.style]: Boolean(notification.accept.style),
                                        'rounded-br-lg': !Boolean(notification.reject),
                                    }"
                                    x-on:click="accept(notification)"
                                    x-text="notification.accept.label">
                                </button>
                            </div>
                        </template>

                        <template x-if="notification.reject">
                            <div class="h-0 flex-1 flex">
                                <button class="w-full rounded-none rounded-br-lg px-4 py-3 flex items-center
                                                justify-center text-sm font-medium focus:outline-none"
                                    :class="{
                                        'text-secondary-700 hover:text-secondary-500 dark:text-secondary-600 hover:bg-secondary-50 dark:hover:bg-secondary-700': !Boolean(notification.reject.style),
                                        [notification.reject.style]: Boolean(notification.reject.style),
                                        'rounded-tr-lg': !Boolean(notification.accept),
                                    }"
                                    x-on:click="reject(notification)"
                                    x-text="notification.reject.label">
                                </button>
                            </div>
                        </template>
                    </div>
                </template>
            </div>
        </template>
    </div>
</div>
