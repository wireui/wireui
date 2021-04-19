import { assert } from 'chai'
import { describe, it } from 'mocha'
import masker from '../../ts/utils/masker/index'

describe('Testing masker', () => {
  it('should mask phone value', () => {
    let phone = '12345678901'
    let expected = '(12) 34567-8901'
    const masks = ['(##) #####-####', '(##) ####-####']
    let masked = masker(masks, phone).value

    assert.equal(masked, expected)

    phone = '1234567890'
    expected = '(12) 3456-7890'
    masked = masker(masks, phone).value
    assert.equal(masked, expected)
  })

  it('should mask letters pattern', () => {
    const letters = 'abcdef'
    const expected = 'a-b-c-d-e-f'
    const mask = 'S-S-S-S-S-S'
    const masked = masker(mask, letters).value

    assert.equal(masked, expected)
  })

  it('should mask and transform to uppercase', () => {
    const letters = 'abcdef'
    const expected = 'A-B-C-D-E-F'
    const mask = 'A-A-A-A-A-A'
    const masked = masker(mask, letters).value

    assert.equal(masked, expected)
  })

  it('should mask and transform to lowercase', () => {
    const letters = 'ABCDEF'
    const expected = 'a-b-c-d-e-f'
    const mask = 'a-a-a-a-a-a'
    const masked = masker(mask, letters).value

    assert.equal(masked, expected)
  })

  it('should mask numbers values', () => {
    const numbers = 12345
    const expected = '12.345'
    const mask = '##.###'
    const masked = masker(mask, numbers).value

    assert.equal(masked, expected)
  })

  it('should mask nullable values', () => {
    const nullable = null
    const expected = null
    const mask = '#_#'
    const masked = masker(mask, nullable).value

    assert.equal(masked, expected)
  })

  it('should mask multiple times', () => {
    const value = 'abcdef'
    const expected = 'ab-cd-ef'
    const mask = 'SS-SS-SS'
    const maskerIt = masker(mask, value)

    assert.equal(maskerIt.value, expected)

    maskerIt.apply('fe-dc-ba')
    assert.equal(maskerIt.value, 'fe-dc-ba')
    assert.equal(maskerIt.original, 'fedcba')
  })
})
