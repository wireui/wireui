import { applyMask, masker } from '@/utils/masker/index'

describe('Testing masker', () => {
  it('should mask phone value', () => {
    let phone = '12345678901'
    let expected = '(12) 34567-8901'
    const masks = ['(##) #####-####', '(##) ####-####']
    let masked = applyMask(masks, phone)

    expect(masked).toEqual(expected)

    phone = '1234567890'
    expected = '(12) 3456-7890'
    masked = applyMask(masks, phone)
    expect(masked).toEqual(expected)
  })

  it('should mask letters pattern', () => {
    const letters = 'abcdef'
    const expected = 'a-b-c-d-e-f'
    const mask = 'S-S-S-S-S-S'
    const masked = applyMask(mask, letters)

    expect(masked).toEqual(expected)
  })

  it('should mask and transform to uppercase', () => {
    const letters = 'abcdef'
    const expected = 'A-B-C-D-E-F'
    const mask = 'A-A-A-A-A-A'
    const masked = applyMask(mask, letters)

    expect(masked).toEqual(expected)
  })

  it('should mask and transform to lowercase', () => {
    const letters = 'ABCDEF'
    const expected = 'a-b-c-d-e-f'
    const mask = 'a-a-a-a-a-a'
    const masked = applyMask(mask, letters)

    expect(masked).toEqual(expected)
  })

  it('should mask numbers values', () => {
    const numbers = 12345
    const expected = '12.345'
    const mask = '##.###'
    const masked = applyMask(mask, numbers)

    expect(masked).toEqual(expected)
  })

  it('should mask nullable values', () => {
    const nullable = null
    const expected = null
    const mask = '#_#'
    const masked = applyMask(mask, nullable)

    expect(masked).toEqual(expected)
  })

  it('should mask multiple times', () => {
    const value = 'abcdef'
    const expected = 'ab-cd-ef'
    const mask = 'SS-SS-SS'
    const maskerIt = masker(mask, value)

    expect(maskerIt.value).toEqual(expected)

    maskerIt.apply('fe-dc-ba')
    expect(maskerIt.value).toEqual('fe-dc-ba')
    expect(maskerIt.getOriginal()).toEqual('fedcba')
  })

  it('should mask time 12h using token h', () => {
    const value = '12:33'
    const maskerIt = masker('h', value)
    expect(maskerIt.value).toEqual('12')

    maskerIt.apply('21:12')
    expect(maskerIt.value).toEqual('2')

    maskerIt.apply('1:12')
    expect(maskerIt.value).toEqual('1')

    maskerIt.apply('10:12')
    expect(maskerIt.value).toEqual('10')

    maskerIt.apply('0091:12')
    expect(maskerIt.value).toEqual('9')
  })

  it('should mask time minutes using token m', () => {
    const maskerIt = masker('m', '33')
    expect(maskerIt.value).toEqual('33')

    maskerIt.apply('99')
    expect(maskerIt.value).toEqual(null)

    maskerIt.apply('1:22')
    expect(maskerIt.value).toEqual('1')

    maskerIt.apply('14:12')
    expect(maskerIt.value).toEqual('14')

    maskerIt.apply('09')
    expect(maskerIt.value).toEqual('09')

    maskerIt.apply('00')
    expect(maskerIt.value).toEqual('00')
  })

  it('should mask hour and minutes using mask h:m', () => {
    const times = ['1:10', '11:23', '10:10', '9:59', '12:28', '7:36', '11:11']

    times.forEach(time => expect(applyMask('h:m', time)).toEqual(time))

    expect(applyMask('h:m', '1a:22')).toEqual('1:22')
    expect(applyMask('h:m', '59:99')).toEqual('5:')
    expect(applyMask('h:m', '00:00')).toEqual(null)
  })

  it('should mask 24 hours and minutes using mask H:m', () => {
    const times = ['11:10', '01:23', '00:00', '09:59', '12:28', '07:36', '23:59']

    times.forEach(time => expect(applyMask('H:m', time)).toEqual(time))

    expect(applyMask('H:m', '59:99')).toEqual(null)
    expect(applyMask('H', '0:0')).toEqual('0')
    expect(applyMask('H', '25')).toEqual('2')
    expect(applyMask('H', '22')).toEqual('22')
    expect(applyMask('H', '99')).toEqual(null)
    expect(applyMask('H', '29')).toEqual('2')
    expect(applyMask('H', '33')).toEqual(null)
    expect(applyMask('H', '3')).toEqual(null)
  })
})
