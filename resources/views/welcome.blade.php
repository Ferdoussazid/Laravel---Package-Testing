<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel bKash Payment</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
            h1 {
                color: #333;
                margin-bottom: 1rem;
            }
            p {
                color: #666;
                margin-bottom: 2rem;
            }
            .form-group {
                margin-bottom: 1.5rem;
                text-align: left;
            }
            .form-group label {
                display: block;
                margin-bottom: 0.5rem;
                color: #333;
                font-weight: bold;
            }
            .form-group input {
                width: 100%;
                padding: 12px;
                border: 2px solid #e1e5e9;
                border-radius: 8px;
                font-size: 16px;
                transition: border-color 0.3s ease;
                box-sizing: border-box;
            }
            .form-group input:focus {
                outline: none;
                border-color: #e2136e;
            }
            .amount-display {
                font-size: 24px;
                font-weight: bold;
                color: #e2136e;
                margin: 1rem 0;
                padding: 1rem;
                background: #f8f9fa;
                border-radius: 8px;
                border: 2px solid #e2136e;
            }
            .btn {
                background: #e2136e;
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
                width: 100%;
            }
            .btn:hover {
                background: #c4125e;
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(226, 19, 110, 0.4);
            }
            .btn:active {
                transform: translateY(0);
            }
            .btn:disabled {
                background: #ccc;
                cursor: not-allowed;
                transform: none;
                box-shadow: none;
            }
            .error {
                color: #dc3545;
                font-size: 14px;
                margin-top: 0.5rem;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>bKash Payment</h1>
            <p>Enter the amount and click the button below to proceed with payment</p>
            
            <form action="{{ route('bkash.pay') }}" method="POST" id="paymentForm">
                @csrf
                <div class="form-group">
                    <label for="amount">Amount (৳)</label>
                    <input type="number" id="amount" name="amount" min="1" max="100000" step="0.01" 
                           placeholder="Enter amount" required value="{{ old('amount', 100) }}">
                    @error('amount')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="amount-display" id="amountDisplay">
                    Amount: ৳<span id="displayAmount">100</span>
                </div>
                
                <button type="submit" class="btn" id="payButton">
                    Pay with bKash
                </button>
            </form>
        </div>

        <script>
            const amountInput = document.getElementById('amount');
            const displayAmount = document.getElementById('displayAmount');
            const payButton = document.getElementById('payButton');

            // Update display amount as user types
            amountInput.addEventListener('input', function() {
                const amount = this.value;
                displayAmount.textContent = amount || '0';
                
                // Enable/disable button based on amount
                if (amount && amount > 0) {
                    payButton.disabled = false;
                } else {
                    payButton.disabled = true;
                }
            });

            // Form validation
            document.getElementById('paymentForm').addEventListener('submit', function(e) {
                const amount = amountInput.value;
                if (!amount || amount <= 0) {
                    e.preventDefault();
                    alert('Please enter a valid amount greater than 0');
                    return false;
                }
            });
        </script>
    </body>
</html>
