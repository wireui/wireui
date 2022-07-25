export interface ShowPassword {
  status: boolean

  type (): string
  toggle (): void
}

export default (): ShowPassword => ({
  status: false,

  type () {
    return this.status ? 'text' : 'password'
  },
  toggle () {
    this.status = !this.status
  }
})
