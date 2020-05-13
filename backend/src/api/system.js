import request from '../util/request'
export const fetchAdmins = params => {
  return request({
    url: 'admins',
    params
  })
}
