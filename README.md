
# PHP MVC Login System

This is a simple login system built using the MVC (Model View Controller) pattern in PHP. The system allows users to authenticate using their email and password.

## Project Structure

The project follows the MVC architecture:

```
/login-mvc
    /app
        /controllers
            AuthController.php
        /models
            User.php
        /views
            login.php
    /config
        database.php
    /public
        index.php
    /resources
        /css
        /js
    /routes
        web.php
```

## Installation

1. **Clone the repository:**
   ```
   git clone https://github.com/your-repo/login-mvc.git
   ```

2. **Navigate to the project directory:**
   ```
   cd login-mvc
   ```

3. **Configure the database:**
   Edit the `config/database.php` file with your database credentials.

4. **Create the `users` table:**
   Run the following SQL query in your database:
   ```sql
   CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       email VARCHAR(100) NOT NULL,
       password VARCHAR(255) NOT NULL
   );
   ```

5. **Start the PHP server:**
   ```
   php -S localhost:8000 -t public
   ```

## Usage

- Navigate to `http://localhost:8000/login` to access the login form.
- Use the form to log in with your email and password.
- If login is successful, the user is redirected to the dashboard.

## Important Files

- **config/database.php**: Contains the database connection settings.
- **app/models/User.php**: The User model that handles login logic.
- **app/controllers/AuthController.php**: The controller that manages authentication actions.
- **app/views/login.php**: The login form view.
- **routes/web.php**: Defines the routes for login actions.

## Future Improvements

- Password recovery functionality.
- Registration system.
- User roles and permissions.

## Correr seeders

```bash
php ./database/seeders/user_seeder.php
```

```bash
php ./database/seeders/category_seeder.php
```

```bash
php ./database/seeders/product_seeder.php
```

## License

This project is licensed under the MIT License.
```

