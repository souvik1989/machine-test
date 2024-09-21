# machine-test



#SETUP
To set up The project locally.you have to put it in local server folder, then you have to create a database in local server and import the sql file.Then you have to put the DB detail in the .env file of the project directory .Then you have to run php artisan serve in terminal of the project path.



# Laravel Task Management System

## Overview

The project is about simple task management.
There is task category managements and tasks managements module.We have to create task category atfirst then it will populate data in task management form.
There is APIs also to do the crud operation of thos tables.
You have to register first and then login .then you will be redirected to the dash board page ,where is a navigation bar ,from there you can go to task management and task category management.

## Prerequisites

- PHP >= 8.1
- Composer
- Laravel >= 10
- A database server (e.g., MySQL)

## Installation

Running the Development Server
- php artisan migrate
- 
- php artisan serve
    Navigate to http://localhost:8000 in your browser to view the application.
  
- php artisan db:seed


## Usage
- Web Interface
    List Categories: /categories
  
    Create Categories: /categories/create
  
    Edit Categories: /categories/{id}/edit
  
    Delete Categories: /categories/{id}

    List Task: /task
  
    Create Task: /task/create
  
    Edit Task: /task/{id}/edit
  
    Delete Task: /task/{id}
  
- API Endpoints
    Get All Task: GET /api/list-tasks
  
    Create Task: POST /store-task
  
    Update Task: POST /api/update-task/{id}
  
    Delete Task: DELETE /api/delete-task/{id}
  
    Status Change of Task: PATCH /api/task/{id}/status

    Get All Task Category: GET /api/list-categories
  
    Create Task Category: POST /store-category
  
    Update Task Category: POST /api/update-category/{id}
  
    Delete Task Category: DELETE /api/delete-category/{id}
  
    Status Change of Task Category: PATCH /api/category/{id}/status


## Testing
- php arisan test

