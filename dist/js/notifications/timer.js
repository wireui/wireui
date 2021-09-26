import Timeout from '../utils/timeout';
import Interval from '../utils/interval';
const makeInterval = (totalTimeout, delay, callback) => {
    let percentage = 100;
    let timeout = totalTimeout;
    const interval = Interval(() => {
        timeout -= delay;
        percentage = Math.floor(timeout * 100 / totalTimeout);
        callback(percentage);
        if (timeout <= delay) {
            interval.pause();
        }
    }, delay);
    return interval;
};
export const timer = (timeout, onTimeout, onInterval) => {
    const timer = Timeout(onTimeout, timeout);
    const interval = makeInterval(timeout, 100, onInterval);
    return {
        pause: () => {
            timer.pause();
            interval.pause();
        },
        resume: () => {
            timer.resume();
            interval.resume();
        }
    };
};
//# sourceMappingURL=timer.js.map