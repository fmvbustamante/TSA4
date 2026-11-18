# Tasks for Today Management System — Laravel TSA4

Extends TSA3 with validated task CRUD, authenticated management, archiving, and completion emails.

## Features

- Public Welcome, Task List, Profile, and About pages.
- Authenticated create, edit, update, and archive actions.
- `is_archived` flag keeps archived tasks out of active lists.
- Completion email is triggered only when a task transitions from a non-done status to `done`.
- Laravel Breeze is included as a development dependency; login and registration screens/routes are provided.
- Mail defaults to Laravel's `log` driver, so test messages are written to `storage/logs/laravel.log`, not sent to a real inbox.
- `.env.example` is included; populated `.env` and `vendor/` are excluded.

## Setup (Windows PowerShell)

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
if (!(Test-Path database/database.sqlite)) { New-Item -ItemType File -Path database/database.sqlite | Out-Null }
php artisan migrate --seed
php artisan serve
```

Open `/register` to create an account. For the seeded demo account, use `francesca.bustamante@example.com` with password `password`; change this demo password for any non-local use. Management routes require login; the four read-only pages remain public.

To inspect the email log after marking a task done, open `storage/logs/laravel.log`. To use a different recipient, set `TASK_COMPLETED_EMAIL` in your local `.env`. The default mailer remains `log`.

## Pages

- `/` — today's active tasks
- `/tasks` — all active tasks, ordered by date
- `/profile` — seeded user profile
- `/about` — developer and project information
- `/login`, `/register` — authentication
- `/tasks/create`, `/tasks/{id}/edit` — authenticated task management

## Database and email files

- `database/migrations/` — tasks, users, archive flag, authentication fields.
- `database/seeders/` — nine dated tasks and one user.
- `app/Mail/TaskCompletedMail.php` and `resources/views/emails/tasks/completed.blade.php` — completion notification.
