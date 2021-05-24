import { uuid, UuidGenerator } from './uuid'
import { timeout, PausableInterval } from './timeout'
import { interval } from './interval'
import { masker, applyMask, Maskable, ApplyMask } from './masker'
import { currency, Currency } from './currency'
import { occurrenceCount, OccurrenceCount } from './helpers'
import { date, getLocalTimezone, ParseDate } from './date'
export interface Utilities {
  uuid: UuidGenerator
  timeout: PausableInterval
  interval: PausableInterval
  masker: Maskable
  mask: ApplyMask
  currency: Currency
  occurrenceCount: OccurrenceCount
  date: ParseDate,
  getLocalTimezone: () => string
}

const utilities: Utilities = {
  uuid,
  timeout,
  interval,
  masker,
  mask: applyMask,
  currency,
  occurrenceCount,
  date,
  getLocalTimezone
}

export default utilities
