export type Refs = {
  inputNumber: HTMLInputElement
}

export interface Number {
  $refs: Refs,

  plus (): void
  minus (): void
}

export default (): Number => ({
  $refs: {} as Refs,

  plus () {
    this.$refs.inputNumber.stepUp();
  },
  minus () {
    this.$refs.inputNumber.stepDown();
  }
})
