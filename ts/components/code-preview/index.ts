import ClipboardJS from 'clipboard'

export type Refs = {
  copy: HTMLInputElement,
  code: HTMLInputElement
}

export default () => ({
  code: false,
  copy: false,
  $refs: {} as Refs,
  init () {
    this.initClipboard()
  },
  toggle () {
    this.code = !this.code
  },
  initClipboard () {
    if (!this.$refs.copy) return

    this.setCodeBlockId()

    const clipboard = new ClipboardJS(this.$refs.copy)

    clipboard.on('success', (element) => {
      this.copy = true

      element.clearSelection()

      setTimeout(() => {
        this.copy = false
      }, 2000)
    })
  },
  setCodeBlockId () {
    const codeId = `code${Math.random().toString(36).slice(2)}`

    this.$refs.code.querySelector('code')?.setAttribute('id', codeId)

    this.$refs.copy.dataset.clipboardTarget = `#${codeId}`
  }
})
