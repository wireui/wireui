export const timeout = (callback, delay) => {
    let timerId = delay;
    let remaining = delay;
    let start = new Date();
    const resume = () => {
        start = new Date();
        window.clearTimeout(timerId);
        timerId = window.setTimeout(callback, remaining);
    };
    const pause = () => {
        window.clearTimeout(timerId);
        remaining -= new Date().getTime() - start.getTime();
    };
    resume();
    return { resume, pause };
};
export default timeout;
//# sourceMappingURL=timeout.js.map