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
