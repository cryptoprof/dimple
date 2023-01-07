# Dimple

Dimple is a simple application for organizing work processes. It is built on the Laravel framework and several Vue components. This application implements a simple RestAPI with user authentication and roles. By default, there are two roles in the application: admins and users.
![dimple](https://sun1-91.userapi.com/impg/ksb9VauCN_qo5KhM-plFQ0TbTvDzORjBmRGWaQ/Y6Nv1NeEVcU.jpg?size=2560x1351&quality=95&sign=85dc04bb2227f7d9299eae70f73fdfad&type=album "Скрин")
## Installation

To install Dimple, follow these steps:

1. Download the repository: `git clone https://github.com/cryptoprof/dimple.git`
2. Run the dependency installation in the dimple directory: `composer install && npm install`
3. Run the migrations and populate the database with default users: `php artisan:migrate --seed`
4. Run the local environment: `php artisan serve`

## Default User Accounts

Admin account:

- Email: admin@admin.com
- Password: admin

User account:

- Email: user@user.com
- Password: user

