import { assert } from 'chai'
import { describe, it } from 'mocha'
import { applyMask, masker } from '../../ts/utils/masker/index'

describe('Testing masker', () => {
  it('should mask phone value', () => {
    let phone = '12345678901'
    let expected = '(12) 34567-8901'
    const masks = ['(##) #####-####', '(##) ####-####']
    let masked = applyMask(masks, phone)

    assert.equal(masked, expected)

    phone = '1234567890'
    expected = '(12) 3456-7890'
    masked = applyMask(masks, phone)
    assert.equal(masked, expected)
  })

  it('should mask letters pattern', () => {
    const letters = 'abcdef'
    const expected = 'a-b-c-d-e-f'
    const mask = 'S-S-S-S-S-S'
    const masked = applyMask(mask, letters)

    assert.equal(masked, expected)
  })

  it('should mask and transform to uppercase', () => {
    const letters = 'abcdef'
    const expected = 'A-B-C-D-E-F'
    const mask = 'A-A-A-A-A-A'
    const masked = applyMask(mask, letters)

    assert.equal(masked, expected)
  })

  it('should mask and transform to lowercase', () => {
    const letters = 'ABCDEF'
    const expected = 'a-b-c-d-e-f'
    const mask = 'a-a-a-a-a-a'
    const masked = applyMask(mask, letters)

    assert.equal(masked, expected)
  })

  it('should mask numbers values', () => {
    const numbers = 12345
    const expected = '12.345'
    const mask = '##.###'
    const masked = applyMask(mask, numbers)

    assert.equal(masked, expected)
  })

  it('should mask nullable values', () => {
    const nullable = null
    const expected = null
    const mask = '#_#'
    const masked = applyMask(mask, nullable)

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
    assert.equal(maskerIt.getOriginal(), 'fedcba')
  })

  it('should mask time 12h using token h', () => {
    const value = '12:33'
    const maskerIt = masker('h', value)
    assert.equal(maskerIt.value, '12')

    maskerIt.apply('21:12')
    assert.equal(maskerIt.value, '2')

    maskerIt.apply('1:12')
    assert.equal(maskerIt.value, '1')

    maskerIt.apply('10:12')
    assert.equal(maskerIt.value, '10')

    maskerIt.apply('0091:12')
    assert.equal(maskerIt.value, '9')
  })

  it('should mask time minutes using token m', () => {
    const maskerIt = masker('m', '33')
    assert.equal(maskerIt.value, '33')

    maskerIt.apply('99')
    assert.equal(maskerIt.value, null)

    maskerIt.apply('1:22')
    assert.equal(maskerIt.value, '1')

    maskerIt.apply('14:12')
    assert.equal(maskerIt.value, '14')

    maskerIt.apply('09')
    assert.equal(maskerIt.value, '09')

    maskerIt.apply('00')
    assert.equal(maskerIt.value, '00')
  })

  it('should mask hour and minutes using mask h:m', () => {
    const times = ['1:10', '11:23', '10:10', '9:59', '12:28', '7:36', '11:11']

    times.forEach(time => assert.equal(applyMask('h:m', time), time))

    assert.equal(applyMask('h:m', '1a:22'), '1:22')
    assert.equal(applyMask('h:m', '59:99'), '5:')
    assert.equal(applyMask('h:m', '00:00'), null)
  })

  it('should mask 24 hours and minutes using mask H:m', () => {
    const times = ['11:10', '01:23', '00:00', '09:59', '12:28', '07:36', '23:59']

    times.forEach(time => assert.equal(applyMask('H:m', time), time))

    assert.equal(applyMask('H:m', '59:99'), null)
    assert.equal(applyMask('H', '0:0'), '0')
    assert.equal(applyMask('H', '25'), '2')
    assert.equal(applyMask('H', '22'), '22')
    assert.equal(applyMask('H', '99'), null)
    assert.equal(applyMask('H', '29'), '2')
    assert.equal(applyMask('H', '33'), null)
    assert.equal(applyMask('H', '3'), null)
  })
})
