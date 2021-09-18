<?php
/*
language : English
*/
return [
    'title' => [
        'index' => 'Roles',
        'create' => 'Add role',
        'edit' => 'Edit role',
        'detail' => 'Detail role',
    ],
    'form_control' => [
        'input' => [
            'name' => [
                'label' => 'Name',
                'placeholder' => 'Enter name',
                'attribute' => 'name'
            ],
            'permission' => [
                'label' => 'Permission',
                'placeholder' => 'Choose permission',
                'attribute' => 'permission'
            ],
            'search' => [
                'label' => 'Search',
                'placeholder' => 'Search for roles',
                'attribute' => 'search'
            ]
        ],
    ],
    'label' => [
        'no_data' => [
            'fetch' => "Roles Not Yet Available!",
            'search' => ":keyword role not found",
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
        'back' => [
            'value' => 'Back'
        ],
    ],
    'alert' => [
        'create' => [
            'title' => [
                'error'     => 'Error',
                'success'   => 'Success'
            ],
            'message' => [
                'success' => "Role with title \":name\", saved successfully!",
                'error' => "Oops.. An error occurred while saving the new Role. :error",
            ]
        ],
        'update' => [
            'title' => [
                'error'     => 'Error',
                'success'   => 'Success'
            ],
            'message' => [
                'success' => "Role with title \":name\", updated successfully!",
                'error' => "Oops.. An error occurred while updating the Role. :error",
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
                'confirm' => "Are you sure you want to delete the \":title\" Role?",
                'success' => "Role with title \":name\", deleted successfully",
                'error' => "Oops.. An error occurred while deleting the Role. :error",
                'warning' => "Sorry, the :name role cannot be deleted. Because it's still in use.",
            ]
        ],
    ]
];
