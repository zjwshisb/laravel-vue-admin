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
            span: 2
          },
          lg: {
            span: 2
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
            span: 22
          },
          lg: {
            span: 22
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
              offset: 2,
              span: 22
            },
            lg: {
              offset: 2,
              span: 22
            }
          }
        }
      }
    }
  }
}
