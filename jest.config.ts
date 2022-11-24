/*
 * For a detailed explanation regarding each configuration property and type check, visit:
 * https://jestjs.io/docs/configuration
 */

/** @returns {import('ts-jest/dist/types').InitialOptionsTsJest} */
export default {
  clearMocks: true,
  collectCoverage: false,
  collectCoverageFrom: ['<rootDir>/ts/**/*.ts'],
  coverageDirectory: 'coverage/ts',
  coveragePathIgnorePatterns: ['/node_modules/'],
  coverageProvider: 'v8',
  moduleNameMapper: {
    '@/(.*)$': '<rootDir>/ts/$1',
    '@tests/(.*)$': '<rootDir>/tests/TypeScript/$1'
  },
  preset: 'ts-jest',
  roots: [
    '<rootDir>',
    'tests/TypeScript',
    'ts'
  ],
  setupFilesAfterEnv: ['jest-extended/all'],
  testEnvironment: 'jsdom',
  testMatch: ['<rootDir>/tests/TypeScript/**/*.spec.ts']
}
