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
    this.plusStatus = Number(this.$refs.inputNumber.value) >= Number(this.$refs.inputNumber.max)

    this.minusStatus = Number(this.$refs.inputNumber.value) <= Number(this.$refs.inputNumber.min)
  }
})
