Installation
============

This document will guide you through the process of installing Yii2-simpleTodo using **composer**. Installation is a quick
and easy three-step process.

Step 1: Download Yii2-simpleTodo using composer
-----------------------------------------

Add `"deka6pb/yii2-simple-todo": "*"` to the require section of your **composer.json** file and run
`composer update` to download and install Yii2-simple-todo.

Step 2: Configure your application
------------------------------------

> **NOTE:** Make sure that you don't have any `user` component configuration in your config files.

Add following lines to your main configuration file:

```php
'modules' => [
    'todo' => [
        'class' => 'deka6pb\simpleTodo\Module',
    ],
],
```

Step 3: Update database schema
------------------------------

> **NOTE:** Make sure that you have properly configured **db** application component.

After you downloaded and configured Yii2-user, the last thing you need to do is updating your database schema by
applying
the migrations:

```bash
$ php yii migrate/up --migrationPath=@vendor/deka6pb/yii2-simple-todo/migrations
```