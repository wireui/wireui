import { parseConfirmation, parseNotification } from '../notifications/parses'
import { timer } from '../notifications/timer'
import uuid from '../utils/uuid'

export interface Notifications {
  [index: string]: any
}

export default (): Notifications => ({
  notifications: [],

  init () {
    this.$nextTick(() => {
      window.Wireui.dispatchHook('notifications:load')
    })
  },
  proccessNotification (notification) {
    notification.id = uuid()

    if (notification.timeout) {
      notification.timer = timer(
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
  addNotification (data) {
    const { options, componentId } = Array.isArray(data) ? data[0] : data

    const notification = parseNotification(options, componentId)

    this.proccessNotification(notification)
  },
  addConfirmNotification (data) {
    const { options, componentId } = Array.isArray(data) ? data[0] : data

    const notification = parseConfirmation(options, componentId)

    this.proccessNotification(notification)
  },
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
  },
  removeNotification (id) {
    const index = this.notifications.findIndex(notification => notification.id === id)

    if (~index) { this.notifications.splice(index, 1) }
  },
  closeNotification (notification) {
    notification.onClose()
    notification.onDismiss()
    this.removeNotification(notification.id)
  },
  pauseNotification (notification) {
    notification.timer?.pause()
  },
  resumeNotification (notification) {
    notification.timer?.resume()
  },
  accept (notification) {
    notification.onClose()
    notification.accept.execute()
    this.removeNotification(notification.id)
  },
  reject (notification) {
    notification.onClose()
    notification.reject.execute()
    this.removeNotification(notification.id)
  }
})
