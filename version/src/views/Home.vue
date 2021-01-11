<template>
  <div class="main">
    <el-image class="logo" :src="require('@/assets/logo.jpg')"/>
    <div class="title">DSSHOP电商商城</div>
    <div class="describe">傻瓜式一键安装，轻松实现DSSHOP的安装</div>
    <div>
      <el-button class="sub" type="danger" round @click="goPath">开始安装</el-button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Home',
  components: {},
  data() {
    return {
      url: window.location.protocol + "//" + window.location.host,
    }
  },
  methods: {
    goPath() {
      this.$router.push({ path:'/install/server'})
    }
  }
}
</script>
<style  lang="scss" scoped>
  .logo{
    margin-top:80px;
    width:280px;
  }
  .title{
    font-size: 32px;
    font-weight: bold;
    margin-bottom: 20px;
  }
  .describe{
    font-size: 16px;
    color: #999999;
    width: 200px;
    margin: 0 auto 30px;
    line-height: 30px;
  }
  .sub{
    width: 200px;
  }
  .link{
    width: 120px;
    margin-bottom: 10px;
    margin-left:10px;
    margin-right:10px;
  }
</style>
