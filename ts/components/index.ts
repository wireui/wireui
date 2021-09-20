import { Alpine } from './alpine'
import dropdown from './dropdown'
import maskable from './inputs/maskable'

export interface Start {
  (Alpine: Alpine): void
}

const start: Start = (Alpine: Alpine) => {
  Alpine.data('dropdown', dropdown)
  Alpine.data('maskable', maskable)
}

export default start
