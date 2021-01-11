<template>
  <div class="main">
    <el-image class="logo" :src="require('@/assets/logo.jpg')"/>
    <div class="title">DSSHOP电商商城</div>
    <div class="describe">恭喜你，安装成功</div>
    <el-alert
      class="alert"
      title="切忌删除api/public/install目录"
      type="error"
      effect="dark"/>
    <div>
      <a :href="url + '/h5'" target="_blank"><el-button class="link" size="small">访问H5</el-button></a>
      <a :href="url + '/admin'" target="_blank"><el-button class="link" size="small">访问后台</el-button></a>
    </div>
    <div>
      <a href="https://github.com/dspurl/dsshop" target="_blank"><el-button class="link" size="small" type="primary">项目Github地址</el-button></a>
      <a href="https://gitee.com/dswjcms/dsshop" target="_blank"><el-button class="link" size="small" type="primary">项目Gitee地址</el-button></a>
    </div>
    <div>
      <a href="https://dspurl.github.io/dsshop/" target="_blank"><el-button class="link" size="small" type="success">开发手册(Github)</el-button></a>
      <a href="https://dswjcms_purl.gitee.io/dsshop/" target="_blank"><el-button class="link" size="small" type="success">开发手册(Gitee)</el-button></a>
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
  .alert{
    width: 400px;
    margin: 0 auto 10px;
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
