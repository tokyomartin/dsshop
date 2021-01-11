import axios from 'axios'
import { ElMessage } from 'element-plus'
const service = axios.create({
  baseURL: process.env.NODE_ENV === 'development' ? 'http://dsshop.test/install/api/' : window.location.protocol+"//"+window.location.host+"/install/api/", // api 的 base_url
  timeout: 500000 // request timeout
})
// request interceptor
service.interceptors.request.use(
  config => {
    return config
  },
  error => {
    // Do something with request error
    console.log(error) // for debug
    Promise.reject(error)
  }
)

// response interceptor
service.interceptors.response.use(
  response => {
    if (response.data.result === 'error') {
      ElMessage({
        message: '你的环境不支持laravel，请先进行配置',
        type: 'error',
        duration: 5 * 1000
      })
    }
    const res = response.data
    if (response.status !== 200) {
      ElMessage({
        message: res.message || 'Error',
        type: 'error',
        duration: 5 * 1000
      })
      return Promise.reject(new Error(res.message || 'Error'))
    } else {
      return {
        data: res
      }
    }
  },
  error => {
    // console.log('err' + error) // for debug
    ElMessage({
      message: error.message,
      type: 'error',
      duration: 5 * 1000
    })
    return Promise.reject(error)
  }
)

export default service
