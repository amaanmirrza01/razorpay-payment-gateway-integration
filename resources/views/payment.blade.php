<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <title>Document</title>
</head>

<body>
    <h1>Processing.......</h1>
    <script>
        var options = {
            "key": "{{ env('RAZORPAY_KEY') }}", // Enter the Key ID generated from the Dashboard
            "amount": {{ $amount }}, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
            "currency": "INR",
            "name": "Acme Corp", //your business name
            "description": "Test Transaction",
            "handler": function(response) {
                var payid = response.razorpay_payment_id;
                var orderid = response.razorpay_order_id;
                var sign = response.razorpay_signature;

                window.location.href ="{{ route('razorpay.callback') }}?payid="+payid+"&orderid="+orderid+"&sign="+sign;
            },
            "order_id": "{{ $orderId }}",
            "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
                "name": "Amaan Mirza", //your customer's name
                "email": "mirrza0001@gmail.com",
                "contact": "+919690990704" //Provide the customer's phone number for better conversion rates 
            },
            "notes": {
                "address": "Razorpay Corporate Office"
            },
            "theme": {
                "color": "#3399cc"
            }
        };
        var rzp1 = new Razorpay(options);
        rzp1.open();
    </script>
</body>

</html>
