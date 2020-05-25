<template>
  <div>
    <a-form-model :model="form" ref="form" :rules="rules" :label-col="simpleForm.labelCol" :wrapper-col="simpleForm.wrapperCol">
      <a-form-model-item prop="name" label="角色名称">
        <a-input v-model="form.name" :maxLength="32"></a-input>
      </a-form-model-item>
      <a-form-model-item prop="description" label="说明">
        <a-input v-model="form.description" :maxLength="255"></a-input>
      </a-form-model-item>
      <a-form-model-item label="权限设置"  prop="menus">
        <a-table row-key="id" :data-source="menus" :columns="columns" :pagination="false" :rowSelection="{
           onSelect: select, selectedRowKeys: form.menus, onChange: selectChange, getCheckboxProps: getCheckboxProps
        }">
        </a-table>
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
import { addRole, getRole, updateRole, getRoleOption } from '../../../api/system'
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
        menus: []
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
    }
  },
  methods: {
    handleSubmit () {
      this.$refs.form.validate().then(res => {
        this.loading.submit = true
        if (this.id === '') {
          addRole(this.form).then(res => {
            if (res.code === 0) {
              this.$message.success('新增成功')
              this.$router.go(-1)
            }
            this.loading.submit = false
          }).catch(() => {
            this.loading.submit = false
          })
        } else {
          updateRole(this.id, this.form).then(res => {
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
    getCheckboxProps (record) {
      return {
        props: {
          disabled: false,
          name: record.name
        }
      }
    },
    select (record, selected, selectedRowKeys, selectedRows) {
      if (selected &&
        record.parent_id &&
        this.form.menus.findIndex(v => parseInt(v.id) === record.parent_id) === -1) {
        this.form.menus.push(record.parent_id)
      }
    },
    selectChange (selectedRowKeys, selectedRow) {
      this.form.menus = selectedRowKeys
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
