import request from '@/utils/request'

export const login = data => {
  return request({
    url: '/tokens',
    method: 'post',
    data
  })
}

export function getInfo() {
  return request({
    url: `/me`,
    method: 'get'
  })
}

export function logout() {
  return request({
    url: '/user/logout',
    method: 'post'
  })
}
