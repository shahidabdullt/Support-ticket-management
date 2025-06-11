 Support Ticket Management System (Laravel 12)

This is a Laravel 12-based support ticket management system that allows users to submit tickets and admins to manage them. Built with Bootstrap for styling and a simple admin panel.

---

##  Features

- Submit support tickets by category (Technical, Billing, Product, General, Feedback)
- Admin login & dashboard
- Ticket listing & status updates 
- Multi-database routing by ticket type 
- Bootstrap 5-based responsive UI
- Laravel validation & session flash messages

---

 Admin Credentials (Seeded)
 Email      adminsha@gmail.com`     
 Password   12345678                

You can modify this in `database/seeders/AdminSeeder.php` if needed.

---

##  Installation

### 1. Clone the repo
```bash
git clone https://github.com/shahidabdullt/Support-ticket-management.git
cd Support-ticket-management

2.Install dependencies composer install
3. Create .env file  cp .env.example .env, php artisan key:generate
4.Run migrations and seed admin php artisan migrate --seed
5.Serve the app  php artisan serve
