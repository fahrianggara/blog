<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push(trans('dashboard.title.index'), route('dashboard.index'));
});

// Dashboard > Home
Breadcrumbs::for('dashboard_home', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Home', '#');
});

//============================================================================================

// Dashboard > Categories
Breadcrumbs::for('categories', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push(trans('categories.title.index'), route('categories.index'));
});

// Dashboard > Categories > Add
Breadcrumbs::for('add_category', function (BreadcrumbTrail $trail) {
    $trail->parent('categories');
    $trail->push(trans('categories.button.create.value'), route('categories.create'));
});

// Dashboard > Categories > Edit
Breadcrumbs::for('edit_category', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('categories');
    $trail->push(trans('categories.button.edit.value'), route('categories.edit', ['category' => $category]));
});

// Dashboard > Categories > Edit > [title]
Breadcrumbs::for('edit_category_title', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('edit_category', $category);
    $trail->push($category->title, route('categories.edit', ['category' => $category]));
});

// Dashboard > Categories > Detail
Breadcrumbs::for('detail_category', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('categories');
    $trail->push('Detail', route('categories.show', ['category' => $category]));
});

// Dashboard > Categories > Detail > [title]
Breadcrumbs::for('detail_category_title', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('detail_category', $category);
    $trail->push($category->title, route('categories.show', ['category' => $category]));
});

//============================================================================================

// Dashboard > Tags
Breadcrumbs::for('tags', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push(trans('tags.title.index'), route('tags.index'));
});

// Dashboard > Tags > Add
Breadcrumbs::for('add_tags', function (BreadcrumbTrail $trail) {
    $trail->parent('tags');
    $trail->push(trans('tags.button.create.value'), route('tags.create'));
});

// Dashboard > Tags > Edit
Breadcrumbs::for('edit_tags', function (BreadcrumbTrail $trail, $tag) {
    $trail->parent('tags');
    $trail->push(trans('tags.button.edit.value'), route('tags.edit', ['tag' => $tag]));
});

// Dashboard > Tags > Edit > [title]
Breadcrumbs::for('edit_tags_title', function (BreadcrumbTrail $trail, $tag) {
    $trail->parent('edit_tags', $tag);
    $trail->push($tag->title, route('tags.edit', ['tag' => $tag]));
});

//============================================================================================

// Dashboard > posts
Breadcrumbs::for('posts', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push(trans('posts.title.index'), route('posts.index'));
});

// Dashboard > posts > Add
Breadcrumbs::for('add_post', function (BreadcrumbTrail $trail) {
    $trail->parent('posts');
    $trail->push(trans('posts.button.create.value'), route('posts.create'));
});

// Dashboard > Posts > Edit > [title]
Breadcrumbs::for('edit_post', function (BreadcrumbTrail $trail, $post) {
    $trail->parent('posts', $post);
    $trail->push(trans('posts.button.edit.value'), route('posts.edit', ['post' => $post]));
    $trail->push($post->title, route('posts.edit', ['post' => $post]));
});

// Dashboard > Posts > Detail > [title]
Breadcrumbs::for('detail_post', function (BreadcrumbTrail $trail, $post) {
    $trail->parent('posts', $post);
    $trail->push('Detail', route('posts.show', ['post' => $post]));
    $trail->push($post->title, route('posts.show', ['post' => $post]));
});

//============================================================================================

// Dashboard > filemanager
Breadcrumbs::for('file_manager', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push(trans('filemanager.title.index'), route('filemanager.index'));
});

//============================================================================================

// Dashboard > Roles
Breadcrumbs::for('roles', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push(trans('roles.title.index'), route('roles.index'));
});

// Dashboard > roles > Add
Breadcrumbs::for('add_role', function (BreadcrumbTrail $trail) {
    $trail->parent('roles');
    $trail->push(trans('roles.button.create.value'), route('roles.create'));
});


// Dashboard > Roles > Detail > [title]
Breadcrumbs::for('detail_role', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('roles', $role);
    $trail->push('Detail', route('roles.show', ['role' => $role]));
    $trail->push($role->name, route('roles.show', ['role' => $role]));
});

// Dashboard > Roles > Edit > [title]
Breadcrumbs::for('edit_role', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('roles', $role);
    $trail->push(trans('roles.button.edit.value'), route('roles.edit', ['role' => $role]));
    $trail->push($role->name, route('roles.edit', ['role' => $role]));
});

//============================================================================================

// Dashboard > Users
Breadcrumbs::for('users', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push(trans('users.title.index'), route('users.index'));
});

// Dashboard > users > Add
Breadcrumbs::for('add_user', function (BreadcrumbTrail $trail) {
    $trail->parent('users');
    $trail->push(trans('users.button.create.value'), route('users.create'));
});

// Dashboard > Users > Edit > [title]
Breadcrumbs::for('edit_user', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('users');
    $trail->push(trans('users.button.edit.value'), route('users.edit', ['user' => $user]));
    $trail->push($user->name, route('users.edit', ['user' => $user]));
});

//============================================================================================

// Blog (INDUK)
Breadcrumbs::for('blog', function (BreadcrumbTrail $trail) {
    $trail->push('Blog', route('blog.home'));
});

// Blog > Home
Breadcrumbs::for('blog_home', function (BreadcrumbTrail $trail) {
    $trail->parent('blog');
    $trail->push(trans('blog.title.home'), route('blog.home'));
});

// Blog > Categories
Breadcrumbs::for('category_blog', function (BreadcrumbTrail $trail) {
    $trail->parent('blog');
    $trail->push(trans('blog.title.categories'), route('blog.categories'));
});

// Blog > Categories > [title]
Breadcrumbs::for('posts_category_blog', function (BreadcrumbTrail $trail, $title) {
    $trail->parent('blog');
    $trail->push(trans('blog.title.categories'), route('blog.categories'));
    $trail->push($title, '#');
});

// Blog > Tags
Breadcrumbs::for('tag_blog', function (BreadcrumbTrail $trail) {
    $trail->parent('blog');
    $trail->push(trans('blog.title.tags'), route('blog.tags'));
});

// Blog > Tags > [title]
Breadcrumbs::for('posts_tag_blog', function (BreadcrumbTrail $trail, $title) {
    $trail->parent('blog');
    $trail->push(trans('blog.title.tags'), route('blog.tags'));
    $trail->push($title, '#');
});

// Blog > Search
Breadcrumbs::for('search_blog', function (BreadcrumbTrail $trail, $search) {
    $trail->parent('blog');
    $trail->push('Search', route('blog.search'));
    $trail->push($search, route('blog.search'));
});

// Blog > Post > [title]
Breadcrumbs::for('post_detail', function (BreadcrumbTrail $trail, $title) {
    $trail->parent('blog');
    $trail->push($title, '#');
});
