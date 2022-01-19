import { assert } from 'chai'
import { describe, it } from 'mocha'
import { date as parseDate } from '../../ts/utils/date'

const testTimezone = 'America/Sao_Paulo'

describe('Fluent date api tests', () => {
  it('should manipulate date', () => {
    const date = parseDate('2021-05-26', testTimezone)

    date.addMonth()
    assert.equal(6, date.getMonth() + 1)

    date.addMonths(2)
    assert.equal(8, date.getMonth() + 1)

    date.addDay()
    assert.equal(27, date.getDay())

    date.addDays(2)
    assert.equal(29, date.getDay())

    date.subMonth()
    assert.equal(7, date.getMonth() + 1)

    date.subMonths(2)
    assert.equal(5, date.getMonth() + 1)

    date.subDay()
    assert.equal(28, date.getDay())

    date.subDays(2)
    assert.equal(26, date.getDay())
  })

  it('should pass in getters test', () => {
    const date = parseDate('2021-05-26 12:33', testTimezone)

    assert.equal(31, date.getMonthDays())
    assert.equal(2021, date.getYear())
    assert.equal(5, date.getMonth() + 1)
    assert.equal(26, date.getDay())
    assert.equal(3, date.getDayOfWeek()) // wed
    assert.equal(12, date.getHours())
    assert.equal('12:33', date.getTime())
    assert.equal(33, date.getMinutes())
    assert.isTrue(date.getNativeDate() instanceof Date)
  })

  it('should pass in seters test', () => {
    const date = parseDate('2021-05-26 12:33', testTimezone)

    assert.equal(2000, date.setYear(2000).getYear())
    assert.equal(7, date.setMonth(7).getMonth())
    assert.equal(31, date.setDay(31).getDay())
    assert.equal('15:59', date.setTime('15:59').getTime())
    assert.equal(4, date.setHours(4).getHours())
    assert.equal(30, date.setMinutes(30).getMinutes())
    assert.equal('America/Denver', date.setTimezone('America/Denver').timezone)
  })

  it('can get number os days in month', () => {
    const month31Days = parseDate('2021-07-15', testTimezone)
    assert.equal(31, month31Days.getMonthDays())

    const month30Days = parseDate('2021-06-15', testTimezone)
    assert.equal(30, month30Days.getMonthDays())

    const februaryMonth = parseDate('2021-02-15', testTimezone)
    assert.equal(28, februaryMonth.getMonthDays())

    const leapYearFebruary = parseDate('2016-02-15', testTimezone)
    assert.equal(29, leapYearFebruary.getMonthDays())
  })

  it('can return formatted date', () => {
    const date = parseDate('2021-05-26')

    assert.equal('26/05/2021', date.format('DD/MM/YYYY'))
  })

  it('can clone instance', () => {
    const date = parseDate('2021-05-26')
    const clonedDate = date.clone()

    date.subDays(10)

    assert.equal(16, date.getDay())
    assert.equal(26, clonedDate.getDay())
  })

  it('can check if date is before another date', () => {
    const before = parseDate('2020-12-24')
    const after = parseDate('2020-12-25')

    assert.equal(true, before.isBefore(after))
  })

  it('can check if date is same another date', () => {
    const dateOne = parseDate('2020-12-25')
    const dateTwo = parseDate('2020-12-25')

    assert.equal(true, dateOne.isSame(dateTwo))
  })

  it('can check if date is after another date', () => {
    const before = parseDate('2020-12-24')
    const after = parseDate('2020-12-25')

    assert.equal(true, after.isAfter(before))
  })

  it('can get date as json', () => {
    const date = parseDate('2020-05-22')

    assert.equal('2020-05-22T00:00:00.000Z', date.toJson())
  })
})
