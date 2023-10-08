import { AlpineComponent } from '@/alpine/components/alpine'

export default class Password extends AlpineComponent {
  state: boolean = false

  get type () {
    return this.state ? 'text' : 'password'
  }

  toggle () {
    this.state = !this.state
  }
}
