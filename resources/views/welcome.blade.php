<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SafeSpace - Anonymous Abuse Reporting System</title>
        <meta name="description" content="SafeSpace is a secure platform for anonymous reporting of abuse, bullying, harassment, and other safety concerns.">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=poppins:400,500,600,700" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /*! SafeSpace Custom Styles */
                @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap');                :root {
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
                }                body {
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
                }                /* Header Styles */
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
                }                .nav-link:hover {
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
                }                .btn-primary:hover {
                    background: var(--primary-dark);
                    transform: translateY(-2px);
                    box-shadow: var(--shadow-lg);
                }.btn-outline {
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
                }                /* Hero Section */
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
                }                .hero h1 {
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
                }                .hero-buttons {
                    display: flex;
                    gap: 1rem;
                    justify-content: center;
                    flex-wrap: wrap;
                    margin-top: 2rem;
                }/* Trust Statement Section */
                .trust-statement {
                    padding: 4rem 0;
                    background: var(--background-white);
                    text-align: center;
                    border-bottom: 1px solid var(--border-color);
                }                .trust-statement h2 {
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
                }                /* How It Works Section */
                .how-it-works {
                    padding: 4rem 0;
                    background: var(--background-light);
                }                .how-it-works h2 {
                    font-family: 'Poppins', sans-serif;
                    font-size: 2.5rem;
                    font-weight: 600;
                    text-align: center;
                    margin-bottom: 3rem;
                    color: var(--text-primary);
                    position: relative;
                }

                .how-it-works h2::after {
                    content: '';
                    width: 60px;
                    height: 4px;
                    background: var(--primary-color);
                    position: absolute;
                    bottom: -10px;
                    left: 50%;
                    transform: translateX(-50%);
                    border-radius: 2px;
                }                .steps-grid {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                    gap: 2.5rem;
                    max-width: 1200px;
                    margin: 0 auto;
                }.step {
                    background: var(--background-white);
                    padding: 2.5rem 2rem;
                    border-radius: 1rem;
                    box-shadow: var(--shadow-md);
                    text-align: center;
                    transition: all 0.3s ease;
                    position: relative;
                    border: 1px solid var(--border-color);
                }

                .step:hover {
                    transform: translateY(-5px);
                    box-shadow: var(--shadow-xl);
                    border-color: var(--primary-color);
                }                .step-number {
                    width: 3.5rem;
                    height: 3.5rem;
                    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
                    color: white;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 1.4rem;
                    font-weight: 700;
                    margin: 0 auto 1.5rem;
                    box-shadow: var(--shadow-md);
                }

                .step h3 {
                    font-family: 'Poppins', sans-serif;
                    font-size: 1.25rem;
                    font-weight: 600;
                    margin-bottom: 0.75rem;
                    color: var(--text-primary);
                }

                .step p {
                    color: var(--text-secondary);
                    line-height: 1.6;
                }                /* Features Section */
                .features {
                    padding: 4rem 0;
                    background: var(--background-white);
                    border-bottom: 1px solid var(--border-color);
                }

                .features h2 {
                    font-family: 'Poppins', sans-serif;
                    font-size: 2.5rem;
                    font-weight: 600;
                    text-align: center;
                    margin-bottom: 3rem;
                    color: var(--text-primary);
                    position: relative;
                }

                .features h2::after {
                    content: '';
                    width: 60px;
                    height: 4px;
                    background: var(--primary-color);
                    position: absolute;
                    bottom: -10px;
                    left: 50%;
                    transform: translateX(-50%);
                    border-radius: 2px;
                }                .feature-grid {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                    gap: 2rem;
                    max-width: 1200px;
                    margin: 0 auto;
                }.feature-card {
                    background: var(--background-white);
                    padding: 2rem 1.5rem;
                    border-radius: 1rem;
                    box-shadow: var(--shadow-md);
                    text-align: center;
                    transition: all 0.3s ease;
                    border: 1px solid var(--border-color);
                }

                .feature-card:hover {
                    transform: translateY(-5px);
                    box-shadow: var(--shadow-xl);
                    border-color: var(--primary-color);
                }                .feature-icon {
                    width: 3.5rem;
                    height: 3.5rem;
                    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin: 0 auto 1rem;
                    font-size: 1.5rem;
                    color: white;
                    box-shadow: var(--shadow-md);
                }

                .feature-card h3 {
                    font-family: 'Poppins', sans-serif;
                    font-size: 1.1rem;
                    font-weight: 600;
                    margin-bottom: 0.5rem;
                }

                .feature-card p {
                    color: var(--text-secondary);
                    font-size: 0.9rem;
                    line-height: 1.5;
                }                /* Report Types Section */
                .report-types {
                    padding: 4rem 0;
                    background: var(--background-white);
                }                .report-types h2 {
                    font-family: 'Poppins', sans-serif;
                    font-size: 2.5rem;
                    font-weight: 600;
                    text-align: center;
                    margin-bottom: 3rem;
                    color: var(--text-primary);
                    position: relative;
                }

                .report-types h2::after {
                    content: '';
                    width: 60px;
                    height: 4px;
                    background: var(--primary-color);
                    position: absolute;
                    bottom: -10px;
                    left: 50%;
                    transform: translateX(-50%);
                    border-radius: 2px;
                }                .report-grid {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                    gap: 1.5rem;
                    max-width: 1200px;
                    margin: 0 auto;
                }.report-card {
                    background: var(--background-light);
                    padding: 1.8rem 1.5rem;
                    border-radius: 1rem;
                    box-shadow: var(--shadow-md);
                    text-align: center;
                    transition: all 0.3s ease;
                    border: 2px solid transparent;
                    cursor: pointer;
                }

                .report-card:hover {
                    transform: translateY(-3px);
                    border-color: var(--primary-color);
                    box-shadow: var(--shadow-lg);
                    background: var(--background-white);
                }                .report-card h4 {
                    font-weight: 600;
                    margin-bottom: 0.8rem;
                    color: var(--text-primary);
                    font-size: 1.1rem;
                }

                .report-card p {
                    font-size: 0.95rem;
                    color: var(--text-secondary);
                    line-height: 1.5;
                }                /* CTA Section */
                .cta {
                    padding: 4rem 0;
                    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
                    color: white;
                    text-align: center;
                    position: relative;
                    overflow: hidden;
                }

                .cta::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></svg>') repeat;
                    background-size: 50px 50px;
                    animation: float 20s infinite linear;
                }

                @keyframes float {
                    0% { transform: translateY(0px); }
                    100% { transform: translateY(-100px); }
                }                .cta h2 {
                    font-family: 'Poppins', sans-serif;
                    font-size: 2.5rem;
                    font-weight: 600;
                    margin-bottom: 1.5rem;
                    position: relative;
                    z-index: 1;
                }

                .cta p {
                    font-size: 1.2rem;
                    margin-bottom: 2rem;
                    opacity: 0.95;
                    max-width: 600px;
                    margin-left: auto;
                    margin-right: auto;
                    position: relative;
                    z-index: 1;
                }

                .cta .btn {
                    position: relative;
                    z-index: 1;
                    background: white;
                    color: var(--primary-color);
                    font-weight: 600;
                    padding: 1rem 2rem;
                    font-size: 1.1rem;
                }

                .cta .btn:hover {
                    background: var(--background-light);
                    transform: translateY(-2px);
                }/* Footer */
                .footer {
                    background: var(--primary-dark);
                    color: white;
                    padding: 2rem 0;
                    text-align: center;
                }

                .footer p {
                    opacity: 0.8;
                }                /* Responsive */
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
                    }                    .hero-buttons {
                        flex-direction: column;
                        align-items: center;
                        gap: 0.75rem;
                    }

                    .btn {
                        width: 100%;
                        max-width: 280px;
                    }

                    .trust-statement h2,
                    .how-it-works h2,
                    .features h2,
                    .report-types h2 {
                        font-size: 2rem;
                    }

                    .cta h2 {
                        font-size: 2rem;
                    }

                    .steps-grid,
                    .feature-grid {
                        grid-template-columns: 1fr;
                        gap: 1.5rem;
                    }

                    .report-grid {
                        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                    }
                }

                /* Animations */
                @keyframes fadeInUp {
                    from {
                        opacity: 0;
                        transform: translateY(30px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }                .feature-card,
                .report-card,
                .step {
                    animation: fadeInUp 0.6s ease-out;
                    animation-fill-mode: both;
                }

                .feature-card:nth-child(1),
                .step:nth-child(1) { animation-delay: 0.1s; }
                .feature-card:nth-child(2),
                .step:nth-child(2) { animation-delay: 0.2s; }
                .feature-card:nth-child(3),
                .step:nth-child(3) { animation-delay: 0.3s; }
                .feature-card:nth-child(4),
                .step:nth-child(4) { animation-delay: 0.4s; }

                .report-card:nth-child(1) { animation-delay: 0.1s; }
                .report-card:nth-child(2) { animation-delay: 0.2s; }
                .report-card:nth-child(3) { animation-delay: 0.3s; }
                .report-card:nth-child(4) { animation-delay: 0.4s; }
                .report-card:nth-child(5) { animation-delay: 0.5s; }
                .report-card:nth-child(6) { animation-delay: 0.6s; }
            </style>
        @endif
    </head>
    <body>
        <!-- Header -->
        <header class="header">
            <div class="container">
                <nav class="nav">
                    <div class="logo">SafeSpace</div>
                    @if (Route::has('login'))
                        <ul class="nav-links">
                            @auth
                                <li>
                                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                                        Dashboard
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('login') }}" class="nav-link">Admin Login</a>
                                </li>
                                @if (Route::has('register'))
                                    <li>
                                        <a href="{{ route('register') }}" class="btn btn-outline">Register</a>
                                    </li>
                                @endif
                            @endauth
                        </ul>
                    @endif
                </nav>
            </div>
        </header>        <!-- Hero Section -->
        <section class="hero">
            <div class="container">
                <h1>Safe Space: Report Abuse safely and Anonymously</h1>
                <p>A confidential platform designed to protect and empower learners and employees to speak out- with the option to report anonymously</p>                <div class="hero-buttons">
                    <a href="{{ route('reports.create') }}" class="btn btn-primary">Report Now</a>
                    <a href="{{ route('reports.track') }}" class="btn btn-outline white">Track Report</a>
                    <a href="#" class="btn btn-outline white" onclick="showLogin()">Admin Login</a>
                </div>
            </div>        </section>

        <!-- Trust Statement Section -->
        <section class="trust-statement">
            <div class="container">
                <h2>Your voice matters. Your identity is protected</h2>
                <p>We understand that speaking out takes courage. That's why SafeSpace is built with your privacy and safety as our top priority. Every report is handled with the utmost confidentiality.</p>
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="how-it-works">
            <div class="container">
                <h2>How it works</h2>
                <div class="steps-grid">
                    <div class="step">
                        <div class="step-number">1</div>
                        <h3>Choose Your Method</h3>
                        <p>Report anonymously or provide your details - the choice is yours</p>
                    </div>
                    <div class="step">
                        <div class="step-number">2</div>
                        <h3>Share Your Story</h3>
                        <p>Describe the incident with as much detail as you feel comfortable sharing</p>
                    </div>
                    <div class="step">
                        <div class="step-number">3</div>
                        <h3>Submit Evidence</h3>
                        <p>Upload photos, documents, or other supporting materials if available</p>
                    </div>
                    <div class="step">
                        <div class="step-number">4</div>
                        <h3>Get Support</h3>
                        <p>Receive immediate response and ongoing support from trained professionals</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features">
            <div class="container">
                <h2>Why Choose SafeSpace?</h2>
                <div class="feature-grid">
                    <div class="feature-card">
                        <div class="feature-icon">🔒</div>
                        <h3>100% Anonymous</h3>
                        <p>Your identity remains completely protected. Report without fear of retaliation or exposure.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⚡</div>
                        <h3>Instant Response</h3>
                        <p>Reports are immediately forwarded to appropriate authorities for quick action and resolution.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🔍</div>
                        <h3>Case Tracking</h3>
                        <p>Follow up on your reports with secure case tracking using your unique reference number.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🛡️</div>
                        <h3>Secure Platform</h3>
                        <p>Advanced encryption and security measures protect all communications and data.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Report Types Section -->
        <section class="report-types">
            <div class="container">
                <h2>What Can You Report?</h2>
                <div class="report-grid">
                    <div class="report-card" onclick="selectReportType('bullying')">
                        <h4>🎯 Bullying</h4>
                        <p>Physical, verbal, or cyber bullying incidents</p>
                    </div>
                    <div class="report-card" onclick="selectReportType('sexual-abuse')">
                        <h4>⚠️ Sexual Harassment</h4>
                        <p>Unwanted sexual advances or inappropriate behavior</p>
                    </div>
                    <div class="report-card" onclick="selectReportType('substance-abuse')">
                        <h4>💊 Substance Abuse</h4>
                        <p>Drug or alcohol related incidents</p>
                    </div>
                    <div class="report-card" onclick="selectReportType('weapons')">
                        <h4>🔫 Weapons</h4>
                        <p>Possession or threats involving weapons</p>
                    </div>
                    <div class="report-card" onclick="selectReportType('teenage-pregnancy')">
                        <h4>👶 Teenage Pregnancy</h4>
                        <p>Support and guidance for teen pregnancy</p>
                    </div>
                    <div class="report-card" onclick="selectReportType('other')">
                        <h4>📋 Other Concerns</h4>
                        <p>Any other safety or welfare concerns</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta">
            <div class="container">
                <h2>Ready to Make a Difference?</h2>
                <p>Your report could save someone's life. Take the first step towards creating a safer community.</p>
                <a href="#" class="btn btn-primary" onclick="startAnonymousReport()">Start Anonymous Report</a>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <p>&copy; {{ date('Y') }} SafeSpace. All rights reserved. Your safety is our priority.</p>
            </div>
        </footer>

        <script>            function startAnonymousReport() {
                alert('Anonymous reporting feature will be implemented in the next phase. This will take you to the report form.');
                // TODO: Redirect to anonymous report form
                // window.location.href = '/report/anonymous';
            }

            function showLogin() {
                alert('Admin login feature will be implemented in the next phase. This will take you to the admin dashboard login.');
                // TODO: Redirect to admin login page
                // window.location.href = '/login';
            }

            function trackReport() {
                alert('Case tracking feature will be implemented in the next phase. You can track your report using your reference number.');
                // TODO: Redirect to case tracking page
                // window.location.href = '/track-report';
            }

            function selectReportType(type) {
                alert(`Selected report type: ${type}. This will take you to the specific reporting form for ${type}.`);
                // TODO: Redirect to specific report form
                // window.location.href = `/report/${type}`;
            }

            // Add smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Add fade-in animation on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);            // Observe all cards for animation
            document.querySelectorAll('.feature-card, .report-card, .step').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        </script>
    </body>
</html>
