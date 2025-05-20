<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Login</title>
    <style>
        /* Resetting default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle, #1f1f1f, #121212);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            color: #e0e0e0;
        }

        .form-container {
            background: linear-gradient(135deg, #292929, #1e1e1e);
            border-radius: 20px;
            padding: 40px 35px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.7);
            animation: fadeIn 0.7s ease-out forwards;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Fade-in effect */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            color: #66db9e; /* Soft green */
            text-align: center;
            margin-bottom: 25px;
            font-size: 1.8rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        label {
            position: absolute;
            top: -8px;
            left: 12px;
            font-size: 0.85rem;
            background: #1e1e1e;
            color: #66db9e;
            font-weight: bold;
            padding: 0 6px;
            opacity: 0.9;
        }

        input {
            width: 100%;
            padding: 14px 12px;
            font-size: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            outline: none;
            background: #292929;
            color: #f5f5f5;
            transition: box-shadow 0.3s ease, background-color 0.3s ease;
        }

        input:focus {
            background-color: #333;
            box-shadow: 0 0 8px rgba(102, 219, 158, 0.4);
        }

        /* Submit Button */
        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #66db9e, #42a85f);
            border: none;
            border-radius: 12px;
            color: #ffffff;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 219, 158, 0.4);
        }

        button:active {
            transform: translateY(1px);
        }

        /* Error Messages */
        .error-message {
            color: #e57373;
            font-size: 0.9rem;
            text-align: left;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 12px;
            background-color: #2e2e2e;
            border: 1px solid #e57373;
            animation: shake 0.3s ease;
        }

        /* Shake animation for error */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-4px); }
            50% { transform: translateX(4px); }
            75% { transform: translateX(-4px); }
        }

        /* Register Link */
        .styled-link {
            display: inline-block;
            padding: 12px;
            width: 100%;
            text-align: center;
            background: linear-gradient(135deg, #4086f5, #1a73e8);
            border-radius: 12px;
            color: white;
            text-decoration: none;
            font-size: 1rem;
            font-weight: bold;
            margin-top: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .styled-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(64, 134, 245, 0.4);
        }

        .styled-link:active {
            transform: translateY(1px);
        }
    </style>
</head>
<body>

    <!-- Login Form -->
    <div class="form-container">
        <h2>Login as Cashier</h2>

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('cashier.login') }}">
            @csrf

            <div class="form-group">
                <input type="email" id="email" name="email" placeholder=" " required>
                <label for="email">Email</label>
            </div>

            <div class="form-group">
                <input type="password" id="password" name="password" placeholder=" " required>
                <label for="password">Password</label>
            </div>

            <button type="submit">Login</button>

            <!-- Link for register -->
            <a href="{{ route('cashier.register') }}" class="styled-link">Don't have an account? Register</a>
        </form>
    </div>

</body>
</html>
