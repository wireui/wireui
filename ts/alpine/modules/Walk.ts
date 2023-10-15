import chunkArray from '@/utils/chunk'

export type Direction = 'up'|'down'|'left'|'right'

export default class Walk {
  private container: HTMLElement

  private selector: string

  constructor (container: HTMLElement, selector: string) {
    this.container = container
    this.selector = selector
  }

  to (direction: Direction): void {
    const elements = Array.from(this.container.querySelectorAll(this.selector)) as HTMLElement[]

    let target = document.activeElement

    if (!target || !this.container.contains(target)) {
      target = elements[0]

      if (target instanceof HTMLElement) {
        target?.focus()
      }

      return
    }

    const matrix = chunkArray(elements, this.countFirstRowElements())

    const focusableId = target.getAttribute('focusable-id') ?? ''

    const closest = this.getClosestElement(direction, matrix, focusableId)

    closest?.focus()
  }

  private countFirstRowElements (): number {
    const container = this.container

    const items = container.querySelectorAll(this.selector)

    let firstRowItemCount = 0

    let firstItemTop: number|null = null

    items.forEach(item => {
      const rect = item.getBoundingClientRect()

      if (firstItemTop === null) {
        firstItemTop = rect.top
      }

      if (rect.top === firstItemTop) {
        firstRowItemCount++
      }
    })

    return firstRowItemCount
  }

  private findElementIndex (matrix: HTMLElement[][], focusableId: string) {
    for (let i = 0; i < matrix.length; i++) {
      for (let j = 0; j < matrix[i].length; j++) {
        if (matrix[i][j]?.getAttribute('focusable-id') === focusableId) {
          return { row: i, col: j }
        }
      }
    }

    return null
  }

  private getClosestElement (
    direction: Direction,
    matrix: HTMLElement[][],
    focusableId: string
  ): HTMLElement|null {
    let { row, col } = this.findElementIndex(matrix, focusableId) || {}

    if (
      row === undefined
      || col === undefined
      || !Number.isInteger(row)
      || !Number.isInteger(col)
    ) {
      return null
    }

    const numRows = matrix.length

    if (direction === 'up') {
      const upRow = row === 0 ? numRows - 1 : row - 1
      col = this.getApproximateIndex(matrix[row].length, matrix[upRow].length, col, true)
      row = upRow
    }

    if (direction === 'down') {
      const downRow = row === numRows - 1 ? 0 : row + 1
      col = this.getApproximateIndex(matrix[row].length, matrix[downRow].length, col, false)
      row = downRow
    }

    if (direction === 'left') {
      col = col === 0 ? matrix[row].length - 1 : col - 1
    }

    if (direction === 'right') {
      col = col === matrix[row].length - 1 ? 0 : col + 1
    }

    return matrix[row][col] ?? null
  }

  private getApproximateIndex (
    sourceLength: number,
    targetLength: number,
    sourceIndex: number,
    isUp: boolean
  ) {
    // Calculate the offsets considering the elements are center-aligned
    const sourceOffset = Math.floor((sourceLength - 1) / 2) - sourceIndex
    const targetOffset = Math.floor((targetLength - 1) / 2)

    let targetIndex = targetOffset - sourceOffset

    // When moving down, assign the left elements to the first element in the current row
    if (!isUp && targetIndex < 0) {
      targetIndex = 0
    }

    // When moving up, do the reverse
    if (isUp && targetIndex >= targetLength) {
      targetIndex = targetLength - 1
    }

    // Make sure the index is within bounds
    return Math.min(Math.max(0, targetIndex), targetLength - 1)
  }
}
