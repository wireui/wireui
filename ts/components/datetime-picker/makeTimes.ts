export interface Time {
  label: string
  value: string
}

export interface MakeTimes {
  (time12H: boolean, interval: number): Time[]
}

const makeTimes: MakeTimes = (isTime12H, interval) => {
  const times: Time[] = []
  let startTime = 0
  const timePeriods = ['AM', 'PM']

  for (let i = 0; startTime < 24 * 60; i++) {
    const hour = Number(Math.floor(startTime / 60))
    const hours = hour.toString().padStart(2, '0')
    const minutes = Number(startTime % 60).toString().padStart(2, '0')

    const time: Time = {
      label: `${hours}:${minutes}`,
      value: `${hours}:${minutes}`
    }

    if (isTime12H) {
      let displayHour = Number(hour % 12)

      if (displayHour === 0) displayHour = 12

      time.label = `${Number(displayHour % 12)}:${minutes} ${timePeriods[Math.floor(hour / 12)]}`
    }

    times.push(time)

    startTime += interval
  }

  return times
}

export { makeTimes }
