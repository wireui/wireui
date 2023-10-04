import { AlpineComponent } from '@/alpine/components/alpine'

export default class Dropdown extends AlpineComponent {
  state: boolean = false

  open () {
    this.state = true
  }

  close () {
    this.state = false
  }

  toggle () {
    this.state = !this.state
  }
}
