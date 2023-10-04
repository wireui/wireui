import { Component } from '@/alpine/components/alpine'

export function props (el: HTMLElement): object {
  const $root = el.closest('[x-data]')
  const expression = $root?.getAttribute('x-props')

  if (!expression || !$root) return {}

  const cacheKey = `x-props:${expression}`

  const cache = window.Wireui.cache[cacheKey]

  if (cache) {
    return cache
  }

  const evaluated = window.Alpine.evaluate($root, expression)

  window.Wireui.cache[cacheKey] = evaluated

  return evaluated
}

export function watchProps (component: Component, callback: CallableFunction): void {
  const observer = new MutationObserver(mutations => {
    const wasChanged = mutations.some(
      mutation => mutation.attributeName === 'x-props'
    )

    if (wasChanged) {
      callback(mutations)
    }
  })

  observer.observe(component.$root, { attributes: true })

  // todo: refactor cleanup
  component.$cleanup(() => observer.disconnect())
}
