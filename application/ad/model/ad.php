<?php
 class Admodel extends Model { public function add($zym_13) { $zym_14 = $this->insert($zym_13); $this->createJs($zym_14); return $zym_14; } public function edit($zym_13) { $zym_14 = $this->update($zym_13); dc::refresh('ad', $zym_13['id']); $this->createJs($zym_13['id']); return $zym_14; } public function del($zym_15) { $zym_12 = $this->where($zym_15)->field('id,key')->select(); foreach ($zym_12 as $zym_16) { dc::del('ad', $zym_16['id']); F(PT_ROOT . '/public/' . C('addir') . '/' . $zym_16['key'] . '.js', null); } $this->where($zym_15)->delete(); } public function getlist() { $zym_12 = (array)$this->select(); foreach ($zym_12 as &$zym_16) { if (isset($zym_16['create_user_id'])) { $zym_16['create_username'] = dc::get('user', $zym_16['create_user_id'], 'name'); $zym_16['update_username'] = dc::get('user', $zym_16['update_user_id'], 'name'); $zym_16['url_edit'] = U('ad.manage.edit', array('id' => $zym_16['id'])); $zym_16['url_show'] = U('ad.manage.show', array('id' => $zym_16['id'])); $zym_16['create_time'] = $zym_16['create_time'] ? date('Y-m-d H:i', $zym_16['create_time']) : ''; $zym_16['update_time'] = $zym_16['update_time'] ? date('Y-m-d H:i', $zym_16['update_time']) : ''; } } return $zym_12; } public function createJs($zym_17) { $zym_10 = dc::get('ad', $zym_17); $zym_6 = PT_ROOT . '/public/' . C('addir') . '/' . $zym_10['key'] . '.js'; if ($zym_10['status'] == 1) { if ($zym_10['type'] == 1) { $zym_5 = $this->html2js($zym_10['code']); } else { $zym_5 = $zym_10['code']; } F($zym_6, $zym_5); } else { F($zym_6, null); } } public function html2js($zym_7) { $zym_11 = ''; $zym_8 = str_replace("\r\n", "\n", $zym_7); $zym_8 = explode("\n", addcslashes($zym_8, '\'"\\')); for ($zym_9 = 0; $zym_9 < count($zym_8); $zym_9++) { $zym_11 .= "document.writeln(\"" . $zym_8[$zym_9] . "\");\r\n"; } return $zym_11; } }
?>