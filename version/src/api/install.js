import request from '@/utils/request'
import Qs from 'qs'
export function server() {
  return request({
    url: 'server.php',
    method: 'get'
  })
}

export function jurisdiction() {
  return request({
    url: 'jurisdiction.php',
    method: 'get'
  })
}

export function configuration(data) {
  data = Qs.parse({
    data
  })
  data = data.data
  return request({
    url: 'configuration.php',
    method: 'POST',
    data
  })
}

export function dispose(step) {
  return request({
    url: 'dispose.php',
    method: 'get',
    params: { step: step }
  })
}
