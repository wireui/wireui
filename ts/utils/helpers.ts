export const str = (value: string | number | null): string => {
  return value ? value.toString() : ''
}

export const onlyNumbers = (value: string | null): string => {
  return str(value).replace(/\D+/g, '')
}
