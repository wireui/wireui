<div>
    <h1>notifications test</h1>

    <span dusk="value">{{ $value }}</span>
    <span dusk="events">{{ implode(',', $events) }}</span>

    <button
        dusk="button.test.directive"
        type="button"
        @confirmAction({
            title: 'Confirm Action',
            accept: {
                label: 'Confirm Directive',
                method: 'setValue',
                params: 'Accepted'
            },
            reject: {
                label: 'Cancel Directive',
                method: 'setValue',
                params: 'Rejected'
            }
        })>
        Confirm action dialog
    </button>

    <button
        dusk="button.test.simple_notification"
        wire:click="showSimpleNotification">
        Show Success Notification
    </button>

    <button
        dusk="button.test.call_confirm_action_with_single_callback"
        wire:click="showConfirmActionWithSingleCallback">
        Call Confirm Action with single callback
    </button>

    <button
        dusk="button.clear_events"
        wire:click="clearEvents">
        clear events
    </button>

    <button
        dusk="button.test.call_confirm_action_with_multiples_callbacks_and_events"
        wire:click="showConfirmActionWithMultipleCallbacksAndEvents">
        Call Confirm Action with multiples callbacks and events
    </button>

    <button
        dusk="button.test.js.simple_notification"
        onclick="addSimpleNotification()">
        Fire Simple Notification from js
    </button>

    <button
        dusk="button.test.js.complex_notification"
        onclick="firstComplexPersistentNotification()">
        Fire Complex Notification from js
    </button>

    <button
        dusk="button.test.redirect_on_close_notification"
        onclick="showNotificationWithRedirectOnClose()">
        Redirect on close Notification
    </button>

    @push('scripts')
        <script>
            function addSimpleNotification() {
                window.$wireui.notify({
                    title: 'My Simple Notification from js',
                    icon: 'info',
                })
            }

            function firstComplexPersistentNotification() {
                window.$wireui.notify({
                    title: 'My Complex Notification from js',
                    description: 'Want to delete this record?',
                    icon: 'success',
                    iconColor: 'text-blue-900',
                    closeButton: false,
                    timeout: false,
                    accept: {
                        label: 'Delete',
                        style: null,
                        execute: () => @this.call('setValue', 'deleted')
                    },
                    reject: {
                        label: 'No delete',
                        style: null,
                        execute: () => @this.call('setValue', 'delete canceled')
                    },
                    onClose:   () => @this.call('addEvent', 'onClose'),
                    onDismiss: () => @this.call('addEvent', 'onDismiss'),
                    onTimeout: () => @this.call('addEvent', 'onTimeout'),
                })
            }

            function showNotificationWithRedirectOnClose() {
                window.$wireui.notify({
                    title: 'My Simple Notification from js',
                    icon: 'info',
                    onClose: {
                        url: `${window.location.href}#redirected`
                    }
                })
            }
        </script>
    @endpush
</div>
