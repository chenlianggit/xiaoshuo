<?php
class searchController extends CommonController{ public function indexAction() { $this->display('searchindex'); } public function resultAction() { $zym_7 = $this->input->request('searchkey','str'); $zym_6 = $this->input->request('searchtype','en'); if($zym_6 == 'author'){ $zym_5 = 'author'; }else{ $zym_5 = 'name'; } $zym_7=$this->filter->safeStrip($zym_7); if(!empty($zym_7)) { if($zym_5=='name' && preg_match('/^[\w\-]+$/',$zym_7)){ $zym_8 = array('pinyin'=>array("like",'%'.$zym_7.'%')); $zym_9=M('novelsearch_info')->getpagelist($zym_8,'allvisit','1',C('pagesize_search')); if(!$zym_9){ $zym_8 = array('name'=>array("like",'%'.$zym_7.'%')); $zym_9=M('novelsearch_info')->getpagelist($zym_8,'allvisit','1',C('pagesize_search')); } }else{ $zym_8 = array($zym_5=>array("like",'%'.$zym_7.'%')); $zym_9=M('novelsearch_info')->getpagelist($zym_8,'allvisit','1',C('pagesize_search')); } $this->view->searchkey=$zym_7; $this->view->resultlist=$zym_9; $this->display('search'); }else{ $this->error('请输入搜索关键词'); } } }
?>