# diarytz
Реализовать на шаблоне diary.ru: 
1) Старница регистрации 
2) Авторизации 
3) Восстановления пароля 
В том виде, чтобы это можно было выкатывать в прод

## Инструкция развертывания
1. 
~~~
git clone git@github.com:LoreFist/diarytz.git
~~~
2. 
~~~
composer install
~~~
3. 
~~~ 
php init
~~~ 
Local показывает varDump, на Prod - 404

4. Для отправки писем в файл common-local.php прописать настройки емайл-сервера подробности [тут](https://www.yiiframework.com/extension/yiisoft/yii2-swiftmailer/doc/api/2.1/yii-swiftmailer-mailer)
5. Стоит переоделить параметры senderEmail и senderName в файле params-local.php
6. Для отправки писем организовоанна работа очереди для запуска, подробности [тут](https://github.com/yiisoft/yii2-queue/blob/master/docs/guide/worker.md) 
~~~
php yii queue/listen --verbose
~~~
7. В файле db-local.php Нужно прописать настройки бд подробности [тут](https://www.yiiframework.com/doc/guide/2.0/en/start-databases) 
~~~
php yii migrate
~~~
8. Для работы веб-сервера нужно настроить Nginx подробности [тут](https://www.yiiframework.com/doc/guide/1.1/ru/quickstart.apache-nginx-config#nginx)

**Тестировался код**
- PHP 7.2
- MySQL 5.7
