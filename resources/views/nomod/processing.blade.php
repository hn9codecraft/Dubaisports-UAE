<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Complete Payment</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="w-full max-w-md bg-white rounded-xl shadow-lg p-6 text-center">

    <!-- Header -->
    <h2 class="text-2xl font-semibold text-gray-800 mb-2">
        Secure Payment
    </h2>
    <p class="text-gray-500 text-sm mb-6">
        Please complete your payment to proceed
    </p>

    <!-- Amount -->
    <div class="bg-gray-50 rounded-lg p-4 mb-6">
        <p class="text-sm text-gray-500">Amount to Pay</p>
        <p id="amount" class="text-xl font-bold text-gray-800">
            Loading...
        </p>
    </div>

    <!-- Pay Button -->
    <a
        id="payButton"
        href="#"
        target="_blank"
        class="block w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 rounded-lg transition disabled:opacity-50 disabled:cursor-not-allowed"
    >
        Pay Now
    </a>

    <!-- Status -->
    <div class="mt-6 flex flex-col items-center gap-2">
        <div id="loader" class="hidden">
            <svg class="animate-spin h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
        </div>

        <p id="status" class="text-sm text-gray-600">
            Waiting for payment confirmation...
        </p>
    </div>

    <!-- Footer -->
    <p class="mt-6 text-xs text-gray-400">
        Do not refresh or close this page
    </p>
</div>

<script>
    const transactionId = "{{ $transactionId }}";

    function showLoader(show = true) {
        $('#loader').toggleClass('hidden', !show);
    }

    function loadTransaction() {
        showLoader(true);

        $.ajax({
            url: "{{ route('nomod.getTransaction', ['id' => ':id']) }}".replace(':id', transactionId),
            method: 'GET',
            success: function(response) {
                if (!response.success) {
                    $('#status').text(response.message);
                    showLoader(false);
                    return;
                }

                const transaction = response.transaction;
                let checkout = {};

                if (transaction.checkout_response) {
                    checkout = typeof transaction.checkout_response === 'string'
                        ? JSON.parse(transaction.checkout_response)
                        : transaction.checkout_response;
                }

                $('#amount').text(`${checkout.amount ?? 'N/A'} ${checkout.currency ?? ''}`);

                if (checkout.url) {
                    $('#payButton').attr('href', checkout.url);
                } else {
                    $('#payButton')
                        .addClass('opacity-50 cursor-not-allowed')
                        .text('Payment Link Unavailable');
                }

                checkPaymentStatus();
            },
            error: function() {
                $('#status').text('Failed to load transaction.');
                showLoader(false);
            }
        });
    }

    function checkPaymentStatus() {
        showLoader(true);

        $.ajax({
            url: "{{ route('nomod.checkStatus') }}",
            method: 'POST',
            data: {
                transaction_id: transactionId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (!response.success) {
                    $('#status').text(response.message || 'Payment check failed.');
                    showLoader(false);
                    return;
                }

                if (response.status === 'paid') {
                    $('#status')
                        .text('Payment Successful! Redirecting...')
                        .removeClass('text-gray-600')
                        .addClass('text-green-600 font-medium');

                    setTimeout(() => {
                        window.location.href =
                            "{{ route('front.checkout.nomod.success') }}" +
                            "?transactionId=" + transactionId;
                    }, 1500);
                } else {
                    $('#status').text('Waiting for payment confirmation...');
                    setTimeout(checkPaymentStatus, 5000);
                }
            },
            error: function() {
                showLoader(false);
            }
        });
    }

    $(document).ready(loadTransaction);
</script>

</body>
</html>
