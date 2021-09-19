import dropdown from './dropdown'

export interface Alpine {
  data (name: string, data: any): void
}

export interface Start {
  (Alpine: Alpine): void
}

const start: Start = (Alpine: Alpine) => {
  Alpine.data('dropdown', dropdown)
}

export default start
