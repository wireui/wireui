import { AlpineComponent } from '@/alpine/components/alpine'
import { parseConfirmation, parseNotification } from '@/alpine/components/notifications/parses'

export default class Notifications extends AlpineComponent {
  notifications: any = []

  init () {
    this.$nextTick(() => {
      window.Wireui.dispatchHook('notifications:load')
    })
  }

  proccessNotification (notification) {
    console.log('proccessNotification', notification)
  }

  addNotification (data) {
    const { options, componentId } = Array.isArray(data) ? data[0] : data

    const notification = parseNotification(options, componentId)

    this.proccessNotification(notification)
  }

  addConfirmNotification (data) {
    const { options, componentId } = Array.isArray(data) ? data[0] : data

    const notification = parseConfirmation(options, componentId)

    this.proccessNotification(notification)
  }

  fillNotificationIcon (notification) {
    const classes = `w-6 h-6 ${notification.icon.color}`.split(' ')

    fetch(`/wireui/icons/outline/${notification.icon.name}`)
      .then(response => response.text())
      .then(text => {
        const svg = new DOMParser().parseFromString(text, 'image/svg+xml').documentElement

        svg.classList.add(...classes)

        document
          ?.getElementById(`notification.${notification.id}`)
          ?.querySelector('.notification-icon')
          ?.replaceChildren(svg)
      })
  }

  removeNotification (id) {
    const index = this.notifications.findIndex(notification => notification.id === id)

    if (~index) {
      this.notifications.splice(index, 1)
    }
  }

  closeNotification (notification) {
    notification.onClose()
    notification.onDismiss()
    this.removeNotification(notification.id)
  }

  pauseNotification (notification) {
    notification.timer?.pause()
  }

  resumeNotification (notification) {
    notification.timer?.resume()
  }

  accept (notification) {
    notification.onClose()
    notification.accept.execute()
    this.removeNotification(notification.id)
  }

  reject (notification) {
    notification.onClose()
    notification.reject.execute()
    this.removeNotification(notification.id)
  }
}
