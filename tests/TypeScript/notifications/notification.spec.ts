import { assert } from 'chai'
import { describe, it } from 'mocha'
import { parseConfirmation, parseNotification } from '../../../ts/notifications/parses'

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

    assert.equal(notification.title, options.title)
    assert.equal(notification.description, options.description)
    assert.isFunction(notification.onClose)
    assert.isFunction(notification.onTimeout)
    assert.isFunction(notification.onDismiss)
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

    assert.isFunction(notification.onClose)
    assert.isFunction(notification.onTimeout)
    assert.isFunction(notification.onDismiss)

    notification.onClose()
    notification.onTimeout()
    notification.onDismiss()

    assert.isTrue(onClose)
    assert.isTrue(onTimeout)
    assert.isTrue(onDismiss)
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

    assert.equal(notification.accept.label, 'Save')
    assert.equal(notification.reject.label, 'Delete')
    assert.isFunction(notification.accept.execute)
    assert.isFunction(notification.reject.execute)
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

    assert.equal(notification.accept.label, 'Save')
    assert.equal(notification.reject.label, 'Delete')
    assert.isFunction(notification.accept.execute)
    assert.isFunction(notification.reject.execute)

    notification.reject.execute()
    notification.accept.execute()

    assert.isTrue(accepted)
    assert.isTrue(rejected)
  })
})
