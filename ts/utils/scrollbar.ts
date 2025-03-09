export const toggleScrollbar = (state: boolean) => {
  const elements = [...document.querySelectorAll('body, [main-container]')]

  state
    ? elements.forEach(el => el.classList.add('!overflow-hidden', 'overflow-hidden!'))
    : elements.forEach(el => el.classList.remove('!overflow-hidden', 'overflow-hidden!'))
}

export default toggleScrollbar
