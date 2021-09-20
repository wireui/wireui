import { Alpine } from './alpine'
import dropdown from './dropdown'
import maskable from './inputs/maskable'
import currency from './inputs/currency'

export interface Start {
  (Alpine: Alpine): void
}

const start: Start = (Alpine: Alpine) => {
  Alpine.data('dropdown', dropdown)
  Alpine.data('maskable', maskable)
  Alpine.data('currency', currency)
}

export default start
