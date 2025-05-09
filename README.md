# Employee Management System

A simple web-based Employee Management System built with CodeIgniter 4 and Bootstrap 5.

## Features

- Secure user authentication (login/logout)
- Full CRUD for employees:
  - Create employee profiles with name, address, designation, salary, and profile picture
  - View employees in a responsive table or card layout
  - Edit and delete employee records
- Profile picture upload and display (stored in `public/uploads`)
- Flash messaging for user feedback
- Responsive, mobile-friendly UI using Bootstrap

## Prerequisites

- PHP 8.1 or higher
- Composer
- A web server (Apache, Nginx) with document root set to the `public` folder
- Writable permissions on the `writable/uploads` and `public/uploads` directories

## Installation

1. Clone this repository:
   ```bash
   git clone <repository-url> employee-management
   cd employee-management
   ```
2. Install PHP dependencies with Composer:
   ```bash
   composer install
   ```
3. Copy and configure environment variables:
   ```bash
   cp env .env
   # Edit .env, set `app.baseURL` and database credentials
   ```
4. Create your database and update the `Database` settings in `.env` or `app/Config/Database.php`.
5. (Optional) Run migrations and seeders if available:
   ```bash
   php spark migrate
   php spark db:seed InitialData
   ```
6. Ensure the `writable/uploads` and `public/uploads` folders exist and are writable:
   ```bash
   mkdir -p writable/uploads public/uploads
   chmod -R 775 writable/uploads public/uploads
   ```
7. Point your web server to the `public` directory, or use the built-in PHP server:
   ```bash
   php spark serve
   ```

## Usage

- Open your browser and navigate to the base URL (e.g., `http://localhost:8080`).
- Log in with your user account.
- Add, view, edit, or delete employees from the dashboard.
- When creating or updating an employee, upload a picture; images are saved to `public/uploads` and served at `/uploads/{filename}`.

## Project Structure

```
/app
  /Controllers
    Auth.php            # Handles user login/logout
    EmployeeController.php  # Employee CRUD and image upload
  /Models
    LoginModel.php
    EmpModel.php        # Defines the emp_details table fields
  /Views
    /layouts/main.php   # Main layout with navbar
    login.php           # Login form view
    /employees
      index.php         # List employees
      create.php        # Add employee form
      edit.php          # Edit employee form
/public
  index.php            # Front controller
  /uploads             # Stores uploaded profile pictures
/writable
  /uploads             # Temporary storage, protected by .htaccess
```

## Contributing

Contributions are welcome! Please open an issue or submit a pull request.

## License

This project is licensed under the MIT License.
