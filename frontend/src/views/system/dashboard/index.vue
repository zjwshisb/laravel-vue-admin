<template>
    <div>
      <a-spin v-bind:spinning="spinning">
        <a-row :gutter="20">
            <a-col :xs="24" :sm="24" :md="16" :lg="16">
                <a-card title="动态">
                    <router-link slot="extra" v-pid="11200" to="/system/account/action-logs">更多</router-link>
                    <a-list item-layout="horizontal" :data-source="activities">
                        <a-list-item slot="renderItem" slot-scope="item">
                            <a-list-item-meta
                                :description="item.created_at + '   ' + item.name"
                            >
                                <template slot="avatar">
                                  <a-avatar v-if="item.avatar" :src="item.avatar"/>
                                  <a-avatar v-else icon="user" :size="48" />
                                </template>
                                <a slot="title">{{ item.admin_name }}</a>
                            </a-list-item-meta>
                        </a-list-item>
                    </a-list>
                </a-card>
            </a-col>
            <a-col :xs="24" :sm="24" :md="8" :lg="8">
                <a-card title="页面错误">
                    <router-link slot="extra" v-pid="11200" to="/system/frontend-error">更多</router-link>
                    <a-list item-layout="horizontal" :data-source="errors">
                        <a-list-item slot="renderItem" slot-scope="error">
                            <a-list-item-meta
                                :description="error.created_at"
                            >
                                <a slot="title">{{ error.message }}</a>
                            </a-list-item-meta>
                        </a-list-item>
                    </a-list>
                </a-card>
            </a-col>
        </a-row>
      </a-spin>
    </div>
</template>

<script>
import { getDashboard } from '../../../api/system'

export default {
  name: 'index',
  data () {
    return {
      activities: [],
      errors: [],
      spinning: false
    }
  },
  created () {
    this.spinning = true
    getDashboard().then(res => {
      this.activities = res.activities
      this.errors = res.errors
      this.spinning = false
    })
  }
}
</script>

<style scoped>

</style>
