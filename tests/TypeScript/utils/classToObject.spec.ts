import ColorPicker from '@/components/color-picker'
import Dropdown from '@/components/Dropdown'
import TimeSelector from '@/components/TimeSelector'
import classToObject from '@/utils/classToObject'

describe('classToObject function test', () => {
  it('should convert Alpine Components to Object', () => {
    const components = [new Dropdown(), new ColorPicker(), new TimeSelector()]

    const baseFunctions = [
      '$safeWatch',
      '$skipNextWatcher',
      '$destroy',
      'destroy'
    ]

    const baseProperties = [
      'skipWatchers',
      'destroyCallbacks'
    ]

    components.forEach(component => {
      const object = classToObject(component)

      baseFunctions.forEach(func => {
        expect(object[func]).toBe(component[func])
      })

      baseProperties.forEach(prop => {
        expect(object[prop]).toEqual(component[prop])
      })

      const prototype = Object.getPrototypeOf(component)
      const object2 = Object.assign({}, component)

      Object.getOwnPropertyNames(prototype)

      expect(Object.keys(object2)).toEqual(Object.keys(component))
    })
  })

  it('should convert class instance properties to object', () => {
    class MyClass {
      instanceProp = 'Hello'
    }
    const myInstance = new MyClass()
    const obj = classToObject(myInstance)
    expect(obj.instanceProp).toBe('Hello')
  })

  it('should convert class methods to object', () => {
    class MyClass {
      greet () {
        return 'Hello'
      }
    }
    const myInstance = new MyClass()
    const obj = classToObject(myInstance)
    expect(obj.greet()).toBe('Hello')
  })

  it('should handle inherited properties and methods', () => {
    abstract class ParentClass {
      parentMethod () {
        return 'Parent Greeting'
      }
    }

    class ChildClass extends ParentClass {
      childMethod () {
        return 'Child Greeting'
      }
    }

    const childInstance = new ChildClass()
    const obj = classToObject(childInstance)
    expect(obj.parentMethod()).toBe('Parent Greeting')
    expect(obj.childMethod()).toBe('Child Greeting')
  })

  it('should handle properties and methods with $ prefix', () => {
    class MyClass {
      $prop = 'Dollar Prop'
      $greet () {
        return 'Dollar Greeting'
      }
    }
    const myInstance = new MyClass()
    const obj = classToObject(myInstance)
    expect(obj.$prop).toBe('Dollar Prop')
    expect(obj.$greet()).toBe('Dollar Greeting')
  })

  it('should not include the constructor method', () => {
    class MyClass {
      constructor () {}
    }
    const myInstance = new MyClass()
    const obj = classToObject(myInstance)
    expect(obj.constructor).not.toBe(myInstance.constructor)
  })

  it('should handle nested inherited properties and methods', () => {
    class GrandparentClass {
      grandparentMethod () {
        return 'Grandparent Greeting'
      }
    }

    class ParentClass extends GrandparentClass {
      parentMethod () {
        return 'Parent Greeting'
      }
    }

    class ChildClass extends ParentClass {
      childMethod () {
        return 'Child Greeting'
      }
    }

    const childInstance = new ChildClass()
    const obj = classToObject(childInstance)
    expect(obj.grandparentMethod()).toBe('Grandparent Greeting')
    expect(obj.parentMethod()).toBe('Parent Greeting')
    expect(obj.childMethod()).toBe('Child Greeting')
  })

  it('should handle classes with no properties or methods', () => {
    class EmptyClass {}

    const emptyInstance = new EmptyClass()
    const obj = classToObject(emptyInstance)
    expect(Object.keys(obj).length).toBe(0)
  })
})
