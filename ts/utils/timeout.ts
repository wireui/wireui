export type Pauseable = {
  pause: () => void,
  resume: () => void
}

export type PauseableInterval = {
  (callback: CallableFunction, delay: number): Pauseable
}

export const timeout: PauseableInterval = (callback: CallableFunction, delay: number): Pauseable => {
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
