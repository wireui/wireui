export const str = (value: string | number | null): string => {
  return value ? value.toString() : ''
}

export const onlyNumbers = (value: string | null): string => {
  return str(value).replace(/\D+/g, '')
}

export interface OccurrenceCount {
  (haystack: string, needle: string | number | null): number
}

export const occurrenceCount: OccurrenceCount = (haystack, needle): number => {
  const regex = new RegExp(`\\${needle}`, 'g')

  return (haystack?.match(regex) || []).length
}

export const jsonParse = (value?: string | null, fallback: any = null): any => {
  try {
    return JSON.parse(value ?? '')
  } catch (error) {
    return fallback
  }
}
