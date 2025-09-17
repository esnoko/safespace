<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SafeSpace - Anonymous Abuse Reporting System</title>
    <meta name="description"
        content="SafeSpace is a secure platform for anonymous reporting of abuse, bullying, harassment, and other safety concerns.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=poppins:400,500,600,700"
        rel="stylesheet" />

    <style>
        /*! SafeSpace Custom Styles */
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
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 50%, #a7f3d0 100%);
            min-height: 100vh;
            color: var(--text-primary);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Header Styles */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid var(--border-color);
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
        }

        .nav-links {
            display: flex;
            gap: 1rem;
            list-style: none;
        }

        .nav-link {
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.2s;
        }

        .nav-link:hover {
            color: var(--primary-color);
            background: var(--background-light);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
            font-size: 0.875rem;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-outline {
            background: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }

        .btn-outline:hover {
            background: var(--primary-color);
            color: white;
        }

        .btn-outline.white {
            color: white;
            border-color: white;
        }

        .btn-outline.white:hover {
            background: white;
            color: var(--primary-color);
        }

        /* Hero Section */
        .hero {
            padding: 5rem 0;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(5, 150, 105, 0.8) 0%, rgba(4, 120, 87, 0.9) 100%);
            z-index: -1;
        }

        .hero h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 2.5rem;
            opacity: 0.95;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            font-weight: 400;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        /* Trust Statement Section */
        .trust-statement {
            padding: 4rem 0;
            background: var(--background-white);
            text-align: center;
            border-bottom: 1px solid var(--border-color);
        }

        .trust-statement h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 2.5rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 1.5rem;
            position: relative;
        }

        .trust-statement h2::after {
            content: '';
            width: 60px;
            height: 4px;
            background: var(--primary-color);
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .trust-statement p {
            font-size: 1.1rem;
            color: var(--text-secondary);
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.7;
        }

        /* Footer */
        .footer {
            background: var(--primary-dark);
            color: white;
            padding: 2rem 0;
            text-align: center;
        }

        .footer p {
            opacity: 0.8;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav {
                flex-direction: column;
                gap: 1rem;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
                gap: 0.75rem;
            }

            .btn {
                width: 100%;
                max-width: 280px;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">        <div class="container">
            <nav class="nav">
                <div class="logo">SafeSpace</div>
                <ul class="nav-links">
                    <li><a href="{{ route('reports.create') }}" class="nav-link">Report Incident</a></li>
                    <li><a href="{{ route('reports.track') }}" class="nav-link">Track Report</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>SafeSpace: Report Abuse Safely and Anonymously</h1>
            <p>A confidential platform designed to protect and empower learners and employees to speak out - with the
                option to report anonymously</p>            <div class="hero-buttons">
                <a href="{{ route('reports.create') }}" class="btn btn-primary" style="margin-right: 8px;">Report Now</a>
                <a href="{{ route('reports.track') }}" class="btn btn-outline white">Track Report</a>
                <a href="{{ route('login') }}" class="btn btn-primary">Login as School</a>
            </div>
        </div>
    </section>

    <!-- Trust Statement Section -->
    <section class="trust-statement">
        <div class="container">
            <h2>Your voice matters. Your identity is protected</h2>
            <p>We understand that speaking out takes courage. That's why SafeSpace is built with your privacy and safety
                as our top priority. Every report is handled with the utmost confidentiality.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} SafeSpace. All rights reserved. Your safety is our priority.</p>
        </div>
    </footer>

    <script>
        // Simple JavaScript for the links
        document.addEventListener('DOMContentLoaded', function() {
            // All links should work properly now
            console.log('SafeSpace loaded successfully');
        });
    </script>
</body>

</html>
