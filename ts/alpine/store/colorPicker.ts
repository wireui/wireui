import { Color } from '@components/ColorPicker/ts'
import { makeColors } from '@components/ColorPicker/ts/colors'

export interface ColorsStore {
  colors: Color[]
  setColors (colors: Color[]): this
}

const store: ColorsStore = {
  colors: makeColors(),

  setColors (colors: Color[]) {
    this.colors = colors

    return this
  }
}

export default store
