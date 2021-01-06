<template>
  <div class="main">
    <el-row>
      <el-col class="card" :xs="20" :sm="20" :md="16" :lg="14" :xl="10">
        <div class="title"><i class="el-icon-cpu"/>安装</div>
        <!-- 步骤-->
        <steps :place="place"></steps>
        <div class="details">
          <el-button @click="goPath" type="danger" class="sub">安装<i class="el-icon-arrow-right el-icon--right"/></el-button>
        </div>
      </el-col>
    </el-row>
  </div>
</template>

<script>
import Steps from "@/components/steps"
import { ElMessage } from 'element-plus'
export default {
  name: 'Dispose',
  components: {
    Steps
  },
  data() {
    return {
      place: 4
    }
  },
  methods: {
    goPath() {
      this.$refs['ruleForm'].validate((valid) => {
        if (valid) {
          this.$router.push({ path:'/install/configuration'})
        } else {
          ElMessage.error('存在错误信息，请处理');
          return false;
        }
      });
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
      .demo-ruleForm{
        height:450px;
        overflow-y:auto;
        text-align: left;
        padding:20px;
        .margin-top{
          margin-top:30px;
        }
        .min-title{
          font-size: 22px;
          color: #999999;
        }
        .tip{
          color:#999999;
          line-height: 25px;
        }
      }
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
