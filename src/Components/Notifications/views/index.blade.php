<div @class([
        'fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-5 sm:pt-4',
        $positionClasses,
        $zIndex,
    ])
     x-data="wireui_notifications"
     x-on:wireui:notification.window="addNotification($event.detail)"
     x-on:wireui:confirm-notification.window="addConfirmNotification($event.detail)"
     wire:ignore>
    <div class="flex flex-col-reverse w-full max-w-sm space-y-2 pointer-events-auto">
        <template x-for="notification in notifications" :key="`notification-${notification.id}`">
            <div class="relative w-full max-w-sm overflow-hidden bg-white rounded-lg shadow-lg pointer-events-auto ring-1 ring-black ring-opacity-5 dark:bg-secondary-800 dark:border dark:border-secondary-700"
                 :class="{ 'flex': notification.rightButtons }"
                 :id="`notification.${notification.id}`"
                 x-transition:enter="transform ease-out duration-300 transition"
                 x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                 x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                 x-on:mouseenter="pauseNotification(notification)"
                 x-on:mouseleave="resumeNotification(notification)">
                <div class="absolute top-0 left-0 transition-all duration-150 ease-linear rounded-full bg-secondary-300 dark:bg-secondary-600"
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
                            <div class="shrink-0" :class="{
                                    'w-6': Boolean(notification.icon),
                                    'pt-0.5': Boolean(notification.img),
                                }">
                                <template x-if="notification.icon">
                                    <div class="notification-icon"></div>
                                </template>

                                <template x-if="notification.img">
                                    <img class="w-10 h-10 rounded-full" :src="notification.img" />
                                </template>
                            </div>
                        </template>

                        <div class="w-0 flex-1 pt-0.5" :class="{
                                'ml-3': Boolean(notification.icon || notification.img)
                            }">
                            <p class="text-sm font-medium text-secondary-900 dark:text-secondary-400"
                               x-show="notification.title"
                               x-html="notification.title">
                            </p>
                            <p class="mt-1 text-sm text-secondary-500"
                               x-show="notification.description"
                               x-html="notification.description">
                            </p>

                            <!-- actions buttons -->
                            <template x-if="!notification.dense && !notification.rightButtons && (notification.accept || notification.reject)">
                                <div class="flex mt-3 gap-x-3">
                                    <button class="text-sm font-medium rounded-md focus:outline-none"
                                            :class="{
                                            'bg-white dark:bg-transparent text-primary-600 hover:text-primary-500': !Boolean($wireui.dataGet(notification, 'accept.style')),
                                            [$wireui.dataGet(notification, 'accept.style')]: Boolean($wireui.dataGet(notification, 'accept.style')),
                                            'px-3 py-2 border shadow-sm': Boolean($wireui.dataGet(notification, 'accept.solid')),
                                        }"
                                            x-on:click="accept(notification)"
                                            x-show="$wireui.dataGet(notification, 'accept.label')"
                                            x-text="$wireui.dataGet(notification, 'accept.label', '')">
                                    </button>

                                    <button class="text-sm font-medium rounded-md focus:outline-none"
                                            :class="{
                                            'bg-white dark:bg-transparent text-secondary-700 dark:text-secondary-600 hover:text-secondary-500': !Boolean($wireui.dataGet(notification, 'reject.style')),
                                            [$wireui.dataGet(notification, 'reject.style')]: Boolean($wireui.dataGet(notification, 'reject.style')),
                                            'px-3 py-2 border border-secondary-300 shadow-sm': Boolean($wireui.dataGet(notification, 'accept.solid')),
                                        }"
                                            x-on:click="reject(notification)"
                                            x-show="$wireui.dataGet(notification, 'reject.label')"
                                            x-text="$wireui.dataGet(notification, 'reject.label', '')">
                                    </button>
                                </div>
                            </template>
                        </div>

                        <div class="flex ml-4 shrink-0">
                            <!-- accept button -->
                            <button class="mr-4 text-sm font-medium rounded-md shrink-0 focus:outline-none"
                                    :class="{
                                    'text-primary-600 hover:text-primary-500': !Boolean($wireui.dataGet(notification, 'accept.style')),
                                    [$wireui.dataGet(notification, 'accept.style')]: Boolean($wireui.dataGet(notification, 'accept.style'))
                                }"
                                    x-on:click="accept(notification)"
                                    x-show="notification.dense && notification.accept"
                                    x-text="$wireui.dataGet(notification, 'accept.label', '')">
                            </button>

                            <!-- close button -->
                            <button class="inline-flex rounded-md text-secondary-400 hover:text-secondary-500 focus:outline-none"
                                    x-show="notification.closeButton"
                                    x-on:click="closeNotification(notification)">
                                <span class="sr-only">Close</span>
                                <x-dynamic-component
                                        :component="WireUi::component('icon')"
                                        class="w-5 h-5"
                                        name="x-mark"
                                />
                            </button>
                        </div>
                    </div>
                </div>

                <!-- right actions buttons -->
                <template x-if="notification.rightButtons">
                    <div class="flex flex-col border-l border-secondary-200 dark:border-secondary-700">
                        <template x-if="notification.accept">
                            <div class="flex flex-1 h-0" :class="{
                                'border-b border-secondary-200 dark:border-secondary-700': notification.reject
                            }">
                                <button class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium rounded-none rounded-tr-lg focus:outline-none"
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
                            <div class="flex flex-1 h-0">
                                <button class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium rounded-none rounded-br-lg focus:outline-none"
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
