<?php

return [
    [
        'name' => 'Quản lý Danh mục',
        'flag' => 'catalog.index',
    ],
    [
        'name' => 'Chức danh',
        'flag' => 'catalog-position.index',
        'parent_flag' => 'catalog.index',
    ],
    [
        'name'        => 'Tạo',
        'flag'        => 'catalog-position.create',
        'parent_flag' => 'catalog-position.index',
    ],
    [
        'name'        => 'Sửa',
        'flag'        => 'catalog-position.edit',
        'parent_flag' => 'catalog-position.index',
    ],
    [
        'name'        => 'Xóa',
        'flag'        => 'catalog-position.destroy',
        'parent_flag' => 'catalog-position.index',
    ],
    [
        'name' => 'Vùng',
        'flag' => 'catalog-zone.index',
        'parent_flag' => 'catalog.index',
    ],
    [
        'name'        => 'Tạo',
        'flag'        => 'catalog-zone.create',
        'parent_flag' => 'catalog-zone.index',
    ],
    [
        'name'        => 'Sửa',
        'flag'        => 'catalog-zone.edit',
        'parent_flag' => 'catalog-zone.index',
    ],
    [
        'name'        => 'Xóa',
        'flag'        => 'catalog-zone.destroy',
        'parent_flag' => 'catalog-zone.index',
    ],
    [
        'name' => 'Chi nhánh',
        'flag' => 'catalog-branch.index',
        'parent_flag' => 'catalog.index',
    ],
    [
        'name'        => 'Tạo',
        'flag'        => 'catalog-branch.create',
        'parent_flag' => 'catalog-branch.index',
    ],
    [
        'name'        => 'Sửa',
        'flag'        => 'catalog-branch.edit',
        'parent_flag' => 'catalog-branch.index',
    ],
    [
        'name'        => 'Xóa',
        'flag'        => 'catalog-branch.destroy',
        'parent_flag' => 'catalog-branch.index',
    ],
];
