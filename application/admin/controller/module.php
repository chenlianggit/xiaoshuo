<?php
class moduleController extends AdminController{ public function init() { $this->tableName='module'; parent::init(); } public function indexAction() { $this->list=$this->model->getlist(); $this->display(); } public function installAction() { $zym_10=I('get.key','en',''); $zym_9=APP_PATH.'/'.$zym_10.'/config.ini'; if (is_file($zym_9)) { $zym_11 = parse_ini_file($zym_9, true); if ($zym_12=$this->model->where(array('key'=>$zym_10))->find()){ $this->error('模块已经安装过了'); } if (!empty($zym_11['installsql'])){ $zym_8=APP_PATH.'/'.$zym_10.'/'.$zym_11['installsql']; if (!is_file($zym_8)) $this->error('安装数据库文件不存在'); M()->execute(F($zym_8)); } if(isset($zym_11['nodelist'])){ $zym_11['nodegroup']=isset($zym_11['nodegroup'])?$zym_11['nodegroup']:''; M('admin_node')->install($zym_11['nodelist'],$zym_11['nodegroup'],$zym_10); } $zym_5['key']=$zym_10; $zym_5['name']=$zym_11['name']; $zym_5['system']=0; $zym_5['create_user_id']=$_SESSION['admin']['userid']; $zym_5['create_time']=NOW_TIME; $zym_5['status']=1; $this->model->add($zym_5); $this->success('安装成功'); }else{ $this->error('模块配置文件不存在'); } } public function uninstallAction() { $zym_10=I('get.key','en',''); $zym_9=APP_PATH.'/'.$zym_10.'/config.ini'; if (is_file($zym_9)) { $zym_11 = parse_ini_file($zym_9, true); if (!$zym_12=$this->model->where(array('key'=>$zym_10))->find()){ $this->error('模块尚未安装'); } if (isset($_GET['deldb']) && $_GET['deldb']==1 && !empty($zym_11['uninstallsql'])){ $zym_8=APP_PATH.'/'.$zym_10.'/'.$zym_11['uninstallsql']; if (!is_file($zym_8)) $this->error('卸载数据库文件不存在'); M()->execute(F($zym_8)); } if(isset($zym_11['nodelist'])){ $zym_11['nodegroup']=isset($zym_11['nodegroup'])?$zym_11['nodegroup']:''; M('admin_node')->uninstall($zym_11['nodelist'],$zym_11['nodegroup'],$zym_10); } $this->model->del(array('key'=>$zym_10)); $this->success('卸载成功'); }else{ $this->error('模块配置文件不存在'); } } public function upgradeAction() { } public function configAction() { $zym_10=I('request.module','en',''); $zym_6=pt::import(APP_PATH.'/'.$zym_10.'/set.php'); if ($zym_6){ if (IS_POST){ $zym_11=array(); foreach($zym_6 as &$zym_7){ if (isset($_POST[$zym_7['key']])){ $zym_11[$zym_7['key']]=$zym_7['value']=$_POST[$zym_7['key']]; } } F(APP_PATH.'/'.$zym_10.'/set.php',$zym_6); F(APP_PATH.'/'.$zym_10.'/config.php',$zym_11); $this->success('修改成功'); } $zym_6=M('config')->parseConfigValue($zym_6); $this->module=$zym_10; $this->list=$zym_6; $this->display(); }else{ $this->error('该插件无配置项'); } } }
?>