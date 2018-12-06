import request from '@/utils/request'

export const fetchRoles = params => {
  return request({
    url: '/roles',
    method: 'get',
    params
  })
}
export const addRole = data => {
  return request({
    url: '/roles',
    method: 'post',
    data
  })
}
export const editRole = (data, id) => {
  return request({
    url: `/roles/${id}`,
    method: 'put',
    data
  })
}
export const deleteRole = id => {
  return request({
    url: `/roles/${id}`,
    method: 'delete'
  })
}
export const fetchAdmins = params => {
  return request({
    url: '/admins',
    method: 'get',
    params
  })
}
export const addAdmin = data => {
  return request({
    url: '/admins',
    method: 'post',
    data
  })
}
export const editAdmin = (data, id) => {
  return request({
    url: `/admins/${id}`,
    method: 'put',
    data
  })
}
export const deleteAdmin = id => {
  return request({
    url: `/admins/${id}`,
    method: 'delete'
  })
}
export const fetchMenus = async() => {
  return await request({
    url: 'data',
    params: {
      sources: ['menus']
    }
  })
}
export const fetData = async data => {
  return await request({
    url: 'data',
    params: {
      sources: data
    }
  })
}

