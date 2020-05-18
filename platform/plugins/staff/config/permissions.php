<?php

return [
    [
        'name' => 'Staff',
        'flag' => 'staff.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'staff.create',
        'parent_flag' => 'staff.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'staff.edit',
        'parent_flag' => 'staff.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'staff.destroy',
        'parent_flag' => 'staff.index',
    ],
];
