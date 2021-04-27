import { uuid, UuidGenerator } from './uuid'
import { timeout, PausableInterval } from './timeout'
import { interval } from './interval'
import { masker, applyMask, Maskable, ApplyMask } from './masker'
import { currency, Currency } from './currency'

export interface Utilities {
  uuid: UuidGenerator
  timeout: PausableInterval
  interval: PausableInterval
  masker: Maskable
  mask: ApplyMask
  currency: Currency
}

const utilities: Utilities = {
  uuid,
  timeout,
  interval,
  masker,
  mask: applyMask,
  currency
}

export { uuid, timeout, interval, masker, applyMask, currency }
export default utilities
