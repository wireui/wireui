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

    const matrix = this.chunkElementsByRow()

    const focusableId = target as HTMLElement

    const closest = this.getClosestElement(direction, matrix, focusableId)

    closest?.focus()
  }

  private chunkElementsByRow (): HTMLElement[][] {
    const container = this.container
    const elements = Array.from(container.querySelectorAll(this.selector)) as HTMLElement[]

    const rowMap: { [key: number]: HTMLElement[] } = {}

    elements.forEach(element => {
      const rect = element.getBoundingClientRect()
      let top = rect.top

      if (top === 0) {
        return
      }

      const relatedPosition = Object.keys(rowMap).find(key => {
        return Math.abs(Number(key) - Number(top)) <= 7
      })

      if (Number(relatedPosition)) {
        top = Number(relatedPosition)
      }

      if (!rowMap[top]) {
        rowMap[top] = []
      }

      rowMap[top].push(element)
    })

    return Object.values(rowMap)
  }

  private findElementIndex (matrix: HTMLElement[][], target: HTMLElement) {
    for (let i = 0; i < matrix.length; i++) {
      for (let j = 0; j < matrix[i].length; j++) {
        if (matrix[i][j] === target) {
          return { row: i, col: j }
        }
      }
    }

    return null
  }

  private getClosestElement (
    direction: Direction,
    matrix: HTMLElement[][],
    target: HTMLElement
  ): HTMLElement|null {
    let { row, col } = this.findElementIndex(matrix, target) || {}

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
      col = this.getApproximateIndex(matrix[row].length, matrix[upRow].length, col, 'up')
      row = upRow
    }

    if (direction === 'down') {
      const downRow = row === numRows - 1 ? 0 : row + 1
      col = this.getApproximateIndex(matrix[row].length, matrix[downRow].length, col, 'down')
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
    direction: Direction
  ) {
    if (direction === 'down' && sourceIndex === 0) {
      return 0
    }

    if (direction === 'down' && sourceIndex === sourceLength - 1) {
      return targetLength - 1
    }

    // Calculate the offsets considering the elements are center-aligned
    const sourceOffset = Math.floor((sourceLength - 1) / 2) - sourceIndex
    const targetOffset = Math.floor((targetLength - 1) / 2)

    let targetIndex = targetOffset - sourceOffset

    // When moving down, assign the left elements to the first element in the current row
    if (direction === 'down' && targetIndex < 0) {
      targetIndex = 0
    }

    // When moving up, do the reverse
    if (direction === 'up' && targetIndex >= targetLength) {
      targetIndex = targetLength - 1
    }

    // Make sure the index is within bounds
    return Math.min(Math.max(0, targetIndex), targetLength - 1)
  }
}
