# ToDo List Application

This project is a ToDo List web application built using the **Laravel** framework and **Vue.js** (via Inertia.js and Laravel Breeze). It meets all the core requirements including User Authentication and CRUD operations for tasks. 

## Features
- **User Authentication:** Login and Registration using Laravel Breeze.
- **Task Management:** Create, Read, Update, and Delete (CRUD) tasks.
- **Modern Front-End:** Built with Vue.js components (Header, Footer, TaskModal, Dashboard) and styled with Tailwind CSS.
- **Typography:** Uses the **Roboto** font as the primary typography schema.
- **Responsive Design:** A clean, mobile-friendly user interface.

## Prerequisites
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL or any other supported database

## Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/[owner]/test-[your short name].git
   cd test-[your short name]
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies:**
   ```bash
   npm install
   ```

4. **Environment Setup:**
   Copy the example environment file and set up your database credentials:
   ```bash
   cp .env.example .env
   ```
   *Open the `.env` file and configure your `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`.*

5. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

6. **Run Database Migrations:**
   ```bash
   php artisan migrate
   ```

7. **Compile Frontend Assets:**
   ```bash
   npm run build
   ```
   *(For active development with hot-reloading, use `npm run dev`)*

8. **Start the Local Development Server:**
   ```bash
   php artisan serve
   ```
   *Your application will now be available at [http://localhost:8000](http://localhost:8000).*

## Tech Stack
- **Backend:** Laravel
- **Frontend:** Vue 3 + Inertia.js
- **Styling:** Tailwind CSS
- **Database:** SQLite / MySQL
