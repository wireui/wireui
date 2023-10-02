export interface Dropdown {
  status: boolean

  open (): void
  close (): void
  toggle (): void
}

export default (): Dropdown => ({
  status: false,

  open () { this.status = true },
  close () { this.status = false },
  toggle () { this.status = !this.status }
})
