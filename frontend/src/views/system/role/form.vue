<template>
  <a-page-header :title="title" @back="$router.back()">
    <a-form-model
      ref="form"
      :model="form"
      :rules="rules"
      :label-col="labelCol"
      :wrapper-col="wrapperCol"
      style="margin-top: 20px"
    >
      <a-form-model-item label="角色名称" prop="name">
        <a-input
          v-model="form.name"
          placeholder="请输入角色名称"
          style="width: 500px"
          allow-clear />
      </a-form-model-item>
      <a-form-model-item label="说明" prop="description">
        <a-textarea
          v-model="form.description"
          placeholder="请输入说明"
          style="width: 500px"
          :auto-size="{ minRows: 3, maxRows: 5 }"
          allowClear
          suffix="x" />
      </a-form-model-item>
      <a-divider orientation="left">
        权限设置
      </a-divider>
      <a-form-model-item :wrapper-col="{ span: 22, offset: 2 }" >
        <a-checkbox :indeterminate="indeterminate" :checked="isCheckAll" @change="e => checkAll(e)" >
          全选
        </a-checkbox>
      </a-form-model-item>
      <a-form-model-item v-model="form.menus" v-for="root in this.menus" :key="root.id" :label="root.name" prop="menus.checkIds" >
        <a-checkbox :checked="isCheck(m)" v-for="m in root.children" :key="m.index" @change="e => checkChange(e, m)">
          {{ m.name }}
          <a-popover placement="right">
            <template slot="title">
              <div class="font">
                子权限
              </div>
            </template>
            <template slot="content">
              <div v-for="sm in m.children" :key="sm.id" style="margin: 5px">
                <a-checkbox :checked="isCheck(sm)" @change="e => checkChange(e, sm, m)" >
                  {{ sm.name }}
                </a-checkbox>
                <div v-if="sm.children && sm.children.length > 0" style="margin: 8px 0 8px 30px">
                  <a-checkbox :checked="isCheck(smm)" v-for="smm in sm.children" :key="smm.id" @change="e => checkChange(e, smm, sm, m)">
                    {{ smm.name }}
                  </a-checkbox>
                </div>
              </div>
            </template>
            <a-icon v-if="m.children && m.children.length > 0" type="unordered-list" @click.stop.prevent style="margin-right: 20px" />
          </a-popover>
        </a-checkbox>
      </a-form-model-item>
      <a-form-model-item :wrapper-col="{ span: 14, offset: 4 }">
        <a-button type="primary" @click="handleSubmit" :loading="loading.submit">提交</a-button>
        <a-button style=" margin-left: 10px;" @click="() => $router.back()">取消</a-button>
      </a-form-model-item>
    </a-form-model>
  </a-page-header>
</template>
<script>
import SimpleForm from '@/mixins/simpleForm'
import { requireValidator } from '../../../util/validator'
import { getRoleOption, addRole, updateRole, getRole } from '../../../api/system'
export default {
  name: 'add',
  mixin: [SimpleForm],
  data () {
    return {
      id: '',
      labelCol: { span: 2 },
      wrapperCol: { span: 14 },
      indeterminate: false,
      isCheckAll: false,
      checkIdsSet: new Set(),
      menus: [],
      form: {
        name: '',
        description: '',
        menus: {
          checkIds: []
        }
      },
      loading: {
        submit: false
      }
    }
  },
  computed: {
    menuTotal () {
      let i = 0
      const func = menu => {
        i++
        if (menu.children && menu.children.length > 0) {
          console.log(menu.children)
          for (const child of menu.children) {
            func(child)
          }
        }
      }
      for (const m of this.menus) {
        for (const c of m.children) {
          func(c)
        }
      }
      return i
    },
    title () {
      if (this.id) {
        return '编辑'
      } else {
        return '新增'
      }
    },
    /* 验证规则 */
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
    /* 提交数据 */
    handleSubmit () {
      this.$refs.form.validate().then(res => {
        this.loading.submit = true
        const form = {
          name: this.form.name,
          description: this.form.description,
          menus: this.form.menus.checkIds
        }
        if (this.id === '') {
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
    /* 判断全选框样式 */
    isIndeterminate () {
      this.indeterminate = !!this.form.menus.checkIds.length && this.form.menus.checkIds.length < this.menuTotal
      this.isCheckAll = this.form.menus.checkIds.length === this.menuTotal
    },
    checkAll (e) {
      if (e.target.checked) {
        this.menus.forEach((item) => {
          item.children.forEach(c => {
            this.handleCheck(c, true)
          })
        })
      } else {
        this.menus.forEach((item) => {
          item.children.forEach(c => {
            this.handleUncheck(item)
          })
        })
      }
      this.isIndeterminate()
    },
    /* 判断当前多选框是否已选中 */
    isCheck (m) {
      return this.form.menus.checkIds.findIndex((v) => v === m.id) > -1
    },
    handleCheck (m, checkChildren = false) {
      this.checkIdsSet.add(m.id)
      this.form.menus.checkIds = [...this.checkIdsSet]
      if (checkChildren) {
        if (m.children && m.children.length > 0) {
          for (const i of m.children) {
            this.handleCheck(i, checkChildren)
          }
        }
      }
    },
    handleUncheck (m) {
      this.checkIdsSet.delete(m.id)
      this.form.menus.checkIds = [...this.checkIdsSet]
      if (m.children && m.children.length > 0) {
        for (const i of m.children) {
          this.handleUncheck(i)
        }
      }
    },
    checkChange (e, item, pitem = null, ppitem = null) {
      if (e.target.checked) {
        this.handleCheck(item, true)
        if (pitem) {
          this.handleCheck(pitem)
        }
        if (ppitem) {
          this.handleCheck(ppitem)
        }
      } else {
        this.handleUncheck(item)
      }
      this.isIndeterminate()
      // console.log(this.form.menus.checkIds)
    }
  },
  created () {
    /* 获取权限设置选项 */
    getRoleOption().then(res => {
      this.menus = res.data
    })
    /* 编辑页面 */
    if (this.$route.params.id) {
      this.id = this.$route.params.id
      getRole(this.id).then(res => {
        this.form.name = res.name
        this.form.menus.checkIds = res.menus
        this.form.description = res.description
        if (res.menus && res.menus.length > 0) {
          this.isIndeterminate()
          res.menus.forEach((item) => {
            this.checkIdsSet.add(item)
          })
        }
      })
    }
  }

}
</script>

<style>
  .font{
    font-size: 17px;
    font-weight: bold;
  }
</style>
