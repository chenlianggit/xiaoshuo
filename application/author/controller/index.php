<?php
 class IndexController extends UserController { public function indexAction() { $zym_6 = $this->model('author')->getinfo($this->userinfo['id']); $this->assign('authorlist', $this->model('novelsearch_info')->where(['author' => $zym_6['name'], 'siteid' => 0])->getlist()); $this->assign('userpagesign', 'author'); $this->display('index'); } public function registerAction() { if ($this->request->isPost()) { $zym_5['user_id'] = $this->userinfo['id']; $zym_5['name'] = $this->input->post('name', 'str', ''); $zym_5['truename'] = $this->input->post('truename', 'str', ''); $zym_5['idcard'] = $this->input->post('idcard', 'str', ''); $zym_5['mobile'] = $this->input->post('mobile', 'str', ''); $zym_5['pay'] = $this->input->post('pay', 'str', ''); $zym_5['qq'] = $this->input->post('qq', 'str', ''); if (!$zym_5['name']) $this->error('请完整填写资料'); if ($this->model('author')->add($zym_5)) { $this->success('成功提交申请材料', U('author.index.index')); } else { $this->error('注册失败'); } } if ($this->userinfo['author']) $this->error('您已经是作者了'); if ($this->model('author')->getinfo($this->userinfo['id'])) { $this->error('请等待管理员审核您的资料'); } $this->assign('userpagesign', 'authorregister'); $this->display('register'); } }
?>