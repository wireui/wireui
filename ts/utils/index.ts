import { uuid, UuidGenerator } from './uuid'
import { timeout, PausableInterval } from './timeout'
import { interval } from './interval'
import { masker, Maskable } from './masker'
import { mask, Mask } from './masker/masker'

export interface Utilities {
  uuid: UuidGenerator
  timeout: PausableInterval
  interval: PausableInterval
  masker: Maskable
  mask: Mask
}

const utilities: Utilities = {
  uuid,
  timeout,
  interval,
  masker,
  mask
}

export { uuid, timeout, interval, masker, mask }
export default utilities
