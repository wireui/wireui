import interval from '@/utils/interval'
import { sleep } from '@tests/helpers'

describe('Testing pausable interval', () => {
  it('should pause interval', () => {
    let called = false
    const pausableInterval = interval(() => { called = true }, 5)
    pausableInterval.pause()

    expect(called).toBeFalse()
  })

  it('should resume a interval', async () => {
    let called = false
    const pausableInterval = interval(() => { called = true }, 5)

    pausableInterval.pause()
    await sleep(6)
    expect(called).toBeFalse()

    pausableInterval.resume()
    await sleep(6)
    expect(called).toBeTrue()
  })
})
