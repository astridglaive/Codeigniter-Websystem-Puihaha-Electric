# Puihaha Electric Company

A CodeIgniter 4 company website with a separate customer account management
system connected to the `electric_company` MariaDB database.

## Features

- Database-backed customer dashboard
- Public-facing Puihaha Electric Company homepage
- Tutorial-style About, Services, Contact, and Register pages
- SQL-backed public customer registration with hashed passwords
- SQL-backed contact/quote requests
- Create, read, update, and delete customer accounts
- Search, status/type filters, statistics, and pagination
- Database-backed staff login
- Session-protected dashboard and CRUD routes
- Hashed passwords, CSRF protection, input validation, and escaped output

## Local setup

1. Download or clone this repository into `C:\xampp\htdocs\Codeigniter\PuihahaElectricCompany`.
2. Copy the included `env` file to a new file named `.env`.
3. In `.env`, set `CI_ENVIRONMENT = development` and configure `app.baseURL` as `http://localhost/Codeigniter/PuihahaElectricCompany/`.
4. Configure the database as `electric_company`, username `root`, and the password used by your local MySQL installation.
5. Start Apache and MySQL in XAMPP.
6. In phpMyAdmin, create a database named `electric_company`.
7. Import `database/puihaha_electric_company_schema.sql`.
8. Open `http://localhost/Codeigniter/PuihahaElectricCompany/setup` and create your administrator account.
9. Open `http://localhost/Codeigniter/PuihahaElectricCompany/` to view the main website.
10. Select **Staff Login** and use the administrator account you created.

The `.env` file is already configured for the default XAMPP database account:
username `root` with no password. Update it if your MySQL setup is different.

## Main routes

- `GET /` - public Puihaha Electric Company website
- `GET /about` - company information
- `GET /services` - electrical services
- `GET|POST /contact` - contact form stored in `contact_messages`
- `GET|POST /register` - customer registration stored in `users`
- `GET /login` - login form
- `GET|POST /setup` - one-time administrator creation on a fresh database
- `POST /login` - authenticate user
- `GET /dashboard` and `GET /customers` - protected customer list
- `GET /customers/new` and `POST /customers` - create
- `GET /customers/{id}` - read
- `GET /customers/{id}/edit` and `POST /customers/{id}` - update
- `POST /customers/{id}/delete` - delete
- `POST /logout` - end the session

## Database tables

- `users` - customer registrations from the public website
- `contact_messages` - inquiries from the contact form
- `user_accounts` - staff credentials for the protected backend
- `customer_accounts` - customer records managed by the CRUD dashboard
