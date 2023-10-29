import { Period } from '@/components/TimeSelector/index'

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

export function toAmPmFormat (period: Period, hours: number): number {
  if (period === 'AM') {
    return hours === 12 ? 0 : hours
  }

  if (hours >= 12) {
    return hours - 12
  }

  return hours
}
