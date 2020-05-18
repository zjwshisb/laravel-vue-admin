import axios from 'axios'
import { Modal } from 'ant-design-vue'
import store from '../store/index'
const instance = axios.create({
  baseURL: process.env.VUE_APP_BASE_URL,
  headers: {
    Accept: 'application/json, text/plain, */*'
  },
  timeout: 5000
})
instance.interceptors.request.use(config => {
  if (store.getters.token) {
    config.headers.Authorization = 'Bearer ' + store.getters.token
  }
  return config
}, error => {
  Promise.reject(error)
})
instance.interceptors.response.use(response => {
  return Promise.resolve(response.data)
}, error => {
  if (error.response) {
    switch (error.response.status) {
      case 401: {
        Modal.error({
          title: '登录已失效',
          centered: true,
          onOk () {
            store.dispatch('frontendLogout').then(() => {
              window.location.reload()
            })
          }
        })
        return Promise.reject(error)
      }
      case 403: {
        Modal.error({
          title: '你没有权限执行此操作',
          centered: true,
        })
        return Promise.reject(error)
      }
      case 404: {
        Modal.error({
          title: '404',
          centered: true
        })
        return Promise.reject(error)
      }
      case 422: {
        const data = error.response.data
        for (const x in data.errors) {
          for (const msg of data.errors[x]) {
            Modal.error({
              title: msg,
              centered: true
            })
            return Promise.reject(data)
          }
        }
        break
      }
      case 500:
      case 501:
      case 502:
      case 503:
      case 504:
        Modal.error({
          title: '服务器出了点小差',
          centered: true
        })
        return Promise.reject(error.response.data)
    }
  } else {
    if (error.message === 'Network Error') {
      Modal.error({
        title: 'network error',
        centered: true
      })
    }
    if (error.code && error.code === 'ECONNABORTED') {
      Modal.error({
        title: '请求服务器超时',
        centered: true
      })
    }
    return Promise.reject(error)
  }
})
export default instance
