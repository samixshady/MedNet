<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/all.css') }}" class="css" />
</head>

<body>
    <div class="container">
        <div class="main-content">
            <p class="text"> MEDNET </p>
        </div>

        <div class="centre-content">
            <h1 id="cartTotal" class="price"><span>/-</span></h1>
            <p class="course">
                Buy Antibiotics Now!
            </p>
        </div>

        <div class="last-content">
            <button type="button" class="pay-now-btn">
                Apply Coupons
            </button>
            <div class="last-content">
                <button type="button" class="pay-now-btn" onclick="applyCoupons()">
                    Pay With Bkash
                </button>
            </div>

            <!-- <button type="button" class="pay-now-btn">
                Netbanking options
            </button> -->
        </div>

        <div class="card-details">
            <p>Pay using Credit or Debit card</p>

            <div class="card-number">
                <label> Card Number </label>
                <input type="text" class="card-number-field" placeholder="###-###-###" />
            </div>
            <br />
            <div class="date-number">
                <label> Expiry Date </label>
                <input type="text" class="date-number-field" placeholder="DD-MM-YY" />
            </div>

            <div class="cvv-number">
                <label> CVV number </label>
                <input type="text" class="cvv-number-field" placeholder="xxx" />
            </div>
            <div class="nameholder-number">
                <label> Card Holder name </label>
                <input type="text" class="card-name-field" placeholder="Enter your Name" />
            </div>
            <button type="submit" class="submit-now-btn">
                submit
            </button>
        </div>
    </div>

    <script>
    // Function to update the cart total dynamically
    function updateCartTotal() {
        // Use AJAX to fetch the cart total from the correct endpoint
        fetch("{{ url('carts') }}") // Use the URL directly instead of the route name
            .then(response => response.json())
            .then(data => {
                console.log('Cart data:', data);
                // Update the cart total element
                document.getElementById('cartTotal').innerHTML = (data.cart_total ? data.cart_total.toFixed(2) : '0.00') + "<span>/-</span>";
            })
            .catch(error => {
                console.error('Error fetching cart data:', error);
            });
    }

    // Call the function initially to set the initial total
    updateCartTotal();

    // Function to apply coupons
    function applyCoupons() {
        // Redirect to the Bkash route
        window.location.href = "{{ route('bkash') }}";
    }
</script>

</body>

</html>
