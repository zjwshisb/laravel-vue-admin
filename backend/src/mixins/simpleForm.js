export default {
  name: 'simpleForm',
  computed: {
    simpleForm () {
      return {
        labelCol: {
          xs: {
            span: 24
          },
          sm: {
            span: 24
          },
          md: {
            span: 4
          },
          lg: {
            span: 8
          }
        },
        wrapperCol: {
          xs: {
            span: 24
          },
          sm: {
            span: 24
          },
          md: {
            span: 16
          },
          lg: {
            span: 8
          }
        },
        noLabel: {
          wrapperCol: {
            xs: {
              offset: 0,
              span: 24
            },
            sm: {
              offset: 0,
              span: 24
            },
            md: {
              offset: 4,
              span: 16
            },
            lg: {
              offset: 8,
              span: 8
            }
          }
        }
      }
    }
  }
}
