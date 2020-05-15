<template>
  <div>
    <a-form-model :model="form" ref="form" :rules="rules" :label-col="simpleForm.labelCol" :wrapper-col="simpleForm.wrapperCol">
      <a-form-model-item prop="name" label="角色名称">
        <a-input v-model="form.name"></a-input>
      </a-form-model-item>
      <a-form-model-item prop="description" label="说明">
        <a-input v-model="form.description" type="password"></a-input>
      </a-form-model-item>
      <a-form-model-item label="权限设置" >
        <a-table row-key="id" :data-source="menus" :columns="columns" :pagination="false" :rowSelection="{
           onSelect: select, selectedRowKeys: form.menus, onChange: selectChange
        }">
        </a-table>
      </a-form-model-item>
      <a-form-model-item :wrapperCol="simpleForm.noLabel.wrapperCol">
        <a-button type="primary">提交</a-button>
        <a-button @click="() => $router.go(-1)">取消</a-button>
      </a-form-model-item>
    </a-form-model>
  </div>
</template>

<script>
import { simpleForm } from '../../../util/gird'
import { addRole } from '../../../api/system'
export default {
  name: 'add',
  data () {
    return {
      menus: [],
      form: {
        name: '',
        description: '',
        menus: ['35']
      },
      columns: [
        {
          dataIndex: 'name',
          key: 'id'
        }
      ]
    }
  },
  computed: {
    simpleForm: () => simpleForm
  },
  methods: {
    select (record, selected, selectedRowKeys, selectedRows) {
      if (selected &&
        record.parent_id &&
        this.form.menus.findIndex(v => parseInt(v.id) === record.parent_id) === -1) {
        this.form.menus.push(record.parent_id)
      }
    },
    selectChange (selectedRowKeys, selectedRow) {
      this.form.menus = selectedRowKeys
    },
    handleSubmit () {
      addRole()
    }
  },
  created () {
    this.$fetchOptions({
      sources: ['admin_menus']
    }).then(res => {
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
      for (const x of res.admin_menus) {
        filterChildren(x)
      }
      this.menus = res.admin_menus
    })
  }
}
</script>

<style scoped>

</style>
