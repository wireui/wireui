export default function classToObject<Type> (component: Type): Type {
  let prototype = Object.getPrototypeOf(component)
  const object: Type = Object.assign({}, component)

  while (prototype && prototype !== Object.prototype) {
    Object.getOwnPropertyNames(prototype)
      .filter(method => method !== 'constructor')
      .forEach(method => {
        const descriptor: any = Object.getOwnPropertyDescriptor(prototype, method)
        Object.defineProperty(object, method, descriptor)
      })

    prototype = Object.getPrototypeOf(prototype)
  }

  return object
}
