**Project Management API (Laravel 12)**

A Laravel 12 API-only backend for a React frontend (stored in a separate repository).

**Overview:**

- **Purpose:** API backend for a project-management application.
- **Modules:** `Project` and `Task` — a Project has many Tasks; both support full CRUD operations.
- **Authentication:** Laravel Sanctum is used for authentication.
- **Database:** MySQL (migrations provided in `database/migrations`).

**Features:**

- CRUD for Projects and Tasks.
- Associate multiple Tasks to a single Project.
- User authentication via Sanctum (token-based / SPA-friendly).
- API-ready for consumption by a React frontend in a separate repository.

**Tech Stack:**

- PHP 8.2
- Laravel 12
- MySQL
- Laravel Sanctum (authentication)

**Quick Start:**

1. Install PHP dependencies:

    `composer install`

2. Copy the example environment and set your DB and app values:

    `cp .env.example .env`

    Edit `.env` and set `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, and any Sanctum/CORS settings required by your frontend.

3. Generate application key:

    `php artisan key:generate`

4. Run migrations (and optionally seeders):

    `php artisan migrate`

    `php artisan db:seed` (optional)

5. Start the development server:

    `php artisan serve --host=127.0.0.1 --port=8000`

The React frontend should be configured to call this API's base URL and handle authentication via Sanctum (ensure cookie/CORS configuration if using SPA authentication).

**API Endpoints (examples)**

- `GET /api/projects` — list projects
- `POST /api/projects` — create a project
- `GET /api/projects/{project}` — show a project
- `PUT/PATCH /api/projects/{project}` — update a project
- `DELETE /api/projects/{project}` — delete a project
- `GET /api/projects/{project}/tasks` — list tasks for a project
- `POST /api/projects/{project}/tasks` — add a task to a project
- `PUT/PATCH /api/tasks/{task}` — update a task
- `DELETE /api/tasks/{task}` — delete a task

Check `routes/api.php` and the `app/Http/Controllers` folder for the exact routes and controller methods.

**Notes:**

- The React frontend lives in a separate repository; this repository only provides the API.
- Ensure Sanctum and CORS configuration match your frontend's domain and auth approach.

**License:**

- MIT
