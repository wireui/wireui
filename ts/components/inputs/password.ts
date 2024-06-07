import { AlpineComponent } from '@/components/alpine2'

export default class Password extends AlpineComponent {
  status = false

  get type () {
    return this.status ? 'text' : 'password'
  }

  toggle () {
    this.status = !this.status
  }
}
