import request from '../util/request'
export const fetchAdmins = params => {
  return request({
    url: 'admins',
    params
  })
}
export const fetchOptions = params => {
  return request({
    url: 'options',
    method: 'get',
    params
  })
}
export const AddRole = data => {
  return request({
    url: 'roles',
    method: 'post',
    data
  })
}
