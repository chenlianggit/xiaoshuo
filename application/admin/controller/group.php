<?php
class GroupController extends AdminController{ public function init() { $this->tableName='admin_group'; parent::init(); } public function indexAction() { $this->list=$this->model->order('id asc')->getlist(); $this->display(); } public function addAction() { if (IS_POST){ $zym_7['name']=I('name','str'); $zym_7['intro']=I('intro','str'); $zym_7['node']=implode(',',M('admin_node')->toNodeAuth(I('node','arr',array()))); $zym_7['create_user_id']=$_SESSION['admin']['userid']; $zym_7['create_time']=NOW_TIME; if($this->model->add($zym_7)){ $this->success('添加成功',U('index')); }else{ $this->error('添加失败'); } } $zym_6=new Tree(M('admin_node')); $this->menu=$zym_6->getAuthList(0,'id,name'); $this->display(); } public function editAction() { $zym_5=I('request.id','int',0); $zym_8=$this->model->field('id,name,node,intro')->where(array('id'=>$zym_5))->find(); if (IS_POST){ $zym_7['name']=I('name','str'); $zym_7['intro']=I('intro','str'); $zym_7['node']=implode(',',M('admin_node')->toNodeAuth(I('node','arr',array()))); $zym_7['update_user_id']=$_SESSION['admin']['userid']; $zym_7['update_time']=NOW_TIME; $zym_7['id']=$zym_5; if ($this->model->edit($zym_7)){ $this->success('修改成功',U('index')); }else{ $this->error('修改失败'); } } $zym_8['node']=explode(',',$zym_8['node']); $zym_6=new Tree(M('admin_node')); $this->menu=$zym_6->getAuthList(0,'id,name'); $this->info=$zym_8; $this->display(); } }
?>