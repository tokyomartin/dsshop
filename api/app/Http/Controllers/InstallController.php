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
                'install'=>'php(version '.PHP_VERSION.' required)',
                'value'=>'7.2.5',
                'state'=>PHP_VERSION >= '7.2.5' ? PHP_VERSION : false
            ],
            [
                'install'=>'curl',
                'value'=>'',
                'state'=>extension_loaded('curl') ? true : false
            ],
            [
                'install'=>'pdo',
                'value'=>'',
                'state'=>extension_loaded('pdo') ? true : false
            ],
            [
                'install'=>'openssl',
                'value'=>'',
                'state'=>extension_loaded('openssl') ? true : false
            ],
          /*  [
                'install'=>'pcntl',
                'value'=>'',
                'state'=>extension_loaded('pcntl') ? true : false
            ],*/
            [
                'install'=>'redis',
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
