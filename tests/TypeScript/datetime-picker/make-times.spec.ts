import { makeTimes } from '@/components/datetime-picker/makeTimes'

describe('Test the make times function', () => {
  it('should generate AM/PM times for a given interval', () => {
    const times = makeTimes({ time12H: true, interval: 10 })

    expect(times.length).toEqual(144)

    expect(times[0].label).toBe('12:00 AM')
    expect(times[0].value).toBe('00:00')

    expect(times[1].label).toBe('12:10 AM')
    expect(times[1].value).toBe('00:10')

    expect(times[20].label).toBe('3:20 AM')
    expect(times[20].value).toBe('03:20')

    expect(times[times.length - 1].label).toBe('11:50 PM')
    expect(times[times.length - 1].value).toBe('23:50')
  })

  it('should generate military times for a given interval', () => {
    const times = makeTimes({ time12H: false, interval: 10 })

    expect(times.length).toEqual(144)

    expect(times[0].label).toEqual('00:00')
    expect(times[0].value).toEqual('00:00')

    expect(times[1].label).toEqual('00:10')
    expect(times[1].value).toEqual('00:10')

    expect(times[20].label).toEqual('03:20')
    expect(times[20].value).toEqual('03:20')

    expect(times[times.length - 1].label).toEqual('23:50')
    expect(times[times.length - 1].value).toEqual('23:50')
  })

  it('should calculate the time interval correctly', () => {
    const times = makeTimes({ time12H: false, interval: 30, min: '08:13', max: '15:48' })

    expect(times.length).toEqual(16)

    expect(times[0].label).toEqual('08:13')
    expect(times[0].value).toEqual('08:13')

    expect(times[1].label).toEqual('08:43')
    expect(times[1].value).toEqual('08:43')

    expect(times[8].label).toEqual('12:13')
    expect(times[8].value).toEqual('12:13')

    expect(times[times.length - 1].label).toEqual('15:43')
    expect(times[times.length - 1].value).toEqual('15:43')
  })
})

describe.each([
  { min: '10:00', max: '15:00' },
  { min: 10, max: '15:00' },
  { min: '10:00', max: 15 },
  { min: 10, max: 15 }
])('Testing make times with many times', ({ min, max }) => {
  it(`should generate times for a given times interval (${min} - ${max})`, () => {
    const times = makeTimes({ time12H: false, interval: 30, min, max })

    expect(times.length).toEqual(10)

    expect(times[0].label).toEqual('10:00')
    expect(times[0].value).toEqual('10:00')

    expect(times.at(-1)?.label).toEqual('14:30')
    expect(times.at(-1)?.value).toEqual('14:30')
  })
})
