import request from '../util/request'
export const login = () => {
  return request({
    url: 'token',
    method: 'post'
  })
}
