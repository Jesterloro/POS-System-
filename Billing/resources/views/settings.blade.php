<!-- resources/views/settings.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System Settings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>POS System Settings</h1>
        <a class="btn btn-primary btn-hover" href="{{asset('product')}}">Go Back</a>
        <form>
            <!-- Add your form fields here -->
            <div class="form-group">
                <label for="taxRate">Tax Rate (%)</label>
                <input type="number" class="form-control" id="taxRate" placeholder="Enter tax rate">
            </div>
            <div class="form-group">
                <label for="currency">Currency</label>
                <input type="text" class="form-control" id="currency" placeholder="Enter currency (e.g., USD)">
            </div>
            <button type="submit" class="btn btn-primary">Save Settings</button>
        </form>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
