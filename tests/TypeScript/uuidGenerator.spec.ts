import uuid from '@/utils/uuid'

describe('Testing uuid4 generator', () => {
  it('should match regex pattern', () => {
    const regexExp = new RegExp('^[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}$')

    for (let i = 0; i < 10; i++) {
      expect(regexExp.test(uuid())).toBeTruthy()
    }
  })
})
