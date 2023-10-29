/* eslint-disable no-console */

type Payload = {
  message: string
  context: any
}

type ErrorPayload = Payload & {
  exception: any
}

export const error = (payload: ErrorPayload) => {
  console.error(`[WireUi]: ${payload.message}`, {
    context: payload.context,
    exception: payload.exception
  })
}

export const warn = (payload: Payload) => {
  console.error(`[WireUi]: ${payload.message}`, payload.context)
}

export const info = (payload: Payload) => {
  console.error(`[WireUi]: ${payload.message}`, payload.context)
}
