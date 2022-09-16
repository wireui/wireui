import tippy from 'tippy.js'
import { DirectiveParameters } from '@/components/alpine'

export const tooltip = function (el: Node, content: DirectiveParameters) {
  tippy(el as Element, {
    content: content.expression,
    animation: 'scale',
    theme: 'translucent'
  })
}

export default tooltip
