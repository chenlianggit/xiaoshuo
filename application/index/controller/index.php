<?php
 class IndexController extends CommonController { public function indexAction() { $this->display(); } public function debugAction() { $this->show('当前主进程任务ID：'.cache::get('cron_master_pid',rand(1,10000))."<br/>\n"); $this->show('当前主进程最后一次运行时间：'.date('Y-m-d H:i:s',cache::get('cron_master_time'))."<br/>\n"); $this->show('当前主进程最后一次检查子任务时间：'.date('Y-m-d H:i:s',cache::get('cron_master_runtime'))."<br/>\n"); $this->show('当前主进程启动时间：'.date('Y-m-d H:i:s',cache::get('cron_master_starttime'))."<br/>\n"); $this->show("<br/>\n"); $this->show("<br/>\n"); $zym_6=M('cron')->field('id,name,action,interval,lastruntime')->where(array('status'=>1))->select(); foreach($zym_6 as $zym_7){ if (is_numeric($zym_7['interval'])){ $this->show('子任务：'.$zym_7['name']."<br/>\n"); $this->show('子任务pid：'.cache::get("cron_{$zym_7['id']}_pid")."<br/>\n"); $this->show('子任务上次完成时间：'.date('Y-m-d H:i:s',$zym_7['lastruntime'])."<br/>\n"); $this->show('子任务check时间：'.date('Y-m-d H:i:s',cache::get("cron_{$zym_7['id']}_checktime"))."<br/>\n"); $this->show('子任务采集间隔时间：'.$zym_7['interval']."<br/>\n"); $this->show('子任务状态：'.cache::get("cron_{$zym_7['id']}_status")."<br/>\n"); $this->show('子任务开始时间：'.date('Y-m-d H:i:s',cache::get("cron_{$zym_7['id']}_time"))."<br/>\n"); $this->show('子任务当前采集的小说：'.cache::get("cron_{$zym_7['id']}_novel")."<br/>\n"); } $this->show("<br/>\n"); } } public function testAction() { $zym_5=new Compare(); var_dump($zym_5->test('第一千一百零四章 三位金龙弟子',' 第一千一百零九章 第四位金龙弟子')); var_dump($zym_5->test('第一千六百二十五章 源头','第八百八十一章 源头')); exit; var_dump($zym_5->test('第一千六百二十五章 源头','第八百八十一章 源头(第二更)')); var_dump(novel::chapterformat('事实上不独是这一营，整个京师三大营二十余万人马的编制，实际兵力也不过两成左右。不管是天子观操，还是大臣查验，大家要么是彼此营头拼凑，要么就干脆到大街上雇些青壮来临时凑数<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;　。反正皇帝也不是同时观看所有部')); exit; } }
?>