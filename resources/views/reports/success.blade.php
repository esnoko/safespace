<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report Submitted - SafeSpace</title>
    <meta name="description" content="Your report has been successfully submitted to SafeSpace.">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=poppins:400,500,600,700" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        /*! SafeSpace Success Page Styles */
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

        .success-section {
            padding: 3rem 0;
        }

        .success-card {
            background: var(--background-white);
            padding: 3rem;
            border-radius: 1.5rem;
            box-shadow: var(--shadow-xl);
            max-width: 700px;
            margin: 0 auto;
            border: 1px solid rgba(5, 150, 105, 0.1);
            position: relative;
            overflow: hidden;
            text-align: center;
        }
        .success-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        .success-icon {
            background: var(--success-color);
            color: white;
            padding: 1.5rem;
            border-radius: 50%;
            width: 120px;
            height: 120px;
            margin: 0 auto 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 2s infinite;
        }

        .success-title {
            font-family: 'Poppins', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .success-subtitle {
            font-size: 1.2rem;
            color: var(--text-secondary);
            margin-bottom: 3rem;
            line-height: 1.6;
        }

        .reference-card {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            border: 2px solid var(--primary-color);
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 3rem;
        }

        .reference-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .reference-number {
            font-family: 'Courier New', monospace;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            letter-spacing: 2px;
            margin-bottom: 1rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.875rem 2rem;
            border-radius: 0.75rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            cursor: pointer;
            font-size: 1rem;
            position: relative;
            overflow: hidden;
            margin: 0.5rem;
        }

        .btn-primary {
            background: var(--gradient-primary);
            color: white;
            box-shadow: var(--shadow-md);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
        }

        .btn-secondary {
            background: var(--background-white);
            color: var(--text-primary);
            border: 2px solid var(--border-color);
        }
        .btn-secondary:hover {
            background: var(--background-light);
            transform: translateY(-2px);
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin: 2rem 0;
            text-align: left;
        }

        .info-item {
            background: linear-gradient(135deg, #fef9e7 0%, #fef3c7 100%);
            border: 1px solid #f59e0b;
            border-radius: 0.75rem;
            padding: 1.5rem;
        }

        .info-item h3 {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-item p {
            color: var(--text-secondary);
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .steps-section {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 1rem;
            padding: 2rem;
            margin: 2rem 0;
            text-align: left;
        }

        .steps-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .step {
            display: flex;
            align-items: start;
            margin-bottom: 1.5rem;
        }

        .step-number {
            background: var(--primary-color);
            color: white;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .step-content h3 {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .step-content p {
            color: var(--text-secondary);
            line-height: 1.5;
        }

        .support-card {
            background: linear-gradient(135deg, #fef7ed 0%, #fed7aa 100%);
            border: 1px solid var(--warning-color);
            border-radius: 1rem;
            padding: 2rem;
            margin-top: 3rem;
        }

        .support-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .support-links {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .support-link {
            background: var(--background-white);
            color: var(--text-primary);
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-size: 0.875rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .support-link:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-1px);
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 0.5rem;
            }
            .success-card {
                padding: 2rem 1.5rem;
                margin: 0 0.5rem;
            }
            .success-title {
                font-size: 2rem;
            }
            .reference-number {
                font-size: 2rem;
            }
            .info-grid {
                grid-template-columns: 1fr;
            }
            .btn {
                width: 100%;
                margin: 0.25rem 0;
            }
        }

        @media (max-width: 480px) {
            .success-card {
                padding: 1.5rem 1rem;
                margin: 0 0.25rem;
            }
            .success-title {
                font-size: 1.75rem;
            }
            .reference-number {
                font-size: 1.75rem;
            }
            .success-icon {
                width: 100px;
                height: 100px;
                padding: 1.25rem;
            }
        }
    </style>
</head>
<<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <nav class="nav">
                <div class="logo">
                    <i class="fas fa-shield-alt" style="margin-right: 0.5rem;"></i>
                    SafeSpace
                </div>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <!-- Success Section -->
            <section class="success-section">
                <div class="success-card">
                    <!-- Success Icon -->
                    <div class="success-icon">
                        <i class="fas fa-check" style="font-size: 3rem;"></i>
                    </div>

                    <!-- Success Message -->
                    <h1 class="success-title">Report Submitted Successfully!</h1>
                    <p class="success-subtitle">
                        Thank you for trusting us with your report. Your voice matters and we take every report seriously.
                    </p>                    <!-- Reference Number -->
                    <div class="reference-card">
                        <h2 class="reference-title">Your Case Number</h2>
                        <div class="reference-number" id="reference-number">
                            {{ $report->reference_number }}
                        </div>
                        <button onclick="copyReference()" class="btn btn-primary">
                            <i class="fas fa-copy" style="margin-right: 0.5rem;"></i>Copy Case Number
                        </button>
                    </div>

                    <!-- Important Info -->
                    <div class="info-grid">                        <div class="info-item">
                            <h3>
                                <i class="fas fa-bookmark" style="color: #f59e0b;"></i>
                                Save This Number
                            </h3>
                            <p>Write down or screenshot your case number. You'll need it to track your report status.</p>
                        </div>
                        <div class="info-item">
                            <h3>
                                <i class="fas fa-search" style="color: #f59e0b;"></i>
                                Track Your Report
                            </h3>
                            <p>Use your case number to check the status of your report at any time.</p>
                        </div>
                    </div>

                    <!-- What Happens Next -->
                    <div class="steps-section">
                        <h2 class="steps-title">What Happens Next?</h2>
                        
                        <div class="step">
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <h3>Review Process</h3>
                                <p>Our team will review your report within 24-48 hours. Your report status will be updated to "Under Review".</p>
                            </div>
                        </div>
                        
                        <div class="step">
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <h3>Investigation</h3>
                                <p>If needed, appropriate authorities will be notified and an investigation will begin. Your anonymity will be maintained throughout.</p>
                            </div>
                        </div>
                        
                        <div class="step">
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <h3>Resolution</h3>
                                <p>You'll be able to track progress and see when your report has been resolved through our tracking system.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div style="margin-top: 2rem;">
                        <a href="{{ route('reports.track') }}" class="btn btn-primary">
                            <i class="fas fa-search" style="margin-right: 0.5rem;"></i>Track This Report
                        </a>
                        <a href="{{ route('welcome') }}" class="btn btn-secondary">
                            <i class="fas fa-home" style="margin-right: 0.5rem;"></i>Return to Home
                        </a>
                    </div>

                    <!-- Support Information -->
                    <div class="support-card">
                        <h3 class="support-title">Need Additional Support?</h3>
                        <p style="color: var(--text-secondary); margin-bottom: 1rem;">
                            Remember, you're not alone. There are people who care and want to help.
                        </p>
                        <div class="support-links">
                            <a href="tel:741741" class="support-link">Crisis Text Line: Text HOME to 741741</a>
                            <a href="tel:988" class="support-link">National Suicide Prevention: 988</a>
                            <a href="tel:1-800-852-8336" class="support-link">Teen Helpline: 1-800-852-8336</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>    <script>
        function copyReference() {
            const referenceNumber = document.getElementById('reference-number').textContent.trim();
            navigator.clipboard.writeText(referenceNumber).then(function() {
                // Show success message
                const button = event.target.closest('button');
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="fas fa-check" style="margin-right: 0.5rem;"></i>Copied!';
                button.style.background = 'var(--success-color)';
                
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.style.background = '';
                }, 2000);
            }).catch(function(err) {
                console.error('Could not copy text: ', err);
                alert('Case number: ' + referenceNumber);
            });
        }
    </script>
</body>
</html>
