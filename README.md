# 🏥 MedNet - Online Pharmacy Management System

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![SQLite](https://img.shields.io/badge/SQLite-3-003B57?style=for-the-badge&logo=sqlite&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.0-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

**A comprehensive e-commerce platform for managing and selling pharmaceutical products online.**

[Features](#-features) • [Installation](#-installation) • [Usage](#-usage) • [Admin Panel](#-admin-panel) • [Tech Stack](#-tech-stack)

</div>

---

## 📖 About

MedNet is a modern, full-featured online pharmacy platform built with Laravel 12. It provides a complete e-commerce solution for selling medicines, supplements, and first-aid products with advanced features like prescription management, inventory tracking, promotional campaigns, and comprehensive admin analytics.

## ✨ Features

### 🛒 Customer Features

#### Product Management
- **📦 Product Catalog**: Browse 200+ medical products across three categories:
  - 💊 Medicines (prescription & non-prescription)
  - 🌿 Supplements & Vitamins
  - 🏥 First Aid Supplies
- **🔍 Advanced Search**: Real-time search with product name, generic name, and description matching
- **🏷️ Smart Filtering**: Filter by category, manufacturer, price range, and stock status
- **💰 Discounts**: Automatic discount calculations with updated pricing display

#### Shopping Experience
- **🛍️ Shopping Cart**: 
  - Add/remove products with quantity control
  - Real-time cart count updates
  - Prescription upload for restricted medicines
  - Cart persistence across sessions
- **⚡ Quick Buy**: One-click purchase for frequently ordered items
- **📋 Wishlist Management**: Save favorite products for later

#### Checkout & Orders
- **🏠 Address Management**: 
  - Multiple saved addresses with alias names
  - Inside/Outside Dhaka distinction for shipping
  - Default address selection
  - Easy address CRUD operations
- **💳 Secure Checkout**: 
  - Order summary with itemized pricing
  - Cash on Delivery payment method
  - Prescription verification for restricted products
  - Order confirmation with detailed receipt
- **📦 Order Tracking**: 
  - View order history
  - Track order status (pending, processing, shipped, delivered, cancelled)
  - Order details with product list
  - Delivery time estimates

#### User Profile
- **👤 Profile Management**: Update personal information
- **🔐 Account Security**: Email verification and password management
- **📍 Address Book**: Manage multiple delivery addresses
- **📜 Order History**: Complete purchase history with reorder capability

#### Support & Communication
- **💬 Support Feedback System**: Submit queries and issues
- **📧 Email Notifications**: Order confirmations and updates
- **❓ Help Center**: FAQ and product information

---

### 🎛️ Admin Panel Features

#### Dashboard & Analytics
- **📊 Real-time Statistics**:
  - Total revenue and sales metrics
  - Product inventory status
  - Order volume tracking
  - User registration trends
- **📈 Visual Analytics**:
  - Sales charts and graphs
  - Revenue by product category
  - Top-selling products
  - Order status distribution
  - Monthly/weekly/daily trends

#### Product Management
- **➕ Add Products**: Complete product creation with:
  - Name, generic name, and description
  - Dosage and manufacturer details
  - Pricing with discount support
  - Stock quantity and low stock threshold
  - Expiry date tracking
  - Category and tag assignment
  - Image upload
  - Side effects documentation
  - Prescription requirement flag
- **✏️ Edit Products**: Update all product details
- **🗑️ Delete Products**: Remove discontinued items
- **📦 Stock Management**: 
  - Automatic stock status (normal/low_stock/out_of_stock)
  - Bulk stock updates
  - Expiry date alerts
- **🔍 Product Search**: Quick product lookup in admin panel

#### Order Management
- **📋 Order Overview**: 
  - List all orders with filtering
  - Order status tracking
  - Customer information
  - Order value and items
- **✅ Order Processing**:
  - Update order status
  - Mark as shipped/delivered
  - Cancel orders with reason
  - View order details
- **💊 Prescription Approval**:
  - Review uploaded prescriptions
  - Approve/reject prescription-required orders
  - Prescription image viewer
  - Order notes and communication

#### User Management
- **👥 User Administration**:
  - View all registered users
  - User search and filtering
  - Account status management
  - Ban/unban users
  - View user order history
- **🚫 Email Banning**: Block email addresses from registration
- **📊 User Analytics**: Registration trends and user activity

#### Promotional Management
- **🎨 Promotion Slider**:
  - Upload promotional banners
  - Set display order
  - Enable/disable promotions
  - Add title and description
  - Alt text for accessibility
  - Manage up to 6 active promotions
- **🎯 Discount Campaigns**: Create product-specific discounts

#### Support Management
- **📨 Feedback System**:
  - View customer support requests
  - Categorize feedback (bug, feature request, general)
  - Assign status (pending, in progress, resolved, closed)
  - Respond to customer queries
  - Priority management

#### Reports & Insights
- **📑 Sales Reports**: Generate revenue reports by date range
- **📊 Inventory Reports**: Stock levels and low stock alerts
- **📈 Performance Metrics**: Key business indicators

---

## 🛠️ Tech Stack

### Backend
- **Framework**: Laravel 12.0
- **PHP Version**: 8.2+
- **Database**: SQLite (portable and included)
- **Authentication**: Laravel Breeze
- **ORM**: Eloquent

### Frontend
- **CSS Framework**: Tailwind CSS 3.0
- **JavaScript**: Vanilla JS with Alpine.js components
- **Build Tool**: Vite
- **Icons**: Font Awesome / Heroicons

### Development Tools
- **Code Quality**: Laravel Pint (PHP CS Fixer)
- **Debugging**: Laravel Telescope (optional)
- **API Testing**: Laravel Pail
- **Development Server**: Laravel Sail (Docker) or Artisan serve

---

## 📋 Requirements

- PHP >= 8.2
- Composer
- Node.js >= 18.x & NPM
- SQLite extension enabled
- Git

---

## 🚀 Installation

### 1. Clone the Repository

```bash
git clone https://github.com/samixshady/MedNet.git
cd MedNet
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install JavaScript Dependencies

```bash
npm install
```

### 4. Environment Configuration

```bash
# Copy the example environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Database Setup

The project includes a pre-populated SQLite database with 205+ products. If you want to start fresh:

```bash
# Run migrations
php artisan migrate

# Seed the database with sample data
php artisan db:seed

# Create admin user
php artisan db:seed --class=CreateAdminSeeder
```

### 6. Create Storage Symlink

```bash
php artisan storage:link
```

### 7. Build Frontend Assets

```bash
# For development
npm run dev

# For production
npm run build
```

### 8. Start the Development Server

```bash
php artisan serve
```

Visit `http://127.0.0.1:8000` in your browser.

---

## 👤 Default Credentials

### Admin Account
- **Email**: `admin@admin.com`
- **Password**: `adminadmin`

### Test User Account
- **Email**: `duck@duck.com`
- **Password**: `password`

> ⚠️ **Important**: Change these credentials in production!

---

## 📖 Usage

### For Customers

1. **Register/Login**: Create an account or log in at the homepage
2. **Browse Products**: Navigate through Medicine, Supplements, or First Aid categories
3. **Search**: Use the search bar to find specific products
4. **Add to Cart**: Select products and specify quantity
5. **Upload Prescription**: For prescription medicines, upload your prescription in cart
6. **Checkout**: Add delivery address and complete your order
7. **Track Orders**: View order status in your profile

### For Administrators

1. **Admin Login**: Access admin panel at `/admin/login`
2. **Dashboard**: View analytics and quick stats
3. **Manage Products**: Add, edit, or remove products
4. **Process Orders**: Review and update order status
5. **Review Prescriptions**: Approve prescription-based orders
6. **User Management**: Monitor and manage user accounts
7. **Promotions**: Update promotional banners
8. **Support**: Respond to customer feedback

---

## 📁 Project Structure

```
MedNet/
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Application controllers
│   │   │   ├── Admin/          # Admin panel controllers
│   │   │   ├── Auth/           # Authentication controllers
│   │   │   └── ...
│   │   ├── Middleware/         # Custom middleware
│   │   └── Requests/           # Form request validation
│   ├── Models/                 # Eloquent models
│   │   ├── User.php
│   │   ├── Product.php
│   │   ├── Order.php
│   │   └── ...
│   ├── Policies/               # Authorization policies
│   └── Providers/              # Service providers
├── database/
│   ├── migrations/             # Database migrations
│   ├── seeders/                # Database seeders
│   ├── factories/              # Model factories
│   └── database.sqlite         # SQLite database
├── public/
│   ├── css/                    # Compiled CSS
│   ├── js/                     # Compiled JavaScript
│   └── storage/                # Public storage symlink
├── resources/
│   ├── css/                    # Source CSS files
│   ├── js/                     # Source JavaScript files
│   └── views/                  # Blade templates
├── routes/
│   ├── web.php                 # Web routes
│   ├── auth.php                # Authentication routes
│   └── console.php             # Console commands
├── storage/
│   └── app/
│       └── public/             # User uploaded files
│           ├── products/       # Product images
│           └── promotions/     # Promotion banners
└── tests/                      # Application tests
```

---

## 🔒 Security Features

- ✅ **CSRF Protection**: All forms protected with CSRF tokens
- ✅ **SQL Injection Prevention**: Using Eloquent ORM with prepared statements
- ✅ **XSS Protection**: Automatic output escaping with Blade templates
- ✅ **Password Hashing**: Bcrypt hashing for user passwords
- ✅ **Email Verification**: Optional email verification for new accounts
- ✅ **Admin Middleware**: Role-based access control for admin routes
- ✅ **File Upload Validation**: Strict validation for prescription uploads
- ✅ **Session Security**: Secure session management
- ✅ **Rate Limiting**: API rate limiting to prevent abuse

---

## 🗃️ Database Schema

### Key Tables

- **users**: User accounts with admin flags
- **products**: Product catalog with pricing, stock, and metadata
- **categories**: Product categorization
- **orders**: Customer orders with status tracking
- **order_items**: Individual items within orders
- **carts**: Shopping cart items
- **quick_buys**: Saved items for quick purchasing
- **addresses**: Customer delivery addresses
- **promotions**: Promotional banner management
- **support_feedback**: Customer support tickets
- **banned_emails**: Email blacklist

---

## 🛠️ Available Artisan Commands

```bash
# Run migrations
php artisan migrate

# Seed database with products
php artisan db:seed

# Create admin user
php artisan db:seed --class=CreateAdminSeeder

# Import MySQL data to SQLite
php artisan db:seed --class=MySQLDataImportSeeder

# Assign random product images
php artisan db:seed --class=AssignRandomImagesSeeder

# Clear application cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Run code formatter
./vendor/bin/pint
```

---

## 🔧 Configuration

### Environment Variables

Key configurations in `.env`:

```env
APP_NAME=MedNet
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
```

### File Storage

Product images and promotional banners are stored in:
- `storage/app/public/products/`
- `storage/app/public/promotions/`

Accessed via the public symlink: `public/storage/`

---

## 📱 Responsive Design

MedNet is fully responsive and works seamlessly across:
- 💻 Desktop computers
- 📱 Mobile phones
- 📲 Tablets
- 🖥️ Large displays

---

## 🐛 Common Issues & Solutions

### Issue: Images not displaying
**Solution**: Run `php artisan storage:link`

### Issue: Permission errors
**Solution**: 
```bash
chmod -R 775 storage bootstrap/cache
```

### Issue: Database not found
**Solution**: Ensure `.env` has correct `DB_DATABASE` path

### Issue: CSS not loading after installation
**Solution**: Run `npm run build`

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 👨‍💻 Author

**Samix Shady**

- GitHub: [@samixshady](https://github.com/samixshady)
- Project Link: [https://github.com/samixshady/MedNet](https://github.com/samixshady/MedNet)

---

## 🙏 Acknowledgments

- Laravel Framework
- Tailwind CSS
- Laravel Breeze for authentication scaffolding
- All open-source contributors

---

## 📞 Support

For support, email support@mednet.com or create an issue in the GitHub repository.

---

<div align="center">

**⭐ Star this repository if you find it helpful!**

Made with ❤️ using Laravel

</div>
