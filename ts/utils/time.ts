export const convertMilitaryTimeToStandard = (time: string): string => {
  if (time.length !== 5 || time.indexOf(':') !== 2) {
    throw new Error('Must pass a valid military time. e.g. 15:00')
  }

  const [hour, minute] = time.split(':')

  let standardHour = Number(hour)

  const period = standardHour >= 12 ? 'PM' : 'AM'

  if (standardHour >= 12) {
    standardHour -= 12
  }

  return `${standardHour}:${minute} ${period}`
}

export const convertStandardTimeToMilitary = (time: string): string => {
  time = time.toUpperCase()

  if (time.length < 7 || !time.includes(':')) {
    throw new Error('Must pass a valid standard time. e.g. 9:00 AM')
  }

  if (!time.includes('AM') && !time.includes('PM')) {
    throw new Error('Missing standard time period. e.g. AM or PM')
  }

  const [hour, minute] = time.split(':')

  let standardHour = Number(hour)

  if (time.includes('PM')) {
    standardHour += 12
  }

  const militaryHour = standardHour.toString().padStart(2, '0')

  return `${militaryHour}:${minute}`.slice(0, 5)
}
