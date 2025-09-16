<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Quick Report - SafeSpace</title>
        <meta name="description" content="SafeSpace is a secure platform for anonymous reporting of abuse, bullying, harassment, and other safety concerns.">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=poppins:400,500,600,700" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else            <style>
                /*! SafeSpace Advanced Professional Styles for Kids */
                @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap');
                :root {
                    --primary-color: #059669;
                    --primary-dark: #047857;
                    --primary-light: #10b981;
                    --secondary-color: #6b7280;
                    --success-color: #10b981;
                    --warning-color: #f59e0b;
                    --error-color: #ef4444;
                    --background-light: #f9fafb;
                    --background-white: #ffffff;
                    --background-cream: #f8fafc;
                    --text-primary: #1f2937;
                    --text-secondary: #6b7280;
                    --text-muted: #9ca3af;
                    --border-color: #e5e7eb;
                    --accent-green: #34d399;
                    --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
                    --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
                    --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
                    --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 10px 10px -5px rgb(0 0 0 / 0.04);
                    --gradient-primary: linear-gradient(135deg, #059669 0%, #10b981 100%);
                    --gradient-background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 50%, #a7f3d0 100%);
                }

                * {
                    box-sizing: border-box;
                    margin: 0;
                    padding: 0;
                }
                body {
                    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
                    background: var(--gradient-background);
                    min-height: 100vh;
                    color: var(--text-primary);
                    line-height: 1.6;
                    overflow-x: hidden;
                }

                .container {
                    max-width: 800px;
                    margin: 0 auto;
                    padding: 0 1rem;
                }

                /* Header Styles */
                .header {
                    background: rgba(255, 255, 255, 0.95);
                    backdrop-filter: blur(20px);
                    box-shadow: var(--shadow-sm);
                    position: sticky;
                    top: 0;
                    z-index: 100;
                    border-bottom: 1px solid var(--border-color);
                    animation: slideDown 0.5s ease-out;
                }

                .nav {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 1rem 0;
                }

                .logo {
                    font-family: 'Poppins', sans-serif;
                    font-size: 1.5rem;
                    font-weight: 700;
                    color: var(--primary-color);
                    display: flex;
                    align-items: center;
                    gap: 0.5rem;
                }

                .nav-links {
                    display: flex;
                    gap: 1rem;
                    list-style: none;
                }

                .hamburger {
                    display: none;
                    flex-direction: column;
                    cursor: pointer;
                    padding: 0.5rem;
                    border-radius: 0.5rem;
                    transition: background 0.3s ease;
                }
                .hamburger:hover {
                    background: var(--background-light);
                }
                .hamburger span {
                    width: 25px;
                    height: 3px;
                    background: var(--primary-color);
                    margin: 3px 0;
                    transition: all 0.3s ease;
                    border-radius: 2px;
                }
                .hamburger.open span:nth-child(1) {
                    transform: rotate(-45deg) translate(-5px, 6px);
                }
                .hamburger.open span:nth-child(2) {
                    opacity: 0;
                }
                .hamburger.open span:nth-child(3) {
                    transform: rotate(45deg) translate(-5px, -6px);
                }

                .nav-link {
                    color: var(--text-secondary);
                    text-decoration: none;
                    font-weight: 500;
                    padding: 0.5rem 1rem;
                    border-radius: 0.5rem;
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    position: relative;
                }
                .nav-link:hover {
                    color: var(--primary-color);
                    background: var(--background-light);
                    transform: translateY(-2px);
                }
                .nav-link::after {
                    content: '';
                    position: absolute;
                    bottom: 0;
                    left: 50%;
                    width: 0;
                    height: 2px;
                    background: var(--primary-color);
                    transition: all 0.3s;
                    transform: translateX(-50%);
                }
                .nav-link:hover::after {
                    width: 100%;
                }

                .btn {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    padding: 0.75rem 1.5rem;
                    border-radius: 0.75rem;
                    font-weight: 600;
                    text-decoration: none;
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    border: none;
                    cursor: pointer;
                    font-size: 0.875rem;
                    position: relative;
                    overflow: hidden;
                }
                .btn::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: -100%;
                    width: 100%;
                    height: 100%;
                    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
                    transition: left 0.5s;
                }
                .btn:hover::before {
                    left: 100%;
                }

                .btn-primary {
                    background: var(--gradient-primary);
                    color: white;
                    box-shadow: var(--shadow-md);
                }
                .btn-primary:hover {
                    background: var(--gradient-primary);
                    transform: translateY(-3px);
                    box-shadow: var(--shadow-xl);
                }

                /* Form Styles */
                .form-section {
                    padding: 2rem 0;
                }

                .form-card {
                    background: var(--background-white);
                    padding: 2rem;
                    border-radius: 1.5rem;
                    box-shadow: var(--shadow-xl);
                    max-width: 700px;
                    margin: 0 auto;
                    border: 1px solid rgba(5, 150, 105, 0.1);
                    position: relative;
                    overflow: hidden;
                }
                .form-card::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    height: 4px;
                    background: var(--gradient-primary);
                }

                .form-card h2 {
                    font-family: 'Poppins', sans-serif;
                    font-size: 1.75rem;
                    font-weight: 700;
                    text-align: center;
                    color: var(--text-primary);
                    margin-bottom: 2rem;
                    position: relative;
                }
                .form-card h2::after {
                    content: '';
                    position: absolute;
                    bottom: -10px;
                    left: 50%;
                    transform: translateX(-50%);
                    width: 60px;
                    height: 3px;
                    background: var(--primary-color);
                    border-radius: 2px;
                }

                .form-group {
                    margin-bottom: 2rem;
                    padding: 1.5rem;
                    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
                    border-radius: 1rem;
                    border: 1px solid var(--border-color);
                    transition: all 0.3s ease;
                    position: relative;
                }
                .form-group:hover {
                    transform: translateY(-2px);
                    box-shadow: var(--shadow-lg);
                    border-color: var(--primary-light);
                }
                .form-group h3 {
                    font-size: 1.25rem;
                    font-weight: 600;
                    color: var(--text-primary);
                    margin-bottom: 0.5rem;
                    display: flex;
                    align-items: center;
                    gap: 0.5rem;
                }
                .form-group h3 i {
                    color: var(--primary-color);
                    font-size: 1.5rem;
                }
                .form-group p {
                    font-size: 0.9rem;
                    color: var(--text-secondary);
                    margin-bottom: 1rem;
                    line-height: 1.5;
                }

                .form-label {
                    display: block;
                    font-weight: 600;
                    color: var(--text-primary);
                    margin-bottom: 0.5rem;
                    font-size: 0.95rem;
                }

                .form-input, .form-select, .form-textarea {
                    width: 100%;
                    padding: 0.875rem 1rem;
                    border: 2px solid var(--border-color);
                    border-radius: 0.75rem;
                    font-size: 1rem;
                    transition: all 0.3s ease;
                    background: var(--background-white);
                    color: var (--text-primary);
                }
                .form-input:focus, .form-select:focus, .form-textarea:focus {
                    outline: none;
                    border-color: var(--primary-color);
                    box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
                    transform: scale(1.02);
                }
                .form-input:hover, .form-select:hover, .form-textarea:hover {
                    border-color: var(--primary-light);
                }

                .form-textarea {
                    resize: vertical;
                    min-height: 120px;
                    line-height: 1.6;
                }

                .form-select {
                    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
                    background-position: right 0.75rem center;
                    background-repeat: no-repeat;
                    background-size: 1rem;
                    padding-right: 2.5rem;
                }

                .grid-2 {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 1rem;
                }
                @media (max-width: 640px) {
                    .grid-2 {
                        grid-template-columns: 1fr;
                    }
                }

                .checkbox-label {
                    display: flex;
                    align-items: center;
                    cursor: pointer;
                    font-size: 1rem;
                    font-weight: 500;
                    gap: 0.75rem;
                    padding: 0.5rem;
                    border-radius: 0.5rem;
                    transition: background 0.3s ease;
                }
                .checkbox-label:hover {
                    background: rgba(5, 150, 105, 0.05);
                }

                .checkbox-input {
                    width: 1.25rem;
                    height: 1.25rem;
                    accent-color: var(--primary-color);
                    border-radius: 0.25rem;
                }

                .reporter-info {
                    animation: slideIn 0.5s ease-out;
                }

                .form-submit {
                    text-align: center;
                    margin-top: 2rem;
                }

                .btn-submit {
                    background: var(--gradient-primary);
                    color: white;
                    padding: 1.25rem 3rem;
                    border-radius: 1rem;
                    font-size: 1.25rem;
                    font-weight: 700;
                    border: none;
                    cursor: pointer;
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    display: inline-flex;
                    align-items: center;
                    gap: 0.75rem;
                    box-shadow: var(--shadow-lg);
                    position: relative;
                    overflow: hidden;
                }
                .btn-submit::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: -100%;
                    width: 100%;
                    height: 100%;
                    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
                    transition: left 0.6s;
                }
                .btn-submit:hover::before {
                    left: 100%;
                }
                .btn-submit:hover {
                    transform: translateY(-3px) scale(1.05);
                    box-shadow: var(--shadow-xl);
                }
                .btn-submit:active {
                    transform: translateY(-1px) scale(1.02);
                }

                /* Footer */
                .footer {
                    background: var(--gradient-primary);
                    color: white;
                    padding: 2rem 0;
                    text-align: center;
                    margin-top: 4rem;
                    position: relative;
                }
                .footer::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    height: 4px;
                    background: rgba(255,255,255,0.2);
                }

                .footer p {
                    font-size: 0.875rem;
                    opacity: 0.9;
                }

                .footer a {
                    color: white;
                    text-decoration: underline;
                    transition: opacity 0.3s;
                }
                .footer a:hover {
                    opacity: 0.7;
                }

                /* Animations */
                @keyframes fadeIn {
                    from { opacity: 0; transform: translateY(20px); }
                    to { opacity: 1; transform: translateY(0); }
                }
                @keyframes slideDown {
                    from { transform: translateY(-100%); }
                    to { transform: translateY(0); }
                }
                @keyframes slideIn {
                    from { opacity: 0; transform: translateX(-20px); }
                    to { opacity: 1; transform: translateX(0); }
                }
                .fade-in {
                    animation: fadeIn 0.6s ease-out;
                }
                .hover-scale {
                    transition: transform 0.3s ease;
                }
                .hover-scale:hover {
                    transform: scale(1.02);
                }

                /* Responsive */
                @media (max-width: 768px) {
                    .container {
                        padding: 0 0.5rem;
                    }
                    .form-card {
                        padding: 1.5rem;
                        margin: 0 0.5rem;
                        border-radius: 1rem;
                    }
                    .form-card h2 {
                        font-size: 1.5rem;
                        margin-bottom: 1.5rem;
                    }
                    .form-group {
                        padding: 1rem;
                        margin-bottom: 1.5rem;
                    }
                    .form-group h3 {
                        font-size: 1.1rem;
                    }
                    .form-group p {
                        font-size: 0.85rem;
                        margin-bottom: 0.75rem;
                    }
                    .btn-submit {
                        padding: 1rem 2rem;
                        font-size: 1.1rem;
                    }
                    .nav {
                        flex-direction: row;
                        gap: 1rem;
                        justify-content: space-between;
                    }
                    .nav-links {
                        position: absolute;
                        top: 100%;
                        left: 0;
                        right: 0;
                        background: rgba(255, 255, 255, 0.95);
                        backdrop-filter: blur(20px);
                        flex-direction: column;
                        padding: 1rem 0;
                        box-shadow: var(--shadow-md);
                        border-bottom: 1px solid var(--border-color);
                        display: none;
                        z-index: 99;
                    }
                    .nav-links li {
                        text-align: center;
                        margin: 0.5rem 0;
                    }
                    .hamburger {
                        display: flex;
                    }
                    .logo {
                        font-size: 1.25rem;
                    }
                }

                @media (max-width: 640px) {
                    .form-card {
                        padding: 1rem;
                        margin: 0 0.25rem;
                    }
                    .form-card h2 {
                        font-size: 1.25rem;
                    }
                    .form-group {
                        padding: 0.75rem;
                        margin-bottom: 1rem;
                    }
                    .form-group h3 {
                        font-size: 1rem;
                    }
                    .form-group h3 i {
                        font-size: 1.25rem;
                    }
                    .form-group p {
                        font-size: 0.8rem;
                    }
                    .form-input, .form-select, .form-textarea {
                        padding: 0.75rem 0.875rem;
                        font-size: 0.95rem;
                    }
                    .form-textarea {
                        min-height: 100px;
                    }
                    .btn-submit {
                        padding: 0.875rem 1.5rem;
                        font-size: 1rem;
                    }
                    .checkbox-label {
                        font-size: 0.9rem;
                        padding: 0.375rem;
                    }
                    .checkbox-input {
                        width: 1.1rem;
                        height: 1.1rem;
                    }
                    .footer {
                        padding: 1.5rem 0;
                    }
                    .footer p {
                        font-size: 0.8rem;
                    }
                    .hamburger {
                        display: flex;
                    }
                    .nav-links {
                        display: none;
                    }
                }

                @media (max-width: 480px) {
                    .container {
                        padding: 0 0.25rem;
                    }
                    .form-section {
                        padding: 1rem 0;
                    }
                    .form-card {
                        padding: 0.75rem;
                        margin: 0;
                        border-radius: 0.75rem;
                    }
                    .form-card h2 {
                        font-size: 1.1rem;
                        margin-bottom: 1rem;
                    }
                    .form-card h2::after {
                        width: 40px;
                        height: 2px;
                    }
                    .form-group {
                        padding: 0.5rem;
                        margin-bottom: 0.75rem;
                        border-radius: 0.5rem;
                    }
                    .form-group h3 {
                        font-size: 0.9rem;
                        margin-bottom: 0.25rem;
                    }
                    .form-group h3 i {
                        font-size: 1rem;
                    }
                    .form-group p {
                        font-size: 0.75rem;
                        margin-bottom: 0.5rem;
                    }
                    .form-label {
                        font-size: 0.85rem;
                        margin-bottom: 0.375rem;
                    }
                    .form-input, .form-select, .form-textarea {
                        padding: 0.625rem 0.75rem;
                        font-size: 0.9rem;
                        border-radius: 0.5rem;
                    }
                    .form-textarea {
                        min-height: 80px;
                    }
                    .grid-2 {
                        gap: 0.5rem;
                    }
                    .btn-submit {
                        padding: 0.75rem 1.25rem;
                        font-size: 0.9rem;
                        border-radius: 0.75rem;
                    }
                    .checkbox-label {
                        font-size: 0.85rem;
                        padding: 0.25rem;
                        gap: 0.5rem;
                    }
                    .checkbox-input {
                        width: 1rem;
                        height: 1rem;
                    }
                    .header {
                        padding: 0.5rem 0;
                    }
                    .nav {
                        gap: 0.75rem;
                    }
                    .logo {
                        font-size: 1.1rem;
                    }
                    .nav-link {
                        padding: 0.375rem 0.75rem;
                        font-size: 0.85rem;
                    }
                    .footer {
                        padding: 1rem 0;
                        margin-top: 2rem;
                    }
                    .footer p {
                        font-size: 0.75rem;
                    }
                    .hamburger {
                        display: flex;
                    }
                    .nav-links {
                        display: none;
                    }
                }
            </style>
        @endif
    </head>
<body>
        <header class="header">
            <div class="container">
                <nav class="nav">
                    <div class="logo">
                        <i class="fas fa-shield-alt" style="margin-right: 0.5rem;"></i>
                        SafeSpace
                    </div>
                    <div class="hamburger" id="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <ul class="nav-links" id="nav-links">
                        <li><a href="{{ route('welcome') }}" class="nav-link">Home</a></li>
                        <li><a href="{{ route('reports.track') }}" class="nav-link">Track a report</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <main>
            <div class="container">
                <!-- Form Section -->
                <section class="form-section">
                    <div class="form-card">
                        <h2>Let's Get Started</h2>

                        <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Anonymous -->
                            <div class="form-group">
                                <h3><i class="fas fa-user-secret"></i> Do you want to stay secret?</h3>
                                <p style="font-size: 0.9rem; color: var(--text-secondary); margin-bottom: 0.75rem;">Check this if you don't want to share your name.</p>
                                <label class="checkbox-label">
                                    <input type="checkbox" id="is_anonymous" name="is_anonymous" value="1" checked class="checkbox-input">
                                    <span>Yes, keep me anonymous</span>
                                </label>
                            </div>

                            <!-- Reporter Info (Hidden by default) -->
                            <div id="reporter-info" class="reporter-info" style="display: none;">
                                <h3><i class="fas fa-id-card"></i> Your Info (Optional)</h3>
                                <p style="font-size: 0.9rem; color: var(--text-secondary); margin-bottom: 0.75rem;">If you want us to contact you, fill this out.</p>
                                <div class="form-group">
                                    <label for="reporter_name" class="form-label">Your Full Name</label>
                                    <textarea id="reporter_name" name="reporter_name" class="form-textarea" placeholder="Enter your full name"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="reporter_email" class="form-label">Your Email</label>
                                    <input type="email" id="reporter_email" name="reporter_email" class="form-input">
                                </div>
                                <div class="form-group">
                                    <label for="reporter_phone" class="form-label">Your Phone</label>
                                    <input type="tel" id="reporter_phone" name="reporter_phone" class="form-input">
                                </div>
                                <div class="grid-2">
                                    <div class="form-group">
                                        <label for="reporter_grade" class="form-label">Your Grade</label>
                                        <input type="text" id="reporter_grade" name="reporter_grade" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label for="reporter_student_id" class="form-label">Student ID</label>
                                        <input type="text" id="reporter_student_id" name="reporter_student_id" class="form-input">
                                    </div>
                                </div>
                            </div>

                            <!-- What Happened -->
                            <div class="form-group">
                                <h3><i class="fas fa-question-circle"></i> What happened?</h3>
                                <p style="font-size: 0.9rem; color: var(--text-secondary); margin-bottom: 0.75rem;">Choose the best one that fits.</p>
                                <select id="category" name="category" class="form-select" required>
                                    <option value="">Pick one</option>
                                    <option value="bullying">Bullying</option>
                                    <option value="harassment">Harassment</option>
                                    <option value="violence">Violence</option>
                                    <option value="other">Something else</option>
                                </select>
                            </div>

                            <!-- Tell Us More -->
                            <div class="form-group">
                                <h3><i class="fas fa-edit"></i> Tell us more</h3>
                                <p style="font-size: 0.9rem; color: var (--text-secondary); margin-bottom: 0.75rem;">What happened? Write it here. Be as clear as you can.</p>
                                <textarea id="description" name="description" class="form-textarea" placeholder="Type your story here..." required></textarea>
                            </div>

                            <!-- Where Did It Happen -->
                            <div class="form-group">
                                <h3><i class="fas fa-map-marker-alt"></i> Where did it happen?</h3>
                                <p style="font-size: 0.9rem; color: var(--text-secondary); margin-bottom: 0.75rem;">Tell us the place, like classroom, playground, or online.</p>
                                <input type="text" id="location" name="location" class="form-input" placeholder="e.g., School hallway, Online chat">
                            </div>

                            <!-- When Did It Happen -->
                            <div class="form-group">
                                <h3><i class="fas fa-calendar-alt"></i> When did it happen?</h3>
                                <p style="font-size: 0.9rem; color: var(--text-secondary); margin-bottom: 0.75rem;">Pick the date and time if you remember.</p>
                                <div class="grid-2">
                                    <div class="form-group">
                                        <label for="incident_date" class="form-label">Date</label>
                                        <input type="date" id="incident_date" name="incident_date" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label for="incident_time" class="form-label">Time</label>
                                        <input type="time" id="incident_time" name="incident_time" class="form-input">
                                    </div>
                                </div>
                            </div>

                            <!-- Who Was Involved -->
                            <div class="form-group">
                                <h3><i class="fas fa-users"></i> Who was involved?</h3>
                                <p style="font-size: 0.9rem; color: var(--text-secondary); margin-bottom: 0.75rem;">Names or descriptions of people involved (optional).</p>
                                <textarea id="involved_parties" name="involved_parties" class="form-textarea" placeholder="e.g., Teacher name, other students"></textarea>
                            </div>

                            <!-- Add Proof -->
                            <div class="form-group">
                                <h3><i class="fas fa-camera"></i> Add a photo or file (if you have one)</h3>
                                <p style="font-size: 0.9rem; color: var(--text-secondary); margin-bottom: 0.75rem;">This helps us understand better.</p>
                                <input type="file" id="evidence" name="evidence[]" accept="image/*,video/*,audio/*,.pdf,.doc,.docx" class="form-input">
                            </div>

                            <!-- Submit -->
                            <div class="form-submit">
                                <button type="submit" class="btn-submit">
                                    <i class="fas fa-paper-plane"></i> Send Report
                                </button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </main>

        <footer class="footer">
            <div class="container">
                <p>SafeSpace — Safe reporting for everyone. <a href="/privacy">Privacy</a></p>
            </div>
        </footer>

    <script>
            function toggleReporterInfo() {
                const checkbox = document.getElementById('is_anonymous');
                const info = document.getElementById('reporter-info');
                if (checkbox.checked) {
                    info.style.display = 'none';
                } else {
                    info.style.display = 'block';
                }
            }

            function toggleMenu() {
                const hamburger = document.getElementById('hamburger');
                const navLinks = document.getElementById('nav-links');
                hamburger.classList.toggle('open');
                if (navLinks.style.display === 'flex') {
                    navLinks.style.display = 'none';
                } else {
                    navLinks.style.display = 'flex';
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const checkbox = document.getElementById('is_anonymous');
                if (checkbox) {
                    checkbox.addEventListener('change', toggleReporterInfo);
                    toggleReporterInfo(); // Initial check
                }

                const hamburger = document.getElementById('hamburger');
                if (hamburger) {
                    hamburger.addEventListener('click', toggleMenu);
                }
            });
        </script>
</body>
</html>
