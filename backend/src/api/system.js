import request from '../util/request'
export const fetchAdmins = params => {
  return request({
    url: 'admins',
    params
  })
}

export const addRole = data => {
  return request({
    url: 'roles',
    method: 'post',
    data
  })
}
export const getRoleOption = () => {
  return request({
    url: 'roles/options'
  })
}
export const fetchRoles = params => {
  return request({
    url: 'roles',
    params
  })
}
export const getRole = id => {
  return request({
    url: `roles/${id}`
  })
}
export const updateRole = (id, data) => {
  return request({
    url: `roles/${id}`,
    method: 'put',
    data
  })
}
export const deleteRole = id => {
  return request({
    url: `roles/${id}`,
    method: 'delete'
  })
}
