import { date as parseDate } from '@/utils/date'

const testTimezone = 'America/Sao_Paulo'

describe('Fluent date api tests', () => {
  it('should manipulate date', () => {
    const date = parseDate('2021-05-26', testTimezone)

    date.addMonth()
    expect(6).toEqual(date.getMonth() + 1)

    date.addMonths(2)
    expect(8).toEqual(date.getMonth() + 1)

    date.addDay()
    expect(27).toEqual(date.getDay())

    date.addDays(2)
    expect(29).toEqual(date.getDay())

    date.subMonth()
    expect(7).toEqual(date.getMonth() + 1)

    date.subMonths(2)
    expect(5).toEqual(date.getMonth() + 1)

    date.subDay()
    expect(28).toEqual(date.getDay())

    date.subDays(2)
    expect(26).toEqual(date.getDay())
  })

  it('should pass in getters test', () => {
    const date = parseDate('2021-05-26 12:33', testTimezone)

    expect(31).toEqual(date.getMonthDays())
    expect(2021).toEqual(date.getYear())
    expect(5).toEqual(date.getMonth() + 1)
    expect(26).toEqual(date.getDay())
    expect(3).toEqual(date.getDayOfWeek()) // wed
    expect(12).toEqual(date.getHours())
    expect('12:33:00').toEqual(date.getTime())
    expect(33).toEqual(date.getMinutes())
    expect(date.getNativeDate()).toBeInstanceOf(Date)
  })

  it('should pass in setters test', () => {
    const date = parseDate('2021-05-26 12:33', testTimezone)

    expect(2000).toEqual(date.setYear(2000).getYear())
    expect(7).toEqual(date.setMonth(7).getMonth())
    expect(31).toEqual(date.setDay(31).getDay())
    expect('15:59:00').toEqual(date.setTime('15:59').getTime())
    expect(4).toEqual(date.setHours(4).getHours())
    expect(30).toEqual(date.setMinutes(30).getMinutes())
    expect('America/Denver').toEqual(date.setTimezone('America/Denver').timezone)
  })

  it('can get number os days in month', () => {
    const month31Days = parseDate('2021-07-15', testTimezone)
    expect(31).toEqual(month31Days.getMonthDays())

    const month30Days = parseDate('2021-06-15', testTimezone)
    expect(30).toEqual(month30Days.getMonthDays())

    const FebruaryMonth = parseDate('2021-02-15', testTimezone)
    expect(28).toEqual(FebruaryMonth.getMonthDays())

    const leapYearFebruary = parseDate('2016-02-15', testTimezone)
    expect(29).toEqual(leapYearFebruary.getMonthDays())
  })

  it('can return formatted date', () => {
    const date = parseDate('2021-05-26')

    expect('26/05/2021').toEqual(date.format('DD/MM/YYYY'))
  })

  it('can clone instance', () => {
    const date = parseDate('2021-05-26')
    const clonedDate = date.clone()

    date.subDays(10)

    expect(16).toEqual(date.getDay())
    expect(26).toEqual(clonedDate.getDay())
  })

  it('can check if date is before another date', () => {
    const before = parseDate('2020-12-24')
    const after = parseDate('2020-12-25')

    expect(true).toEqual(before.isBefore(after))
  })

  it('can check if date is same another date', () => {
    const dateOne = parseDate('2020-12-25')
    const dateTwo = parseDate('2020-12-25')

    expect(true).toEqual(dateOne.isSame(dateTwo))
  })

  it('can check if date is after another date', () => {
    const before = parseDate('2020-12-24')
    const after = parseDate('2020-12-25')

    expect(true).toEqual(after.isAfter(before))
  })

  it('can get date as json', () => {
    const date = parseDate('2020-05-22')

    expect('2020-05-22T00:00:00.000Z').toEqual(date.toJson())
  })
})
