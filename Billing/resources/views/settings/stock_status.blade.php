<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Stock Status</title>

    <style>
        /* Global styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fc;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Container styling */
        .container {
            margin-top: 40px;
            text-align: center;
        }

        h3 {
            color: #2c3e50;
            font-size: 28px;
            margin-bottom: 20px;
        }

        h5 {
            color: #3498db;
            font-size: 22px;
            margin-bottom: 15px;
        }

        /* Table styling */
        .table {
            width: 90%;
            margin: 0 auto;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            border: 1px solid #ddd;
        }

        .table th, .table td {
            padding: 12px 15px;
            text-align: center;
            font-size: 16px;
        }

        .table thead {
            background-color: #3498db;
            color: #ffffff;
        }

        .table th {
            font-weight: bold;
            text-transform: uppercase;
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #f1f1f1;
        }

        .table-striped tbody tr:nth-child(even) {
            background-color: #fafafa;
        }

        .table-hover tbody tr:hover {
            background-color: #3498db;
            color: #fff;
            cursor: pointer;
        }

        /* Pagination styling */
        .pagination-container {
            text-align: center;
            margin-top: 20px;
        }

        .pagination {
            display: inline-flex;
            list-style: none;
            padding: 0;
            margin: 0;
            justify-content: center;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination .page-link {
            display: inline-block;
            padding: 8px 16px;
            background-color: #f8f9fa;
            color: #3498db;
            text-decoration: none;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .pagination .page-link:hover {
            background-color: #3498db;
            color: white;
        }

        .pagination .active .page-link {
            background-color: #3498db;
            color: white;
            border-color: #3498db;
        }

        .pagination .disabled .page-link {
            color: #ccc;
            pointer-events: none;
        }

        /* Fade-in effect for rows */
        .fade-in-row {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .fade-in-row.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive design for small screens */
        @media (max-width: 768px) {
            .table {
                width: 100%;
            }
        }
            /* Ensure the button is aligned to the left */
    .go-back-btn {
        background-color: #3498db;
        color: white;
        font-size: 16px;
        padding: 10px 20px;
        border-radius: 5px;
        border: none;
        text-decoration: none;
        display: inline-block;
        transition: background-color 0.3s, transform 0.3s;
        text-align: left; /* Ensures text is left-aligned */
        margin-left: 100px;
    }

    .go-back-btn:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
    }

    .go-back-btn:active {
        background-color: #1f6582;
        transform: translateY(1px);
    }

    .go-back-btn:focus {
        outline: none;
    }

    /* Optionally, you can add a wrapper div to align to the left more specifically */
    .go-back-wrapper {
        display: flex;
        justify-content: flex-start; /* Align the button to the left */
        margin-bottom: 20px;
    }

    /* Responsive Design: ensure button is properly sized on small screens */
    @media (max-width: 768px) {
        .go-back-btn {
            font-size: 14px;
            padding: 8px 16px;
        }
    }

    </style>
</head>
<body>
    <div class="container">
        <h3 class="mb-4">Product Stock Status</h3>
   <!-- Search Form for Low Stock Products -->
   <div class="mb-4">
    <form method="GET" action="{{ route('product.index') }}#section2" class="d-flex justify-content-start">
        <input type="text" name="search" class="form-control me-2" placeholder="Search Low Stock Products..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>
        <!-- Optional Wrapper -->
<div class="go-back-wrapper">
    <a href="{{ route('product.index') }}#section2" class="btn btn-primary go-back-btn mb-4">Go back</a>
</div>
        <!-- Low Stock Table -->
        <h5 class="text-primary mb-3">Low Stock Products (10 or less)</h5>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="text-uppercase">
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Product Name</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lowStockProducts as $product)
                        <tr class="fade-in-row">
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->quantity }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No products with low stock.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <!-- Low Stock Pagination -->
            <div class="pagination-container">
                <ul class="pagination">
                    @if ($lowStockProducts->onFirstPage())
                        <li class="disabled"><a href="#" class="page-link">&laquo; Prev</a></li>
                    @else
                        <li><a href="{{ $lowStockProducts->previousPageUrl() }}" class="page-link">&laquo; Prev</a></li>
                    @endif

                    @foreach ($lowStockProducts->links() as $page)
                        <li class="{{ $page->active ? 'active' : '' }}">
                            <a href="{{ $page->url }}" class="page-link">{{ $page->label }}</a>
                        </li>
                    @endforeach

                    @if ($lowStockProducts->hasMorePages())
                        <li><a href="{{ $lowStockProducts->nextPageUrl() }}" class="page-link">Next &raquo;</a></li>
                    @else
                        <li class="disabled"><a href="#" class="page-link">Next &raquo;</a></li>
                    @endif
                </ul>
            </div>
        </div>

        <!-- Out of Stock Table -->
        <h5 class="text-danger mt-4 mb-3">Out of Stock Products</h5>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="text-uppercase">
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Product Name</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($outOfStockProducts as $product)
                        <tr class="fade-in-row">
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->product_name }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No out of stock products.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <!-- Out of Stock Pagination -->
            <div class="pagination-container">
                <ul class="pagination">
                    @if ($outOfStockProducts->onFirstPage())
                        <li class="disabled"><a href="#" class="page-link">&laquo; Prev</a></li>
                    @else
                        <li><a href="{{ $outOfStockProducts->previousPageUrl() }}" class="page-link">&laquo; Prev</a></li>
                    @endif

                    @foreach ($outOfStockProducts->links() as $page)
                        <li class="{{ $page->active ? 'active' : '' }}">
                            <a href="{{ $page->url }}" class="page-link">{{ $page->label }}</a>
                        </li>
                    @endforeach

                    @if ($outOfStockProducts->hasMorePages())
                        <li><a href="{{ $outOfStockProducts->nextPageUrl() }}" class="page-link">Next &raquo;</a></li>
                    @else
                        <li class="disabled"><a href="#" class="page-link">Next &raquo;</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const rows = document.querySelectorAll(".fade-in-row");
            rows.forEach((row, index) => {
                setTimeout(() => {
                    row.classList.add("show");
                }, index * 150); // Stagger the animation for each row
            });
        });
    </script>
</body>
</html>
