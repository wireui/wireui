export type Token = {
  pattern?: RegExp
  transform?: (value: string) => string
  escape?: boolean
}

export type MaskerTokens = {
  '#': Token
  'X': Token
  'S': Token
  'A': Token
  'a': Token
  '!': Token
}

export default {
  '#': { pattern: /\d/ },
  'X': { pattern: /[0-9a-zA-Z]/ },
  'S': { pattern: /[a-zA-Z]/ },
  'A': { pattern: /[a-zA-Z]/, transform: (v: string): string => v.toLocaleUpperCase() },
  'a': { pattern: /[a-zA-Z]/, transform: (v: string): string => v.toLocaleLowerCase() },
  '!': { escape: true }
} as MaskerTokens
