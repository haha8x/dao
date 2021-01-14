<?php

return [
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
