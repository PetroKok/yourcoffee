<?php

return [
    'actions' => [
        'enter_email' => 'Введіть емейл',
        'remember_me' => 'Запамятати мене',
        'forgot_password' => 'Забули пароль?',
        'welcome_back' => 'Ласкаво просимо!',
        'create_account' => 'Створити аккаунт!',
        'register' => 'Регістрація',
        'save' => 'Зберегти',
        'create' => 'Створити',
        'back' => 'Створити',
        'cancel' => 'Скасувати',
    ],
    'fields' => [
        'password' => 'Пароль',
        'name' => 'Ім\'я',
        'login' => 'Увійти',
        'phone' => 'Телефон',
    ],
    'cart' => [
        'address' => 'Адрес',
        'delivery' => 'Доставка',
        'apartment' => 'Квартира',
        'entrance' => 'Під\'їзд',
        'floor' => 'Поверх',
        'door_code' => 'Код дверей',
        'specify' => 'Уточнюйте',
    ],

    'status' => [
        'CREATED' => 'Створено', // створене замовлення
        'PREPARING' => 'Готується',  // взято в роботу, готується
        'DELIVERING' => 'Відправлено', // приготували, якщо доставка - доставляється.
        'WAIT_FOR_PICK_UP' => 'Заберіть замовлення', // приготували, чекають поки кдієнт забере.
        'DONE' => 'Завершено', // успішна доставка, або клієнт сам забрав
        'CANCELED' => 'Відмінено', // відміна замовлення
        'SPECIFY' => 'Уточнюється', // потребує уточнення, клієнту зателефонуються у випадку непередбачуваних ситуацій.
        'FRAUD' => 'Шахрайство', // шахрайство
        'color' => [
            'CREATED' => '#',
            'PREPARING' => '#',
            'DELIVERING' => '#',
            'WAIT_FOR_PICK_UP' => '#',
            'DONE' => '#',
            'CANCELED' => '#',
            'SPECIFY' => '#',
            'FRAUD' => '#',
        ],
    ],

];
