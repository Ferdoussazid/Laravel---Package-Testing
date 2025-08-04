<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Payment Failed</title>
        <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                margin: 0;
                padding: 0;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .container {
                background: white;
                padding: 2rem;
                border-radius: 10px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.2);
                text-align: center;
                max-width: 400px;
                width: 90%;
            }
            .error-icon {
                color: #dc3545;
                font-size: 4rem;
                margin-bottom: 1rem;
            }
            h1 {
                color: #333;
                margin-bottom: 1rem;
            }
            .error-message {
                background: #f8d7da;
                color: #721c24;
                padding: 1rem;
                border-radius: 5px;
                margin: 1rem 0;
                border: 1px solid #f5c6cb;
            }
            .btn {
                background: #dc3545;
                color: white;
                padding: 12px 30px;
                border: none;
                border-radius: 25px;
                font-size: 16px;
                font-weight: bold;
                cursor: pointer;
                transition: all 0.3s ease;
                text-decoration: none;
                display: inline-block;
                margin-top: 1rem;
            }
            .btn:hover {
                background: #c82333;
                transform: translateY(-2px);
            }
            .btn-secondary {
                background: #6c757d;
                margin-left: 10px;
            }
            .btn-secondary:hover {
                background: #5a6268;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="error-icon">❌</div>
            <h1>Payment Failed</h1>
            <p>Sorry, your payment could not be processed.</p>
            
            <div class="error-message">
                <strong>Error:</strong> {{ $message }}
            </div>
            
            <a href="{{ url('/') }}" class="btn">Back to Home</a>
            <a href="{{ route('bkash.pay') }}" class="btn btn-secondary">Try Again</a>
        </div>
    </body>
</html> 