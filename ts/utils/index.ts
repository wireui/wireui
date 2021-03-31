import { uuid, UuidGenerator } from './uuid'
import { timeout, PausableInterval } from './timeout'
import { interval } from './interval'

export interface Utilities {
  uuid: UuidGenerator
  timeout: PausableInterval
  interval: PausableInterval
}

export { uuid, timeout, interval }
export default { uuid, timeout, interval }
