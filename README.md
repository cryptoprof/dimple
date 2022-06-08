# Dimple is a simple task manager

Dimple это простое приложение для организации рабочих процессов.  
Построено на базе Laravel и нескольких компонентов Vue.  
Данное приложение представляет простую реализацию RestAPI с авторизацией и ролями пользователей.   
По умолчанию в приложении 2 роли - админы и пользователи.
В дальнейшем планирую подключить к данному приложению n8n и через вебхуки организовать интеграцию со сторонними сервисами.  
В качестве шаблона админки использую [flatlogic/light-blue-dashboard](https://github.com/flatlogic/light-blue-dashboard)
![flatlogic/light-blue-dashboard](https://user-images.githubusercontent.com/24964748/47848874-c4dc8800-dde0-11e8-93e7-a78c1e098207.png "Скрин")


## Установка

Скачиваем репозиторий:  
`git clone https://github.com/cryptoprof/dimple.git`  
Запускаем установку зависимостей в директории dimple:  
`composer install && npm install`  
Запускаем миграции и заполняем базу дефолтными пользователями:  
`php artisan:migrate --seed`  
Запускаем локальное окружение:  
`php artisan serve`  


Учетка админа:  
admin@admin.com  
admin  
Учетка юзера:  
user@user.com  
user
