<?php
// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
   $breadcrumbs->push(trans("backend.Dashboard"), route('home_route'));
});

// Home > Article
Breadcrumbs::register('article', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('backend.Article.page_title'), route('article'));
});

// Home > Article > Add
Breadcrumbs::register('add_article', function($breadcrumbs)
{
    $breadcrumbs->parent('article');
    $breadcrumbs->push(trans('backend.Article.new'), route('add_article'));
});

// Home > System
Breadcrumbs::register('system', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('backend.Menu.system_nav'), route('system'));
});

// Home > System > Menu
Breadcrumbs::register('category', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('backend.Category.list'), route('category'));
});

Breadcrumbs::register('order', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Hệ thống Order', route('order_list'));
});

Breadcrumbs::register('products', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('backend.Product.list'), route('product'));
});