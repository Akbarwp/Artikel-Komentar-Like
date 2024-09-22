# Komentar & Like Article

Komentar & Like Article is a website that provides interactive features for users to comment and reply to comments on articles in real-time. Additionally, users can "like" other comments. Built using Laravel and Livewire, the website offers a responsive and dynamic experience for interacting with article content.

## Tech Stack

- **Laravel 9**
- **MySQL Database**
- **Liverire**
- **Laravel UI**

## Features

- Main features available in this application:
  - comments an article
  - Replies comment
  - Likes comment

## Installation

Follow the steps below to clone and run the project in your local environment:

1. Clone repository:

    ```bash
    git clone https://github.com/Akbarwp/Artikel-Komentar-Like.git
    ```

2. Install dependencies use Composer and NPM:

    ```bash
    composer install
    npm install
    ```

3. Copy file `.env.example` to `.env`:

    ```bash
    cp .env.example .env
    ```

4. Generate application key:

    ```bash
    php artisan key:generate
    ```

5. Setup database in the `.env` file:

    ```plaintext
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=komentar_like
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6. Run migration database:

    ```bash
    php artisan migrate
    ```

7. Run website:

    ```bash
    npm run dev
    php artisan serve
    ```

## Screenshot

- ### **Article page**

<img src="https://github.com/user-attachments/assets/229ea01d-7066-4695-9968-b1bc1c038ed7" alt="Halaman Artikel" width="" />
<br><br>

- ### **Article Detail page**

<img src="https://github.com/user-attachments/assets/01fe9ee9-0710-436a-a7c0-7ea73dbc832e" alt="Halaman Detail Artikel" width="" />
<br><br>

- ### **Feature**

<img src="https://github.com/user-attachments/assets/bd04f5e0-fdf1-4c91-93c3-582c4a9b66c3" alt="Fitur Komentar Replay Like" width="" />
<br><br>
