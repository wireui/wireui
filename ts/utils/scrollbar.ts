export const toggleScrollbar = (state: boolean) => {
  const elements = [...document.querySelectorAll('body, [main-container]')]

  if (state) {
    elements.forEach(el => el.classList.add('!overflow-hidden'))
  } else {
    elements.forEach(el => el.classList.remove('!overflow-hidden'))
  }
}

export default toggleScrollbar
