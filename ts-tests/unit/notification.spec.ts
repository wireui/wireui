import { assert } from 'chai'
import { describe, it } from 'mocha'
import { makeCallback, parseActions, parseEvents, makeNotification, NotificationOptions } from '../../ts/notification'

declare global {
  interface Window {
    Livewire: any
  }
}

describe('Testing notifications', () => {
  window.Livewire = {
    find: () => null
  }

  it('should make call livewire action callback', () => {
    const callback = makeCallback('componentId', 'delete', 1)

    assert.isFunction(callback)
  })

  it('should parse notification actions', () => {
    const notification = {
      title: 'Testing',
      accept: {
        label: 'Save',
        method: 'save'
      },
      reject: {
        label: 'Delete',
        method: 'delete',
        params: 1
      }
    } as NotificationOptions

    parseActions(notification, 'componentId')

    assert.isFunction(notification.accept?.callback)
    assert.isFunction(notification.reject?.callback)
  })

  it('should parse notification events into callback', () => {
    const notification = {
      title: 'Testing',
      onClose: {
        url: '#redirect-to'
      }
    } as NotificationOptions

    parseEvents(notification, 'componentId')

    assert.isFunction(notification.onClose)
  })

  it('should parse simple notification', () => {
    let notification = {
      title: 'Testing',
      accept: {
        label: 'Save',
        callback: () => null
      },
      onClose: {
        url: '#redirect-to'
      }
    } as NotificationOptions

    notification = makeNotification(notification)

    assert.equal('Testing', notification.title)
    assert.isFunction(notification.accept?.callback)
    assert.isFunction(notification.onClose)
  })

  it('should parse simple notification with method and componentId', () => {
    let notification = {
      title: 'Testing',
      acceptLabel: 'Delete',
      method: 'delete',
      params: 1
    } as NotificationOptions

    notification = makeNotification(notification, 'componentId')

    assert.equal('Delete', notification.accept?.label)
    assert.isFunction(notification.accept?.callback)
  })

  it('should parse complete notification with method and componentId', () => {
    let notification = {
      title: 'Testing',
      accept: {
        label: 'Save',
        method: 'save'
      },
      reject: {
        label: 'Delete',
        method: 'delete',
        params: 1
      }
    } as NotificationOptions

    notification = makeNotification(notification, 'componentId')

    assert.equal('Save', notification.accept?.label)
    assert.equal('Delete', notification.reject?.label)
    assert.isFunction(notification.accept?.callback)
    assert.isFunction(notification.reject?.callback)
  })
})
