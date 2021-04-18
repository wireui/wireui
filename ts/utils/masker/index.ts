import dynamicMasker from './dynamicMasker'
import singleMasker from './masker'

export type Masker = {
  original: any
  mask: string | string[]
  value: any
  apply (value: any): Masker
}

export interface Maskable {
  (mask: string | string[], value: any): Masker
}

export const masker: Maskable = (mask, value): Masker => {
  return {
    original: value,
    mask,
    value,
    apply (value: any): Masker {
      const masked = false
      this.original = Array.isArray(mask) ? dynamicMasker(mask, value, masked) : singleMasker(mask, value, masked)
      this.value = Array.isArray(mask) ? dynamicMasker(mask, value) : singleMasker(mask, value)

      return this
    }
  }.apply(value)
}

export default masker
