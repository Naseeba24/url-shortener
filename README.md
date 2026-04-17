# URL Shortener (Full-Stack Project)

## 📌 Overview
This is a simple full-stack URL Shortener application.  
It allows users to convert long URLs into short links and redirect users to the original URL when accessed.

---

## ⚙️ Features
- Shorten long URLs into unique short codes
- Redirect short links to original URLs
- Input validation (empty and invalid URL handling)
- Clean API-based architecture
- Simple frontend UI using Vue.js

---

## 🛠️ Tech Stack
- Frontend: Vue.js
- Backend: PHP
- Database: MySQL (Laragon / HeidiSQL)

---

## 📂 Project Structure
url-shortener/
│
├── backend/
│ ├── db.php
│ ├── shorten.php
│ ├── index.php
│
├── frontend/
│ ├── Vue project files
│
├── README.md

---

## 🗄️ Database Setup

Create database:

```sql
CREATE DATABASE url_shortener;

USE url_shortener;

CREATE TABLE links (
    id INT AUTO_INCREMENT PRIMARY KEY,
    long_url TEXT NOT NULL,
    short_code VARCHAR(10) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
🚀 How to Run Locally
1️⃣ Backend (PHP - Laragon)
Place project inside www folder
Start Apache + MySQL
Open: http://localhost/url-shortener/

## frontend
2️⃣ Frontend (Vue.js)
cd frontend
npm install
npm run dev