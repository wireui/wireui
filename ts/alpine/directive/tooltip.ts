import tippy from "tippy.js"
import { DirectiveParameters } from "@/components/alpine"

export const tooltip = function (el: HTMLElement, content: DirectiveParameters) {
  tippy(el as Element, {
    content: content.expression
  })
}

export default tooltip
