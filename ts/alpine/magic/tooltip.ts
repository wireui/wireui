import tippy from 'tippy.js'

export const tooltip = el => (message, timeout = null) => {
  const instance = tippy(el as Element, {
    content: message,
    trigger: 'manual'
  })

  instance.show()

  setTimeout(() => { instance.hide() }, timeout ?? 2000)
}

export default tooltip
