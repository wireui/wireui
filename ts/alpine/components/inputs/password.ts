export interface Password {
  status: boolean

  get type (): string
  toggle (): void
}

export default (): Password => ({
  status: false,

  get type () {
    return this.status ? 'text' : 'password'
  },
  toggle () {
    this.status = !this.status
  }
})
