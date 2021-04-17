import { assert } from 'chai'
import { describe, it } from 'mocha'
import interval from '../../ts/utils/interval'

describe('Testing pausable interval', () => {
  let calledIntervalTimes = 0
  let calledBeforePause = 0
  const pausableInterval = interval(() => { calledIntervalTimes++ }, 5)

  it('should pause interval', () => {
    assert.isFunction(pausableInterval.pause)
    pausableInterval.pause()
    assert.isTrue(calledIntervalTimes > 0)
    calledBeforePause = calledIntervalTimes
  })

  it('should resume a interval', () => {
    pausableInterval.resume()

    setTimeout(() => {
      assert.notEqual(calledBeforePause, calledIntervalTimes)
      pausableInterval.pause()
    }, 10)
  })
})
