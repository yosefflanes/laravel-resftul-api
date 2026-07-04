# DibiEdu API

REST API backend for an online learning platform, built with Laravel. Supports course management, categories, and student enrollments with role-based access control (instructor/student).

**Live Demo:** https://laravel-resftul-api.onrender.com

## Tech Stack

- **Framework:** Laravel 13
- **Database:** MySQL (Aiven, SSL-secured connection)
- **Authentication:** Laravel Sanctum (token-based)
- **Deployment:** Docker, hosted on Render
- **Web Server:** Nginx + PHP-FPM

## Features

- User registration & authentication with role-based access (`student` / `instructor`)
- CRUD operations for courses and course categories
- Course enrollment tracking with duplicate-enrollment protection
- Protected routes via Sanctum token authentication

## Database Schema

| Table | Description |
|---|---|
| `users` | Registered users, with `role` (student/instructor) |
| `course_categories` | Course categories (e.g. Web Development, Data Science) |
| `courses` | Courses, linked to an instructor and a category |
| `enrollments` | Tracks which students are enrolled in which courses |

## API Endpoints

### Public

| Method | Endpoint | Description |
|---|---|---|
| POST | `/api/register` | Register a new user |
| POST | `/api/login` | Log in and receive an access token |
| GET | `/api/courses` | List all courses |
| GET | `/api/courses/{id}` | Get a single course by ID |
| GET | `/api/categories` | List all course categories |
| GET | `/api/categories/{id}` | Get a single category by ID |

### Protected (requires `Authorization: Bearer {token}`)

| Method | Endpoint | Description |
|---|---|---|
| POST | `/api/courses` | Create a new course |
| PUT | `/api/courses/{id}` | Update an existing course |
| DELETE | `/api/courses/{id}` | Delete a course |
| POST | `/api/categories` | Create a new category |
| PUT | `/api/categories/{id}` | Update an existing category |
| DELETE | `/api/categories/{id}` | Delete a category |
| POST | `/api/logout` | Revoke the current access token |

## Getting Started

### Prerequisites

- PHP 8.3+
- Composer
- MySQL or PostgreSQL

### Installation

```bash
git clone https://github.com/your-username/dibiedu-api.git
cd dibiedu-api
composer install
cp .env.example .env
php artisan key:generate
```

Configure your database credentials in `.env`, then run:

```bash
php artisan migrate --seed
php artisan serve
```

The API will be available at `http://localhost:8000`.

### Sample credentials (from seeder)

| Role | Email | Password |
|---|---|---|
| Instructor | jane@mail.com | Instructor123 |
| Student | alice@mail.com | Student123 |

## Deployment

This project is containerized with Docker and deployed on Render, using a managed MySQL database on Aiven with SSL enforced. On every push to `main`, Render automatically rebuilds and redeploys the container, running migrations and seeders on startup.

## License

This project was created for portfolio and learning purposes.
