# Core PHP Task Manager

A simple Task Manager application built using object-oriented Core PHP, PDO, raw SQL, and MySQL.

## Features

- Create tasks
- View all tasks
- View individual tasks
- Edit tasks
- Delete tasks
- Mark tasks as pending or completed
- Server-side validation
- PDO prepared statements
- CSRF protection
- Flash messages
- Basic responsive styling

## Tech Stack

- PHP 8.4+
- MySQL 8
- PDO
- HTML5
- CSS
- Vanilla JavaScript

No framework or ORM is used.

## Project Structure

```text
config/
    bootstrap.php
    database.php
    csrf.php
    helpers.php

classes/
    Task.php

public/
    index.php
    create.php
    store.php
    show.php
    edit.php
    update.php
    delete.php

assets/
    css/
        style.css
```
