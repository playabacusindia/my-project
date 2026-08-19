# 🎯 Play Abacus India — My Project

**Ideal Play Abacus India Pvt Ltd** | Static HTML Website

## 🔗 Social Links

| Platform  | URL |
|-----------|-----|
| Facebook  | https://www.facebook.com/idealplayabacusindiapvtltd/ |
| Instagram | https://www.instagram.com/ideal_play_abacus_india/ |
| Twitter/X | https://x.com/PlayAbacus |
| LinkedIn  | https://www.linkedin.com/in/ideal-play-abacus-india/ |
| YouTube   | https://www.youtube.com/@idealplayabacusindia |

---

## 🚀 Build & Deploy Commands

### 📦 Install Dependencies

```bash
npm install
```

### 🔨 Build (Local Development)

This is a static HTML project using Gulp. Run the default Gulp task:

```bash
npx gulp
```

> No bundling needed — HTML files are served directly as-is.

### 🌐 Deploy to GitHub Pages

Deployment is **automatic via GitHub Actions** when you push to the `main` branch.

```bash
# Step 1: Stage all your changes
git add .

# Step 2: Write a commit message
git commit -m "your message here"

# Step 3: Push to main branch → triggers auto-deploy
git push origin main
```

> ✅ After pushing, GitHub Actions will automatically:
> 1. Copy all `.html` files and the `assets/` folder to the `site/` directory
> 2. Upload and deploy to **GitHub Pages**
> 3. Your site will be live at your GitHub Pages URL

### 🔁 Manual Deploy (from GitHub Actions tab)

You can also trigger a deploy manually:
1. Go to your GitHub repo → **Actions** tab
2. Select **"Deploy static content to Pages"**
3. Click **"Run workflow"** → **"Run workflow"** button

---

## ☁️ Cloudflare Pages — Deploy

This project is deployed as a **static site** via **Cloudflare Pages**.

### 🔧 One-Time Setup

```bash
# Install Wrangler CLI (Cloudflare's tool)
npm install -g wrangler

# Login to your Cloudflare account
npx wrangler login
```

### 🔨 Build Command

Runs Gulp to copy all HTML + assets into the `dist/` output folder:

```bash
npx gulp
```

> This copies all `.html` files, `assets/`, `india/`, `Australia/`, `UAE/`, `Zimbabwe/`, `southafrica/`, `blog/` and `template/` folders into `dist/`

### 🚀 Deploy Command

Deploys the `dist/` folder to Cloudflare Pages:

```bash
npx wrangler pages deploy dist --project-name=my-project
```

### 📋 Cloudflare Pages Dashboard Settings

| Field | Value |
|-------|-------|
| **Project Name** | `my-project` |
| **Build Command** | `npx gulp` |
| **Deploy Command** | `npx wrangler pages deploy dist --project-name=my-project` |
| **Output Directory** | `dist` |
| **Account** | `Idealplayabacus20@gmail.com` |

> ✅ Cloudflare Pages auto-deploys when you push to GitHub — no manual deploy needed!

---

## ☁️ Cloudflare CDN Links (cdnjs.cloudflare.com)

All libraries are loaded via **Cloudflare's free CDN** (`cdnjs.cloudflare.com`).  
Copy-paste these tags directly into your HTML `<head>` (CSS) and before `</body>` (JS).

---

### 🎨 CSS — Paste inside `<head>`

```html
<!-- Font Awesome 7.0.1 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

<!-- Bootstrap Icons 1.13.1 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css">

<!-- Tiny Slider 2.9.4 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">
```

---

### ⚙️ JS — Paste before `</body>`

```html
<!-- Bootstrap 5.3.3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"
  integrity="sha512-7Pi/otdlr42QRB28bMIg0O+E5J2VGAbFdBxEVqpfEi0UQKN1FIbfq7kMi0RJUa2jRY8o0ynDg3HqOzN2gRR1w=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- jQuery Isotope 3.0.6 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"
  integrity="sha512-Zq2BOxyhvnRFXu0+WE6ojpZLOU2jdnqbrM1hmVdGzyeCa1DgM3X5Q4A/Is9xA1IkbUeDd7755dNNI/PzSf2Pew=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- jQuery ImagesLoaded 4.1.4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.4/imagesloaded.js"
  integrity="sha512-ZjK7a00dTbrRt4c0efsVC+IM+AZRSW1NpGNNbXQQTjjp3N3Q2FJ0Mg8XTIoyNwWcton/qjf40SnI/g/2OMKiYA=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Tiny Slider 2.9.4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js"
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Choices.js 10.2.0 (optional — used in select dropdowns) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/choices.js/10.2.0/choices.js"
  integrity="sha512-V0s+xMo96qxq9oaDb+oHF+yqn4BLPnehZQlo7Vw6wYPjGADIyZ7uSQrAEHD8OWfBg/kalcr6h3GKIlNX78AyJA=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
```

---

### 📋 Quick Reference Table

| Library | Type | Version | Full Cloudflare CDN URL |
|---------|------|---------|------------------------|
| Font Awesome | CSS | 7.0.1 | `https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css` |
| Bootstrap Icons | CSS | 1.13.1 | `https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css` |
| Tiny Slider | CSS | 2.9.4 | `https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css` |
| Bootstrap | JS | 5.3.3 | `https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js` |
| jQuery Isotope | JS | 3.0.6 | `https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js` |
| jQuery ImagesLoaded | JS | 4.1.4 | `https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.4/imagesloaded.js` |
| Tiny Slider | JS | 2.9.4 | `https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js` |
| Choices.js | JS | 10.2.0 | `https://cdnjs.cloudflare.com/ajax/libs/choices.js/10.2.0/choices.js` |



# cPanel Deployment Guide: Enquiry Modal Backend

Follow these instructions to successfully deploy the backend changes on your MochaHost cPanel account.

## 1. Required Files and Layout

Ensure the following files are uploaded to your `public_html` directory (or the root folder of your website on cPanel):

```text
public_html/
│
├── index.html                 <-- Updated with Modal, Toast, and AJAX JS
├── send_enquiry.php           <-- New Backend PHP Processing Script
└── PHPMailer/                 <-- **NEW REQUIRED FOLDER** (See Step 2)
    └── src/
        ├── Exception.php
        ├── PHPMailer.php
        └── SMTP.php
```

## 2. Installing PHPMailer

Because you are using an authenticated SMTP connection over port 465 (MochaHost), PHP's standard `mail()` function will fail or lack security. **You must install PHPMailer.**

**How to get PHPMailer manually:**
1. Download the latest PHPMailer ZIP from [GitHub](https://github.com/PHPMailer/PHPMailer/archive/master.zip).
2. Extract the ZIP file locally on your computer.
3. Locate the `src` folder inside the extracted files.
4. Upload this `src` folder to your cPanel File Manager and rename its parent directory to `PHPMailer`. So the path becomes `public_html/PHPMailer/src/...`

## 3. Configure Your Password

Open the uploaded `send_enquiry.php` file using the **cPanel File Manager -> Edit** tool. 
Locate **line 38**:
```php
$mail->Password   = 'YOUR_EMAIL_PASSWORD_HERE'; 
```
Replace `YOUR_EMAIL_PASSWORD_HERE` with the actual password for `contact@playabacusindia.com`. Save your changes.

## 4. Final Testing

1. Clear your browser cache or open an Incognito Window.
2. Load the website and click the **"Enquiry Now"** button in the top navigation.
3. Fill out the form and submit it.
4. Ensure the modal closes, the Toast popup appears saying "Thx for the Enquiry Now soon our ipa team will contact you asps".
5. Log into MochaHost webmail for `contact@playabacusindia.com` and ensure the email arrived correctly.