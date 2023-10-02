import { makeColors } from '@/alpine/components/color-picker/colors'
import { Color } from '@/alpine/components/color-picker'

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
