import { Entangle } from "@/components/alpine"

export type Refs = {
  inputNumber: HTMLInputElement
}

export interface Number {
  $refs: Refs,
  plusStatus: boolean,
  minusStatus: boolean,
  wireModel?: Entangle,

  init(): void
  plus(): void
  minus(): void
  checkStatus(): void
}

export default (params): Number => ({
  $refs: {} as Refs,
  plusStatus: false,
  minusStatus: false,
  wireModel: params.wireModel,

  init() {
    this.checkStatus()
  },
  plus() {
    this.$refs.inputNumber.stepUp()

    this.checkStatus()
  },
  minus() {
    this.$refs.inputNumber.stepDown()

    this.checkStatus()
  },
  checkStatus() {
    let max = this.$refs.inputNumber.max
    let min = this.$refs.inputNumber.min
    this.wireModel = this.$refs.inputNumber.value

    this.plusStatus = max ? Number(this.wireModel) >= Number(max) : false

    this.minusStatus = min ? Number(this.wireModel) <= Number(min) : false
  }
})
