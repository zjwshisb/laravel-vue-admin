<template>
    <div>
        <a-row :gutter="20">
            <a-col :xs="24" :sm="24" :md="16" :lg="16">
                <a-card title="动态">
                    <a-list item-layout="horizontal" :data-source="activities">
                        <a-list-item slot="renderItem" slot-scope="item">
                            <a-list-item-meta
                                :description="item.created_at + '   ' + item.name"
                            >
                                <a slot="title">{{ item.admin_name }}</a>
                            </a-list-item-meta>
                        </a-list-item>
                    </a-list>
                </a-card>
            </a-col>
            <a-col :xs="24" :sm="24" :md="8" :lg="8">
                <a-card title="最近的错误">
                </a-card>
            </a-col>
        </a-row>
    </div>
</template>

<script>
import { getDashboard } from '../../../api/system'

export default {
  name: 'index',
  data () {
    return {
      activities: []
    }
  },
  created () {
    getDashboard().then(res => {
      this.activities = res.activities
    })
  }
}
</script>

<style scoped>

</style>
