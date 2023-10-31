import { TimePeriod, toStandardFormat } from '@/components/TimeSelector/helpers'

describe('toStandardFormat', () => {
  test('converts military hours to standard time', () => {
    expect(toStandardFormat(13)).toEqual({ period: 'PM', hours: 1 })
    expect(toStandardFormat(0)).toEqual({ period: 'AM', hours: 12 })
    expect(toStandardFormat(12)).toEqual({ period: 'PM', hours: 12 })
    expect(toStandardFormat(23)).toEqual({ period: 'PM', hours: 11 })
  })

  test('returns default for invalid hours', () => {
    const time: TimePeriod = { period: 'AM', hours: 12 }

    expect(toStandardFormat(-1)).toEqual(time)
    expect(toStandardFormat(24)).toEqual(time)
    expect(toStandardFormat(NaN)).toEqual(time)
  })
})
