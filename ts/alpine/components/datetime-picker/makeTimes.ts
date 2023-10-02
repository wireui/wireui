export interface Time {
  label: string
  value: string
}

export type Config = {
  time12H: boolean
  interval: number
  min?: string | number
  max?: string | number
}

export interface MakeTimes {
  (config: Config): Time[]
}

const makeTimes: MakeTimes = ({ time12H, interval, min = 0, max = 24 }) => {
  const [minHours = 0, minMinutes = 0] = min.toString().split(':')
  const [maxHours = 0, maxMinutes = 0] = max.toString().split(':')

  let currentTime = Number(minHours) * 60 + Number(minMinutes) // eslint-disable-line
  const maxTime = Number(maxHours) * 60 + Number(maxMinutes)// eslint-disable-line

  const times: Time[] = []
  const timePeriods = ['AM', 'PM']

  if (interval <= 0) { interval = 60 }

  while (currentTime < maxTime) {
    const hours = Number(Math.floor(currentTime / 60)).toString().padStart(2, '0')
    const minutes = Number(currentTime % 60).toString().padStart(2, '0')

    const time: Time = {
      label: `${hours}:${minutes}`,
      value: `${hours}:${minutes}`
    }

    if (time12H) {
      let displayHour = Number(hours) % 12

      if (displayHour === 0) displayHour = 12

      time.label = `${displayHour}:${minutes} ${timePeriods[Math.floor(Number(hours) / 12)]}`
    }

    times.push(time)

    currentTime += interval
  }

  return times
}

export { makeTimes }
