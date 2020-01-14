<?php

return [
    [
        'name' => 'Daos',
        'flag' => 'dao.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'dao.create',
        'parent_flag' => 'dao.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'dao.edit',
        'parent_flag' => 'dao.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'dao.destroy',
        'parent_flag' => 'dao.index',
    ],
    [
        'name' => 'Dao registers',
        'flag' => 'dao-register.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'dao-register.create',
        'parent_flag' => 'dao-register.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'dao-register.edit',
        'parent_flag' => 'dao-register.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'dao-register.destroy',
        'parent_flag' => 'dao-register.index',
    ],
    [
        'name' => 'Customers',
        'flag' => 'customer.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'customer.create',
        'parent_flag' => 'customer.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'customer.edit',
        'parent_flag' => 'customer.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'customer.destroy',
        'parent_flag' => 'customer.index',
    ],
];
