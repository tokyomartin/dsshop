<template>
  <div id="app">
    <router-view/>
  </div>
</template>

<script>

export default {
  name: 'App',
  created() {
    if(localStorage.getItem('install')){
      this.$router.push({ path:'/install/succeed'})
    }
  },
}
</script>
<style>
  .main{
    font-size: 12px;
    margin: 0 auto;
    text-align: center;
  }
    .your-table .el-table__body-wrapper::-webkit-scrollbar {
      width: 5px;
      height: 5px;
    }
    .your-table .el-table__body-wrapper::-webkit-scrollbar-thumb {
      background-color: #a1a3a9;
      border-radius: 3px;
    }
    ::-webkit-scrollbar {
      width: 5px;
      height: 5px;
    }
    ::-webkit-scrollbar-thumb {
      background-color: #a1a3a9;
      border-radius: 3px;
    }
</style>
