<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SafeSpace - Your Voice Matters</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 100vh;
            color: #1e293b;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .logo-icon {
            width: 4rem;
            height: 4rem;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .logo-text {
            font-size: 3.5rem;
            font-weight: 800;
            color: white;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .tagline {
            font-size: 1.5rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 1rem;
        }

        .subtitle {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.8);
            max-width: 600px;
            margin: 0 auto;
        }

        .main-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .action-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 1.5rem;
            padding: 2.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.4s ease;
        }

        .action-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 32px 64px -12px rgba(0, 0, 0, 0.25);
        }

        .card-icon {
            width: 5rem;
            height: 5rem;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin-bottom: 2rem;
        }

        .card-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 1rem;
        }

        .card-description {
            color: #475569;
            margin-bottom: 2rem;
            font-size: 1.1rem;
            line-height: 1.7;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 1rem 2rem;
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .features-section {
            margin-bottom: 4rem;
        }

        .features-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 3rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border-radius: 1rem;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-4px);
        }

        .feature-icon {
            width: 4rem;
            height: 4rem;
            background: linear-gradient(135deg, #f59e0b, #f97316);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin: 0 auto 1.5rem;
        }

        .feature-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 1rem;
            font-size: 1.25rem;
        }

        .feature-description {
            color: #475569;
            line-height: 1.6;
        }

        .admin-section {
            margin-top: 4rem;
            text-align: center;
        }

        .admin-card {
            background: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(20px);
            border-radius: 1.5rem;
            padding: 2.5rem;
            max-width: 400px;
            margin: 0 auto;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .admin-icon {
            width: 4rem;
            height: 4rem;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin: 0 auto 1.5rem;
        }

        .admin-title {
            font-weight: 700;
            color: white;
            margin-bottom: 1rem;
            font-size: 1.25rem;
        }

        .admin-description {
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .btn-admin {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .btn-admin:hover {
            transform: translateY(-2px);
        }

        .footer {
            text-align: center;
            margin-top: 4rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.8);
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }
            
            .logo-text {
                font-size: 2.5rem;
            }
            
            .main-grid {
                grid-template-columns: 1fr;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="logo-container">
                <div class="logo-icon">🛡️</div>
                <h1 class="logo-text">SafeSpace</h1>
            </div>
            <p class="tagline">Your Voice Matters. Your Safety Comes First.</p>
            <p class="subtitle">
                A secure, confidential platform where students can report incidents and seek help without fear. 
                Every voice deserves to be heard.
            </p>
        </header>

        <div class="main-grid">
            <div class="action-card">
                <div class="card-icon">📝</div>
                <h2 class="card-title">Submit Report</h2>
                <p class="card-description">
                    Report incidents safely and confidentially. Choose to remain anonymous or provide your details - 
                    the choice is yours. Your report helps create a safer environment for everyone.
                </p>
                <a href="{{ route('reports.create') }}" class="btn btn-primary">
                    Start Report
                    <span>→</span>
                </a>
            </div>

            <div class="action-card">
                <div class="card-icon">🔍</div>
                <h2 class="card-title">Track Report</h2>
                <p class="card-description">
                    Follow up on your submitted report using your unique case number. 
                    Stay informed about the progress and resolution of your case.
                </p>
                <a href="{{ route('reports.track') }}" class="btn btn-secondary">
                    Track Progress
                    <span>📊</span>
                </a>
            </div>
        </div>

        <section class="features-section">
            <h2 class="features-title">Why Choose SafeSpace?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h3 class="feature-title">100% Confidential</h3>
                    <p class="feature-description">
                        Your privacy is our priority. Report anonymously with complete confidence.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3 class="feature-title">Quick & Simple</h3>
                    <p class="feature-description">
                        Easy-to-use interface designed for students. Submit reports in minutes.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3 class="feature-title">Mobile Ready</h3>
                    <p class="feature-description">
                        Access SafeSpace from any device - smartphone, tablet, or computer.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">🎯</div>
                    <h3 class="feature-title">Real-Time Tracking</h3>
                    <p class="feature-description">
                        Get a unique case number to track your report's status in real-time.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">🤝</div>
                    <h3 class="feature-title">Professional Support</h3>
                    <p class="feature-description">
                        Trained professionals review every report with care and discretion.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">📁</div>
                    <h3 class="feature-title">Evidence Upload</h3>
                    <p class="feature-description">
                        Securely attach photos or documents to support your report.
                    </p>
                </div>
            </div>
        </section>

        <section class="admin-section">
            <div class="admin-card">
                <div class="admin-icon">🏫</div>
                <h3 class="admin-title">School Administrator</h3>
                <p class="admin-description">
                    Access the administrative dashboard to review and manage reports. 
                    Secure login required for authorized personnel only.
                </p>
                <button onclick="promptAdminAccess()" class="btn btn-admin">
                    Admin Access
                    <span>🔑</span>
                </button>
            </div>
        </section>

        <footer class="footer">
            <p>&copy; {{ date('Y') }} SafeSpace. Creating safer learning environments, one voice at a time.</p>
        </footer>
    </div>

    <script>
        function promptAdminAccess() {
            const password = prompt("🔐 Enter administrator password:");
            if (password === "admin123") {
                window.location.href = "/admin";
            } else if (password !== null && password !== "") {
                alert("❌ Access denied. Please contact your system administrator.");
            }
        }
    </script>
</body>
</html>
