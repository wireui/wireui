// this script is a refactored code from https://github.com/zhorton34/laravel-js-helpers

export interface DataGet {
  (target: any, key: string | string[] | null | undefined, fallback?: any): any
}

export const dataGet: DataGet = (target, path, fallback = undefined) => {
  if (!path || [null, undefined].includes(target) || ['boolean', 'number', 'string'].includes(typeof target)) {
    return target
  }

  const segments = Array.isArray(path) ? path : path.split('.')
  const segment = segments[0]

  let find = target

  if (segment !== '*' && segments.length > 0) {
    if (find[segment] === null || typeof find[segment] === 'undefined') {
      find = typeof fallback === 'function' ? fallback() : fallback
    } else {
      find = dataGet(find[segment], segments.slice(1), fallback)
    }
  } else if (segment === '*') {
    const partial = segments.slice(path.indexOf('*') + 1, path.length)

    if (typeof find === 'object') {
      find = Object.keys(find).reduce((build, property) => ({
        ...build,
        [property]: dataGet(find[property], partial, fallback)
      }), {})
    } else {
      find = dataGet(find, partial, fallback)
    }
  }

  if (typeof find === 'object' && Object.keys(find).length > 0) {
    const isArrayTransformable = Object.keys(find).every(index => index.match(/^(0|[1-9][0-9]*)$/))

    return isArrayTransformable ? Object.values(find) : find
  }

  return find
}

export default dataGet
