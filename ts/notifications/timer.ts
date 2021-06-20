import Timeout, { Pausable } from '../utils/timeout'
import Interval from '../utils/interval'

export interface Timer {
  (timeout: number, onTimeout: CallableFunction, onInterval: CallableFunction): Pausable
}

const makeInterval = (totalTimeout: number, delay: number, callback: CallableFunction): Pausable => {
  let percentage = 100
  let timeout = totalTimeout

  const interval = Interval(() => {
    timeout -= delay
    percentage = Math.floor(timeout * 100 / totalTimeout)

    callback(percentage)

    if (timeout <= delay) { interval.pause() }
  }, delay)

  return interval
}

export const timer: Timer = (timeout, onTimeout, onInterval) => {
  const timer = Timeout(onTimeout, timeout)
  const interval = makeInterval(timeout, 100, onInterval)

  return {
    pause: () => {
      timer.pause()
      interval.pause()
    },
    resume: () => {
      timer.resume()
      interval.resume()
    }
  }
}
