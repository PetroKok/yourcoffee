<?php

return [
    'actions' => [
        'add_new' => 'Добавити',
        'edit' => 'Редагувати',
        'lock' => 'Заблокувати',
        'unlock' => 'Розблокувати',
        'enter_email' => 'Введіть емейл',
        'remember_me' => 'Запамятати мене',
        'forgot_password' => 'Забули пароль?',
        'welcome_back' => 'Ласкаво просимо!',
        'create_account' => 'Створити аккаунт!',
        'register' => 'Регістрація',

        'null' => 'Немає',
        'show' => 'Перегляд',
        'save' => 'Зберегти',
        'update' => 'Оновити',
        'delete' => 'Видалити',
        'create' => 'Створити',

        'back' => 'Назад',
        'cancel' => 'Скасувати',
    ],
    'menu' => [
        'categories' => 'Категорії',
        'category' => 'Категорія',

        'ingredients' => 'Інгредієнти',
        'ingredient' => 'Інгредієнт',

        'products' => 'Продукти',
        'product' => 'Продукт',

        'labels' => 'Мітки',
        'label' => 'Мітка',
    ],
    'table' => [
        'id' => 'ID',
        'name' => 'Назва',
        'username' => 'Ім\'я',
        'email' => 'Емейл',
        'created_at' => 'Дата створення',
        'updated_at' => 'Дата оновлення',
        'deleted_at' => 'Дата видалення',
    ],
    'fields' => [
        'password' => 'Пароль',
        'name' => 'Ім\'я',
        'login' => 'Увійти',
    ],
    'sidebar' => [
        'for_products' => 'Для товару',
        'on_site' => 'На сайт',
        'settings' => 'Налаштування',
        'users' => 'Користувачі сайту',
        'admins' => 'Працівники',
    ],


    /** ENTITIES **/

    'category' => [
        'title' => 'Назва',
        'position' => 'Позиція',
        'image' => 'Картинка',
        'parent_category_id' => 'Батьківська категорія',
    ],

    'ingredient' => [
        'name' => 'Назва',
        'description' => 'Опис інгредієнта',
        'price' => 'Ціна',
        'pic' => 'Піктограма',
        'image' => 'Фото',
    ],

    'product' => [
        'name' => 'Назва',
        'description' => 'Опис продукту',
        'price' => 'Ціна',
        'category' => 'Категорія',
        'ingredient' => 'Інгредієнт'
    ],

    'label' => [
        'name' => 'Назва',
        'position' => 'Позиція',
        'color' => 'Колір'
    ],
];
