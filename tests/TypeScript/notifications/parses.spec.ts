import { parseIcon } from '@/notifications/icons'
import { parseRedirect, parseLivewire } from '@/notifications/parses'

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

    expect(callback).toBeFunction()
  })

  it('should parse livewire action', () => {
    const options = {
      id: 'x-x-x',
      method: 'save',
      params: null
    }

    const callback = parseLivewire(options)

    expect(callback).toBeFunction()
  })

  it('should parse notification icon', () => {
    const successIcon = parseIcon({ name: 'success' })
    expect(successIcon).toEqual({
      name: 'check-circle',
      color: 'text-positive-400'
    })

    const customIcon = parseIcon({ name: 'x', color: 'text-red-400' })
    expect(customIcon).toEqual({
      name: 'x',
      color: 'text-red-400'
    })
  })
})
