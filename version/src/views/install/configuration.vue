<template>
  <div class="main">
    <el-row>
      <el-col class="card" :xs="20" :sm="20" :md="16" :lg="14" :xl="10">
        <div class="title"><i class="el-icon-setting"/>项目配置</div>
        <!-- 步骤-->
        <steps :place="place"></steps>
        <div class="details">
          <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-position="top" class="demo-ruleForm">
            <div class="min-title">项目配置</div>
            <div class="tip">以下基于docker环境，其它环境请根据实际情况填写；此项目安装向导并不包含所有终端，请自行修改.env文件实现更多支持</div>
            <el-form-item label="项目名称" prop="app_name">
              <el-input v-model="ruleForm.app_name" placeholder="请输入项目名称"/>
            </el-form-item>
            <el-form-item label="项目环境" prop="app_env">
              <el-select v-model="ruleForm.app_env" placeholder="请选择环境">
                <el-option label="本地环境" value="local"></el-option>
                <el-option label="开发环境" value="dev"></el-option>
                <el-option label="生产环境" value="prod"></el-option>
              </el-select>
            </el-form-item>
            <el-form-item label="项目调试" prop="app_debug">
              <el-switch
                v-model="ruleForm.app_debug"
                active-text="开"
                inactive-text="关">
              </el-switch>
            </el-form-item>
            <el-form-item label="项目地址" prop="app_url">
              <el-input v-model="ruleForm.app_url" placeholder="请输入项目地址"/>
              <div class="tip">请区分http和https，默认为当前网址</div>
            </el-form-item>
            <div class="min-title">Mysql数据库配置</div>
            <el-form-item label="数据库主机" prop="db_host">
              <el-input v-model="ruleForm.db_host" placeholder="请输入数据库主机"/>
            </el-form-item>
            <el-form-item label="数据库端口" prop="db_port">
              <el-input v-model="ruleForm.db_port" placeholder="请输入数据库端口"/>
            </el-form-item>
            <el-form-item label="数据库名称" prop="db_database">
              <el-input v-model="ruleForm.db_database" placeholder="请输入数据库名称"/>
            </el-form-item>
            <el-form-item label="数据库用户名" prop="db_username">
              <el-input v-model="ruleForm.db_username" placeholder="请输入数据库用户名"/>
            </el-form-item>
            <el-form-item label="数据库密码" prop="db_password">
              <el-input v-model="ruleForm.db_password" placeholder="请输入数据库密码"/>
            </el-form-item>
            <div class="min-title">Redis缓存配置</div>
            <el-form-item label="Redis主机" prop="redis_host">
              <el-input v-model="ruleForm.redis_host" placeholder="请输入数据库主机"/>
            </el-form-item>
            <el-form-item label="Redis端口" prop="redis_port">
              <el-input v-model="ruleForm.redis_port" placeholder="请输入数据库端口"/>
            </el-form-item>
            <el-form-item label="Redis数据库名称" prop="redis_db">
              <el-input v-model="ruleForm.redis_db" placeholder="请输入数据库名称"/>
            </el-form-item>
            <el-form-item label="Redis密码" prop="redis_password">
              <el-input v-model="ruleForm.redis_password" placeholder="请输入Redis密码"/>
              <div class="tip">默认为空</div>
            </el-form-item>
            <div class="min-title">阿里云短信配置</div>
            <el-form-item label="账号" prop="sms_aliyun_access_id">
              <el-input v-model="ruleForm.sms_aliyun_access_id" placeholder="请输入账号"/>
            </el-form-item>
            <el-form-item label="密钥" prop="sms_aliyun_secret">
              <el-input v-model="ruleForm.sms_aliyun_secret" placeholder="请输入密钥"/>
            </el-form-item>
            <el-form-item label="签名" prop="sms_aliyun_signature">
              <el-input v-model="ruleForm.sms_aliyun_signature" placeholder="请输入签名"/>
              <div class="tip">签名需要在阿里云后台添加</div>
            </el-form-item>
            <el-form-item label="模板" prop="sms_aliyun_verification_code">
              <el-input v-model="ruleForm.sms_aliyun_verification_code" placeholder="请输入模板"/>
              <div class="tip">模板需要在阿里云后台添加，模板内容“您的验证码${code}，该验证码5分钟内有效，请勿泄漏于他人！”</div>
            </el-form-item>
            <div class="min-title">微信支付配置</div>
            <el-form-item label="沙箱模式" prop="WECHAT_PAYMENT_SANDBOX">
              <el-switch
                v-model="ruleForm.wechat_payment_sandbox"
                active-text="开"
                inactive-text="关">
              </el-switch>
              <div class="tip">默认为开启沙箱模式，即所有交易都不走正式接口，方便测试</div>
            </el-form-item>
            <el-form-item label="应用ID" prop="wechat_payment_appid">
              <el-input v-model="ruleForm.wechat_payment_appid" placeholder="请输入应用ID"/>
            </el-form-item>
            <el-form-item label="直连商户号" prop="wechat_payment_mch_id">
              <el-input v-model="ruleForm.wechat_payment_mch_id" placeholder="请输入直连商户号"/>
            </el-form-item>
            <el-form-item label="API密钥" prop="wechat_payment_key">
              <el-input v-model="ruleForm.wechat_payment_key" placeholder="请输入key"/>
            </el-form-item>
            <el-form-item label="cert路径" prop="wechat_payment_cert_path">
              <el-input v-model="ruleForm.wechat_payment_cert_path" placeholder="请输入certPath"/>
              <div class="tip">如storage/weixin/apiclient_cert.pem</div>
            </el-form-item>
            <el-form-item label="key路径" prop="wechat_mini_program_key_path">
              <el-input v-model="ruleForm.wechat_mini_program_key_path" placeholder="请输入keyPath"/>
              <div class="tip">如storage/weixin/apiclient_key.pem</div>
            </el-form-item>
            <el-form-item label="是否开启邮箱" prop="mail_switch">
              <el-switch
                v-model="ruleForm.mail_switch"
                active-text="开"
                inactive-text="关">
              </el-switch>
            </el-form-item>
            <template v-if="ruleForm.mail_switch">
              <div class="min-title margin-top">邮箱配置</div>
              <div class="tip">以下默认值为腾讯企业邮箱配置</div>
              <el-form-item label="邮箱驱动" prop="mail_driver">
                <el-input v-model="ruleForm.mail_driver" placeholder="请输入邮箱驱动"/>
              </el-form-item>
              <el-form-item label="邮箱主机" prop="mail_host">
                <el-input v-model="ruleForm.mail_host" placeholder="请输入邮箱主机地址"/>
              </el-form-item>
              <el-form-item label="邮箱端口" prop="mail_port">
                <el-input v-model="ruleForm.mail_port" placeholder="请输入邮箱端口"/>
              </el-form-item>
              <el-form-item label="邮箱用户名" prop="mail_username">
                <el-input v-model="ruleForm.mail_username" placeholder="请输入邮箱用户名"/>
              </el-form-item>
              <el-form-item label="邮箱密码" prop="mail_password">
                <el-input v-model="ruleForm.mail_password" placeholder="请输入邮箱密码"/>
              </el-form-item>
              <el-form-item label="邮箱加密方式" prop="mail_encryption">
                <el-input v-model="ruleForm.mail_encryption" placeholder="请输入邮箱加密方式"/>
              </el-form-item>
              <el-form-item label="邮箱发件地址" prop="mail_from_address">
                <el-input v-model="ruleForm.mail_from_address" placeholder="请输入邮箱发件地址"/>
              </el-form-item>
              <el-form-item label="邮箱发件名称" prop="mail_from_name">
                <el-input v-model="ruleForm.mail_from_name" placeholder="请输入邮箱发件名称"/>
              </el-form-item>
            </template>
            <el-form-item label="是否开启微信小程序" prop="wechat_mini_program_switch">
              <el-switch
                v-model="ruleForm.wechat_mini_program_switch"
                active-text="开"
                inactive-text="关">
              </el-switch>
            </el-form-item>
            <template v-if="ruleForm.wechat_mini_program_switch">
              <div class="min-title margin-top">微信小程序配置</div>
              <el-form-item label="应用ID" prop="wechat_mini_program_appid">
                <el-input v-model="ruleForm.wechat_mini_program_appid" placeholder="请输入应用ID"/>
              </el-form-item>
              <el-form-item label="AppSecret" prop="wechat_mini_program_secret">
                <el-input v-model="ruleForm.wechat_mini_program_secret" placeholder="请输入AppSecret"/>
              </el-form-item>
              <el-form-item label="token" prop="wechat_mini_program_token">
                <el-input v-model="ruleForm.wechat_mini_program_token" placeholder="请输入token"/>
              </el-form-item>
              <el-form-item label="aesKey" prop="wechat_mini_program_aes_key">
                <el-input v-model="ruleForm.wechat_mini_program_aes_key" placeholder="请输入aesKey"/>
              </el-form-item>
            </template>
            <el-form-item label="是否开启微信公众号" prop="wechat_official_account_switch">
              <el-switch
                v-model="ruleForm.wechat_official_account_switch"
                active-text="开"
                inactive-text="关">
              </el-switch>
            </el-form-item>
            <template v-if="ruleForm.wechat_official_account_switch">
              <div class="min-title margin-top">微信公众号配置</div>
              <el-form-item label="应用ID" prop="wechat_official_account_appid">
                <el-input v-model="ruleForm.wechat_official_account_appid" placeholder="请输入应用ID"/>
              </el-form-item>
              <el-form-item label="AppSecret" prop="wechat_official_account_secret">
                <el-input v-model="ruleForm.wechat_official_account_secret" placeholder="请输入AppSecret"/>
              </el-form-item>
              <el-form-item label="token" prop="wechat_official_account_token">
                <el-input v-model="ruleForm.wechat_official_account_token" placeholder="请输入token"/>
              </el-form-item>
              <el-form-item label="aesKey" prop="wechat_official_account_aes_key">
                <el-input v-model="ruleForm.wechat_official_account_aes_key" placeholder="请输入aesKey"/>
              </el-form-item>
            </template>
            <el-form-item label="是否开启微信小程序模板通知" prop="miniweixin_subscription_information_switch">
              <el-switch
                v-model="ruleForm.miniweixin_subscription_information_switch"
                active-text="开"
                inactive-text="关">
              </el-switch>
            </el-form-item>
            <template v-if="ruleForm.miniweixin_subscription_information_switch">
              <div class="min-title margin-top">微信小程序模板通知</div>
              <div class="tip">参考:<a target="_blank" href="https://dswjcms_purl.gitee.io/dsshop/guide/basic.html#%E5%BE%AE%E4%BF%A1%E5%B0%8F%E7%A8%8B%E5%BA%8F%E9%85%8D%E7%BD%AE%E7%9B%B8%E5%85%B3">微信小程序配置相关</a> </div>
              <el-form-item label="发货通知" prop="miniweixin_subscription_information_shipments">
                <el-input v-model="ruleForm.miniweixin_subscription_information_shipments" placeholder="请输入发货通知模板ID"/>
              </el-form-item>
            </template>
            <el-form-item label="是否开启微信公众号模板通知" prop="wechat_subscription_information_switch">
              <el-switch
                v-model="ruleForm.wechat_subscription_information_switch"
                active-text="开"
                inactive-text="关">
              </el-switch>
            </el-form-item>
            <template v-if="ruleForm.wechat_subscription_information_switch">
              <div class="min-title margin-top">微信公众号模板通知</div>
              <div class="tip">参考:<a target="_blank" href="https://dswjcms_purl.gitee.io/dsshop/guide/common.html#%E5%8F%82%E6%95%B0%E8%AF%B4%E6%98%8E">微信公众号配置相关</a> </div>
              <el-form-item label="订单支付成功通知" prop="wechat_subscription_information_finish_payment">
                <el-input v-model="ruleForm.wechat_subscription_information_finish_payment" placeholder="请输入订单支付成功通知模板ID"/>
              </el-form-item>
              <el-form-item label="订单确认收货通知" prop="wechat_subscription_information_order_confirm_receipt">
                <el-input v-model="ruleForm.wechat_subscription_information_order_confirm_receipt" placeholder="请输入订单确认收货通知模板ID"/>
              </el-form-item>
              <el-form-item label="发货通知" prop="wechat_subscription_information_shipments">
                <el-input v-model="ruleForm.wechat_subscription_information_shipments" placeholder="请输入发货通知模板ID"/>
              </el-form-item>
              <el-form-item label="退款成功通知" prop="wechat_subscription_information_refund_success">
                <el-input v-model="ruleForm.wechat_subscription_information_refund_success" placeholder="请输入退款成功通知模板ID"/>
              </el-form-item>
              <el-form-item label="待发货提醒" prop="wechat_subscription_information_admin_order_send_good">
                <el-input v-model="ruleForm.wechat_subscription_information_admin_order_send_good" placeholder="请输入待发货提醒模板ID"/>
              </el-form-item>
              <el-form-item label="订单完成通知" prop="wechat_subscription_information_admin_order_completion">
                <el-input v-model="ruleForm.wechat_subscription_information_admin_order_completion" placeholder="请输入订单完成通知模板ID"/>
              </el-form-item>
            </template>
          </el-form>
          <el-button @click="goPath" type="danger" class="sub">安装<i class="el-icon-arrow-right el-icon--right"/></el-button>
        </div>
      </el-col>
    </el-row>
  </div>
</template>

<script>
import Steps from "@/components/steps"
import { configuration } from '@/api/install'
import { ElMessage } from 'element-plus'
export default {
  name: 'Configuration',
  components: {
    Steps
  },
  data() {
    return {
      place: 3,
      ruleForm: {
        app_name: 'dsshop',
        app_env: 'local',
        app_key: '',
        app_debug: true,
        app_url: 'http://' + document.location.hostname,
        db_host: 'mysql',
        db_port: 3306,
        db_database: 'dsshop',
        db_username: '',
        db_password: '',
        redis_host: 'redis',
        redis_port: '6379',
        redis_db: '',
        redis_password: '',
        passport_client_id: '',
        passport_client_secret: '',
        mail_switch: false,
        mail_driver: 'smtp',
        mail_host: 'smtp.exmail.qq.com',
        mail_port: '465',
        mail_username: '',
        mail_password: '',
        mail_encryption: 'ssl',
        mail_from_address: '',
        mail_from_name: '',
        sms_aliyun_access_id: '',
        sms_aliyun_secret: '',
        sms_aliyun_signature: '',
        sms_aliyun_verification_code: '',
        wechat_payment_sandbox: true,
        wechat_payment_appid: '',
        wechat_payment_mch_id: '',
        wechat_payment_key: '',
        wechat_payment_cert_path: '',
        wechat_mini_program_key_path: '',
        wechat_mini_program_switch: false,
        wechat_mini_program_appid: '',
        wechat_mini_program_secret: '',
        wechat_mini_program_token: 'dsshop',
        wechat_mini_program_aes_key: '',
        wechat_official_account_switch: false,
        wechat_official_account_appid: '',
        wechat_official_account_secret: '',
        wechat_official_account_token: '',
        wechat_official_account_aes_key: '',
        miniweixin_subscription_information_switch: false,
        miniweixin_subscription_information_shipments: '',
        wechat_subscription_information_switch: false,
        wechat_subscription_information_finish_payment: '',
        wechat_subscription_information_order_confirm_receipt: '',
        wechat_subscription_information_shipments: '',
        wechat_subscription_information_refund_success: '',
        wechat_subscription_information_admin_order_send_good: '',
        wechat_subscription_information_admin_order_completion: ''
      },
      rules: {
        app_name: [
          { required: true, message: '请输入项目名称', trigger: 'blur' }
        ],
        app_env: [
          { required: true, message: '请选择项目环境', trigger: 'change' }
        ],
        app_debug: [
          { required: true, message: '请选择项目调试', trigger: 'change' }
        ],
        app_url: [
          { required: true, message: '请输入项目地址', trigger: 'blur' }
        ],
        db_host: [
          { required: true, message: '请输入数据库主机', trigger: 'blur' }
        ],
        db_port: [
          { required: true, message: '请输入数据库端口', trigger: 'blur' }
        ],
        db_database: [
          { required: true, message: '请输入数据库名称', trigger: 'blur' }
        ],
        db_username:[
          { required: true, message: '请输入数据库用户名', trigger: 'blur' }
        ],
        db_password:[
          { required: true, message: '请输入数据库密码', trigger: 'blur' }
        ],
        redis_host:[
          { required: true, message: '请输入Redis主机', trigger: 'blur' }
        ],
        redis_port:[
          { required: true, message: '请输入Redis端口', trigger: 'blur' }
        ],
        redis_db:[
          { required: true, message: '请输入Redis数据库名称', trigger: 'blur' }
        ],
        redis_password:[
          { message: '请输入Redis密码', trigger: 'blur' }
        ],
        sms_aliyun_access_id:[
          { message: '请输入阿里云账号', trigger: 'blur' }
        ],
        sms_aliyun_secret:[
          { message: '请输入阿里云密钥', trigger: 'blur' }
        ],
        sms_aliyun_signature:[
          { message: '请输入阿里云签名', trigger: 'blur' }
        ],
        sms_aliyun_verification_code:[
          { message: '请输入阿里云模板', trigger: 'blur' }
        ],
        wechat_payment_sandbox:[
          { required: true, message: '请选择沙箱模式', trigger: 'change' }
        ],
        wechat_payment_appid:[
          { message: '请输入微信支付appid', trigger: 'blur' }
        ],
        wechat_payment_mch_id:[
          { message: '请输入微信支付直连商户号', trigger: 'blur' }
        ],
        wechat_payment_key:[
          { message: '请输入微信支付API密钥', trigger: 'blur' }
        ],
        wechat_payment_cert_path:[
          { message: '请输入微信支付cert路径', trigger: 'blur' }
        ],
        wechat_mini_program_key_path:[
          { message: '请输入微信支付key路径', trigger: 'blur' }
        ],
        mail_switch: [
          { required: true, message: '请选择是否开启邮箱', trigger: 'change' }
        ],
        mail_driver: [
          { required: true, message: '请输入邮箱驱动', trigger: 'blur' }
        ],
        mail_host: [
          { required: true, message: '请输入邮箱主机', trigger: 'blur' }
        ],
        mail_port: [
          { required: true, message: '请输入邮箱端口', trigger: 'blur' }
        ],
        mail_username: [
          { required: true, message: '请输入邮箱用户名', trigger: 'blur' }
        ],
        mail_password: [
          { required: true, message: '请输入邮箱密码', trigger: 'blur' }
        ],
        mail_encryption: [
          { required: true, message: '请输入邮箱加密方式', trigger: 'blur' }
        ],
        mail_from_address: [
          { required: true, message: '请输入邮箱发件地址', trigger: 'blur' }
        ],
        mail_from_name: [
          { required: true, message: '请输入邮箱发件名称', trigger: 'blur' }
        ],
        wechat_mini_program_switch: [
          { required: true, message: '请选择是否开启微信小程序', trigger: 'change' }
        ],
        wechat_mini_program_appid: [
          { required: true, message: '请输入微信小程序应用ID', trigger: 'blur' }
        ],
        wechat_mini_program_secret: [
          { required: true, message: '请输入微信小程序AppSecret', trigger: 'blur' }
        ],
        wechat_mini_program_token: [
          { required: true, message: '请输入微信小程序token', trigger: 'blur' }
        ],
        wechat_mini_program_aes_key: [
          { required: true, message: '请输入微信小程序aesKey', trigger: 'blur' }
        ],
        wechat_official_account_switch: [
          { required: true, message: '请选择是否开启微信公众号', trigger: 'change' }
        ],
        wechat_official_account_appid: [
          { required: true, message: '请输入微信公众号应用ID', trigger: 'blur' }
        ],
        wechat_official_account_secret: [
          { required: true, message: '请输入微信公众号AppSecret', trigger: 'blur' }
        ],
        wechat_official_account_token: [
          { required: true, message: '请输入微信公众号token', trigger: 'blur' }
        ],
        wechat_official_account_aes_key: [
          { required: true, message: '请输入微信公众号aesKey', trigger: 'blur' }
        ],
        miniweixin_subscription_information_switch: [
          { required: true, message: '请选择是否开启微信小程序模板通知', trigger: 'change' }
        ],
        miniweixin_subscription_information_shipments: [
          { required: true, message: '请输入发货通知模板ID', trigger: 'blur' }
        ],
        wechat_subscription_information_switch: [
          { required: true, message: '请选择是否开启微信公众号模板通知', trigger: 'change' }
        ],
        wechat_subscription_information_finish_payment: [
          { required: true, message: '请输入订单支付成功通知模板ID', trigger: 'blur' }
        ],
        wechat_subscription_information_order_confirm_receipt: [
          { required: true, message: '请输入订单确认收货通知模板ID', trigger: 'blur' }
        ],
        wechat_subscription_information_shipments: [
          { required: true, message: '请输入发货通知模板ID', trigger: 'blur' }
        ],
        wechat_subscription_information_refund_success: [
          { required: true, message: '请输入退款成功通知模板ID', trigger: 'blur' }
        ],
        wechat_subscription_information_admin_order_send_good: [
          { required: true, message: '请输入待发货提醒模板ID', trigger: 'blur' }
        ],
        wechat_subscription_information_admin_order_completion: [
          { required: true, message: '请输入订单完成通知模板ID', trigger: 'blur' }
        ],
      }
    }
  },
  methods: {
    goPath() {
      this.$refs['ruleForm'].validate((valid) => {
        if (valid) {
          // this.ruleForm.app_url
          
          configuration(this.ruleForm).then(response => {
            if (response.data === 'ok') {
              this.$router.push({ path:'/install/dispose'})
            } else{
              ElMessage.error('创建.env失败');
            }
          })
          
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
