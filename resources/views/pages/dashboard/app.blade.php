<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        A Shoes Marketplace
    </title>
    <meta charset="utf-8" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="telephone=no" name="format-detection" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="TemplatesJungle" name="author" />
    <meta content="Online Store" name="keywords" />
    <meta content="Stylish - Shoes Online Store HTML Template" name="description" />
    <link href="{{ asset('css/vendor.css') }}" rel="stylesheet" />
    <link href="{{ asset('style.css') }}" rel="stylesheet" type="text/css" />
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;family=Playfair+Display:ital,wght@0,900;1,900&amp;family=Source+Sans+Pro:wght@400;600;700;900&amp;display=swap"
        rel="stylesheet" />
    <style>
        /* Global Styles */
        body {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%) !important;
            color: #e91e63 !important;
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
        }

        /* Header Styles */
        .header {
            background: rgba(0, 0, 0, 0.95) !important;
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(233, 30, 99, 0.2);
            box-shadow: 0 4px 20px rgba(233, 30, 99, 0.1);
        }

        /* Top Header */
        .header-top {
            background: linear-gradient(90deg, #e91e63, #f06292) !important;
        }

        .header-link {
            color: #fff !important;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .header-link:hover {
            color: #000 !important;
            transform: translateY(-1px);
        }

        .social-link {
            color: #fff !important;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            color: #000 !important;
            transform: scale(1.1);
        }

        /* Main Navigation */
        .navbar {
            background: rgba(0, 0, 0, 0.98) !important;
            padding: 15px 0;
        }

        .navbar-brand img {
            height: 45px;
            filter: brightness(0) invert(1);
        }

        .navbar-nav .nav-link {
            color: #e91e63 !important;
            font-weight: 600;
            font-size: 1rem;
            margin: 0 15px;
            padding: 10px 0 !important;
            position: relative;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: #f06292 !important;
            transform: translateY(-2px);
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #e91e63, #f06292);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .navbar-nav .nav-link:hover::after,
        .navbar-nav .nav-link.active::after {
            width: 100%;
        }

        /* Dropdown Menus */
        .dropdown-menu {
            background: rgba(0, 0, 0, 0.95) !important;
            border: 1px solid rgba(233, 30, 99, 0.2) !important;
            box-shadow: 0 10px 30px rgba(233, 30, 99, 0.2);
            backdrop-filter: blur(20px);
        }

        .dropdown-item {
            color: #e91e63 !important;
            padding: 12px 20px;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: rgba(233, 30, 99, 0.1) !important;
            color: #f06292 !important;
            transform: translateX(5px);
        }

        /* Buttons & Links */
        .btn,
        button,
        input[type="submit"] {
            background: linear-gradient(135deg, #e91e63, #f06292) !important;
            color: #fff !important;
            border: none !important;
            font-weight: 600;
            padding: 12px 25px;
            border-radius: 25px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn:hover,
        button:hover {
            background: linear-gradient(135deg, #c2185b, #e91e63) !important;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(233, 30, 99, 0.4);
        }

        .btn-link {
            background: none !important;
            color: #e91e63 !important;
            text-decoration: none;
            padding: 8px 15px;
        }

        /* Cards & Sections */
        .card,
        .product-card,
        .collection-card {
            background: rgba(0, 0, 0, 0.8) !important;
            border: 1px solid rgba(233, 30, 99, 0.2) !important;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(233, 30, 99, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card:hover,
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(233, 30, 99, 0.2);
            border-color: rgba(233, 30, 99, 0.5);
        }

        /* Text Elements */
        h1, h2, h3, h4, h5, h6 {
            color: #e91e63 !important;
            font-weight: 700;
            margin-bottom: 20px;
        }

        p, span, li, label {
            color: #b39ddb !important;
        }

        strong {
            color: #e91e63 !important;
        }

        /* Forms */
        .form-control,
        input,
        textarea {
            background: rgba(0, 0, 0, 0.8) !important;
            border: 1px solid rgba(233, 30, 99, 0.3) !important;
            color: #e91e63 !important;
            border-radius: 10px;
            padding: 12px 15px;
        }

        .form-control:focus,
        input:focus {
            border-color: #e91e63 !important;
            box-shadow: 0 0 10px rgba(233, 30, 99, 0.3) !important;
        }

        /* Modals */
        .modal-content {
            background: rgba(0, 0, 0, 0.95) !important;
            border: 1px solid rgba(233, 30, 99, 0.2) !important;
            border-radius: 15px;
        }

        .modal-header {
            border-bottom: 1px solid rgba(233, 30, 99, 0.2) !important;
        }

        /* Swiper */
        .swiper-pagination-bullet {
            background-color: rgba(233, 30, 99, 0.5) !important;
            opacity: 1;
        }

        .swiper-pagination-bullet-active {
            background-color: #e91e63 !important;
        }

        /* Hero Images */
        .jarallax-img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            border-radius: 15px;
        }

        /* SVG Icons */
        svg use,
        svg path {
            fill: #e91e63 !important;
        }

        /* Borders */
        .border-top,
        .border-bottom {
            border-color: rgba(233, 30, 99, 0.2) !important;
        }

        /* Coupon */
        .coupon .bold-text {
            background: linear-gradient(135deg, #e91e63, #f06292) !important;
            color: #fff !important;
            padding: 15px 20px;
            font-weight: 700;
            border-radius: 10px;
            display: inline-block;
        }

        /* Hover Effects */
        a {
            color: #e91e63 !important;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        a:hover {
            color: #f06292 !important;
        }

        /* Search */
        .search-box {
            background: rgba(0, 0, 0, 0.9) !important;
            border: 1px solid rgba(233, 30, 99, 0.2) !important;
            border-radius: 10px;
        }

        /* Price */
        .product-price {
            color: #4caf50 !important;
            font-weight: 700;
        }

        /* Hero Section */
        .hero-section {
            margin-top: 0 !important;
            min-height: 45vh;
        }

        .hero-card {
            background: rgba(0, 0, 0, 0.6) !important;
            border-radius: 20px !important;
            overflow: hidden;
            position: relative;
            min-height: 400px;
        }

        .hero-bg {
            position: absolute !important;
            top: 0;
            left: 0;
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            z-index: -1;
        }

        .hero-content {
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.8), rgba(233, 30, 99, 0.1)) !important;
            backdrop-filter: blur(10px);
            border-radius: 15px;
            border: 1px solid rgba(233, 30, 99, 0.3);
            max-width: 600px;
        }

        .hero-title {
            color: #fff !important;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            animation: fadeInUp 1s ease;
        }

        .hero-subtitle {
            color: #f06292 !important;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            animation: fadeInUp 1.2s ease;
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card,
        .product-card {
            animation: fadeInUp 0.6s ease;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-section {
                min-height: 35vh;
            }

            .hero-card {
                min-height: 300px;
            }

            .jarallax-img {
                height: 250px;
            }

            .hero-content {
                margin: 20px !important;
                padding: 20px !important;
            }

            .hero-title {
                font-size: 2rem !important;
            }
        }

        @media (max-width: 576px) {
            .hero-section {
                min-height: 30vh;
            }

            .hero-card {
                min-height: 250px;
            }

            .jarallax-img {
                height: 200px;
            }

            .hero-title {
                font-size: 1.5rem !important;
            }
        }
    </style>
</head>

<body>
    <svg style="display: none;" xmlns="http://www.w3.org/2000/svg">
        <symbol fill="none" id="shopping-carriage" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M5 22H19C20.103 22 21 21.103 21 20V9C21 8.73478 20.8946 8.48043 20.7071 8.29289C20.5196 8.10536 20.2652 8 20 8H17V7C17 4.243 14.757 2 12 2C9.243 2 7 4.243 7 7V8H4C3.73478 8 3.48043 8.10536 3.29289 8.29289C3.10536 8.48043 3 8.73478 3 9V20C3 21.103 3.897 22 5 22ZM9 7C9 5.346 10.346 4 12 4C13.654 4 15 5.346 15 7V8H9V7ZM5 10H7V12H9V10H15V12H17V10H19L19.002 20H5V10Z"
                fill="black">
            </path>
        </symbol>
        <symbol id="quick-view" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396l1.414-1.414l-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8s3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6s-6-2.691-6-6s2.691-6 6-6z"
                fill="currentColor">
            </path>
        </symbol>
        <symbol fill="none" id="shopping-cart" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M21 4H2V6H4.3L7.582 15.025C7.79362 15.6029 8.1773 16.1021 8.68134 16.4552C9.18539 16.8083 9.78556 16.9985 10.401 17H19V15H10.401C9.982 15 9.604 14.735 9.461 14.342L8.973 13H18.246C19.136 13 19.926 12.402 20.169 11.549L21.962 5.275C22.0039 5.12615 22.0109 4.96962 21.9823 4.81763C21.9537 4.66565 21.8904 4.52234 21.7973 4.39889C21.7041 4.27544 21.5837 4.1752 21.4454 4.106C21.3071 4.0368 21.1546 4.00053 21 4ZM18.246 11H8.246L6.428 6H19.675L18.246 11Z"
                fill="pink">
            </path>
            <path
                d="M10.5 21C11.3284 21 12 20.3284 12 19.5C12 18.6716 11.3284 18 10.5 18C9.67157 18 9 18.6716 9 19.5C9 20.3284 9.67157 21 10.5 21Z"
                fill="pink">
            </path>
            <path
                d="M16.5 21C17.3284 21 18 20.3284 18 19.5C18 18.6716 17.3284 18 16.5 18C15.6716 18 15 18.6716 15 19.5C15 20.3284 15.6716 21 16.5 21Z"
                fill="pink">
            </path>
        </symbol>
        <symbol id="nav-icon" viewbox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M14 10.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 .5-.5zm0-3a.5.5 0 0 0-.5-.5h-7a.5.5 0 0 0 0 1h7a.5.5 0 0 0 .5-.5zm0-3a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0 0 1h11a.5.5 0 0 0 .5-.5z">
            </path>
        </symbol>
        <symbol id="close" viewbox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z">
            </path>
        </symbol>
        <symbol id="navbar-icon" viewbox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M14 10.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 .5-.5zm0-3a.5.5 0 0 0-.5-.5h-7a.5.5 0 0 0 0 1h7a.5.5 0 0 0 .5-.5zm0-3a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0 0 1h11a.5.5 0 0 0 .5-.5z">
            </path>
        </symbol>
        <symbol id="plus" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z" fill="currentColor">
            </path>
        </symbol>
        <symbol id="minus" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M19 12.998H5v-2h14z" fill="currentColor">
            </path>
        </symbol>
        <symbol id="dropdown" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="m7 10l5 5l5-5H7Z" fill="currentColor">
            </path>
        </symbol>
        <symbol id="user" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M12 2a5 5 0 1 0 5 5a5 5 0 0 0-5-5zm0 8a3 3 0 1 1 3-3a3 3 0 0 1-3 3zm9 11v-1a7 7 0 0 0-7-7h-4a7 7 0 0 0-7 7v1h2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1z"
                fill="currentColor">
            </path>
        </symbol>
        <symbol id="arrow-right" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M13.3 17.275q-.3-.3-.288-.725t.313-.725L16.15 13H5q-.425 0-.713-.288T4 12q0-.425.288-.713T5 11h11.15L13.3 8.15q-.3-.3-.3-.713t.3-.712q.3-.3.713-.3t.712.3L19.3 11.3q.15.15.213.325t.062.375q0 .2-.063.375t-.212.325l-4.6 4.6q-.275.275-.687.275t-.713-.3Z"
                fill="currentColor">
            </path>
        </symbol>
        <symbol id="facebook" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M9.198 21.5h4v-8.01h3.604l.396-3.98h-4V7.5a1 1 0 0 1 1-1h3v-4h-3a5 5 0 0 0-5 5v2.01h-2l-.396 3.98h2.396v8.01Z"
                fill="currentColor">
            </path>
        </symbol>
        <symbol id="twitter" viewbox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M496 109.5a201.8 201.8 0 0 1-56.55 15.3a97.51 97.51 0 0 0 43.33-53.6a197.74 197.74 0 0 1-62.56 23.5A99.14 99.14 0 0 0 348.31 64c-54.42 0-98.46 43.4-98.46 96.9a93.21 93.21 0 0 0 2.54 22.1a280.7 280.7 0 0 1-203-101.3A95.69 95.69 0 0 0 36 130.4c0 33.6 17.53 63.3 44 80.7A97.5 97.5 0 0 1 35.22 199v1.2c0 47 34 86.1 79 95a100.76 100.76 0 0 1-25.94 3.4a94.38 94.38 0 0 1-18.51-1.8c12.51 38.5 48.92 66.5 92.05 67.3A199.59 199.59 0 0 1 39.5 405.6a203 203 0 0 1-23.5-1.4A278.68 278.68 0 0 0 166.74 448c181.36 0 280.44-147.7 280.44-275.8c0-4.2-.11-8.4-.31-12.5A198.48 198.48 0 0 0 496 109.5Z"
                fill="currentColor">
            </path>
        </symbol>
        <symbol id="youtube" viewbox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M29.41 9.26a3.5 3.5 0 0 0-2.47-2.47C24.76 6.2 16 6.2 16 6.2s-8.76 0-10.94.59a3.5 3.5 0 0 0-2.47 2.47A36.13 36.13 0 0 0 2 16a36.13 36.13 0 0 0 .59 6.74a3.5 3.5 0 0 0 2.47 2.47c2.18.59 10.94.59 10.94.59s8.76 0 10.94-.59a3.5 3.5 0 0 0 2.47-2.47A36.13 36.13 0 0 0 30 16a36.13 36.13 0 0 0-.59-6.74ZM13.2 20.2v-8.4l7.27 4.2Z"
                fill="currentColor">
            </path>
        </symbol>
        <symbol id="instagram" viewbox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M128 80a48 48 0 1 0 48 48a48.05 48.05 0 0 0-48-48Zm0 80a32 32 0 1 1 32-32a32 32 0 0 1-32 32Zm48-136H80a56.06 56.06 0 0 0-56 56v96a56.06 56.06 0 0 0 56 56h96a56.06 56.06 0 0 0 56-56V80a56.06 56.06 0 0 0-56-56Zm40 152a40 40 0 0 1-40 40H80a40 40 0 0 1-40-40V80a40 40 0 0 1 40-40h96a40 40 0 0 1 40 40ZM192 76a12 12 0 1 1-12-12a12 12 0 0 1 12 12Z"
                fill="currentColor">
            </path>
        </symbol>
        <symbol id="pinterest" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M9.04 21.54c.96.29 1.93.46 2.96.46a10 10 0 0 0 10-10A10 10 0 0 0 12 2A10 10 0 0 0 2 12c0 4.25 2.67 7.9 6.44 9.34c-.09-.78-.18-2.07 0-2.96l1.15-4.94s-.29-.58-.29-1.5c0-1.38.86-2.41 1.84-2.41c.86 0 1.26.63 1.26 1.44c0 .86-.57 2.09-.86 3.27c-.17.98.52 1.84 1.52 1.84c1.78 0 3.16-1.9 3.16-4.58c0-2.4-1.72-4.04-4.19-4.04c-2.82 0-4.48 2.1-4.48 4.31c0 .86.28 1.73.74 2.3c.09.06.09.14.06.29l-.29 1.09c0 .17-.11.23-.28.11c-1.28-.56-2.02-2.38-2.02-3.85c0-3.16 2.24-6.03 6.56-6.03c3.44 0 6.12 2.47 6.12 5.75c0 3.44-2.13 6.2-5.18 6.2c-.97 0-1.92-.52-2.26-1.13l-.67 2.37c-.23.86-.86 2.01-1.29 2.7v-.03Z"
                fill="currentColor">
            </path>
        </symbol>
        <symbol id="search" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396l1.414-1.414l-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8s3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6s-6-2.691-6-6s2.691-6 6-6z"
                fill="currentColor">
            </path>
        </symbol>
    </svg>
    <!-- Loader 4 -->
    <div class="preloader"
        style="position: fixed;top:0;left:0;width: 100%;height: 100%;background-color: #fff;display: flex;align-items: center;justify-content: center;z-index: 9999;">
        <svg enable-background="new 0 0 0 0" height="100" id="L4" version="1.1" viewbox="0 0 50 100"
            width="100" x="0px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" y="0px">
            <circle cx="6" cy="50" fill="#111" r="6" stroke="none">
                <animate attributename="opacity" begin="0.1" dur="1s" repeatcount="indefinite"
                    values="0;1;0">
                </animate>
            </circle>
            <circle cx="26" cy="50" fill="#111" r="6" stroke="none">
                <animate attributename="opacity" begin="0.2" dur="1s" repeatcount="indefinite"
                    values="0;1;0">
                </animate>
            </circle>
            <circle cx="46" cy="50" fill="#111" r="6" stroke="none">
                <animate attributename="opacity" begin="0.3" dur="1s" repeatcount="indefinite"
                    values="0;1;0">
                </animate>
            </circle>
        </svg>
    </div>
    <div class="search-box bg-dark position-relative">
        <div class="search-wrap">
            <div class="close-button">
                <svg class="close" style="fill: white;">
                    <use xlink:href="#close">
                    </use>
                </svg>
            </div>
            <form action="index.html" class="text-lg-center text-md-left pt-3" id="search-form" method="get">
                <input class="search-input" placeholder="Search..." type="text" />
                <svg class="search">
                    <use xlink:href="#search">
                    </use>
                </svg>
            </form>
        </div>
    </div>
    <!-- quick view -->
    <div aria-hidden="true" class="modal fade" id="modaltoggle" tabindex="-1">
        <div class="modal-dialog modal-fullscreen-md-down modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-lg-12 col-md-12 me-3">
                        <div class="image-holder">
                            <img alt="Shoes" src="{{ asset('images/summary-item1.jpg') }}" />
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="summary">
                            <div class="summary-content fs-6">
                                <div class="product-header d-flex justify-content-between mt-4">
                                    <h3 class="display-7">
                                        Running Shoes For Men
                                    </h3>
                                    <div class="modal-close-btn">
                                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"
                                            type="button">
                                        </button>
                                    </div>
                                </div>
                                <span class="product-price fs-3">
                                    $99
                                </span>
                                <div class="product-details">
                                    <p class="fs-7">
                                        Buy good shoes and a good mattress, because when you're not in one you're in the
                                        other. With four pairs of shoes, I can travel the world.
                                    </p>
                                </div>
                                <ul class="select">
                                    <li>
                                        <strong>
                                            Colour Shown:
                                        </strong>
                                        Red, White, Black
                                    </li>
                                    <li>
                                        <strong>
                                            Style:
                                        </strong>
                                        SM3018-100
                                    </li>
                                </ul>
                                <div class="variations-form shopify-cart">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="quantity d-flex pb-4">
                                                <div
                                                    class="qty-number align-top qty-number-plus d-flex justify-content-center align-items-center text-center">
                                                    <span class="increase-qty plus">
                                                        <svg class="plus">
                                                            <use xlink:href="#plus">
                                                            </use>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <input class="input-text text-center" id="quantity_001"
                                                    min="1" name="quantity" step="1" title="Qty"
                                                    type="number" value="1" />
                                                <div
                                                    class="qty-number qty-number-minus d-flex justify-content-center align-items-center text-center">
                                                    <span class="increase-qty minus">
                                                        <svg class="minus">
                                                            <use xlink:href="#minus">
                                                            </use>
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <a class="out-stock button" data-no-instant="" href="#"
                                                rel="nofollow">
                                                Out of stock
                                            </a>
                                            <button class="btn btn-medium btn-black hvr-sweep-to-right"
                                                type="submit">
                                                Add to cart
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- variations-form -->
                                <div class="categories d-flex flex-wrap pt-3">
                                    <strong class="pe-2">
                                        Categories:
                                    </strong>
                                    <a href="#" title="categories">
                                        Clothing,
                                    </a>
                                    <a href="#" title="categories">
                                        Men's Clothes,
                                    </a>
                                    <a href="#" title="categories">
                                        Tops &amp; T-Shirts
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / quick view -->
    <div aria-modal="true" class="modal fade" id="modallong" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-fullscreen-md-down modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5">
                        Cart
                    </h2>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="shopping-cart">
                        <div class="shopping-cart-content">
                            <div class="mini-cart cart-list p-0 mt-3">
                                <div class="mini-cart-item d-flex border-bottom pb-3">
                                    <div class="col-lg-2 col-md-3 col-sm-2 me-4">
                                        <a href="#" title="product-image">
                                            <img alt="single-product-item" class="img-fluid"
                                                src="{{ asset('images/single-product-thumb1.jpg') }}" />
                                        </a>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-8">
                                        <div
                                            class="product-header d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="product-title fs-6 me-5">
                                                Sport Shoes For Men
                                            </h4>
                                            <a aria-label="Remove this item" class="remove" data-cart_item_key="abc"
                                                data-product_id="11913" data-product_sku="" href="">
                                                <svg class="close">
                                                    <use xlink:href="#close">
                                                    </use>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="quantity-price d-flex justify-content-between align-items-center">
                                            <div class="input-group product-qty">
                                                <button
                                                    class="quantity-left-minus btn btn-light rounded-0 rounded-start btn-number"
                                                    data-type="minus" type="button">
                                                    <svg height="16" width="16">
                                                        <use xlink:href="#minus">
                                                        </use>
                                                    </svg>
                                                </button>
                                                <input class="form-control input-number quantity" name="quantity"
                                                    type="text" value="1" />
                                                <button
                                                    class="quantity-right-plus btn btn-light rounded-0 rounded-end btn-number"
                                                    data-type="plus" type="button">
                                                    <svg height="16" width="16">
                                                        <use xlink:href="#plus">
                                                        </use>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="price-code">
                                                <span class="product-price fs-6">
                                                    $99
                                                </span>
                                            </div>
                                        </div>
                                        <!-- quantity-price -->
                                    </div>
                                </div>
                            </div>
                            <div class="mini-cart cart-list p-0 mt-3">
                                <div class="mini-cart-item d-flex border-bottom pb-3">
                                    <div class="col-lg-2 col-md-3 col-sm-2 me-4">
                                        <a href="#" title="product-image">
                                            <img alt="single-product-item" class="img-fluid"
                                                src="{{ asset('images/single-product-thumb2.jpg') }}" />
                                        </a>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-8">
                                        <div
                                            class="product-header d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="product-title fs-6 me-5">
                                                Brand Shoes For Men
                                            </h4>
                                            <a aria-label="Remove this item" class="remove" data-cart_item_key="abc"
                                                data-product_id="11913" data-product_sku="" href="">
                                                <svg class="close">
                                                    <use xlink:href="#close">
                                                    </use>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="quantity-price d-flex justify-content-between align-items-center">
                                            <div class="input-group product-qty">
                                                <button
                                                    class="quantity-left-minus btn btn-light rounded-0 rounded-start btn-number"
                                                    data-type="minus" type="button">
                                                    <svg height="16" width="16">
                                                        <use xlink:href="#minus">
                                                        </use>
                                                    </svg>
                                                </button>
                                                <input class="form-control input-number quantity" name="quantity"
                                                    type="text" value="1" />
                                                <button
                                                    class="quantity-right-plus btn btn-light rounded-0 rounded-end btn-number"
                                                    data-type="plus" type="button">
                                                    <svg height="16" width="16">
                                                        <use xlink:href="#plus">
                                                        </use>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="price-code">
                                                <span class="product-price fs-6">
                                                    $99
                                                </span>
                                            </div>
                                        </div>
                                        <!-- quantity-price -->
                                    </div>
                                </div>
                            </div>
                            <!-- cart-list -->
                            <div class="mini-cart-total d-flex justify-content-between py-4">
                                <span class="fs-6">
                                    Subtotal:
                                </span>
                                <span class="special-price-code">
                                    <span class="price-amount amount fs-6" style="opacity: 1;">
                                        <bdi>
                                            <span class="price-currency-symbol">
                                                $
                                            </span>
                                            198.00
                                        </bdi>
                                    </span>
                                </span>
                            </div>
                            <div class="modal-footer my-4 justify-content-center">
                                <button class="btn btn-red hvr-sweep-to-right dark-sweep" type="button">
                                    View Cart
                                </button>
                                <button class="btn btn-outline-gray hvr-sweep-to-right dark-sweep" type="button">
                                    Checkout
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart view -->
    <div aria-modal="true" class="modal fade" id="modallogin" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-fullscreen-md-down modal-md modal-dialog-centered" role="document">
            <div class="modal-content p-4">
                <div class="modal-header mx-auto border-0">
                    <h2 class="modal-title fs-3 fw-normal">
                        Login
                    </h2>
                </div>
                <div class="modal-body">
                    <div class="login-detail">
                        <div class="login-form p-0">
                            <div class="col-lg-12 mx-auto">
                                <form id="login-form">
                                    <input class="mb-3 ps-3 text-input" name="username"
                                        placeholder="Username or Email Address *" type="text" />
                                    <input class="ps-3 text-input" name="password" placeholder="Password"
                                        type="password" />
                                    <div class="checkbox d-flex justify-content-between mt-4">
                                        <p class="checkbox-form">
                                            <label class="">
                                                <input id="remember-me" name="rememberme" type="checkbox"
                                                    value="forever" />
                                                Remember me
                                            </label>
                                        </p>
                                        <p class="lost-password">
                                            <a href="#">
                                                Forgot your password?
                                            </a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer mt-5 d-flex justify-content-center">
                            <button class="btn btn-red hvr-sweep-to-right dark-sweep" type="button">
                                Login
                            </button>
                            <button class="btn btn-outline-gray hvr-sweep-to-right dark-sweep" type="button">
                                Register
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login -->
    <header class="site-header header" id="header">
        <div class="header-top border-bottom py-2">
            <div class="container-lg">
                <div class="row justify-content-evenly">
                    <div class="col">
                        <ul class="social-links list-unstyled d-flex m-0">
                            <li class="pe-3">
                                <a href="#" class="social-link">
                                    <svg class="facebook" height="18" width="18">
                                        <use xlink:href="#facebook">
                                        </use>
                                    </svg>
                                </a>
                            </li>
                            <li class="pe-3">
                                <a href="#" class="social-link">
                                    <svg class="instagram" height="18" width="18">
                                        <use xlink:href="#instagram">
                                        </use>
                                    </svg>
                                </a>
                            </li>
                            <li class="pe-3">
                                <a href="#" class="social-link">
                                    <svg class="youtube" height="18" width="18">
                                        <use xlink:href="#youtube">
                                        </use>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="social-link">
                                    <svg class="pinterest" height="18" width="18">
                                        <use xlink:href="#pinterest">
                                        </use>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col">
                        <ul class="d-flex justify-content-end gap-4 list-unstyled m-0">
                            <li>
                                <a href="#" class="header-link">
                                    Contact
                                </a>
                            </li>
                            <li>
                                <a href="#" class="header-link">
                                    Cart
                                </a>
                            </li>
                            @auth
                                @if(auth()->user()->isAdmin())
                                <li>
                                    <a href="{{ route('admin.dashboard') }}" class="header-link fw-bold">
                                        Admin Panel
                                    </a>
                                </li>
                                @endif
                                <li>
                                    <form action="{{ route('logout') }}" method="post" class="d-inline">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-link p-0 text-decoration-none header-link">
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('login') }}" class="header-link">
                                        Login
                                    </a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg" id="header-nav">
            <div class="container-lg">
                <button aria-controls="bdNavbar" aria-expanded="false" aria-label="Toggle navigation"
                    class="navbar-toggler d-flex d-lg-none order-3 border-0 p-1 ms-2" data-bs-target="#bdNavbar"
                    data-bs-toggle="offcanvas" type="button">
                    <svg class="navbar-icon">
                        <use xlink:href="#navbar-icon">
                        </use>
                    </svg>
                </button>
                <div class="offcanvas offcanvas-end" id="bdNavbar" tabindex="-1">
                    <div class="offcanvas-header px-4 pb-0">
                        <a class="navbar-brand ps-3" href="{{ route('home') }}">
                            <h2 class="fw-bold m-0" style="color: #e91e63 !important; font-family: 'Playfair Display', serif;">
                                A Shoes
                            </h2>
                        </a>
                        <button aria-label="Close" class="btn-close btn-close-white p-5" data-bs-dismiss="offcanvas"
                            data-bs-target="#bdNavbar" type="button">
                        </button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav fw-bold justify-content-end align-items-center flex-grow-1"
                            id="navbar">
                            <li class="nav-item dropdown">
                                <a aria-expanded="false" class="nav-link me-5 active dropdown-toggle border-0"
                                    data-bs-toggle="dropdown" href="#">
                                    Home
                                </a>
                                <ul class="dropdown-menu fw-bold">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('home') }}">
                                            Home
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link me-5" href="#latest-products">
                                    Men
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link me-5" href="#latest-products">
                                    Women
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a aria-expanded="false" class="nav-link me-5 active dropdown-toggle border-0"
                                    data-bs-toggle="dropdown" href="#">
                                    Page
                                </a>
                                <ul class="dropdown-menu fw-bold">
                                    <li>
                                        <a class="dropdown-item" href="#latest-products">
                                            About Us
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#latest-products">
                                            Shop
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#latest-products">
                                            Blog
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="index.html">
                                            Single Product
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="index.html">
                                            Single Post
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="index.html">
                                            Styles
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" data-bs-target="#modallong" data-bs-toggle="modal"
                                            href="#">
                                            cart
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" data-bs-target="#modallogin" data-bs-toggle="modal"
                                            href="#">
                                            Login
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link me-5" href="#latest-products">
                                    Shop
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link me-5" href="#latest-products">
                                    Sale
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="user-items ps-0 ps-md-5">
                    <ul class="d-flex justify-content-end list-unstyled align-item-center m-0">
                        <li class="pe-3">
                            @auth
                                <a class="border-0" href="{{ route('admin.dashboard') }}" title="Profile">
                                    <svg class="user" height="24" width="24">
                                        <use xlink:href="#user">
                                        </use>
                                    </svg>
                                </a>
                            @else
                                <a class="border-0" data-bs-target="#modallogin" data-bs-toggle="modal" href="#" title="Login">
                                    <svg class="user" height="24" width="24">
                                        <use xlink:href="#user">
                                        </use>
                                    </svg>
                                </a>
                            @endauth
                        </li>
                        <li class="pe-3">
                            <a class="border-0" data-bs-target="#modallong" data-bs-toggle="modal" href="#" title="Cart">
                                <svg class="shopping-cart" height="24" width="24">
                                    <use xlink:href="#shopping-cart">
                                    </use>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a aria-label="Toggle search" class="search-item border-0"
                                data-bs-target="#search-box" data-bs-toggle="collapse" href="#" title="Search">
                                <svg class="search" height="24" width="24">
                                    <use xlink:href="#search">
                                    </use>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section class="position-relative hero-section" id="intro">
        <div class="container-lg">
            <div class="swiper main-swiper">
                <div class="swiper-wrapper">
                    @forelse($heroContents as $hero)
                    <div class="swiper-slide">
                        <div class=" hero-card card d-flex flex-row align-items-end border-0 large jarallax-keep-img">
                            @if($hero->background_image)
                                <img alt="{{ $hero->title }}" class="img-fluid jarallax-img hero-bg"
                                    src="{{ asset('storage/' . $hero->background_image) }}" />
                            @else
                                <img alt="{{ $hero->title }}" class="img-fluid jarallax-img hero-bg"
                                    src="{{ asset('images/card-image1.jpg') }}" />
                            @endif
                            <div class="hero-content cart-concern p-4 m-4 p-lg-5 m-lg-5">
                                <h1 class="hero-title card-title display-2 fw-bold mb-3 text-white">
                                    {{ $hero->title }}
                                </h1>
                                @if($hero->subtitle)
                                <p class="hero-subtitle card-subtitle h4 mb-4 text-white">
                                    {{ $hero->subtitle }}
                                </p>
                                @endif
                                @if($hero->description)
                                <p class="card-text light mb-4 text-white">
                                    {{ Str::limit($hero->description, 120) }}
                                </p>
                                @endif
                                @if($hero->button_text && $hero->button_url)
                                <a class="btn btn-outline-light btn-lg text-uppercase fw-bold px-4 py-2"
                                    href="{{ $hero->button_url }}">
                                    {{ $hero->button_text }}
                                </a>
                                @else
                                <a class="btn btn-outline-light btn-lg text-uppercase fw-bold px-4 py-2"
                                    href="#latest-products">
                                    Shop Now
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <!-- Default slide jika tidak ada hero content -->
                    <div class="swiper-slide">
                        <div class="hero-card card d-flex flex-row align-items-end border-0 large jarallax-keep-img">
                            <img alt="shoes" class="img-fluid jarallax-img hero-bg"
                                src="{{ asset('images/card-image1.jpg') }}" />
                            <div class="hero-content cart-concern p-4 m-4 p-lg-5 m-lg-5">
                                <h1 class="hero-title card-title display-2 fw-bold mb-3 text-white">
                                    Welcome to AShoes Infinity
                                </h1>
                                <p class="hero-subtitle card-subtitle h4 mb-4 text-white">
                                    Discover Premium Footwear Collection
                                </p>
                                <a class="btn btn-outline-light btn-lg text-uppercase fw-bold px-4 py-2"
                                    href="#latest-products">
                                    Shop Now
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
                <!-- Navigation buttons -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <!-- Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <!-- Custom CSS untuk memperbaiki tampilan -->
        <style>
            .hero-section {
                min-height: 70vh;
                overflow: hidden;
                padding: 0;
            }

            .main-swiper {
                width: 100%;
                height: 70vh;
                min-height: 500px;
                position: relative;
            }

            .swiper-slide {
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .hero-card {
                position: relative;
                width: 100%;
                height: 100%;
                min-height: 500px;
                overflow: hidden;
                border-radius: 15px;
                box-shadow: 0 20px 40px rgba(0,0,0,0.1);
                display: flex;
                align-items: flex-end;
                margin: 0 !important;
            }

            .hero-bg {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                z-index: 1;
            }

            .hero-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(45deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 70%, rgba(0,0,0,0.2) 100%);
                z-index: 2;
            }

            .hero-content {
                position: relative;
                z-index: 3;
                max-width: 700px;
                color: white;
                width: 100%;
                padding: 2rem 3rem 3rem 3rem !important;
                margin: 0 !important;
            }

            .hero-title {
                font-size: 3.5rem;
                line-height: 1.1;
                text-shadow: 2px 2px 8px rgba(0,0,0,0.7);
                margin-bottom: 1rem !important;
                font-weight: 800;
            }

            .hero-subtitle {
                font-size: 1.4rem;
                text-shadow: 1px 1px 4px rgba(0,0,0,0.7);
                margin-bottom: 1.5rem !important;
                opacity: 0.95;
            }

            .card-text {
                font-size: 1.1rem;
                text-shadow: 1px 1px 4px rgba(0,0,0,0.7);
                margin-bottom: 2rem !important;
                line-height: 1.6;
                opacity: 0.9;
            }

            .btn-outline-light {
                border: 2px solid white;
                color: white;
                background: rgba(255,255,255,0.15);
                backdrop-filter: blur(15px);
                transition: all 0.3s ease;
                padding: 0.75rem 2rem !important;
                font-weight: 600;
                border-radius: 50px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .btn-outline-light:hover {
                background: white;
                color: #333;
                transform: translateY(-3px);
                box-shadow: 0 15px 30px rgba(0,0,0,0.3);
                border-color: white;
            }

            .swiper-button-next,
            .swiper-button-prev {
                color: white;
                background: rgba(255,255,255,0.25);
                width: 55px;
                height: 55px;
                border-radius: 50%;
                backdrop-filter: blur(15px);
                border: 1px solid rgba(255,255,255,0.3);
                transition: all 0.3s ease;
            }

            .swiper-button-next:hover,
            .swiper-button-prev:hover {
                background: rgba(255,255,255,0.4);
                transform: scale(1.1);
            }

            .swiper-button-next::after,
            .swiper-button-prev::after {
                font-size: 18px;
                font-weight: bold;
            }

            .swiper-pagination {
                bottom: 20px !important;
            }

            .swiper-pagination-bullet {
                background: white;
                opacity: 0.6;
                width: 12px;
                height: 12px;
                margin: 0 6px;
                transition: all 0.3s ease;
            }

            .swiper-pagination-bullet-active {
                opacity: 1;
                background: #e91e63;
                transform: scale(1.3);
                box-shadow: 0 0 15px rgba(233, 30, 99, 0.5);
            }

            /* Responsive Design */
            @media (max-width: 768px) {
                .hero-card {
                    height: 60vh;
                    min-height: 400px;
                    border-radius: 10px;
                }

                .main-swiper {
                    height: 60vh;
                    min-height: 400px;
                }

                .hero-title {
                    font-size: 2.5rem;
                }

                .hero-subtitle {
                    font-size: 1.2rem;
                }

                .hero-content {
                    padding: 1.5rem 2rem 2rem 2rem !important;
                }

                .swiper-button-next,
                .swiper-button-prev {
                    width: 45px;
                    height: 45px;
                }
            }

            @media (max-width: 576px) {
                .hero-card {
                    border-radius: 8px;
                }

                .hero-title {
                    font-size: 2rem;
                }

                .hero-subtitle {
                    font-size: 1rem;
                }

                .card-text {
                    font-size: 0.9rem;
                }

                .hero-content {
                    padding: 1rem 1.5rem 1.5rem 1.5rem !important;
                }

                .btn-outline-light {
                    padding: 0.6rem 1.5rem !important;
                    font-size: 0.9rem;
                }
            }

            /* Product Grid Container */
            .product-content {
                max-width: 100%;
                overflow: hidden;
            }

            .product-content .row {
                margin: 0 -15px;
            }

            .product-content .col {
                padding: 0 15px;
                flex: 0 0 auto;
            }

            /* Enhanced Product Card Styling */
            .product-card {
                background: white;
                border-radius: 20px;
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
                transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
                overflow: hidden;
                border: 1px solid rgba(0, 0, 0, 0.05);
                height: 100%;
                min-height: 380px;
                max-height: 380px;
                width: 100%;
                display: flex;
                flex-direction: column;
            }

            .product-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
                border-color: rgba(233, 30, 99, 0.2);
            }

            .product-card .card-img {
                position: relative;
                overflow: hidden;
                border-radius: 16px 16px 0 0;
                height: 220px;
                min-height: 220px;
                max-height: 220px;
                width: 100%;
                background: #f8f9fa;
            }

            .product-card .product-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.5s ease;
                border-radius: 16px 16px 0 0;
            }

            .product-card:hover .product-image {
                transform: scale(1.08);
            }

            .product-card .cart-concern {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, rgba(233, 30, 99, 0.9), rgba(233, 30, 99, 0.7));
                opacity: 0;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 16px 16px 0 0;
            }

            .product-card:hover .cart-concern {
                opacity: 1;
            }

            .product-card .cart-button {
                transform: translateY(20px);
                transition: transform 0.3s ease 0.1s;
            }

            .product-card:hover .cart-button {
                transform: translateY(0);
            }

            .product-card .cart-button .btn {
                width: 45px;
                height: 45px;
                border-radius: 50%;
                border: none;
                background: white;
                color: #333;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            }

            .product-card .cart-button .btn:hover {
                background: #e91e63;
                color: white;
                transform: scale(1.1);
                box-shadow: 0 8px 25px rgba(233, 30, 99, 0.3);
            }

            .product-card .cart-button svg {
                width: 18px;
                height: 18px;
            }

            .product-card .card-detail {
                padding: 1.5rem 1.25rem 1.25rem;
                background: white;
                height: 160px;
                min-height: 160px;
                max-height: 160px;
                flex-grow: 1;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }

            .product-card .card-title {
                font-size: 1rem;
                font-weight: 600;
                color: #2d3748;
                margin-bottom: 0.75rem;
                line-height: 1.4;
                transition: color 0.3s ease;
            }

            .product-card .card-title a {
                text-decoration: none;
                color: inherit;
                transition: color 0.3s ease;
            }

            .product-card:hover .card-title a {
                color: #e91e63;
            }

            .product-card .card-price {
                font-size: 1.25rem;
                font-weight: 700;
                color: #e91e63;
                margin-top: auto;
            }

            /* Add to Cart Button in Card Detail */
            .product-card .btn-primary {
                background: linear-gradient(135deg, #e91e63, #ad1457);
                border: none;
                padding: 0.5rem 1rem;
                font-size: 0.8rem;
                font-weight: 600;
                border-radius: 20px;
                transition: all 0.3s ease;
                box-shadow: 0 4px 12px rgba(233, 30, 99, 0.3);
            }

            .product-card .btn-primary:hover {
                background: linear-gradient(135deg, #ad1457, #e91e63);
                transform: translateY(-2px);
                box-shadow: 0 6px 16px rgba(233, 30, 99, 0.4);
            }

            .product-card .btn-primary:active {
                transform: translateY(0);
                box-shadow: 0 4px 12px rgba(233, 30, 99, 0.3);
            }

            /* Badge untuk status produk */
            .product-badge {
                position: absolute;
                top: 12px;
                left: 12px;
                background: linear-gradient(135deg, #e91e63, #ad1457);
                color: white;
                padding: 0.375rem 0.75rem;
                border-radius: 20px;
                font-size: 0.75rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                z-index: 2;
                box-shadow: 0 4px 12px rgba(233, 30, 99, 0.3);
            }

            .product-badge.sale {
                background: linear-gradient(135deg, #ff6b35, #f7931e);
                box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);
            }

            .product-badge.new {
                background: linear-gradient(135deg, #4caf50, #2e7d32);
                box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
            }

            /* Rating stars */
            .product-rating {
                display: flex;
                align-items: center;
                gap: 0.25rem;
                margin-bottom: 0.5rem;
            }

            .product-rating .star {
                color: #ffc107;
                font-size: 0.875rem;
            }

            .product-rating .star.empty {
                color: #e9ecef;
            }

            .product-rating .rating-text {
                font-size: 0.75rem;
                color: #6c757d;
                margin-left: 0.5rem;
            }

            /* Responsive adjustments */
            @media (max-width: 992px) {
                .product-card {
                    min-height: 360px;
                    max-height: 360px;
                }

                .product-card .card-img {
                    height: 200px;
                    min-height: 200px;
                    max-height: 200px;
                }

                .product-card .card-detail {
                    height: 160px;
                    min-height: 160px;
                    max-height: 160px;
                    padding: 1.25rem 1rem 1rem;
                }

                .product-card .card-title {
                    font-size: 0.9rem;
                }

                .product-card .card-price {
                    font-size: 1.1rem;
                }
            }

            @media (max-width: 768px) {
                .product-card {
                    border-radius: 16px;
                    min-height: 340px;
                    max-height: 340px;
                }

                .product-card .card-img {
                    border-radius: 12px 12px 0 0;
                    height: 180px;
                    min-height: 180px;
                    max-height: 180px;
                }

                .product-card .card-detail {
                    height: 160px;
                    min-height: 160px;
                    max-height: 160px;
                }

                .product-card .product-image {
                    border-radius: 12px 12px 0 0;
                }

                .product-card .cart-concern {
                    border-radius: 12px 12px 0 0;
                }

                .product-card .cart-button .btn {
                    width: 40px;
                    height: 40px;
                }

                .product-card .cart-button svg {
                    width: 16px;
                    height: 16px;
                }
            }

            @media (max-width: 576px) {
                .product-card {
                    min-height: 320px;
                    max-height: 320px;
                }

                .product-card .card-img {
                    height: 160px;
                    min-height: 160px;
                    max-height: 160px;
                }

                .product-card .card-detail {
                    height: 160px;
                    min-height: 160px;
                    max-height: 160px;
                    padding: 1rem 0.75rem 0.75rem;
                }

                .product-card .card-title {
                    font-size: 0.85rem;
                    line-height: 1.3;
                }

                .product-rating {
                    margin-bottom: 0.75rem;
                }

                .rating-stars {
                    font-size: 0.8rem;
                }
            }

            /* Touch device optimizations */
            @media (hover: none) and (pointer: coarse) {
                .product-card .cart-concern {
                    opacity: 1;
                    transform: translateY(0);
                }

                .product-card:hover {
                    transform: none;
                }

                .product-card:hover .product-image {
                    transform: none;
                }

                .product-card .cart-button .btn {
                    width: 48px;
                    height: 48px;
                }

                .product-card .cart-button svg {
                    width: 20px;
                    height: 20px;
                }
            }

            /* Section spacing */
            #featured-products {
                margin-top: 4rem !important;
                padding: 2rem 0;
            }

            .section-title {
                font-weight: 700;
                color: #2d3748;
                margin-bottom: 0;
                position: relative;
            }

            .section-title::after {
                content: '';
                position: absolute;
                bottom: -8px;
                left: 0;
                width: 60px;
                height: 3px;
                background: linear-gradient(135deg, #e91e63, #ad1457);
                border-radius: 2px;
            }

            .display-header {
                margin-bottom: 3rem;
                padding-bottom: 1rem;
                border-bottom: 1px solid #e9ecef;
            }

            .btn-right a {
                color: #e91e63;
                text-decoration: none;
                font-weight: 600;
                transition: all 0.3s ease;
                position: relative;
            }

            .btn-right a::after {
                content: '→';
                margin-left: 0.5rem;
                transition: transform 0.3s ease;
            }

            .btn-right a:hover {
                color: #ad1457;
            }

            .btn-right a:hover::after {
                transform: translateX(4px);
            }
        </style>
    </section>
    <section class="product-store mt-5" id="featured-products">
        <div class="container-md">
            <div class="display-header d-flex align-items-center justify-content-between">
                <h2 class="section-title text-uppercase">
                    Featured Products
                </h2>
                <div class="btn-right">
                    <a class="d-inline-block text-uppercase text-hover fw-bold" href="index.html">
                        View all
                    </a>
                </div>
            </div>
            <div class="product-content padding-small">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
                    <div class="col mb-4">
                        <div class="product-card position-relative">
                            <div class="card-img">
                                <div class="product-badge new">New</div>
                                <img alt="product-item" class="product-image img-fluid"
                                    src="{{ asset('images/card-item1.jpg') }}" />
                                <div class="cart-concern position-absolute d-flex justify-content-center">
                                    <div class="cart-button d-flex gap-2 justify-content-center align-items-center">
                                        <button class="btn btn-light add-to-cart-btn"
                                            data-product-id="1"
                                            data-product-name="Running shoes for men"
                                            data-product-price="99"
                                            data-product-stock="10"
                                            type="button" title="Add to Cart">
                                            <svg class="shopping-carriage">
                                                <use xlink:href="#shopping-carriage">
                                                </use>
                                            </svg>
                                        </button>
                                        <button class="btn btn-light quick-view-btn"
                                            data-product-id="1"
                                            type="button" title="Quick View">
                                            <svg class="quick-view">
                                                <use xlink:href="#quick-view">
                                                </use>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <!-- cart-concern -->
                            </div>
                            <div class="card-detail d-flex flex-column">
                                <div class="product-rating">
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star empty">★</span>
                                    <span class="rating-text">(4.0)</span>
                                </div>
                                <h3 class="card-title fs-6 fw-normal m-0">
                                    <a href="index.html">
                                        Running shoes for men
                                    </a>
                                </h3>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="card-price fw-bold">
                                        $99
                                    </span>
                                    <button class="btn btn-primary btn-sm add-to-cart-btn"
                                        data-product-id="1"
                                        data-product-name="Running shoes for men"
                                        data-product-price="99"
                                        data-product-stock="10"
                                        type="button">
                                        <i class="fas fa-shopping-cart me-1"></i>Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-4">
                        <div class="product-card position-relative">
                            <div class="card-img">
                                <div class="product-badge sale">Sale</div>
                                <img alt="product-item" class="product-image img-fluid"
                                    src="{{ asset('images/card-item2.jpg') }}" />
                                <div class="cart-concern position-absolute d-flex justify-content-center">
                                    <div class="cart-button d-flex gap-2 justify-content-center align-items-center">
                                        <button class="btn btn-light add-to-cart-btn"
                                            data-product-id="2"
                                            data-product-name="Running shoes for men"
                                            data-product-price="99"
                                            data-product-stock="15"
                                            type="button" title="Add to Cart">
                                            <svg class="shopping-carriage">
                                                <use xlink:href="#shopping-carriage">
                                                </use>
                                            </svg>
                                        </button>
                                        <button class="btn btn-light quick-view-btn"
                                            data-product-id="2"
                                            type="button" title="Quick View">
                                            <svg class="quick-view">
                                                <use xlink:href="#quick-view">
                                                </use>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <!-- cart-concern -->
                            </div>
                            <div class="card-detail d-flex flex-column">
                                <div class="product-rating">
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="rating-text">(5.0)</span>
                                </div>
                                <h3 class="card-title fs-6 fw-normal m-0">
                                    <a href="index.html">
                                        Running shoes for men
                                    </a>
                                </h3>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="card-price fw-bold">
                                        $99
                                    </span>
                                    <button class="btn btn-primary btn-sm add-to-cart-btn"
                                        data-product-id="2"
                                        data-product-name="Running shoes for men"
                                        data-product-price="99"
                                        data-product-stock="15"
                                        type="button">
                                        <i class="fas fa-shopping-cart me-1"></i>Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-4">
                        <div class="product-card position-relative">
                            <div class="card-img">
                                <div class="product-badge">New</div>
                                <img alt="product-item" class="product-image img-fluid"
                                    src="{{ asset('images/card-item3.jpg') }}" />
                                <div class="cart-concern position-absolute d-flex justify-content-center">
                                    <div class="cart-button d-flex gap-2 justify-content-center align-items-center">
                                        <button class="btn btn-light add-to-cart-btn"
                                            data-product-id="3"
                                            data-product-name="Running shoes for men"
                                            data-product-price="99"
                                            data-product-stock="8"
                                            type="button" title="Add to Cart">
                                            <svg class="shopping-carriage">
                                                <use xlink:href="#shopping-carriage">
                                                </use>
                                            </svg>
                                        </button>
                                        <button class="btn btn-light quick-view-btn"
                                            data-product-id="3"
                                            type="button" title="Quick View">
                                            <svg class="quick-view">
                                                <use xlink:href="#quick-view">
                                                </use>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <!-- cart-concern -->
                            </div>
                            <div class="card-detail d-flex flex-column">
                                <div class="product-rating">
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star empty">★</span>
                                    <span class="rating-text">(3.8)</span>
                                </div>
                                <h3 class="card-title fs-6 fw-normal m-0">
                                    <a href="index.html">
                                        Running shoes for men
                                    </a>
                                </h3>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="card-price fw-bold">
                                        $99
                                    </span>
                                    <button class="btn btn-primary btn-sm add-to-cart-btn"
                                        data-product-id="3"
                                        data-product-name="Running shoes for men"
                                        data-product-price="99"
                                        data-product-stock="8"
                                        type="button">
                                        <i class="fas fa-shopping-cart me-1"></i>Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-4">
                        <div class="product-card position-relative">
                            <div class="card-img">
                                <div class="product-badge sale">Sale</div>
                                <img alt="product-item" class="product-image img-fluid"
                                    src="{{ asset('images/card-item4.jpg') }}" />
                                <div class="cart-concern position-absolute d-flex justify-content-center">
                                    <div class="cart-button d-flex gap-2 justify-content-center align-items-center">
                                        <button class="btn btn-light add-to-cart-btn"
                                            data-product-id="4"
                                            data-product-name="Running shoes for men"
                                            data-product-price="99"
                                            data-product-stock="12"
                                            type="button" title="Add to Cart">
                                            <svg class="shopping-carriage">
                                                <use xlink:href="#shopping-carriage">
                                                </use>
                                            </svg>
                                        </button>
                                        <button class="btn btn-light quick-view-btn"
                                            data-product-id="4"
                                            type="button" title="Quick View">
                                            <svg class="quick-view">
                                                <use xlink:href="#quick-view">
                                                </use>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <!-- cart-concern -->
                            </div>
                            <div class="card-detail d-flex flex-column">
                                <div class="product-rating">
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="rating-text">(4.8)</span>
                                </div>
                                <h3 class="card-title fs-6 fw-normal m-0">
                                    <a href="index.html">
                                        Running shoes for men
                                    </a>
                                </h3>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="card-price fw-bold">
                                        $99
                                    </span>
                                    <button class="btn btn-primary btn-sm add-to-cart-btn"
                                        data-product-id="4"
                                        data-product-name="Running shoes for men"
                                        data-product-price="99"
                                        data-product-stock="12"
                                        type="button">
                                        <i class="fas fa-shopping-cart me-1"></i>Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-4">
                        <div class="product-card position-relative">
                            <div class="card-img">
                                <div class="product-badge">New</div>
                                <img alt="product-item" class="product-image img-fluid"
                                    src="{{ asset('images/card-item5.jpg') }}" />
                                <div class="cart-concern position-absolute d-flex justify-content-center">
                                    <div class="cart-button d-flex gap-2 justify-content-center align-items-center">
                                        <button class="btn btn-light add-to-cart-btn"
                                            data-product-id="5"
                                            data-product-name="Running shoes for men"
                                            data-product-price="99"
                                            data-product-stock="6"
                                            type="button" title="Add to Cart">
                                            <svg class="shopping-carriage">
                                                <use xlink:href="#shopping-carriage">
                                                </use>
                                            </svg>
                                        </button>
                                        <button class="btn btn-light quick-view-btn"
                                            data-product-id="5"
                                            type="button" title="Quick View">
                                            <svg class="quick-view">
                                                <use xlink:href="#quick-view">
                                                </use>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <!-- cart-concern -->
                            </div>
                            <div class="card-detail d-flex flex-column">
                                <div class="product-rating">
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star empty">★</span>
                                    <span class="rating-text">(4.0)</span>
                                </div>
                                <h3 class="card-title fs-6 fw-normal m-0">
                                    <a href="index.html">
                                        Running shoes for men
                                    </a>
                                </h3>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="card-price fw-bold">
                                        $99
                                    </span>
                                    <button class="btn btn-primary btn-sm add-to-cart-btn"
                                        data-product-id="5"
                                        data-product-name="Running shoes for men"
                                        data-product-price="99"
                                        data-product-stock="6"
                                        type="button">
                                        <i class="fas fa-shopping-cart me-1"></i>Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product-store py-2 my-2 py-md-5 my-md-5 pt-0" id="latest-products">
        <div class="container-md">
            <div class="display-header d-flex align-items-center justify-content-between">
                <h2 class="section-title text-uppercase">
                    Latest Products
                </h2>
                <div class="btn-right">
                    <a class="d-inline-block text-uppercase text-hover fw-bold" href="index.html">
                        View all
                    </a>
                </div>
            </div>
            <div class="product-content padding-small">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
                    @forelse($latestProducts as $product)
                    <div class="col mb-4">
                        <div class="product-card position-relative">
                            @if($product->stock > 0 && $product->created_at >= now()->subDays(7))
                                <div class="product-badge">New</div>
                            @elseif($product->price < 100)
                                <div class="product-badge sale">Sale</div>
                            @endif
                            <div class="card-img">
                                @if($product->image)
                                    <img alt="{{ $product->name }}" class="product-image img-fluid"
                                        src="{{ asset('storage/' . $product->image) }}" />
                                @else
                                    <img alt="{{ $product->name }}" class="product-image img-fluid"
                                        src="{{ asset('images/card-item6.jpg') }}" />
                                @endif
                                <div class="cart-concern position-absolute d-flex justify-content-center">
                                    <div class="cart-button d-flex gap-2 justify-content-center align-items-center">
                                        <button class="btn btn-light add-to-cart-btn"
                                                data-product-id="{{ $product->id }}"
                                                data-product-name="{{ $product->name }}"
                                                data-product-price="{{ $product->price }}"
                                                data-product-stock="{{ $product->stock }}"
                                                title="Add to Cart"
                                                type="button">
                                            <svg class="shopping-carriage">
                                                <use xlink:href="#shopping-carriage">
                                                </use>
                                            </svg>
                                        </button>
                                        <button class="btn btn-light quick-view-btn"
                                                data-product-id="{{ $product->id }}"
                                                data-bs-target="#modaltoggle"
                                                data-bs-toggle="modal"
                                                title="Quick View"
                                                type="button">
                                            <svg class="quick-view">
                                                <use xlink:href="#quick-view">
                                                </use>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <!-- cart-concern -->
                                @if($product->stock <= 5 && $product->stock > 0)
                                    <div class="position-absolute top-0 end-0 m-2">
                                        <span class="badge bg-warning text-dark">Low Stock</span>
                                    </div>
                                @elseif($product->stock == 0)
                                    <div class="position-absolute top-0 end-0 m-2">
                                        <span class="badge bg-danger">Out of Stock</span>
                                    </div>
                                @endif
                            </div>
                            <div class="card-detail mt-3">
                                <h3 class="card-title fs-6 fw-normal m-0">
                                    <a href="#" title="{{ $product->name }}">
                                        {{ \Illuminate\Support\Str::limit($product->name, 25) }}
                                    </a>
                                </h3>
                                <div class="product-rating mb-2">
                                    <span class="rating-stars">
                                        <i class="star filled">★</i>
                                        <i class="star filled">★</i>
                                        <i class="star filled">★</i>
                                        <i class="star filled">★</i>
                                        <i class="star">★</i>
                                    </span>
                                    <span class="rating-text">(4.0)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="card-price fw-bold">
                                        ${{ number_format($product->price, 0) }}
                                    </span>
                                    @if($product->category)
                                        <span class="badge bg-secondary text-light small">{{ $product->category->name }}</span>
                                    @endif
                                </div>
                                @if($product->brand)
                                    <div class="mt-2">
                                        <small class="text-muted">{{ $product->brand }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <p class="text-muted">No products available at the moment.</p>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize main hero swiper
            if (document.querySelector('.main-swiper')) {
                const mainSwiper = new Swiper('.main-swiper', {
                    // Navigation arrows
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    // Pagination
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    // Settings
                    loop: true,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    effect: 'slide',
                    speed: 800,
                    spaceBetween: 0,
                    slidesPerView: 1,
                    // Responsive breakpoints
                    breakpoints: {
                        768: {
                            speed: 1000,
                        }
                    }
                });
            }
        });
    </script>

    <!-- Cart functionality -->
    <script>
        $(document).ready(function() {
            // Add CSRF token to all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Add to cart functionality
            $('.add-to-cart-btn').on('click', function(e) {
                e.preventDefault();

                const productId = $(this).data('product-id');
                const productName = $(this).data('product-name');
                const productPrice = $(this).data('product-price');
                const productStock = $(this).data('product-stock');

                // Check if user is logged in
                @guest
                    alert('Please login to add items to cart');
                    window.location.href = "{{ route('login') }}";
                    return;
                @endguest

                // Check stock availability
                if (productStock <= 0) {
                    alert('Sorry, this product is out of stock');
                    return;
                }

                const button = $(this);
                const originalHtml = button.html();

                // Show loading state
                button.html('<div class="spinner-border spinner-border-sm" role="status"></div>');
                button.prop('disabled', true);

                // Send AJAX request
                $.ajax({
                    url: '{{ route("cart.add") }}',
                    method: 'POST',
                    data: {
                        product_id: productId,
                        quantity: 1
                    },
                    success: function(response) {
                        if (response.success) {
                            // Show success message
                            showSuccessAlert(productName + ' added to cart successfully!');

                            // Update cart count if counter exists
                            updateCartCount();
                        } else {
                            alert(response.message || 'Error adding product to cart');
                        }
                    },
                    error: function(xhr) {
                        const response = xhr.responseJSON;
                        alert(response?.message || 'Error adding product to cart');
                    },
                    complete: function() {
                        // Restore button state
                        button.html(originalHtml);
                        button.prop('disabled', false);
                    }
                });
            });

            // Quick view functionality
            $('.quick-view-btn').on('click', function(e) {
                const productId = $(this).data('product-id');
                // TODO: Load product details in modal
                console.log('Quick view for product:', productId);
            });

            // Success alert function
            function showSuccessAlert(message) {
                // Remove existing alerts
                $('.success-alert').remove();

                // Create alert
                const alert = $(`
                    <div class="success-alert position-fixed top-0 end-0 m-3" style="z-index: 9999;">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            ${message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                `);

                $('body').append(alert);

                // Auto-hide after 3 seconds
                setTimeout(function() {
                    alert.fadeOut(function() {
                        $(this).remove();
                    });
                }, 3000);
            }

            // Update cart count
            function updateCartCount() {
                $.get('{{ route("cart.count") }}', function(data) {
                    $('.cart-count').text(data.count);
                }).fail(function() {
                    console.log('Failed to update cart count');
                });
            }
        });
    </script>

    <!-- Add meta tag for CSRF token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</body>

</html>
