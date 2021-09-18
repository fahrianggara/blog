<?php
/*
language : English
*/
return [
    'title' => [
        'index' => 'Posts',
        'create' => 'Add post',
        'edit' => 'Edit post',
        'detail' => 'Detail post',
    ],
    'label' => [
        'no_data' => [
            'fetch' => "No post data yet",
            'search' => ":keyword post not found",
        ]
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
            'category' => [
                'label' => 'Category',
                'placeholder' => 'Choose category',
                'attribute' => 'category'
            ],
            'search' => [
                'label' => 'Search',
                'placeholder' => 'Search for posts',
                'attribute' => 'search'
            ]
        ],
        'select' => [
            'tag' => [
                'label' => 'Tag',
                'placeholder' => 'Enter tag',
                'attribute' => 'tag',
                'option' => [
                    'publish' => 'Publish',
                    'draft' => 'Draft',
                    'finished' => 'Finished'
                ],
            ],
            'status' => [
                'label' => 'Status',
                'placeholder' => 'Choose status',
                'attribute' => 'status',
                'option' => [
                    'draft' => 'Draft',
                    'publish' => 'Publish',
                    'finished' => 'Finished'
                ]
            ],
        ],
        'textarea' => [
            'description' => [
                'label' => 'Description',
                'placeholder' => 'Enter description',
                'attribute' => 'description'
            ],
            'content' => [
                'label' => 'Content',
                'placeholder' => 'Enter content',
                'attribute' => 'content'
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
        'apply' => [
            'value' => 'Apply'
        ]
    ],
    'alert' => [
        'create' => [
            'title' => [
                'error'     => 'Error',
                'success'   => 'Success'
            ],
            'message' => [
                'success' => "Post with title \":name\", saved successfully!",
                'error' => "Oops.. An error occurred while saving the new Post. :error",
            ]
        ],
        'update' => [
            'title' => [
                'error'     => 'Error',
                'success'   => 'Success'
            ],
            'message' => [
                'success' => "Post with title \":name\", updated successfully!",
                'error' => "Oops.. An error occurred while updating the Post. :error",
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
                'confirm' => "Are you sure you want to delete the \":title\" Post?",
                'success' => "Post with title \":name\", deleted successfully",
                'error' => "Oops.. An error occurred while deleting the Post. :error"
            ]
        ],
    ]
];
