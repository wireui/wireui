import { uuid, UuidGenerator } from './uuid'
import { timeout, PausableInterval } from './timeout'
import { interval } from './interval'
import { masker, Maskable } from './masker'
import { mask, Mask } from './masker/masker'
import { currency, Currency } from './currency'

export interface Utilities {
  uuid: UuidGenerator
  timeout: PausableInterval
  interval: PausableInterval
  masker: Maskable
  mask: Mask
  currency: Currency
}

const utilities: Utilities = {
  uuid,
  timeout,
  interval,
  masker,
  mask,
  currency
}

export { uuid, timeout, interval, masker, mask, currency }
export default utilities
