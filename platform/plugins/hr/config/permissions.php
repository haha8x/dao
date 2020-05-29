<?php

return [
    [
        'name' => 'Hrs',
        'flag' => 'hr.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'hr.create',
        'parent_flag' => 'hr.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'hr.edit',
        'parent_flag' => 'hr.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'hr.destroy',
        'parent_flag' => 'hr.index',
    ],
    [
        'name' => 'User positions',
        'flag' => 'user-position.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'user-position.create',
        'parent_flag' => 'user-position.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'user-position.edit',
        'parent_flag' => 'user-position.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'user-position.destroy',
        'parent_flag' => 'user-position.index',
    ],
];
