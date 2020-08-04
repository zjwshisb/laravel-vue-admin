<template>
  <div>
    <a-form-model :model="form" ref="form" :rules="rules" :label-col="simpleForm.labelCol" :wrapper-col="simpleForm.wrapperCol">
      <a-form-model-item prop="name" label="角色名称">
        <a-input v-model="form.name" :maxLength="32"></a-input>
      </a-form-model-item>
      <a-form-model-item prop="description" label="说明">
        <a-input v-model="form.description" :maxLength="255"></a-input>
      </a-form-model-item>
      <a-form-model-item label="权限设置"  prop="menus.checked">
        <a-tree
          v-model="form.menus"
          checkable
          :tree-data="menus"
          @check="menuCheck"
          :checkStrictly="true"
          :replaceFields="{children:'children', title:'name', key:'id', selectable: 'has_permission'}"
        />
      </a-form-model-item>
      <a-form-model-item :wrapperCol="simpleForm.noLabel.wrapperCol">
        <a-button type="primary" @click="handleSubmit" :loading="loading.submit">提交</a-button>
        <a-button @click="() => $router.go(-1)">取消</a-button>
      </a-form-model-item>
    </a-form-model>
  </div>
</template>

<script>
import SimpleForm from '@/mixins/simpleForm'
import { addRole, getRole, getRoleOption, updateRole } from '../../../api/system'
import { requireValidator } from '../../../util/validator'

export default {
  name: 'add',
  mixins: [SimpleForm],
  data () {
    return {
      menus: [],
      id: '',
      form: {
        name: '',
        description: '',
        menus: {
          checked: [],
          halfChecked: []
        }
      },
      columns: [
        {
          dataIndex: 'name',
          key: 'id'
        }
      ],
      loading: {
        submit: false
      }
    }
  },
  computed: {
    rules () {
      return {
        name: [
          requireValidator()
        ],
        description: [
          requireValidator()
        ],
        menus: [
          requireValidator('请选择权限')
        ]
      }
    },
    isEdit () {
      return !!this.id
    }
  },
  methods: {
    handleSubmit () {
      this.$refs.form.validate().then(res => {
        this.loading.submit = true
        const form = {
          name: this.form.name,
          description: this.form.description,
          menus: this.form.menus.checked
        }
        if (!this.isEdit) {
          addRole(form).then(res => {
            if (res.code === 0) {
              this.$message.success('新增成功')
              this.$router.go(-1)
            }
            this.loading.submit = false
          }).catch(() => {
            this.loading.submit = false
          })
        } else {
          updateRole(this.id, form).then(res => {
            if (res.code === 0) {
              this.$message.success('修改成功')
              this.$router.go(-1)
            }
            this.loading.submit = false
          }).catch(() => {
            this.loading.submit = false
          })
        }
      }).catch(() => {})
    },
    menuCheck (checkedKeys, e) {
      if (e.checked) {
        if (e.node.$parent.dataRef && e.node.$parent.dataRef.id) {
          const selectParent = node => {
            const parent = node.$parent
            const pid = parent.dataRef.id
            if (this.form.menus && this.form.menus.checked) {
              if (this.form.menus.checked.findIndex(v => v === pid) === -1) {
                this.form.menus.checked.push(pid)
              }
            }
            if (parent.$parent && parent.$parent.dataRef && parent.$parent.dataRef.id) {
              selectParent(node.$parent)
            }
          }
          selectParent(e.node)
        }
      } else {
        const hadPermission = e.node.dataRef.has_permission
        if (hadPermission === 1) {
          const func = node => {
            for (const child of node.$children) {
              if (child.dataRef && child.dataRef.id) {
                const pid = child.dataRef.id
                const index = this.form.menus.checked.findIndex(v => v === pid)
                if (index > -1) {
                  this.form.menus.checked.splice(index, 1)
                }
                if (child.$children && child.$children.length > 0) {
                  func(child)
                }
              }
            }
          }
          func(e.node)
        }
      }
    }
  },
  created () {
    getRoleOption({}).then(res => {
      const filterChildren = menu => {
        if (menu.children) {
          if (menu.children.length === 0) {
            delete menu.children
          } else {
            for (const child of menu.children) {
              filterChildren(child)
            }
          }
        }
      }
      for (const x of res) {
        filterChildren(x)
      }
      this.menus = res
    })
    if (this.$route.params.id) {
      this.id = this.$route.params.id
      getRole(this.id).then(res => {
        this.form.name = res.name
        this.form.menus = res.menus
        this.form.description = res.description
      })
    }
  }
}
</script>

<style scoped>

</style>
