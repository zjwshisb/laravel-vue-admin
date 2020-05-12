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
export const changePassword = (oldPwd, newPwd) => {
  return request({
    url: 'me/password',
    method: 'post',
    data: {
      old_password: oldPwd,
      new_password: newPwd
    }
  })
}
