# To Do List Application


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

**Clone the repository:**
   ```bash
   git clone https://github.com/Syafiq276/test-syafiq276.git
   cd test-syafiq276
   ```

**Install PHP dependencies:**
   ```bash
   composer install
   ```

**Install Node.js dependencies:**
   ```bash
   npm install
   ```

 **Environment Setup:**
   Copy the example environment file and set up your database credentials:
   ```bash
   cp .env.example .env
   ```
   *Open the `.env` file and configure your `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`.*



 **Run Database Migrations:**
   ```bash
   php artisan migrate
   ```

 **Compile Frontend Assets:**
   ```bash
   npm run build
   ```
   *(For active development with hot-reloading, use `npm run dev`)*

 **Start the Local Development Server:**
   ```bash
   php artisan serve
   ```
   *Your application will now be available at [http://localhost:8000](http://localhost:8000).*

**Credentials**

```
Email: hello@example.com
Password: Test1234
```