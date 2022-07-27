import tippy from "tippy.js"

export const tooltip = el => (message, timeout = null) => {
  let instance = tippy(el as Element, {
    content: message,
    animation: 'scale',
    theme: 'translucent',
    trigger: 'manual'
  })

  instance.show()

  setTimeout(() => { instance.hide() }, timeout ?? 2000)
}

export default tooltip
