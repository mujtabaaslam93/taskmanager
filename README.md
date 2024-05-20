# Task Manager

## Requirements
- PHP 7.4+
- Composer
- MySQL

## Setup Instructions

1. Clone the repository.
2. Navigate to the project directory.
3. Run `composer install` to install dependencies.
4. Set up your `.env` file with your database credentials.
5. Create a new MySQL database and update the `.env` file with the database name.
6. Run `php artisan migrate` to create the database tables.
7. Start the development server using `php artisan serve`.
8. Access the application at `http://localhost:8000`.

## Features
- Create, edit, delete, and reorder tasks.
- Tasks are associated with projects.
- Edit task name using inline-edit, press enter to save.
- Reorder tasks using drag and drop functionality.

##
