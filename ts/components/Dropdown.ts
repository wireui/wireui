import { watchProps } from '@/alpine/magic/props'
import Positionable, { Position } from '@/alpine/modules/Positionable'
import { AlpineComponent } from '@/components/alpine2'

export default class Dropdown extends AlpineComponent {
  declare $refs: {
    trigger: HTMLDivElement
    popover: HTMLDivElement
  }

  declare $props: {
    position: Position
  }

  positionable: Positionable = new Positionable()

  init () {
    this.positionable
      .toggleScrollbar(false)
      .toggleScrollbar(false)
      .start(this, this.$refs.trigger, this.$refs.popover)
      .position(this.$props.position)
      .offset(8)

    watchProps(this, () => {
      this.positionable
        .position(this.$props.position)
        .computePosition()
    })
  }

  open () {
    this.positionable.open()
  }

  close () {
    this.positionable.close()
  }

  toggle () {
    this.positionable.toggle()
  }
}
