export default function classToObject<Type> (component: Type): Type {
  const prototype = Object.getPrototypeOf(component)
  const object = Object.assign({}, component)

  Object.getOwnPropertyNames(prototype)
    .filter(method => method !== 'constructor')
    .forEach(method => {
      const descriptor: any = Object.getOwnPropertyDescriptor(prototype, method)

      Object.defineProperty(object, method, descriptor)
    })

  return object
}
