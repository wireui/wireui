import { dataGet } from '@/utils/dataGet'

describe('Test if dataGet function can get any value from target', () => {
  it('it should get value from nested object', () => {
    const object = {
      foo: {
        bar: {
          baz: 22
        }
      }
    }

    const expected = 22

    expect(dataGet(object, 'foo.bar.baz')).toEqual(expected)
  })

  it('should return fallback when path doest exists', () => {
    const object = {}

    const expected = 22
    const fallback = expected

    expect(dataGet(object, 'foo.bar.baz', fallback)).toEqual(expected)
  })

  it('should return undefined as default fallback when path doest exists', () => {
    const object = {}

    const expected = undefined

    expect(dataGet(object, 'foo.bar.baz')).toEqual(expected)
  })

  it('should get all data using *', () => {
    const object = {
      foo: {
        bar: 1,
        biz: 2,
        baz: 3
      }
    }

    const expected = {
      bar: 1,
      biz: 2,
      baz: 3
    }

    expect(dataGet(object, 'foo.*')).toEqual(expected)
  })
})
