## Project Description
This is a Laravel 11-based **User Voting System**, where users can register, get admin approval, and vote for other approved users. It includes:
- A web-based frontend using Laravel Blade and Bootstrap.
- A REST API for mobile applications (with JWT authentication).
- An admin panel for managing users and viewing voting statistics.
  
## Installation Guide
Follow these steps to set up the project on your local machine.

### 1️⃣ **Clone the Repository**
- git clone https://github.com/3amur/voting-system.git
- cd voting-system

### 2️⃣ Install Dependencies

- composer install
- npm install

3️⃣ Copy Environment File & Generate Key

- cp .env.example =To=> .env
- php artisan key:generate

4️⃣ Set Up the Database

- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=your_database
- DB_USERNAME=your_username
- DB_PASSWORD=your_password

4️⃣ Add The Admin Credentials (Email & Password)
- ADMIN_EMAIL="Your Email"
- ADMIN_Password ="Your Password"

5️ Create JWT Secret Key
- php artisan jwt:secret

6️⃣ Run the migration & seeder
- php artisan migrate --seed

7️⃣ Run the Application
- php artisan ser or serve 😁
