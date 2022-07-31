export type Refs = {
  inputNumber: HTMLInputElement
}

export interface Number {
  $refs: Refs,
  plusStatus: boolean,
  minusStatus: boolean,

  plus(): void
  minus(): void
  checkStatus(): void
}

export default (): Number => ({
  $refs: {} as Refs,
  plusStatus: false,
  minusStatus: false,

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
    let value = this.$refs.inputNumber.value

    this.plusStatus = max ? Number(value) >= Number(max) : false

    this.minusStatus = min ? Number(value) <= Number(min) : false
  }
})
