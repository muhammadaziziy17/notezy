# 📝 Laravel Note App

Bu loyiha foydalanuvchilarga o'zlarining shaxsiy eslatmalarini (notes) yaratish, tahrirlash, arxivlash va boshqarish imkonini beruvchi zamonaviy veb-ilovadir. Loyiha **Laravel 12** va **Tailwind CSS** (DaisyUI bilan) yordamida yaratilgan bo'lib, juda tez va interaktiv ishlaydi.

## 🌟 Asosiy imkoniyatlar (Features)

* **🔐 Xavfsiz avtorizatsiya tizimi:** Foydalanuvchilar ro'yxatdan o'tishi, tizimga kirishi va parolini tiklashi mumkin (maxsus tayyorlangan pochta xabari orqali).
* **⚡ Tezkor eslatmalar (AJAX):** Yangi eslatmalar sahifani yangilamasdan, orqa fonda (AJAX orqali) darhol saqlanadi.
* **✏️ O'qish va tahrirlash:** Eslatmalarni to'liq ekranda o'qish va ularning sarlavhasi, mazmuni yoki turini (type) tahrirlash imkoniyati.
* **🗂 Arxiv tizimi:** 
  * Kerak bo'lmagan, lekin o'chirishga ko'zi qiymagan eslatmalarni **arxivlash**.
  * Arxivlangan eslatmalarni alohida maxsus sahifada ko'rish va xohlagan paytda **qayta tiklash (restore)**.
  * Barcha arxivlangan eslatmalarni bir tugma bilan **butunlay tozalab tashlash (clean archive)**.
* **🛡 Maxfiylik:** Har bir foydalanuvchi faqatgina o'zi yaratgan eslatmalarni ko'radi va boshqaradi (xavfsizlik `Auth::user()->id` orqali ta'minlangan).
* **🎨 Zamonaviy UI:** Tailwind CSS v4 va DaisyUI yordamida chiroyli va qulay dizayn (Light, Dark va Cupcake temalari qo'llab-quvvatlanadi).

## 🛠 Texnologiyalar to'plami (Tech Stack)

* **Backend:** PHP 8.2+, Laravel 12.0
* **Frontend:** Tailwind CSS v4, DaisyUI, Vite, JavaScript (AJAX uchun)
* **Ma'lumotlar bazasi:** MySQL / PostgreSQL / SQLite (Sizning tanlovingizga qarab)

## 🚀 O'rnatish va ishga tushirish (Installation)

Loyihani o'z kompyuteringizda (lokal muhitda) ishga tushirish uchun quyidagi qadamlarni bajaring:

**1. Repozitoriyni yuklab oling:**
```bash
git clone https://github.com/SizningUsername/note-app.git
cd note-app
```

**2. Barcha PHP kutubxonalarni o'rnating:**
```bash
composer install
```

**3. NPM paketlarni o'rnating:**
```bash
npm install
```

**4. `.env` faylini yarating va sozlang:**
```bash
cp .env.example .env
```
Yaratilgan fayl ichidagi ma'lumotlar bazasi (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) sozlamalarini o'zingizning kompyuteringizga moslang.

**5. Ilova kalitini (App Key) generatsiya qiling:**
```bash
php artisan key:generate
```

**6. Ma'lumotlar bazasi jadvallarini yarating:**
```bash
php artisan migrate
```

**7. Frontend fayllarni yig'ing va serverni ishga tushiring:**
```bash
# Frontend fayllarni tayyorlash uchun (Vite)
npm run build
# (yoki kod yozish jarayonida "npm run dev")

# Laravel serverini ishga tushirish (yangi terminalda)
php artisan serve
```

Endi ilova `http://localhost:8000` manzilida ishlashni boshlaydi! 🎉

## 💡 Hosting bo'yicha muhim eslatma

Agar ilovani haqiqiy serverga (hosting) yuklayotgan bo'lsangiz va u yerda **HTTPS (SSL)** o'rnatilgan bo'lsa, xavfsizlik va CSS/JS fayllarni yuklashda muammo bo'lmasligi uchun `app/Providers/AppServiceProvider.php` faylida quyidagi o'zgartirishni kiritish esdan chiqmasin:

```php
use Illuminate\Support\Facades\URL;

public function boot()
{
    if (config('app.env') !== 'local') {
        URL::forceScheme('https');
    }
}
```

---
*Ushbu loyiha ochiq kodli bo'lib, uni istalgancha o'zgartirishingiz va GitHub-ga yuklashingiz mumkin!*