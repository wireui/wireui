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

export interface ApplyMask {
  (mask: string | string[], value: string, masked?: boolean): string | null
}

export const applyMask: ApplyMask = (mask, value, masked = true): string | null => {
  return Array.isArray(mask)
    ? dynamicMasker(mask, value, masked)
    : singleMasker(mask, value, masked)
}

export const masker: Maskable = (mask, value): Masker => {
  return {
    original: value,
    mask,
    value,
    apply (value: any): Masker {
      this.original = applyMask(mask, value, false)
      this.value = applyMask(mask, value)

      return this
    }
  }.apply(value)
}

export default masker
