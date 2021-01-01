<template>
  <div class="main">
    <el-row>
      <el-col class="card" :xs="20" :sm="20" :md="16" :lg="14" :xl="10">
        <div class="title"><i class="el-icon-upload"/>服务器要求</div>
        <!-- 步骤-->
        <steps :place="place"></steps>
        <div class="details">
          <el-table
            :data="list"
            border
            style="width: 100%">
            <el-table-column
              prop="server"
              label="要求">
            </el-table-column>
            <el-table-column
              prop="state"
              label="状态"
              width="100"
              align="center">
              <template #default="scope">
                <span v-if="scope.row.state" class="el-icon-circle-check"></span>
                <span v-else class="el-icon-circle-close"></span>
              </template>
            </el-table-column>
          </el-table>
          <el-button @click="goPath" type="danger" class="sub">检查权限<i class="el-icon-arrow-right el-icon--right"/></el-button>
        </div>
      </el-col>
    </el-row>
  </div>
</template>

<script>
import Steps from "@/components/steps"
export default {
  name: 'Server',
  components: {
    Steps
  },
  data() {
    return {
      place: 1,
      list: [
        {
          server: 'php(version 7.0.0 required)',
          value: '7.2.4',
          state: true
        },
        {
          server: 'Openssl',
          value: '',
          state: true
        },
        {
          server: 'Pdo',
          value: '',
          state: false
        }
      ]
    }
  },
  methods: {
    goPath() {
      this.$router.push({ path:'/install/jurisdiction'})
    }
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
      .sub{
        margin-top: 30px;
      }
    }
  }


</style>
