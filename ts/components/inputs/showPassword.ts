export interface Ahh {
  status: boolean

  type (): string
  toggle (): void
}

export default (): Ahh => ({
  status: false,

  type () {
    return this.status ? 'text' : 'password'
  },
  toggle () {
    this.status = !this.status
  }
})
