import axios from 'axios'
import { MessageBox } from 'element-ui'
import store from '../store'
import { getToken } from '@/utils/auth'
// 创建axios实例
const service = axios.create({
  baseURL: process.env.BASE_API, // api的base_url
  timeout: 15000 // 请求超时时间
})

// request拦截器
service.interceptors.request.use(config => {
  if (store.getters.token) {
    config.headers['Authorization'] = 'Bearer ' + getToken() // 让每个请求携带自定义token 请根据实际情况自行修改
  }
  return config
}, error => {
  // Do something with request error
  console.log(error) // for debug
  Promise.reject(error)
})

// respone拦截器
service.interceptors.response.use(
  response => {
    return response.data
  },
  error => {
    if (!error.response) {
      MessageBox.alert('服务器无响应', '提示', {
        confirmButtonText: '知道了'
      })
      return Promise.reject(error)
    }
    switch (error.response.status) {
      case 422: {
        const data = error.response.data.errors
        let content = ''
        Object.keys(data).map(function(key) {
          const value = data[key]
          content = value[0]
        })
        MessageBox.alert(content, '提示', {
          confirmButtonText: '知道了'
        })
        break
      }
      case 403: {
        MessageBox.alert('你没有权限执行此操作', '提示', {
          confirmButtonText: '确定'
        })
        break
      }
      case 401: {
        if (store.getters.name !== '') {
          MessageBox.confirm('你已被登出，可以取消继续留在该页面，或者重新登录', '确定登出', {
            confirmButtonText: '重新登录',
            cancelButtonText: '取消',
            type: 'warning'
          }).then(() => {
            store.dispatch('FedLogOut').then(() => {
              location.reload()// 为了重新实例化vue-router对象 避免bug
            })
          })
        } else {
          store.dispatch('FedLogOut').then(() => {
            location.reload()
          })
        }
        break
      }
      case 500:
      case 501:
      case 503:
        MessageBox.alert('服务器出了点问题', '提示', {
          confirmButtonText: '确定'
        })
        break
    }
    return Promise.reject(error.response)
  }
)
export default service
