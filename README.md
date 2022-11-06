# <b><a href="http://github.com/hairullana/gabut-chat" target="_blank">GABUT CHAT - Real Time App Chatting</a></b>
Still in Coding! `Feel free to fork, clone or contribute :)`
<br>
<br>

## <b>About Gabut Chat</b>
Gabut Chat is a real time chat application using Pusher Websocket. "Gabut" comes from Indonesian which means "no activity" where I made this because I have no activity and want to increase my knowledge about web development.
<br>

## <b>Preview</b>
![image](https://user-images.githubusercontent.com/56705867/200178918-46afef49-0219-4926-8a9a-eae98a84154c.png)
![image](https://user-images.githubusercontent.com/56705867/200178957-99be6856-6a65-484b-821e-6c0302a40a26.png)
![image](https://user-images.githubusercontent.com/56705867/200178978-f9988d37-3b8c-4812-964d-02ec0e1e4074.png)


## <b>Features</b>
- Authentication (Login, Register)
- Public & Private Channel (Chat Channel)
- Online Status
- Notification alert
<br>

## <b>Technology</b>
- <a href="https://getcomposer.org/">Composer (Dependency Manager for PHP)</a>
- <a href="https://laravel.com/">Laravel 8 (Backend)</a>
- <a href="https://getbootstrap.com/">Bootstrap 4.5.0 (Frontend)</a>
- <a href="https://sweetalert2.github.io/">Sweetalert2</a>
- <a href="https://pusher.com/">Pusher (Websocket)</a>
- <a href="https://www.postgresql.org/">PostgreSQL (Database)</a>
<br>

## <b>Installation</b>
- Clone this repository
```bash
git clone https://github.com/hairullana/gabut-chat
```
- Change directory
```bash
cd gabut-chat
```
- Install Composer
```bash
composer install
```
- Create and `Setup` .env file (DB, Pusher)
```bash
cp .env.example .env
```
- Generate Key
```bash
php artisan key:generate
```
- Migration Database
```bash
php artisan migrate:fresh
```
- Run Laravel Server
```bash
php artisan serve
```
