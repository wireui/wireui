export const str = (value: string | number | null): string => {
  return value ? value.toString() : ''
}

export const onlyNumbers = (value: string | null): string => {
  return str(value).replace(/\D+/g, '')
}

export function onlyLetters (value: string): string {
  return value.replace(/[^a-zA-Z]/g, '')
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

export const isEmpty = (value: any): value is null => {
  if (value === null || value === undefined || value === '') {
    return true
  }

  if (Array.isArray(value) && value.length === 0) {
    return true
  }

  if (value instanceof Date) return false

  return typeof value === 'object' && Object.keys(value).length === 0
}

export const isNotEmpty = (value: any): boolean => {
  return !isEmpty(value)
}

/**
 * Normalize Arabic-Indic (٠-٩ U+0660–U+0669) and
 * Extended Arabic-Indic / Persian (۰-۹ U+06F0–U+06F9)
 * digits to their ASCII equivalents (0-9).
 */
export const normalizeDigits = (value: string): string => {
  return value
    .replace(/[\u0660-\u0669]/g, d => String(d.charCodeAt(0) - 0x0660))
    .replace(/[\u06F0-\u06F9]/g, d => String(d.charCodeAt(0) - 0x06F0))
}
