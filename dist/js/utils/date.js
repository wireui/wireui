import dayjs from 'dayjs';
import utc from 'dayjs/plugin/utc';
import timezone from 'dayjs/plugin/timezone';
import customParseFormat from 'dayjs/plugin/customParseFormat';
import localizedFormat from 'dayjs/plugin/localizedFormat';
dayjs.extend(utc);
dayjs.extend(timezone);
dayjs.extend(customParseFormat);
dayjs.extend(localizedFormat);
export class FluentDate {
    timezone;
    date;
    constructor(date, timezone = 'UTC', format = '') {
        this.timezone = timezone;
        this.date = format
            ? dayjs.tz(date, format, timezone)
            : dayjs.tz(date, timezone);
    }
    addDay() {
        this.date = this.date.add(1, 'day');
        return this;
    }
    addDays(days) {
        this.date = this.date.add(days, 'day');
        return this;
    }
    addMonth() {
        this.date = this.date.add(1, 'month');
        return this;
    }
    addMonths(months) {
        this.date = this.date.add(months, 'month');
        return this;
    }
    subMonth() {
        this.date = this.date.subtract(1, 'month');
        return this;
    }
    subMonths(months) {
        this.date = this.date.subtract(months, 'month');
        return this;
    }
    subDay() {
        this.date = this.date.subtract(1, 'day');
        return this;
    }
    subDays(days) {
        this.date = this.date.subtract(days, 'day');
        return this;
    }
    getMonthDays() {
        return this.date.daysInMonth();
    }
    getYear() {
        return this.date.year();
    }
    getMonth() {
        return this.date.month();
    }
    getDay() {
        return this.date.date();
    }
    getDayOfWeek() {
        return this.date.day();
    }
    getTime(timezone) {
        if (timezone) {
            return this.clone().setTimezone(timezone).getTime();
        }
        return this.date.format('HH:mm');
    }
    getHours() {
        return this.date.get('hours');
    }
    getMinutes() {
        return this.date.get('minutes');
    }
    getNativeDate() {
        return this.date.toDate();
    }
    setYear(year) {
        this.date = this.date.set('year', year);
        return this;
    }
    setMonth(month) {
        this.date = this.date.set('month', month);
        return this;
    }
    setDay(day) {
        this.date = this.date.set('date', day);
        return this;
    }
    setTime(time) {
        const [hours = 0, minutes = 0] = time.split(':');
        this.setHours(Number(hours));
        this.setMinutes(Number(minutes));
        return this;
    }
    setHours(hours) {
        this.date = this.date.set('hours', hours);
        return this;
    }
    setMinutes(minutes) {
        this.date = this.date.set('minutes', minutes);
        return this;
    }
    setTimezone(timezone) {
        this.date = this.date.tz(timezone);
        this.timezone = timezone;
        return this;
    }
    format(format, timezone) {
        if (timezone) {
            return this.clone().setTimezone(timezone).format(format);
        }
        return this.date.format(format);
    }
    clone() {
        return new FluentDate(this.date, this.timezone);
    }
    isValid() {
        return this.date.isValid();
    }
    isInvalid() {
        return !this.isValid();
    }
    isSame(date, unit) {
        if (date instanceof FluentDate) {
            return this.date.isSame(date.date, unit);
        }
        return this.date.isSame(String(date), unit);
    }
    toJson() {
        return this.date.toJSON();
    }
}
export const getLocalTimezone = () => {
    return dayjs.tz.guess();
};
export const date = (date, timezone = 'UTC', format = '') => {
    return new FluentDate(date, timezone, format);
};
export default FluentDate;
//# sourceMappingURL=date.js.map