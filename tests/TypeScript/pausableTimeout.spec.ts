import timeout from '@/utils/timeout'

describe('Testing pausable timeout', () => {
  let callbackIsCalled = false
  const pausableTimeout = timeout(() => { callbackIsCalled = true }, 10)

  it('should pause timeout', () => {
    expect(pausableTimeout.pause).toBeFunction()
    pausableTimeout.pause()
    expect(callbackIsCalled).toBeFalsy()
  })

  it('should resume a timeout', () => {
    pausableTimeout.resume()
    setTimeout(() => expect(callbackIsCalled).toBeTruthy(), 10)
  })
})
