import { hour24Token, hour12Token, minutesToken } from './timeTokens'

export interface TokenCallable {
  (value: string, iValue: number): boolean
}
export interface TokenOutput {
  (value: string, iValue: number): string
}

export type Token = {
  pattern?: RegExp
  transform?: (value: string) => string
  escape?: boolean
  validate?: TokenCallable
  output?: TokenOutput
}

export type MaskerTokens = {
  '#': Token
  'X': Token
  'S': Token
  'A': Token
  'a': Token
  'H': Token
  'h': Token
  'm': Token
  '!': Token
}

export const tokens: MaskerTokens = {
  '#': { pattern: /\d/ },
  'X': { pattern: /[0-9a-zA-Z]/ },
  'S': { pattern: /[a-zA-Z]/ },
  'A': { pattern: /[a-zA-Z]/, transform: (v: string): string => v.toLocaleUpperCase() },
  'a': { pattern: /[a-zA-Z]/, transform: (v: string): string => v.toLocaleLowerCase() },
  '!': { escape: true },
  'H': hour24Token,
  'h': hour12Token,
  'm': minutesToken
}

export default tokens
