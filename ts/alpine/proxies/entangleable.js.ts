import { WireModel } from '@/components/alpine'

export interface MakeEntangleable {
  (options: { value: any, wireModel: WireModel }): any
}

const makeEntangleable: MakeEntangleable = ({ value, wireModel }) => {
  if (wireModel.exists) {
    return window.Livewire.find(wireModel.livewireId).entangle(wireModel.name)
  }

  return value
}

export default makeEntangleable
