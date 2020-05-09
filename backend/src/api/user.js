import request from '../util/request'
export const login = form => {
  return request({
    url: 'token',
    method: 'post',
    data: form
  })
}
