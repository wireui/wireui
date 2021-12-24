import { assert } from 'chai'
import { describe, it } from 'mocha'
import { convertMilitaryTimeToStandard } from '../../../ts/utils/time'

describe('Testing The time helpers', () => {
  it('should convert from military time to standard time', () => {
    const times = [
      { time: '00:00', expected: '0:00 AM' },
      { time: '01:05', expected: '1:05 AM' },
      { time: '02:10', expected: '2:10 AM' },
      { time: '03:15', expected: '3:15 AM' },
      { time: '04:20', expected: '4:20 AM' },
      { time: '05:25', expected: '5:25 AM' },
      { time: '06:30', expected: '6:30 AM' },
      { time: '07:35', expected: '7:35 AM' },
      { time: '08:40', expected: '8:40 AM' },
      { time: '09:45', expected: '9:45 AM' },
      { time: '10:50', expected: '10:50 AM' },
      { time: '11:55', expected: '11:55 AM' },
      { time: '12:00', expected: '0:00 PM' },
      { time: '13:05', expected: '1:05 PM' },
      { time: '14:10', expected: '2:10 PM' },
      { time: '15:15', expected: '3:15 PM' },
      { time: '16:20', expected: '4:20 PM' },
      { time: '17:25', expected: '5:25 PM' },
      { time: '18:30', expected: '6:30 PM' },
      { time: '19:35', expected: '7:35 PM' },
      { time: '20:40', expected: '8:40 PM' },
      { time: '21:45', expected: '9:45 PM' },
      { time: '22:50', expected: '10:50 PM' },
      { time: '23:55', expected: '11:55 PM' }
    ]

    times.forEach(({ time, expected }) => {
      assert.equal(convertMilitaryTimeToStandard(time), expected)
    })
  })
})
