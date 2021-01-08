import request from '@/utils/request'
import Qs from 'qs'
export function server() {
  return request({
    url: 'server',
    method: 'get'
  })
}

export function jurisdiction() {
  return request({
    url: 'jurisdiction',
    method: 'get'
  })
}

export function configuration(data) {
  data = Qs.parse({
    data
  })
  data = data.data
  return request({
    url: 'configuration',
    method: 'POST',
    data
  })
}
