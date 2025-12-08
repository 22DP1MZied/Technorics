# 🎮 Technorics - Premium Electronics E-Commerce Store

![Technorics Logo](public/images/logo.png)

A full-featured e-commerce platform built with Laravel for selling electronics, gaming gear, and PC components. Features a modern design with emerald green branding, multi-language support, and comprehensive admin panel.

## ✨ Features

### 🛍️ Customer Features
- **Product Browsing**
  - Browse products by categories (Laptops, PC Components, Monitors, Keyboards, Mice, Headsets)
  - Advanced search with category filtering
  - Product comparison tool
  - "Frequently Bought Together" recommendations
  - Related products suggestions
  - Hot deals section with discount percentages

- **Shopping Experience**
  - Shopping cart with real-time updates
  - Wishlist functionality
  - Guest browsing, authenticated checkout
  - Stripe payment integration (test mode)
  - Address autocomplete (Google Places API)
  - Order tracking system

- **User Accounts**
  - User registration and authentication
  - Profile management
  - Order history with detailed views
  - Review system (unlimited reviews per product)
  - Edit/delete own reviews

- **Internationalization**
  - Multi-language support: English, Latvian, Russian
  - Dynamic language switcher
  - Fully translated interface

- **Modern UI/UX**
  - Dark mode support
  - Responsive design (mobile-friendly)
  - Emerald green brand colors
  - Smooth transitions and animations
  - AI Assistant widget

### 🔐 Admin Features
- **Filament Admin Panel**
  - Custom emerald green theme
  - Dashboard with key metrics:
    - Total Revenue (€11,582.91)
    - Total Orders (6)
    - Active Products
    - Total Users
  - Latest orders widget
  - Admin-only access control

- **Management Tools**
  - Product management (CRUD)
  - Category management
  - Order management with status updates
  - User management
  - Review moderation

### 📧 Email Notifications
- Welcome email on registration
- Order confirmation
- Order status updates
- Shipping notifications with tracking numbers
- Professional HTML email templates
- Queue-based background processing

### 🔧 Technical Features
- Laravel 12.39.0
- PHP 8.4.14
- MySQL database
- Tailwind CSS for styling
- Alpine.js for interactivity
- Filament v3 for admin panel
- Gmail SMTP for emails
- Vite for asset compilation

## 📦 Installation

### Prerequisites
- PHP 8.4+
- Composer
- Node.js & npm
- MySQL
- Git

### Setup Instructions

1. **Clone the repository**
```bash
git clone https://github.com/yourusername/technorics.git
cd technorics
```

2. **Install PHP dependencies**
```bash
composer install
```

3. **Install Node dependencies**
```bash
npm install
```

4. **Environment configuration**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configure your `.env` file**
```env
APP_NAME=Technorics
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=technorics
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@technorics.com"
MAIL_FROM_NAME="Technorics"

STRIPE_KEY=your_stripe_public_key
STRIPE_SECRET=your_stripe_secret_key

GOOGLE_PLACES_API_KEY=your_google_places_api_key
```

6. **Run migrations and seeders**
```bash
php artisan migrate
php artisan db:seed
```

7. **Build assets**
```bash
npm run build
# OR for development with hot reload:
npm run dev
```

8. **Create admin user**
```bash
php artisan tinker
```
```php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

User::create([
    'name' => 'Admin',
    'email' => 'admin@technorics.com',
    'password' => Hash::make('password'),
    'is_admin' => true
]);
exit
```

9. **Start the development server**
```bash
php artisan serve
```

10. **Start the queue worker** (for emails)
```bash
php artisan queue:work
```

Visit: `http://127.0.0.1:8000`

## 🎯 Usage

### Customer Access
- **Homepage**: `http://127.0.0.1:8000`
- **Shop**: `http://127.0.0.1:8000/store`
- **Deals**: `http://127.0.0.1:8000/deals`
- **Register**: `http://127.0.0.1:8000/register`
- **Login**: `http://127.0.0.1:8000/login`

### Admin Access
- **Admin Panel**: `http://127.0.0.1:8000/admin`
- **Credentials**: admin@technorics.com / password
- Only users with `is_admin = true` can access

### Testing Emails
```bash
php artisan test:emails
```
Choose email type and enter recipient address.

## 🗂️ Project Structure
```
technorics/
├── app/
│   ├── Console/Commands/
│   │   └── TestEmails.php          # Email testing command
│   ├── Filament/
│   │   ├── Pages/
│   │   │   └── Dashboard.php       # Custom admin dashboard
│   │   ├── Widgets/
│   │   │   ├── StatsOverview.php   # Revenue/orders stats
│   │   │   └── LatestOrders.php    # Recent orders widget
│   │   └── Resources/              # Auto-discovered resources
│   ├── Http/Controllers/
│   │   ├── AuthController.php      # Authentication
│   │   ├── StoreController.php     # Product browsing
│   │   ├── CartController.php      # Shopping cart
│   │   ├── CheckoutController.php  # Checkout & payment
│   │   ├── OrderController.php     # Order management
│   │   └── ReviewController.php    # Product reviews
│   ├── Mail/
│   │   ├── WelcomeEmail.php
│   │   ├── OrderConfirmationEmail.php
│   │   ├── OrderStatusUpdateEmail.php
│   │   └── OrderShippedEmail.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Product.php
│   │   ├── Category.php
│   │   ├── Order.php
│   │   ├── CartItem.php
│   │   └── Review.php
│   └── Observers/
│       └── OrderObserver.php       # Auto-send status emails
├── database/
│   ├── migrations/                 # Database schema
│   └── seeders/                    # Sample data
├── resources/
│   ├── css/
│   │   └── filament/admin/theme.css # Admin panel styling
│   ├── lang/
│   │   ├── en/                     # English translations
│   │   ├── lv/                     # Latvian translations
│   │   └── ru/                     # Russian translations
│   └── views/
│       ├── auth/                   # Login/register
│       ├── store/                  # Product pages
│       ├── cart/                   # Shopping cart
│       ├── checkout/               # Checkout flow
│       ├── emails/                 # Email templates
│       └── components/             # Reusable components
└── public/
    └── images/
        └── logo.png                # Technorics logo
```

## 🎨 Customization

### Changing Colors
The primary color is Emerald Green. To change:
1. Update `tailwind.config.js`
2. Update `app/Providers/Filament/AdminPanelProvider.php`
3. Update `resources/css/filament/admin/theme.css`

### Adding Products
Use the admin panel at `/admin` or create a seeder in `database/seeders/`

### Email Configuration
Update email templates in `resources/views/emails/`
Configure SMTP in `.env` file

## 🌐 Multi-Language

Supported languages:
- 🇬🇧 English (en)
- 🇱🇻 Latvian (lv)
- 🇷🇺 Russian (ru)

Add translations in `resources/lang/{locale}/messages.php`

## 🔒 Security

- CSRF protection enabled
- Password hashing with bcrypt
- Admin-only routes protected
- XSS protection
- SQL injection prevention via Eloquent ORM

## 📝 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

## 👨‍💻 Developer

**Marsels Ziedins**
- Email: marselsziedins@example.com
- Location: Riga, Latvia

## �� Acknowledgments

- Laravel Framework
- Filament Admin Panel
- Tailwind CSS
- Stripe Payment Gateway
- Google Places API
- Alpine.js

## 📞 Support

For support, email info@technorics.com or create an issue in the repository.

---

Made with 💚 by Marsels Ziedins
