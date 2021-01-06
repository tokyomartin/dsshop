<template>
  <div class="steps">
    <div class="icon">
      <div class="steps-box"><div @click="goPath('/install/install')" class="circle" :class="{on:place>0}"> <i class="el-icon-upload"/></div></div>
      <div class="steps-box"><div @click="goPath('/install/jurisdiction')" class="circle" :class="{on:place>1}"><i class="el-icon-key"/></div></div>
      <div class="steps-box"><div @click="goPath('/install/configuration')" class="circle" :class="{on:place>2}"><i class="el-icon-setting"/></div></div>
      <div class="steps-box"><div @click="goPath('/install/dispose')" class="circle" :class="{on:place>3}"><i class="el-icon-cpu"/></div></div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Steps',
  props: {
    place: Number
  },
  methods: {
    goPath(path) {
      this.$router.push({ path: path})
    }
  }
}
</script>

<style lang="scss" scoped>
.steps{
  position: relative;
  .icon{
    width: 100%;
    position: absolute;
    top:-25px;
    display: flex;
    .steps-box{
      flex:1;
      .circle{
        cursor:pointer;
        margin:0 auto;
        width:50px;
        height: 50px;
        border-radius: 50%;
        background-color: #cccccc;
        i{
          color: #ffffff;
          font-size: 24px;
          line-height: 45px;
        }
      }
      .circle.on{
        background-color: #F56C6C;
        i{
          font-size: 28px;
        }
      }
    }
  }
}
@media screen and (max-width: 500px) {
  .steps .icon .steps-box .circle{
    width:40px;
    height: 40px;
  }
}
</style>
