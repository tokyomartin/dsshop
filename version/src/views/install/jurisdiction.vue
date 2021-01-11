<template>
  <div class="main">
    <el-row>
      <el-col class="card" :xs="20" :sm="20" :md="16" :lg="14" :xl="10">
        <div class="title"><i class="el-icon-key"/>权限检测</div>
        <!-- 步骤-->
        <steps :place="place"></steps>
        <div class="details">
          <el-table
            :data="list"
            border
            v-loading="listLoading"
            style="width: 100%">
            <el-table-column
              prop="catalogue"
              label="目录">
            </el-table-column>
            <el-table-column
              prop="state"
              label="状态"
              width="100"
              align="center">
              <template #default="scope">
                <span v-if="scope.row.state" class="el-icon-circle-check"></span>
                <span v-else class="el-icon-circle-close"></span>
                <span class="jurisdiction">{{ scope.row.jurisdiction }}</span>
              </template>
            </el-table-column>
          </el-table>
          <el-button @click="goPath" type="danger" class="sub">项目配置<i class="el-icon-arrow-right el-icon--right"/></el-button>
        </div>
      </el-col>
    </el-row>
  </div>
</template>

<script>
import Steps from "@/components/steps"
import { jurisdiction } from '@/api/install'
import { ElMessage } from 'element-plus'
export default {
  name: 'Jurisdiction',
  components: {
    Steps
  },
  data() {
    return {
      place: 2,
      listLoading: false,
      list: []
    }
  },
  created() {
    this.getList()
  },
  methods: {
    goPath() {
      for (const element of this.list){
        if (!element.state) {
          ElMessage.error('您的目录权限不足，请先处理');
          return false
        }
      }
      this.$router.push({ path:'/install/configuration'})
    },
    getList() {
      this.listLoading = true
      jurisdiction().then(response => {
        if(response.data.code){
          ElMessage.error(response.data.msg);
          return false
        }
        this.list = response.data
        this.listLoading = false
      })
    },
  }
}
</script>
<style  lang="scss" scoped>
  .card{
    box-shadow: 0 2px 12px 0 rgba(0,0,0,.1);
    margin: 80px auto 0;
    border-radius: 4px;
    border: 1px solid #EBEEF5;
    .title{
      line-height: 45px;
      font-size: 22px;
      background-color: #f98585;
      color: #ffffff;
      padding-top:20px;
      padding-bottom: 50px;
      i{
        font-size: 24px;
        margin-right: 10px;
      }
    }
    .details{
      padding: 50px 20px;
      .el-icon-circle-check{
        color:#67c23a;
        font-size: 24px;
      }
      .el-icon-circle-close{
        color:#f56c6c;
        font-size: 24px;
      }
      .jurisdiction{
        padding-left:5px;
        font-size: 20px;
      }
      .sub{
        margin-top: 30px;
      }
    }
  }

@media screen and (max-width: 500px) {
  .card .steps .icon .steps-box .circle{
    width:40px;
    height: 40px;
  }
}
</style>
