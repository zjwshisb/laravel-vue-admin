import request from '../util/request'
export const fetchAdmins = params => {
  return request({
    url: 'admins',
    params
  })
}
export const addAdmin = data => {
  return request({
    url: 'admins',
    method: 'post',
    data
  })
}
export const updateAdmin = (id, data) => {
  return request({
    url: `admins/${id}`,
    method: 'put',
    data
  })
}
export const getAdminOption = () => {
  return request({
    url: 'admin/options'
  })
}
export const getAdmin = id => {
  return request({
    url: `admin/${id}`
  })
}
export const updateAdminPassword = (id, password) => {
  return request({
    url: `admin/${id}/password`,
    method: 'put',
    data: {
      password
    }
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
export const errorReport = data => {
  return request({
    url: 'frontend-error',
    method: 'post',
    data
  })
}
export const fetchAdminActionLogs = params => {
  return request({
    url: 'admin-action-logs',
    params
  })
}
export const fetchFrontendError = params => {
  return request({
    url: 'frontend-errors',
    params
  })
}
export const flushFrontendError = () => {
  return request({
    url: 'frontend-errors/flush',
    method: 'post'
  })
}
