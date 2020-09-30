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
            span: 6
          },
          xl: {
            span: 8
          },
          xll: {
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
            span: 20
          },
          lg: {
            span: 12
          },
          xl: {
            span: 8
          },
          xll: {
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
              span: 20
            },
            lg: {
              offset: 6,
              span: 8
            },
            xl: {
              offset: 8,
              span: 8
            },
            xll: {
              offset: 8,
              span: 8
            }
          }
        }
      }
    }
  }
}
