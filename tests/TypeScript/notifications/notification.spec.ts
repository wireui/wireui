import { parseConfirmation, parseNotification } from '@/notifications/parses'

declare global {
  interface Window {
    Livewire: any
  }
}

window.Livewire = {
  find: () => null
}

describe('Testing notifications', () => {
  it('should parse notification', () => {
    const options = {
      title: 'Success Notification',
      description: 'Success action'
    }

    const notification = parseNotification(options)

    expect(notification.title).toEqual(options.title)
    expect(notification.description).toEqual(options.description)
    expect(notification.onClose).toBeFunction()
    expect(notification.onTimeout).toBeFunction()
    expect(notification.onDismiss).toBeFunction()
  })

  it('should parse notification with events', () => {
    let onClose = false
    let onTimeout = false
    let onDismiss = false

    const options = {
      title: 'Events Notification',
      onClose () { onClose = true },
      onTimeout () { onTimeout = true },
      onDismiss () { onDismiss = true }
    }

    const notification = parseNotification(options)

    expect(notification.onClose).toBeFunction()
    expect(notification.onTimeout).toBeFunction()
    expect(notification.onDismiss).toBeFunction()

    notification.onClose()
    notification.onTimeout()
    notification.onDismiss()

    expect(onClose).toBeTrue()
    expect(onTimeout).toBeTrue()
    expect(onDismiss).toBeTrue()
  })

  it('should parse confirm notification', () => {
    const options = {
      title: 'Confirm Notification',
      accept: {
        label: 'Save',
        method: 'save'
      },
      reject: {
        label: 'Delete',
        method: 'delete',
        params: 1
      }
    }

    const notification = parseConfirmation(options, 'x-x-x')

    expect(notification.accept.label).toEqual('Save')
    expect(notification.reject.label).toEqual('Delete')
    expect(notification.accept.execute).toBeFunction()
    expect(notification.reject.execute).toBeFunction()
  })

  it('should parse confirm notification with callable actions', () => {
    let accepted = false
    let rejected = false
    const options = {
      title: 'Confirm Notification',
      accept: {
        label: 'Save',
        execute: () => { accepted = true }
      },
      reject: {
        label: 'Delete',
        execute: () => { rejected = true }
      }
    }

    const notification = parseConfirmation(options, 'x-x-x')

    expect(notification.accept.label).toBe('Save')
    expect(notification.reject.label).toBe('Delete')
    expect(notification.accept.execute).toBeFunction()
    expect(notification.reject.execute).toBeFunction()

    notification.reject.execute()
    notification.accept.execute()

    expect(accepted).toBeTrue()
    expect(rejected).toBeTrue()
  })
})
