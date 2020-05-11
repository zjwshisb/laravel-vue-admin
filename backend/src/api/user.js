import request from '../util/request'
export const login = form => {
  return request({
    url: 'tokens',
    method: 'post',
    data: form
  })
}
export const getInfo = () => {
  return request({
    url: 'me'
  })
}
