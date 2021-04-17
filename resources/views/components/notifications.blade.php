@props(['zIndex' => 'z-50'])

<div class="fixed {{ $zIndex }} inset-0 flex items-end justify-center px-4 py-6
            pointer-events-none sm:p-5 sm:pt-4 sm:items-start sm:justify-end"
    x-data="{
        defaultIcons: ['success', 'error', 'warning', 'info', 'question'],
        notifications: [],

        makeNotificationTimer(notificationId, delay) {
            const timer = window.$wireui.utils.timeout(() => {
                const isDismissed = false
                const isTimeover  = true
                this.removeNotification(notificationId, isDismissed, isTimeover)
            }, delay, notificationId)

            let timeout     = delay
            let percentage  = 100
            let progressBar = null

            const interval = window.$wireui.utils.interval(() => {
                if (!progressBar) {
                    progressBar = document.getElementById(`timeout.bar.${notificationId}`)

                    if (!progressBar) return
                }

                timeout   -= 100
                percentage = Math.floor(timeout * 100 / delay)
                progressBar.style.width = `${percentage}%`

                if (timeout === 100) { interval.pause() }
            }, 100)

            return {
                pause: () => {
                    timer.pause()
                    interval.pause()
                },
                resume: () => {
                    timer.resume()
                    interval.resume()
                },
            }
        },
        addNotification(event) {
            const notification = window.$wireui.makeNotification(event.options, event.componentId)
            notification.id    = window.$wireui.utils.uuid()

            if (notification.timeout !== false) {
                notification.timer = this.makeNotificationTimer(notification.id, notification.timeout)
            }

            this.notifications.push(notification)

            if (notification.icon && !this.defaultIcons.includes(notification.icon)) {
                this.fillNotificationIcon(notification)
            }
        },
        pauseNotification(notification) { notification.timer?.pause() },
        resumeNotification(notification) { notification.timer?.resume() },
        notificationPostActions(notification, isDismissed, isTimeover) {
            if (typeof notification.onClose === 'function') {
                notification.onClose()
            }
            if (isDismissed && typeof notification.onDismiss === 'function') {
                notification.onDismiss()
            }
            if (isTimeover && typeof notification.onTimeout === 'function') {
                notification.onTimeout()
            }
        },
        removeNotification(id, isDismissed = false, isTimeover = false) {
            const index = this.notifications.findIndex(notification => notification.id === id)
            if (~index) {
                const notification = this.notifications[index]
                this.notificationPostActions(notification, isDismissed, isTimeover)
                this.notifications.splice(index, 1)
            }
        },
        accept(notification) {
            this.proccessAction(notification.accept)
            this.removeNotification(notification.id)
        },
        reject(notification) {
            this.proccessAction(notification.reject)
            this.removeNotification(notification.id)
        },
        proccessAction(action) {
            if (!action) return

            if (action.callback) { action.callback() }
            else if (action.url) { window.location.href = action.url }
        },
        fillNotificationIcon(notification) {
            const classes = ['w-6', 'h-6']

            notification.iconColor
                ? classes.push(...notification.iconColor.split(' '))
                : classes.push('text-gray-400')

            fetch(`/wireui/icons/{{ config('wireui.icons.style') }}/${notification.icon}`)
                .then(response => response.text())
                .then(text => {
                    const svg = new DOMParser().parseFromString(text, 'image/svg+xml').documentElement
                    svg.classList.add(...classes)
                    this.$refs[`notification.icon.${notification.id}`].appendChild(svg)
                })
        },
    }"
    x-on:wireui:notification.window="addNotification($event.detail)"
    wire:ignore>
    <div class="max-w-sm w-full space-y-2 pointer-events-auto flex flex-col-reverse">
        <template x-for="notification in notifications" :key="`notification-${notification.id}`">
            <div class="max-w-sm w-full bg-white shadow-lg rounded-lg ring-1 ring-black
                        ring-opacity-5 relative overflow-hidden pointer-events-auto"
                :class="{ 'flex': notification.rightButtons }"
                x-transition:enter="transform ease-out duration-300 transition"
                x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                x-on:mouseenter="pauseNotification(notification)"
                x-on:mouseleave="resumeNotification(notification)">
                <div class="bg-gray-300 rounded-full transition-all duration-150 ease-linear absolute top-0 left-0"
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
                        <template x-if="notification.icon || notification.img">
                            <div class="flex-shrink-0"
                                :class="{
                                    'w-6': Boolean(notification.icon),
                                    'pt-0.5': Boolean(notification.img),
                                }"
                                :x-ref="`notification.${notification.id}`">
                                <template x-if="notification.icon">
                                    <div :x-ref="`notification.icon.${notification.id}`">
                                        <x-wireui::icon class="h-6 w-6"
                                            x-bind:class="{
                                                'text-green-400': !notification.iconColor,
                                                [notification.iconColor]: notification.iconColor
                                            }"
                                            x-show="notification.icon === 'success'"
                                            name="check-circle" />
                                        <x-wireui::icon class="h-6 w-6"
                                            x-bind:class="{
                                                'text-red-400': !notification.iconColor,
                                                [notification.iconColor]: notification.iconColor
                                            }"
                                            x-show="notification.icon === 'error'"
                                            name="exclamation" />
                                        <x-wireui::icon class="h-6 w-6"
                                            x-bind:class="{
                                                'text-yellow-400': !notification.iconColor,
                                                [notification.iconColor]: notification.iconColor
                                            }"
                                            x-show="notification.icon === 'warning'"
                                            name="exclamation-circle" />
                                        <x-wireui::icon class="h-6 w-6"
                                            x-bind:class="{
                                                'text-blue-400': !notification.iconColor,
                                                [notification.iconColor]: notification.iconColor
                                            }"
                                            x-show="notification.icon === 'info'"
                                            name="information-circle" />
                                        <x-wireui::icon class="h-6 w-6"
                                            x-bind:class="{
                                                'text-gray-400': !notification.iconColor,
                                                [notification.iconColor]: notification.iconColor
                                            }"
                                            x-show="notification.icon === 'question'"
                                            name="question-mark-circle" />
                                    </div>
                                </template>
                                <template x-if="notification.img">
                                    <img class="h-10 w-10 rounded-full" :src="notification.img" />
                                </template>
                            </div>
                        </template>

                        <div class="w-0 flex-1 pt-0.5" :class="{
                            'ml-3': Boolean(notification.icon || notification.img)
                        }">
                            <p class="text-sm font-medium text-gray-900"
                                x-show="notification.title"
                                x-text="notification.title">
                            </p>
                            <p class="text-sm text-gray-500"
                                x-show="notification.description"
                                x-text="notification.description">
                            </p>
                            <template x-if="!notification.dense && !notification.rightButtons && (notification.accept || notification.reject)">
                                <div class="mt-3 flex gap-x-3">
                                    <button class="rounded-md text-sm font-medium focus:outline-none"
                                        :class="{
                                            'bg-white text-indigo-600 hover:text-indigo-500': !Boolean(notification.accept?.style),
                                            [notification.accept?.style]: Boolean(notification.accept?.style),
                                            'px-3 py-2 border shadow-sm': Boolean(notification.accept?.solid),
                                        }"
                                        x-on:click="accept(notification)"
                                        x-show="notification.accept?.label"
                                        x-text="notification.accept?.label">
                                    </button>
                                    <button class="rounded-md text-sm font-medium focus:outline-none"
                                        :class="{
                                            'bg-white text-gray-700 hover:text-gray-500': !Boolean(notification.reject?.style),
                                            [notification.reject?.style]: Boolean(notification.reject?.style),
                                            'px-3 py-2 border border-gray-300 shadow-sm': Boolean(notification.accept?.solid),
                                        }"
                                        x-on:click="reject(notification)"
                                        x-show="notification.reject?.label"
                                        x-text="notification.reject?.label">
                                    </button>
                                </div>
                            </template>
                        </div>

                        <div class="ml-4 flex-shrink-0 flex">
                            <button class="mr-4 flex-shrink-0 rounded-md text-sm font-medium focus:outline-none"
                                :class="{
                                    'text-indigo-600 hover:text-indigo-500': !Boolean(notification.accept?.style),
                                    [notification.accept?.style]: Boolean(notification.accept?.style)
                                }"
                                x-on:click="accept(notification)"
                                x-show="notification.dense && notification.accept"
                                x-text="notification.accept?.label">
                            </button>

                            <button class="rounded-md bg-white inline-flex text-gray-400 hover:text-gray-500 focus:outline-none"
                                x-show="notification.closeButton"
                                x-on:click="removeNotification(notification.id, true)">
                                <span class="sr-only">Close</span>
                                <x-wireui::icon name="x" class="h-5 w-5" />
                            </button>
                        </div>
                    </div>
                </div>
                <template x-if="notification.rightButtons">
                    <div class="flex flex-col border-l border-gray-200">
                        <template x-if="notification.accept">
                            <div class="h-0 flex-1 flex" :class="{ 'border-b border-gray-200': notification.reject }">
                                <button class="w-full rounded-none rounded-tr-lg px-4 py-3 flex items-center
                                                justify-center text-sm font-medium focus:outline-none"
                                    :class="{
                                        'text-indigo-600 hover:text-indigo-500 hover:bg-gray-50': !Boolean(notification.accept.style),
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
                                        'text-gray-700 hover:text-gray-500 hover:bg-gray-50': !Boolean(notification.reject.style),
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
