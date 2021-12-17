import { assert } from 'chai'
import { describe, it } from 'mocha'
import { parseIcon } from '../../../ts/notifications/icons'
import { parseRedirect, parseLivewire } from '../../../ts/notifications/parses'

declare global {
  interface Window {
    Livewire: any
  }
}

window.Livewire = {
  find: () => null
}

describe('Testing notifications parses', () => {
  it('should parse redirect', () => {
    const redirect = 'https://livewire-wireui.com'

    const callback = parseRedirect(redirect)

    assert.isFunction(callback)
  })

  it('should parse livewire action', () => {
    const options = {
      id: 'x-x-x',
      method: 'save',
      params: null
    }

    const callback = parseLivewire(options)

    assert.isFunction(callback)
  })

  it('should parse notification icon', () => {
    const successIcon = parseIcon({ name: 'success' })
    assert.deepEqual(successIcon, {
      name: 'check-circle',
      color: 'text-emerald-400'
    })

    const customIcon = parseIcon({ name: 'x', color: 'text-red-400' })
    assert.deepEqual(customIcon, {
      name: 'x',
      color: 'text-red-400'
    })
  })
})
