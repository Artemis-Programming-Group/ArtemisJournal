# ArtemisJournal

## About This Project

Hello everyone!

This project is for my personal use as a simple blog app. I created it with the help of Claude AI (free subscription), and the development time took about 16 hours.

I just wanted to share this project with anyone who wants a simple website to post their ideas on the web. There is still a little work that needs to be done on this project, but for now, it's personally enough for me. However, I'm open to any ideas you may have, and you can even make a version with more features based on your needs.

## Installation

### 1. Clone the Repository
```bash
git clone https://github.com/Artemis-Programming-Group/ArtemisJournal.git
cd ArtemisJournal
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Configure Environment
```bash
cp .env.example .env
```
> **Note:** Edit the `.env` file and change the necessary configuration (database, app URL, etc.)

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Run Database Migrations
```bash
php artisan migrate --seed
```
> **Important:** In `DatabaseSeeder`, there is code for creating a user. Please update it with your own data. Currently, my information is there; if you like, you can leave it and let me know when you create your blog - I'd be happy to see your website too!

### 6. Install Frontend Dependencies
```bash
npm install
```

### 7. Build Assets
```bash
npm run build
```

---

## درباره این پروژه

سلام دوستان!

این پروژه برای استفاده شخصی من به عنوان یک اپلیکیشن بلاگ ساده است. من آن را با کمک Claude AI (اشتراک رایگان) ساختم و زمان توسعه آن حدود ۱۶ ساعت طول کشید.

من فقط می‌خواستم این پروژه را با هر کسی که می‌خواهد یک وبسایت ساده برای انتشار ایده‌هایش در وب داشته باشد، به اشتراک بگذارم. همچنین هنوز کمی کار باقی مانده که باید روی این پروژه انجام شود، اما در حال حاضر شخصاً برای من کافی است. با این حال، من به هر ایده‌ای که ممکن است داشته باشید باز هستم و حتی می‌توانید یک نسخه با ویژگی‌های بیشتر بر اساس نیازهای خودتان بسازید.

## نصب و راه‌اندازی

### ۱. دانلود مخزن
```bash
git clone https://github.com/Artemis-Programming-Group/ArtemisJournal.git
cd ArtemisJournal
```

### ۲. نصب وابستگی‌های PHP
```bash
composer install
```

### ۳. تنظیم محیط
```bash
cp .env.example .env
```
> **توجه:** فایل `.env` را ویرایش کرده و تنظیمات لازم (دیتابیس، آدرس اپلیکیشن و غیره) را تغییر دهید

### ۴. ساخت کلید اپلیکیشن
```bash
php artisan key:generate
```

### ۵. اجرای مایگریشن‌های دیتابیس
```bash
php artisan migrate --seed
```
> **مهم:** در `DatabaseSeeder` کدی برای ساخت کاربر وجود دارد. لطفاً آن را با اطلاعات خودتان به‌روزرسانی کنید. در حال حاضر اطلاعات من آنجاست؛ اگر دوست دارید، می‌توانید آن را نگه دارید و وقتی بلاگ خودتان را ساختید به من بگویید - خوشحال می‌شوم وبسایت شما را هم ببینم!

### ۶. نصب وابستگی‌های فرانت‌اند
```bash
npm install
```

### ۷. ساخت فایل‌های استاتیک
```bash
npm run build
```


