<?php
/*
language : English
*/
return [
    'title' => [
        'index' => 'Tags',
        'create' => 'Add tag',
        'edit' => 'Edit tag',
    ],
    'form_control' => [
        'input' => [
            'title' => [
                'label' => 'Title',
                'placeholder' => 'Enter title',
                'attribute' => 'title'
            ],
            'slug' => [
                'label' => 'Slug',
                'placeholder' => 'Auto generate',
                'attribute' => 'slug'
            ],
            'search' => [
                'label' => 'Search',
                'placeholder' => 'Search for tags',
                'attribute' => 'search'
            ]
        ]
    ],
    'label' => [
        'no_data' => [
            'fetch' => "No tag data yet",
            'search' => ":keyword tag not found",
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
                'success' => "Tag with title \":name\", saved successfully!",
                'error' => "Oops.. An error occurred while saving the new Tag. :error",
            ]
        ],
        'update' => [
            'title' => [
                'error'     => 'Error',
                'success'   => 'Success'
            ],
            'message' => [
                'success' => "Tag with title \":name\", updated successfully!",
                'error' => "Oops.. An error occurred while updating the Tag. :error",
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
                'confirm' => "Are you sure you want to delete the \":title\" Tag?",
                'success' => "Tag with title \":name\", deleted successfully",
                'error' => "Oops.. An error occurred while deleting the Tag. :error"
            ]
        ],
    ]
];
