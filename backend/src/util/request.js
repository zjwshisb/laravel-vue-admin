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
  console.log(error)
  Promise.reject(error)
})
instance.interceptors.response.use(response => {
  return Promise.resolve(response.data)
}, error => {
  if (error.response) {
    switch (error.response.status) {
      case 401: {
        return Promise.reject(error)
      }
      case 403: {
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
        return Promise.reject(error)
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
    }
  } else {
    if (error.message === 'Network Error') {
      Modal.error({
        title: 'network error',
        centered: true
      })
    }
    if (error.message === 'timeout') {
      Modal.error({
        title: 'network error',
        centered: true
      })
    }
    return Promise.reject(error)
  }
})
export default instance
