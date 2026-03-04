# SafePost

**SafePost** adalah platform blog berbasis Laravel 12 yang mendukung:

* Login Email & Password
* Login Google (OAuth)
* 2FA Google Authenticator
* CRUD Post
* Category & Tag (Many-to-Many)
* Comment System
* Advanced Full-Text Search (Ranking + Relevance)
* SEO Optimization (Meta Tag + Sitemap)
* Database Indexing & Optimized Query

---

# Teknologi & Library yang Digunakan

## 🔹 Core Framework

* Laravel ^12.0
* PHP ^8.2
* MySQL (FULLTEXT index)

---

## 🔹 Authentication & Security

* Laravel Breeze — Auth scaffolding
* Laravel Socialite ^5.24 — OAuth Google login
* Google Authenticator (via pragmarx/google2fa-laravel) — 2FA TOTP
* bacon/bacon-qr-code — Generate QR Code 2FA

---

## 🔹 SEO & Search

* Artesaos SEOTools — Meta tag management
* Spatie Laravel Sitemap — Generate sitemap.xml
* MySQL FULLTEXT — Advanced ranked search

---

## 🔹 Development Tools

* Laravel Sail — Docker environment
* Laravel Pint — Code formatter
* PHPUnit — Testing
* Faker — Dummy data

---

# Fitur Keamanan

* Password hashing (bcrypt)
* OAuth Google secure flow
* 2FA middleware verification
* Session regeneration
* Try–catch error handling
* Indexed database query

---

# Optimasi Performa

Database indexing:

* `slug` → unique
* `title` → index
* `user_id` → index
* `post_id` → index
* FULLTEXT(`title`, `content`)

Optimized query:

* Eager loading (`with()`)
* Pagination
* Relevance scoring
* Indexed filtering

---

# Advanced Full-Text Search

Menggunakan:

```sql
MATCH(title, content) AGAINST(?)
```

Fitur:

* Ranking score
* Boost title weight
* Order by relevance DESC
* Safe binding
* Pagination

---

# SEO Optimization

* Dynamic meta title & description
* OpenGraph & Twitter Card
* Structured Data (JSON-LD)
* `/sitemap.xml` auto-generated

---

# 2FA Flow

1. Login
2. Jika 2FA aktif → redirect `/2fa/verify`
3. Verifikasi kode Google Authenticator
4. Session `2fa_verified = true`
5. Middleware mengizinkan akses
