<?php
class PluginModel{ public function getlist() { $zym_7=plugin::getlist(); $zym_6 = opendir(APP_PATH.'/common/plugin'); $zym_11 = array(); while ($zym_5 = readdir($zym_6)) { $zym_10 = APP_PATH.'/common/plugin' . '/' . $zym_5; if ($zym_5 != '.' && $zym_5 != '..' && $zym_5 != 'common' && is_dir($zym_10)) { $zym_9 = $zym_10 . '/config.ini'; if (is_file($zym_9)) { $zym_8 = parse_ini_file($zym_9, true); $zym_11[$zym_5] = $zym_8; if (in_array($zym_5,$zym_7)){ $zym_11[$zym_5]['setup']=1; }else{ $zym_11[$zym_5]['setup']=0; } $zym_11[$zym_5]['key']=$zym_5; $zym_11[$zym_5]['url_install']=U('admin.plugin.install',array('key'=>$zym_5)); $zym_11[$zym_5]['url_uninstall']=U('admin.plugin.uninstall',array('key'=>$zym_5)); $zym_11[$zym_5]['url_config']=U('admin.plugin.config',array('pluginkey'=>$zym_5)); } } } return $zym_11; } }
?>