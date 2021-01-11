<template>
  <div class="main">
    <el-row>
      <el-col class="card" :xs="20" :sm="20" :md="16" :lg="14" :xl="10">
        <div class="title"><i class="el-icon-cpu"/>安装</div>
        <!-- 步骤-->
        <steps :place="place"></steps>
        <div class="details">
          <pre class="pre" ref="main">{{ pre }}<div v-if="installation" class="installation">安装中<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div></pre>
          <el-button :disabled="nextStep" @click="goPath" type="danger" class="sub">下一步<i class="el-icon-arrow-right el-icon--right"/></el-button>
        </div>
      </el-col>
    </el-row>
  </div>
</template>

<script>
import Steps from "@/components/steps"
import { ElMessage } from 'element-plus'
import { dispose } from '@/api/install'
export default {
  name: 'Dispose',
  components: {
    Steps
  },
  data() {
    return {
      place: 4,
      pre: '',
      installation: false,
      nextStep: true
    }
  },
  created() {
    this.getDispose(1)
  },
  methods: {
    getDispose(step){
      this.installation = true
      dispose(step).then(response => {
        this.installation = false
        if (!response.data.code) {
          ElMessage.error(response.data.msgCode);
        }
        let div = this.$refs.main
        this.pre+= response.data.msg
        div.scrollTop = div.scrollHeight
        if (response.data.code) {
          if (response.data.step === 'end') {
            this.nextStep = false
          } else {
            this.getDispose(response.data.step)
          }
        }
      })
    },
    goPath() {
      this.$refs['ruleForm'].validate((valid) => {
        if (valid) {
          localStorage.setItem('install', true)
          this.$router.push({ path:'/install/succeed'})
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
  .pre{
    word-wrap: break-word;
    white-space: pre-wrap;
    overflow-x: auto;
    background: #272822;
    color: #f8f8f2;
    text-align: left;
    padding:10px;
    height: 300px;
    code{
      text-align: left;
    }
    .installation{
      position: relative;
      color: #cf7e11;
      line-height: 30px;
      .spinner {
        width: 150px;
        text-align: left;
        position: absolute;
        top:0;
        left: 40px;
      }
  
      .spinner > div {
        width: 6px;
        height: 6px;
        background-color: #cf7e11;
        border-radius: 100%;
        display: inline-block;
        -webkit-animation: bouncedelay 1.4s infinite ease-in-out;
        animation: bouncedelay 1.4s infinite ease-in-out;
        /* Prevent first frame from flickering when animation starts */
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
      }
  
      .spinner .bounce1 {
        -webkit-animation-delay: -0.32s;
        animation-delay: -0.32s;
      }
  
      .spinner .bounce2 {
        -webkit-animation-delay: -0.16s;
        animation-delay: -0.16s;
      }
  
      @-webkit-keyframes bouncedelay {
        0%, 80%, 100% { -webkit-transform: scale(0.0) }
        40% { -webkit-transform: scale(1.0) }
      }
  
      @keyframes bouncedelay {
        0%, 80%, 100% {
          transform: scale(0.0);
          -webkit-transform: scale(0.0);
        } 40% {
            transform: scale(1.0);
            -webkit-transform: scale(1.0);
          }
      }
    }
  }
  .succeed{
    color: #2a9055;
  }
@media screen and (max-width: 500px) {
  .card .steps .icon .steps-box .circle{
    width:40px;
    height: 40px;
  }
}
</style>
