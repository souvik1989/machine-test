# Laravel Book Management System

## Overview

This Laravel application is designed for managing books. It includes functionalities for CRUD operations and book status management. It also provides RESTful API endpoints for integration and testing purposes.

## Prerequisites

- PHP >= 8.1
- Composer
- Laravel >= 10
- A database server (e.g., MySQL)

## Installation

Running the Development Server
- php artisan migrate
- php artisan serve
    Navigate to http://localhost:8000 in your browser to view the application.
- php artisan db:seed


## Usage
- Web Interface
    List Books: /books
    Create Book: /books/create
    Edit Book: /books/{id}/edit
    View Book: /books/{id}
    Delete Book: /books/{id}

- API Endpoints
    Get All Books: GET /api/books
    Get Single Book: GET /api/books/{id}
    Create Book: POST /api/books
    Update Book: PUT /api/books/{id}
    Delete Book: DELETE /api/books/{id}
    Checkout Book: PATCH /api/books/{id}/checkout
    Return Book: PATCH /api/books/{id}/return


## Testing
- php arisan test

