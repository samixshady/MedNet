<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bkash Payment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Bkash Payment Page</h2>

    <form action="{{ route('process_bkash_payment') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="amount">Amount:</label>
            <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter the amount" required>
        </div>
        <div class="form-group">
            <label for="amount">Enter Phone Number:</label>
            <input type="text" class="form-control" id="amount" name="amount" placeholder="Number" required>
        </div>

        <!-- Add more form fields as needed -->

        <button type="submit" class="btn btn-primary">Proceed with Bkash Payment</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
