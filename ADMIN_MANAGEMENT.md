# Admin Management System

Sistem manajemen admin lengkap untuk ASHoes Infinity dengan role-based authentication.

## Fitur Utama

### 1. Dashboard Admin
- **URL**: `/admin`
- **Akses**: Hanya untuk user dengan role `admin`
- **Fitur**:
  - Statistik total produk, produk aktif, kategori, dan brand
  - Tabel produk terbaru
  - Tema konsisten (hitam dengan aksen pink)

### 2. Manajemen Produk
- **URL**: `/admin/products`
- **Fitur CRUD Lengkap**:
  - Create: Tambah produk dengan upload gambar
  - Read: List produk dengan filter dan search
  - Update: Edit produk dan gambar
  - Delete: Hapus produk
  - Toggle status aktif/nonaktif

### 3. Role-Based Authentication
- **2 Role**: `admin` dan `user`
- **Middleware**: `RoleMiddleware` untuk proteksi route
- **Redirect**: Admin ke dashboard, User ke home

## Command Line Tools

### 1. Membuat Admin Baru
```bash
php artisan make:admin {email} {name?} {password?}
```

**Contoh**:
```bash
# Dengan semua parameter
php artisan make:admin admin@example.com "Super Admin" "password123"

# Dengan default name dan password
php artisan make:admin admin@example.com

# Default: name="Admin", password="admin123"
```

### 2. Mengubah Role User
```bash
php artisan user:role {email} {role}
```

**Contoh**:
```bash
# Promosi user jadi admin
php artisan user:role user@example.com admin

# Demosi admin jadi user
php artisan user:role admin@example.com user
```

### 3. List Semua User
```bash
php artisan user:list [--role=admin|user]
```

**Contoh**:
```bash
# List semua user
php artisan user:list

# List hanya admin
php artisan user:list --role=admin

# List hanya user biasa
php artisan user:list --role=user
```

## Setup Database

### 1. Jalankan Migration
```bash
php artisan migrate
```

### 2. Jalankan Seeder
```bash
php artisan db:seed
```

**Data Demo yang Dibuat**:
- Admin: `admin@ashoes.com` / `admin123`
- User: `user@ashoes.com` / `user123`
- 10 produk sample dengan gambar

## Struktur File

### Models
- `app/Models/User.php` - User model dengan role field
- `app/Models/Product.php` - Product model

### Controllers
- `app/Http/Controllers/AdminController.php` - Dashboard admin
- `app/Http/Controllers/ProductController.php` - CRUD produk

### Middleware
- `app/Http/Middleware/RoleMiddleware.php` - Role-based access control

### Views
- `resources/views/admin/` - Semua view admin
  - `dashboard.blade.php` - Dashboard utama
  - `products/` - CRUD produk views

### Commands
- `app/Console/Commands/MakeAdminCommand.php` - Buat admin
- `app/Console/Commands/ChangeUserRoleCommand.php` - Ubah role
- `app/Console/Commands/ListUsersCommand.php` - List users

## Login Credentials

### Admin Default
- **Email**: `admin@ashoes.com`
- **Password**: `admin123`
- **Role**: `admin`

### User Default
- **Email**: `user@ashoes.com`
- **Password**: `user123`
- **Role**: `user`

## Akses URL

### Admin Routes (Require Admin Role)
- `/admin` - Dashboard
- `/admin/products` - Manajemen produk
- `/admin/products/create` - Tambah produk
- `/admin/products/{id}/edit` - Edit produk
- `/admin/products/{id}` - Detail produk

### Public Routes
- `/` - Homepage
- `/login` - Login page
- `/register` - Register page
- `/dashboard` - User dashboard (after login)

## Keamanan

### Role Middleware
- Proteksi semua route admin
- Auto redirect berdasarkan role:
  - Admin → `/admin`
  - User → `/dashboard`

### Validasi Input
- Form validation untuk semua input
- File upload validation untuk gambar
- XSS protection dengan Laravel's built-in security

### Authentication
- Laravel Breeze untuk base authentication
- Password hashing dengan bcrypt
- Session-based authentication

## Tema UI

### Warna Utama
- **Background**: Hitam (`#000000`)
- **Primary**: Pink (`#e91e63`)
- **Secondary**: Abu-abu gelap (`#333333`)
- **Text**: Putih untuk kontras

### Framework
- **Bootstrap 5.3.0**
- **Custom CSS** untuk tema konsisten
- **Responsive design** untuk mobile

## Troubleshooting

### Storage Link
Jika gambar tidak muncul, jalankan:
```bash
php artisan storage:link
```

### Permission Issues
Pastikan folder storage writable:
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Clear Cache
```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Development

### Menambah Fitur Admin Baru
1. Buat controller di `app/Http/Controllers/`
2. Tambah route di `routes/web.php` dalam group admin
3. Buat view di `resources/views/admin/`
4. Gunakan layout `admin.layout` untuk konsistensi

### Menambah Role Baru
1. Update enum di migration `users` table
2. Update `RoleMiddleware.php`
3. Update helper methods di `User.php` model
4. Update command validation

## Backup & Deployment

### Database Backup
```bash
php artisan db:backup
```

### Production Setup
1. Set `APP_ENV=production` di `.env`
2. Jalankan `php artisan config:cache`
3. Setup proper file permissions
4. Configure web server (Apache/Nginx)

---

**Dibuat untuk ASHoes Infinity - Sistem E-commerce Sepatu**
