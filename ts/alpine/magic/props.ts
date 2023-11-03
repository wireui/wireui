import { Component } from '@/components/alpine'
import { AlpineComponent } from '@/components/alpine2'

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

export function watchProps (component: Component|AlpineComponent, callback: CallableFunction): void {
  const observer = new MutationObserver(mutations => {
    const wasChanged = mutations.some(
      mutation => mutation.attributeName === 'x-props'
    )

    if (wasChanged) {
      callback(mutations)
    }
  })

  observer.observe(component.$root, { attributes: true })

  // @ts-ignore
  if (component.$destroy) {
    // @ts-ignore
    component.$destroy(() => observer.disconnect())
  }

  // @ts-ignore
  if (component.$cleanup) {
    // @ts-ignore
    component.$cleanup(() => observer.disconnect())
  }
}
