export const requireValidator = (message = '请填写该选项', trigger = ['blur', 'change']) => {
  return {
    required: true,
    message: message,
    trigger: trigger
  }
}
