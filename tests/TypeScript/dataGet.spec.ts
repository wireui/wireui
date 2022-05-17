import { assert } from 'chai'
import { describe, it } from 'mocha'
import { dataGet } from '../../ts/utils/dataGet'

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

    assert.equal(dataGet(object, 'foo.bar.baz'), expected)
  })

  it('should return fallback when path doest exists', () => {
    const object = {}

    const expected = 22
    const fallback = expected

    assert.equal(dataGet(object, 'foo.bar.baz', fallback), expected)
  })

  it('should return undefined as default fallback when path doest exists', () => {
    const object = null

    const expected = undefined

    assert.equal(dataGet(object, 'foo.bar.baz'), expected)
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

    assert.deepEqual(dataGet(object, 'foo.*'), expected)
  })
})
