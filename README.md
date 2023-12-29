# Laravel Comments

[![Lint PR](https://github.com/achyutkneupane/Laravel-Comment/actions/workflows/prlint.yml/badge.svg)](https://github.com/achyutkneupane/Laravel-Dashboard/actions/workflows/prlint.yml)
[![Bump version](https://github.com/achyutkneupane/Laravel-Comment/actions/workflows/tagrelease.yml/badge.svg)](https://github.com/achyutkneupane/Laravel-Dashboard/actions/workflows/tagrelease.yml)
[![Latest Stable Version](http://poser.pugx.org/achyutn/laravel-comment/v)](https://packagist.org/packages/achyutn/laravel-comment)
[![Total Downloads](http://poser.pugx.org/achyutn/laravel-comment/downloads)](https://packagist.org/packages/achyutn/laravel-comment)
[![Dependents](http://poser.pugx.org/achyutn/laravel-comment/dependents)](https://packagist.org/packages/achyutn/laravel-comment)

This package is used to create a comment system for your Laravel application. You can extend the comment class and add your own functionality.

## Installation

You can install the package via composer:

```bash
composer require achyutn/laravel-comment
```

You can publish the views and config file with:

```bash
php artisan vendor:publish --provider="AchyutN\Comment\CommentServiceProvider"
```