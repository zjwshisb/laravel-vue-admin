const key = 'laravel-token'

export const setToken = token => {
  return localStorage.setItem(key, token)
}
export const getToken = () => {
  return localStorage.getItem(key)
}
