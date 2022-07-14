export interface ModalStore {
  current: string | null
  actives: string[]

  setCurrent (id: string): this
  remove (id: string): this
  isCurrent (id: string): boolean
  isFirstest (id: string): boolean
}

const store: ModalStore = {
  current: null,
  actives: [],

  setCurrent (id) {
    this.current = id
    this.actives.push(id)

    return this
  },
  remove (id) {
    if (this.current === id) {
      this.current = null
    }

    this.actives = this.actives.filter(active => active !== id)

    if (this.current === null && this.actives.length) {
      this.current = this.actives[this.actives.length - 1]
    }

    return this
  },
  isCurrent (id) {
    return this.current === id
  },
  isFirstest (id) {
    return this.actives[0] === id
  }
}

export default store
