<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
class InstallController extends Controller
{
    /**
     * 服务器检测
     * @param Request $request
     * @return mixed
     */
    public function server(Request $request){
        $return=[
            [
                'server'=>'php(version '.PHP_VERSION.' required)',
                'value'=>'7.2.5',
                'state'=>PHP_VERSION >= '7.2.5' ? PHP_VERSION : false
            ],
            [
                'server'=>'curl',
                'value'=>'',
                'state'=>extension_loaded('curl') ? true : false
            ],
            [
                'server'=>'pdo',
                'value'=>'',
                'state'=>extension_loaded('pdo') ? true : false
            ],
            [
                'server'=>'openssl',
                'value'=>'',
                'state'=>extension_loaded('openssl') ? true : false
            ],
          /*  [
                'install'=>'pcntl',
                'value'=>'',
                'state'=>extension_loaded('pcntl') ? true : false
            ],*/
            [
                'server'=>'redis',
                'value'=>'',
                'state'=>extension_loaded('redis') ? true : false
            ],
        ];
        return $return;
    }

    /**
     * 目录权限
     * @param Request $request
     * @return mixed
     */
    public function jurisdiction(Request $request){
        $return =[
            [
                'catalogue'=>'storage/framework/',
                'jurisdiction'=>$this->getPermission('storage/framework/')['jurisdiction'],
                'state'=>$this->getPermission('storage/framework/')['state'],
            ],
            [
                'catalogue'=>'storage/logs/',
                'jurisdiction'=>$this->getPermission('storage/framework/')['jurisdiction'],
                'state'=>$this->getPermission('storage/framework/')['state'],
            ],
            [
                'catalogue'=>'bootstrap/cache/',
                'jurisdiction'=>$this->getPermission('storage/framework/')['jurisdiction'],
                'state'=>$this->getPermission('storage/framework/')['state'],
            ],
        ];
        return $return;
    }

    /**
     * 项目配置
     * @param Request $request
     * @return string
     */
    public function configuration(Request $request){
        $contents='';
        $booleanArr=['app_debug','mail_switch','miniweixin_subscription_information_switch','wechat_mini_program_switch','wechat_official_account_switch','wechat_payment_sandbox','wechat_subscription_information_switch'];
        foreach ($request->all() as $key=>$value){
            if(in_array($key,$booleanArr)){
                $contents.=strtoupper($key).'='.($value ? 'true' : 'false').PHP_EOL;
            }else{
                $contents.=strtoupper($key).'='.$value.PHP_EOL;
            }
        }
        file_put_contents("../.env",$contents);
        return 'ok';
    }

    /**
     * 安装
     * @param Request $request
     */
    public function dispose(Request $request){

    }

    private function getPermission($folder)
    {
        $jurisdiction = substr(sprintf('%o', fileperms(base_path($folder))), -3);
        if($jurisdiction == '777' || $jurisdiction == '755'){
            return [
                'jurisdiction'=>$jurisdiction,
                'state'=>true,
            ];
        }else {
            return [
                'jurisdiction'=>$jurisdiction,
                'state'=>false,
            ];
        }
    }
}
