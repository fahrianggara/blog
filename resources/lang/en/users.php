<?php
/*
language : English
*/
return [
    'title' => [
        'index' => 'Users',
        'create' => 'Add user',
        'edit' => 'Edit user',
    ],
    'form_control' => [
        'input' => [
            'name' => [
                'label' => 'Name',
                'placeholder' => 'Enter name',
                'attribute' => 'name'
            ],
            'email' => [
                'label' => 'Email',
                'placeholder' => 'Enter email',
                'attribute' => 'email'
            ],
            'password' => [
                'label' => 'Password',
                'placeholder' => 'Enter password',
                'attribute' => 'password'
            ],
            'password_confirmation' => [
                'label' => 'Password confirmation',
                'placeholder' => 'Confirm password',
                'attribute' => 'password confirmation'
            ],
            'search' => [
                'label' => 'Search',
                'placeholder' => 'Search for users',
                'attribute' => 'search'
            ]
        ],
        'select' => [
            'role' => [
                'label' => 'Role',
                'placeholder' => 'Choose role',
                'attribute' => 'role'
            ]
        ]
    ],
    'label' => [
        'name' => 'Name',
        'email' => 'Email',
        'role' => 'Role',
        'no_data' => [
            'fetch' => "No user data yet",
            'search' => ":keyword user not found",
        ]
    ],
    'button' => [
        'create' => [
            'value' => 'Add'
        ],
        'save' => [
            'value' => 'Save'
        ],
        'edit' => [
            'value' => 'Edit'
        ],
        'delete' => [
            'value' => 'Delete'
        ],
        'cancel' => [
            'value' => 'Cancel'
        ],
    ],
    'alert' => [
        'create' => [
            'title' => [
                'error'     => 'Error',
                'success'   => 'Success'
            ],
            'message' => [
                'success' => "User with name \":name\", saved successfully!",
                'error' => "Oops.. An error occurred while saving the new User. :error",
            ]
        ],
        'update' => [
            'title' => [
                'error'     => 'Error',
                'success'   => 'Success'
            ],
            'message' => [
                'success' => "User with name \":name\", updated successfully!",
                'error' => "Oops.. An error occurred while updating the User. :error",
                'warning' => "Oops.. There seems to be no change :("
            ]
        ],
        'delete' => [
            'title' => [
                'error'     => 'Error',
                'success'   => 'Success',
                'warning'   => "Warning"
            ],
            'message' => [
                'confirm' => "Are you sure? User with name \":title\" will be deleted?",
                'success' => "User with name \":name\", deleted successfully",
                'error' => "Oops.. An error occurred while deleting the User. :error"
            ]
        ],
    ]
];
