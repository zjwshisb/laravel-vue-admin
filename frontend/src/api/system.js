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

