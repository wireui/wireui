export default function chunkArray<T> (array: T[], chunkSize: number = 11): T[][] {
  const chunks: T[][] = []

  for (let i = 0; i < array.length; i += chunkSize) {
    chunks.push(array.slice(i, i + chunkSize))
  }

  return chunks
}
