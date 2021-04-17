import { assert } from 'chai'
import { describe, it } from 'mocha'
import timeout from '../../ts/utils/timeout'

describe('Testing pausable timeout', () => {
  let callbackIsCalled = false
  const pausableTimeout = timeout(() => { callbackIsCalled = true }, 10)
  pausableTimeout.pause()

  it('should pause timeout', () => {
    assert.isFunction(pausableTimeout.pause)
    pausableTimeout.pause()
    assert.isFalse(callbackIsCalled)
  })

  it('should resume a timeout', () => {
    pausableTimeout.resume()
    setTimeout(() => { assert.isTrue(callbackIsCalled) }, 10)
  })
})
