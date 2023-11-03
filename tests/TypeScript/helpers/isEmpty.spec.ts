import { isEmpty } from '@/utils/helpers'

describe('It should test the isEmpty helper function', () => {
  const truthyDataset = [
    [null],
    [undefined],
    [''],
    [[]],
    [{}]
  ]

  test.each(truthyDataset)('should return true for value %p', (...args) => {
    expect(isEmpty(args[0])).toBe(true)
  })

  const falsyDataset = [
    ['Hello World'],
    [123],
    [true],
    [false],
    [() => {}],
    [new Date()],
    [{ key: 'value' }],
    [[1, 2, 3]],
    [{ key: {} }],
    [[[]]]
  ]

  test.each(falsyDataset)('should return false for value %p', (...args) => {
    expect(isEmpty(args[0])).toBe(false)
  })
})
