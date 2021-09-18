<?php
/*
language : English
*/
return [
    'title' => [
        'index' => 'Categories',
        'create' => 'Add category',
        'edit' => 'Edit category',
        'detail' => 'Detail category',
    ],
    'page' => [
        'create' => [
            'category' => 'Page create category',
            'tag' => 'Page create tag',
            'post' => 'Page create post',
        ],
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
            'thumbnail' => [
                'label' => 'Thumbnail',
                'placeholder' => 'Browse thumbnails',
                'attribute' => 'thumbnail'
            ],
            'search' => [
                'label' => 'Search',
                'placeholder' => 'Search for categories',
                'attribute' => 'search'
            ]
        ],
        'select' => [
            'parent_category' => [
                'label' => 'Parent category',
                'placeholder' => 'Choose parent category',
                'attribute' => 'parent category'
            ]
        ],
        'textarea' => [
            'description' => [
                'label' => 'Description',
                'placeholder' => 'Enter description',
                'attribute' => 'description'
            ],
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
        'browse' => [
            'value' => 'Browse'
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
                'success' => "Category with title \":name\", saved successfully!",
                'error' => "An error occurred while saving the category. :error",
            ]
        ],
        'update' => [
            'title' => [
                'error'     => 'Error',
                'success'   => 'Success'
            ],
            'message' => [
                'success' => "Category with title \":name\", updated successfully!",
                'error' => "An error occurred while updating the category. :error",
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
                'confirm' => "Are you sure you want to delete the \":title\" category?",
                'success' => "Category with title \":name\", deleted successfully",
                'error' => "An error occurred while deleting the category. :error"
            ]
        ],
    ],
    'label' => [
        'no_data' => [
            'fetch' => "No category data yet",
            'search' => ":keyword category not found",
        ]
    ]
];
