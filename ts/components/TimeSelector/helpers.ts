export type Period = 'AM'|'PM'

export type TimePeriod = {
  period: Period
  hours: number
}

export function toMilitaryFormat (period: Period, hours: number): number {
  if (period === 'AM') {
    return hours === 12 ? 0 : hours
  }

  if (hours >= 13) {
    return hours
  }

  if (hours === 12) {
    return 12
  }

  return hours + 12
}

export function toStandardFormat (militaryHours: number): TimePeriod {
  if (Number.isNaN(militaryHours) || militaryHours < 0 || militaryHours > 23) {
    return { period: 'AM', hours: 12 }
  }

  const period: Period = militaryHours >= 12 ? 'PM' : 'AM'

  if (militaryHours > 12) {
    militaryHours -= 12
  }

  if (militaryHours === 0) {
    militaryHours = 12
  }

  return {
    period,
    hours: militaryHours
  }
}
