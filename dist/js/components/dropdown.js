export default () => ({
    status: false,
    open() { this.status = true; },
    close() { this.status = false; },
    toggle() { this.status = !this.status; }
});
//# sourceMappingURL=dropdown.js.map