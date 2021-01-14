<?php

return [
  [
    'name' => 'Quản lý nhân sự',
    'flag' => 'hr.index',
  ],
  [
    'name'        => 'Danh sách tài khoản',
    'flag'        => 'hr.user',
    'parent_flag' => 'hr.index',
  ],
  [
    'name'        => 'Danh sách cấp tài khoản',
    'flag'        => 'hr.new-user',
    'parent_flag' => 'hr.index',
  ],
  [
    'name'        => 'Danh sách CBBH',
    'flag'        => 'hr.cbbh',
    'parent_flag' => 'hr.index',
  ],
  [
    'name'        => 'Kích hoạt tài khoản',
    'flag'        => 'hr.activate',
    'parent_flag' => 'hr.index',
  ],
  [
    'name'        => 'Khoá tài khoản',
    'flag'        => 'hr.deactivate',
    'parent_flag' => 'hr.index',
  ],
];
