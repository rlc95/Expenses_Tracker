# Project Setup Guide

### Clone the Repository
```sh
git clone https://github.com/rlc95/Expenses_Tracker
#Open the Project in VS Code.

#Run XAMPP Apache and MySQL Server
#Install PHP Dependencies using Composer

composer install

# Copy the .env.example file to .env and configure your environment variables:
 cp .env.example .env

# Generate the Application Key:
 php artisan key:generate

# Create a Database:
Create a database named expense_tracker.
# Update your .env file to use the new database:
DB_DATABASE='expense_tracker'

# Import the Database:
# In the project directory, locate the sql folder.
# Use phpMyAdmin to import the SQL file into the expense_tracker.

# Start the Development Server:
 php artisan serve

# Open your Browser and Navigate to:
 http://localhost:8000

# POST API 
http://127.0.0.1:8000/api/expenses      # route/api.php file is not in laravel project so unable to check on postman

# GET API 
http://127.0.0.1:8000/api/expense/daily-summary?user_id=1&date=2025-05-03    # add value of user_id and value of date as you prefer, check on web browser to get the result

# route/api.php is not included in installed lravel project (tried to get api file installing new laravel projects). 


