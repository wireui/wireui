import { assert } from 'chai'
import { describe, it } from 'mocha'
import { makeTimes } from '../../../../ts/components/datetime-picker/makeTimes'

describe('Test the make times function', () => {
  it('should generate AM/PM times for a given interval', () => {
    const times = makeTimes(true, 10)

    assert.equal(times[0].label, '0:00 AM')
    assert.equal(times[0].value, '00:00')

    assert.equal(times[1].label, '0:10 AM')
    assert.equal(times[1].value, '00:10')

    assert.equal(times[20].label, '3:20 AM')
    assert.equal(times[20].value, '03:20')

    assert.equal(times[times.length - 1].label, '11:50 PM')
    assert.equal(times[times.length - 1].value, '23:50')
  })

  it('should generate military times for a given interval', () => {
    const times = makeTimes(false, 10)

    assert.equal(times[0].label, '00:00')
    assert.equal(times[0].value, '00:00')

    assert.equal(times[1].label, '00:10')
    assert.equal(times[1].value, '00:10')

    assert.equal(times[20].label, '03:20')
    assert.equal(times[20].value, '03:20')

    assert.equal(times[times.length - 1].label, '23:50')
    assert.equal(times[times.length - 1].value, '23:50')
  })
})
