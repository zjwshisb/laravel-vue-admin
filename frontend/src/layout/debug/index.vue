<template>
  <div v-if="last !== null">
    <div class="debug-bar" @click="drawerShow = true" >
      <div style="flex: 2;">{{last.request.name}}</div>
      <div>{{last.request.method}}</div>
      <div style="flex: 3;">{{last.request.controller}}</div>
      <div ><span class="success-color">{{formatMemory(last.memory.peak)}}</span></div>
      <div>
        <span class="error-color">{{this.formatTime(last.profiling[0].time)}}</span>
      </div>
      <div>
        <span class="error-color">{{last.database.items.reduce((c, v) => {
              return v.time + c
            }, 0).toFixed(0) + 'ms'}}</span>
      </div>
      <div @click.stop="showSql(last)">
        <a-icon type="database" />
        <span class="success-color">{{last.database.total}}</span></div>
      <div @click.stop="showRedis(last)">redis(<span class="success-color">{{last.redis.total}}</span>)</div>

    </div>
    <a-drawer
      :bodyStyle="{padding: 0}"
      :z-index="1002"
      :height="600"
      title="debug"
      placement="bottom"
      :visible="drawerShow"
      @close="drawerShow = false"
    >
      <a-table :data-source="$store.getters.debugLogs" :columns="columns" :pagination="false"
               :rowKey="rowKey"></a-table>
    </a-drawer>
    <sql-table :visible.sync="sqlShow" :data-source="sql"></sql-table>
    <redis-table :visible.sync="redisShow" :data-source="redisItems"></redis-table>
  </div>
</template>

<script>
import SqlTable from './components/sql'
import RedisTable from './components/redis'
export default {
  name: 'index',
  components: { SqlTable, RedisTable },
  data () {
    return {
      drawerShow: false,
      sqlShow: false,
      redisShow: false,
      columns: [
        {
          title: '路由名称',
          align: 'center',
          dataIndex: 'request.name'
        },
        {
          title: '请求方法',
          align: 'center',
          dataIndex: 'request.method'
        },
        {
          title: '控制器',
          align: 'center',
          dataIndex: 'request.controller'
        },
        {
          title: '内存',
          align: 'center',
          dataIndex: 'memory.peak',
          customRender: text => {
            return this.formatMemory(text)
          }
        },
        {
          title: '请求响应时间',
          align: 'center',
          dataIndex: 'profiling.0.time',
          customRender: text => {
            return this.formatTime(text)
          }
        },
        {
          title: '数据库查询总时间',
          align: 'center',
          customRender: record => {
            const time = record.database.items.reduce((c, v) => {
              return v.time + c
            }, 0)
            return time.toFixed(0) + 'ms'
          }
        },
        {
          title: '数据库查询次数',
          align: 'center',
          dataIndex: 'database.total',
          customRender: (text, record) => {
            return <span class="primary-color point" onclick={() => this.showSql(record)}>{text}</span>
          }
        },
        {
          title: 'redis',
          align: 'center',
          dataIndex: 'redis.total',
          customRender: (text, record) => {
            return <span class="primary-color point" onclick={() => this.showRedis(record)}>{text}</span>
          }
        }
      ],
      sql: [],
      redisItems: []
    }
  },
  methods: {
    formatTime (time) {
      return (time * 1000).toFixed(0) + 'ms'
    },
    formatMemory (memory) {
      return (memory / 1024 / 1024).toFixed(2) + 'M'
    },
    showSql (record) {
      this.sql = record.database.items
      this.sqlShow = true
    },
    showRedis (record) {
      this.redisItems = record.redis.items
      this.redisShow = true
    },
    rowKey (record) {
      return Math.random()
    }
  },
  computed: {
    last () {
      let last = null
      if (this.$store.getters.debugLogs.length >= 1) {
        last = this.$store.getters.debugLogs[0]
      }
      return last
    }
  }
}
</script>

<style scoped lang="less">
.debug-bar{
  z-index: 1002;
  position: fixed;
  bottom: 0;
  left: 0;
  height: 60px;
  line-height: 60px;
  width: 100%;
  background-color: #FFF;
  border-top: 1px solid #e8e8e8;
  display: flex;
  flex-direction: row;
  &> div{
    flex: 1;
    text-align: center;
    &:nth-child(n + 1) {
      border-left: 1px solid #e8e8e8;
    }
  }
  &:hover{
    cursor: pointer;
  }
}
</style>
