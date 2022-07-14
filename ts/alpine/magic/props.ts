import { Component } from '@/components/alpine'

export const props = function (el: HTMLElement): object {
  const $root = window.Alpine.evaluate(el, '$root')
  const attribute = $root?.getAttribute('x-props')

  if (!attribute) return {}

  return window.Alpine.evaluate($root, attribute)
}

export function watchProps (component: Component, callback: CallableFunction): void {
  const observer = new MutationObserver(() => callback())

  observer.observe(component.$root, { attributes: true })

  component.$cleanup(() => observer.disconnect())
}

export default props
