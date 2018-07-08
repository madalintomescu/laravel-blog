<?php

Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard.index'));
});

// Posts
Breadcrumbs::for('dashboard.posts.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Posts', route('dashboard.posts.index'));
});

Breadcrumbs::for('dashboard.posts.create', function ($trail) {
    $trail->parent('dashboard.posts.index');
    $trail->push('Create', route('dashboard.posts.create'));
});

Breadcrumbs::for('dashboard.posts.edit', function ($trail, $post) {
    $trail->parent('dashboard.posts.index');
    $trail->push($post->title, route('dashboard.posts.edit', $post->id));
});

Breadcrumbs::for('dashboard.posts.draft', function ($trail) {
    $trail->parent('dashboard.posts.index');
    $trail->push('Draft', route('dashboard.posts.draft'));
});

Breadcrumbs::for('dashboard.posts.trash', function ($trail) {
    $trail->parent('dashboard.posts.index');
    $trail->push('Trash', route('dashboard.posts.trash'));
});

// Users
Breadcrumbs::for('dashboard.users.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Users', route('dashboard.users.index'));
});

Breadcrumbs::for('dashboard.users.create', function ($trail) {
    $trail->parent('dashboard.users.index');
    $trail->push('Create', route('dashboard.users.create'));
});

Breadcrumbs::for('dashboard.users.edit', function ($trail, $user) {
    $trail->parent('dashboard.users.index');
    $trail->push('Edit user', route('dashboard.users.edit', $user->id));
});

Breadcrumbs::for('dashboard.edit.profile', function ($trail) {
    $trail->parent('dashboard.users');
    $trail->push('Edit profile', route('dashboard.edit.profile'));
});

// Roles
Breadcrumbs::for('dashboard.roles.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Roles', route('dashboard.roles.index'));
});

Breadcrumbs::for('dashboard.roles.create', function ($trail) {
    $trail->parent('dashboard.roles.index');
    $trail->push('Create role', route('dashboard.roles.create'));
});

Breadcrumbs::for('dashboard.roles.show', function ($trail, $role) {
    $trail->parent('dashboard.roles.index');
    $trail->push($role->name, route('dashboard.roles.show', $role->id));
});

Breadcrumbs::for('dashboard.roles.edit', function ($trail, $role) {
    $trail->parent('dashboard.roles.index');
    $trail->push($role->name, route('dashboard.roles.edit', $role->id));
});

// Permissions
Breadcrumbs::for('dashboard.permissions.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Permissions', route('dashboard.permissions.index'));
});

Breadcrumbs::for('dashboard.permissions.create', function ($trail) {
    $trail->parent('dashboard.permissions.index');
    $trail->push('Create permission', route('dashboard.permissions.create'));
});

Breadcrumbs::for('dashboard.permissions.edit', function ($trail, $permission) {
    $trail->parent('dashboard.permissions.index');
    $trail->push($permission->name, route('dashboard.permissions.edit', $permission->id));
});

// Categories
Breadcrumbs::for('dashboard.categories.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Categories', route('dashboard.categories.index'));
});

Breadcrumbs::for('dashboard.categories.create', function ($trail) {
    $trail->parent('dashboard.categories.index');
    $trail->push('Create category', route('dashboard.categories.create'));
});

Breadcrumbs::for('dashboard.categories.edit', function ($trail, $category) {
    $trail->parent('dashboard.categories.index');
    $trail->push($category->name, route('dashboard.categories.edit', $category->id));
});

// Tags
Breadcrumbs::for('dashboard.tags.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Tags', route('dashboard.tags.index'));
});

Breadcrumbs::for('dashboard.tags.create', function ($trail) {
    $trail->parent('dashboard.tags.index');
    $trail->push('Create', route('dashboard.tags.create'));
});

Breadcrumbs::for('dashboard.tags.edit', function ($trail, $tag) {
    $trail->parent('dashboard.tags.index');
    $trail->push($tag->name, route('dashboard.tags.edit', $tag->id));
});

// Settings
Breadcrumbs::for('dashboard.settings.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('General settings', route('dashboard.settings.index'));
});
