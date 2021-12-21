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
    const hour = Number(Math.floor(startTime / 60).toString().padStart(2, '0'))
    let formatedHour = isTime12H ? Number(hour % 12) : hour
    const minutes = Number(startTime % 60).toString().padStart(2, '0')

    if (isTime12H && formatedHour === 0) { formatedHour = 12 }

    const time: Time = {
      label: `${formatedHour}:${minutes}`,
      value: `${hour}:${minutes}`
    }

    if (isTime12H) {
      time.label += ` ${timePeriods[Math.floor(hour / 12)]}`
    }

    times.push(time)

    startTime += interval
  }

  return times
}

export { makeTimes }
