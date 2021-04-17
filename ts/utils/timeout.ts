export type Pausable = {
  pause: () => void,
  resume: () => void
}

export type PausableInterval = {
  (callback: CallableFunction, delay: number): Pausable
}

export const timeout: PausableInterval = (callback: CallableFunction, delay: number): Pausable => {
  let timerId = delay
  let remaining = delay
  let start = new Date()

  const resume = () => {
    start = new Date()
    window.clearTimeout(timerId)
    timerId = window.setTimeout(callback, remaining)
  }

  const pause = () => {
    window.clearTimeout(timerId)
    remaining -= new Date().getTime() - start.getTime()
  }

  resume()

  return { resume, pause }
}

export default timeout
