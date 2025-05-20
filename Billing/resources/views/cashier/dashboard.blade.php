<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Dashboard</title>
</head>
<body>
    <h1>Welcome to the Cashier Dashboard</h1>
    <form method="POST" action="{{ route('cashier.logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
