if (!HTMLElement.prototype.replaceChildren) {
  HTMLElement.prototype.replaceChildren = function (...nodes) {
    this.innerHTML = ''
    this.append(...nodes)
  }
}
