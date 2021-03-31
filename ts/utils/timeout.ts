export type PausableInterval = {
  (callback: CallableFunction, delay: number): Pausable
}

export type Pausable = {
  pause: () => void,
  resume: () => void
}

export const timeout: PausableInterval = (callback: Function, delay: number): Pausable => {
  let timerId, remaining = delay
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
