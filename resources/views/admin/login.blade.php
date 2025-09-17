<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Admin Login - SafeSpace</title>
    <style>
        /* Base Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', Arial, sans-serif;
            background: #f9fafb;
            color: #222;
            line-height: 1.6;
        }

        .login-container {
            max-width: 400px;
            margin: 60px auto;
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
        }

        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #059669;
            font-size: 1.75rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1.2rem;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            font-size: 1rem;
        }

        button {
            width: 100%;
            background: #059669;
            color: #fff;
            border: none;
            padding: 0.75rem;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            font-size: 1rem;
        }

        button:hover {
            background: #047857;
        }

        .error {
            color: #ef4444;
            margin-top: 1rem;
            text-align: center;
            font-size: 0.95rem;
        }

        /* Responsive Styles */
        @media (max-width: 600px) {
            .login-container {
                margin: 20px 10px;
                padding: 1.5rem;
                border-radius: 6px;
                box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
            }

            h2 {
                font-size: 1.5rem;
            }

            input[type="email"],
            input[type="password"] {
                padding: 0.65rem;
                font-size: 1rem;
            }

            button {
                padding: 0.65rem;
                font-size: 1rem;
            }
        }

        @media (max-width: 400px) {
            h2 {
                font-size: 1.3rem;
            }

            .login-container {
                padding: 1rem;
            }

            input[type="email"],
            input[type="password"],
            button {
                font-size: 0.95rem;
                padding: 0.6rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>School Admin Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label for="school_email">School Email</label>
            <input type="email" name="school_email" id="school_email" required autofocus>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Login</button>
        </form>

        @if($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif
    </div>
</body>
</html>
