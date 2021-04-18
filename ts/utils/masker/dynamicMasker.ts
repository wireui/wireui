import masker from './masker'

export default (masks: string[], value: string, masked = true): string | null => {
  masks = masks.sort((a, b) => a.length - b.length)

  let i = 0

  while (i < masks.length) {
    const currentMask = masks[i]
    i++
    const nextMask = masks[i]
    if (!(nextMask && (masker(nextMask, value, true)?.length ?? 0) > currentMask.length)) {
      return masker(currentMask, value, masked)
    }
  }

  return ''
}
