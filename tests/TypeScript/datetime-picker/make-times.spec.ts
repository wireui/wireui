import { makeTimes } from '@/components/datetime-picker/makeTimes'

describe('Test the make times function', () => {
  it('should generate AM/PM times for a given interval', () => {
    const times = makeTimes(true, 10)

    expect(times[0].label).toBe('0:00 AM')
    expect(times[0].value).toBe('00:00')

    expect(times[1].label).toBe('0:10 AM')
    expect(times[1].value).toBe('00:10')

    expect(times[20].label).toBe('3:20 AM')
    expect(times[20].value).toBe('03:20')

    expect(times[times.length - 1].label).toBe('11:50 PM')
    expect(times[times.length - 1].value).toBe('23:50')
  })

  it('should generate military times for a given interval', () => {
    const times = makeTimes(false, 10)

    expect(times[0].label).toEqual('00:00')
    expect(times[0].value).toEqual('00:00')

    expect(times[1].label).toEqual('00:10')
    expect(times[1].value).toEqual('00:10')

    expect(times[20].label).toEqual('03:20')
    expect(times[20].value).toEqual('03:20')

    expect(times[times.length - 1].label).toEqual('23:50')
    expect(times[times.length - 1].value).toEqual('23:50')
  })
})
