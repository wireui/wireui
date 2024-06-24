import dynamicMasker from './dynamicMasker'
import singleMasker from './masker'
import { str } from '../helpers'

export type Masker = {
  mask: string|string[]
  value: any
  getOriginal (): string | null
  apply (value: any): Masker
}

export interface Maskable {
  (mask: string|string[], value: any): Masker
}

export interface ApplyMask {
  (mask: string|string[], value: string| number|null, masked?: boolean): string|null
}

export const applyMask: ApplyMask = (mask, value, masked = true): string|null => {
  return Array.isArray(mask)
    ? dynamicMasker(mask, str(value), masked)
    : singleMasker(mask, str(value), masked)
}

export const masker: Maskable = (mask, value): Masker => {
  return {
    mask,
    value,
    getOriginal (): string|null {
      return applyMask(this.mask, this.value, false)
    },
    apply (value: any): Masker {
      this.value = applyMask(this.mask, value)

      return this
    }
  }.apply(value)
}

export default masker
