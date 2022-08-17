import { Entangle } from '@/components/alpine'

export type Refs = {
  input: HTMLInputElement
}

export interface Number {
  $refs: Refs,
  wireModel?: Entangle,

  plus(): void
  minus(): void
  get disablePlus(): boolean
  get disableMinus(): boolean
}

export default (params): Number => ({
  $refs: {} as Refs,
  wireModel: params.wireModel,

  plus() {
    this.$refs.input.stepUp()
  },
  minus() {
    this.$refs.input.stepDown()
  },
  get disablePlus() {
    const max = this.$refs.input.max
    this.wireModel = this.$refs.input.value

    return max ? Number(this.wireModel) >= Number(max) : false
  },
  get disableMinus() {
    const min = this.$refs.input.min
    this.wireModel = this.$refs.input.value

    return min ? Number(this.wireModel) <= Number(min) : false
  }
})
