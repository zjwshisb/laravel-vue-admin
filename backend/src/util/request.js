import axios from 'axios'
import { getToken } from './token'
console.log(process.env)
const instance = axios.create({
  baseURL: process.env.VUE_APP_BASE_URL,
  headers: {
    Authorization: 'Bearer ' + getToken(),
    Accept: 'application/json, text/plain, */*'
  },
  timeout: 5000
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
        console.log('error')
    }
  } else {
    console.log(error)
    return Promise.reject(error)
  }
})
export default instance
