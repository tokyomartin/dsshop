import request from '@/utils/request'
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

