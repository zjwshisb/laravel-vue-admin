export const requiredValidator = (message = '请输入该字段', trigger = ['blur', 'change']) => {
  return {
    require: true,
    message,
    trigger
  }
}
