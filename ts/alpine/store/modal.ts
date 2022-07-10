export interface ModalStore {
  current: string | null
  actives: string[]

  setCurrent (id: string): this
  isCurrent (id: string): boolean
  remove (id: string): this
}

const store: ModalStore = {
  current: null,
  actives: [],

  setCurrent (id) {
    this.current = id
    this.actives.push(id)

    return this
  },
  isCurrent (id) {
    return this.current === id
  },
  remove (id) {
    if (this.current === id) {
      this.current = null
    }

    this.actives = this.actives.filter(active => active !== id)

    return this
  }
}

export default store
