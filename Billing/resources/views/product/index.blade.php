<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Add this for better animation effects -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet"/>
</head>

<body>
    <header>
        <nav>
            <div class="name">
                @if(session('company'))
    <h1 style="font-size: 30px"> {{ session('company') }}</h1>
@endif

                <p>Address 123, xxx,xxx</p>
            </div>

            <form method="POST" action="{{ route('cashier.logout') }}">
                @csrf
                <button type="submit" class="Btn">
                    <div class="sign">
                        <svg viewBox="0 0 512 512">
                            <path
                                d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z">
                            </path>
                        </svg>
                    </div>
                    <div class="text">Logout</div>
                </button>
            </form>

        </nav>
    </header>
    <div class="side-nav">
        <div class="logo">
            <img style="height: 180px; margin-left:50px; margin-top:1px; filter: drop-shadow(-3px 5px 10px #9f9f9f);"
                src="{{ asset('images/logo.png') }}" alt="">
        </div>
        <div class="dashboard">
            <!-- Dashboard -->
            <div class="content">
                <img class="content-img" src="{{ asset('images/dashboard.png') }}">
                <a class="content-txt" href="#section1" onclick="setActive(event)">Dashboard</a>
            </div>
            <!-- Item List -->
            <div class="content">
                <img class="content-img" src="{{ asset('images/item.png') }}" alt="">
                <a class="content-txt" href="#section2" onclick="setActive(event)">Item list</a>
            </div>
            <!-- Transaction -->
            <div class="content">
                <img class="content-img" src="{{ asset('images/transac.png') }}" alt="">
                <a class="content-txt" href="#section3" onclick="setActive(event)">Transaction</a>
            </div>
            <!-- History -->
            <div class="content">
                <img class="content-img" src="{{ asset('images/settings.png') }}">
                <a class="content-txt" href="#section4" onclick="setActive(event)">Settings</a>
            </div>
            <!-- Footer -->
            <div class="side-footer">
                <p class="footer-txt">F1 Toggle Scan</p>
                <p class="footer-txt">F2 Search</p>
                <p class="footer-txt">F3 Payment</p>
                <p class="footer-txt">F4 Clear All</p>
            </div>
        </div>
    </div>

    <section id="section1">

        <div class="container dashboard-container" style="margin-top: 130px; padding-left: 40px;">
            <h1 class="dashboard-title" style="font-weight: 600; font-size: 32px; color: #2c3e50; ">Dashboard</h1>
            <div class="row g-4 justify-content-start">
                <!-- Total Products in Stock Card -->
                <div class="col-6 col-md-3 col-lg-4">
                    <div class="card dashboard-card" style="background: linear-gradient(135deg, #74b9ff, #0984e3);">
                        <div class="card-body text-center">
                            <div class="center d-flex justify-content-around align-center">
                                <img class="fas fa-boxes fa-4x" src="{{ asset('images/icons8-product-50.png') }}" alt="">
                            <h6 class="card-title text-light" style="font-size: 25px;">Total Product Item</h6>
                            </div>
                            <p class="fw-bold text-light" style="font-size: 20px;">{{ $productCount }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Registered Cashiers Card -->
                <div class="col-6 col-md-3 col-lg-4">
                    <div class="card dashboard-card" style="background: linear-gradient(135deg, #55efc4, #00cec9);">
                        <div class="card-body text-center">
                            <div class="center d-flex justify-content-around align-center">
                                <img class="fas fa-boxes fa-4x" style="height: 50px" src="{{ asset('images/icons8-cashier-60.png') }}" alt="">
                            <h6 class="card-title text-light" style="font-size: 25px;">Registered Cashier</h6>
                            </div>
                            <p class="fw-bold text-light" style="font-size: 20px;">{{ $totalCashiers }}</p>
                        </div>
                    </div>
                </div>

                <!-- Performance Metrics Card -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card dashboard-card" style="background: linear-gradient(135deg, #ffeaa7, #fdcb6e);">
                        <div class="card-body text-center">
                            <i class="fas fa-chart-line fa-4x mb-4 text-dark"></i>
                            <h6 class="card-title text-dark" style="font-size: 21px;">Performance Metrics Sample</h6>
                            <p class="fw-bold text-dark" style="font-size: 20px;">85%</p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-5" style="border: none; height: 1px; background: #bdc3c7;">

            <h1 class="dashboard-title" style="font-weight: 600; font-size: 32px; color: #2c3e50;">Transactions</h1>
            <div class="row g-4 justify-content-start">
                <!-- Total Transactions Card -->
                <div class="col-6 col-md-4 col-lg-4">
                    <div class="card dashboard-card" style="background: linear-gradient(135deg, #a29bfe, #6c5ce7);">
                        <div class="card-body text-center">
                            <div class="center d-flex justify-content-around align-center">
                                <img class="fas fa-boxes fa-4x" style="height: 50px;" src="{{ asset('images/icons8-transactions-32.png') }}" alt="">
                            <h6 class="card-title text-light" style="font-size: 25px;">Total transactions</h6>
                            </div>
                            <p class="fw-bold text-light" style="font-size: 20px;">{{ $totalTransactions }}</p>
                        </div>
                    </div>
                </div>

                <!-- Transactions Today Card -->
                <div class="col-6 col-md-4 col-lg-4">
                    <div class="card dashboard-card" style="background: linear-gradient(135deg, #fab1a0, #ff7675);">
                        <div class="card-body text-center">
                            <div class="center d-flex justify-content-around align-center">
                                <img class="fas fa-boxes fa-4x" src="{{ asset('images/icons8-product-50.png') }}" alt="">
                            <h6 class="card-title text-light" style="font-size: 25px;">Today Transactions</h6>
                            </div>
                            <p class="fw-bold text-light" style="font-size: 20px;">{{ $totalTransactionsToday }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-5" style="border: none; height: 1px; background: #bdc3c7;">

            <h1 class="dashboard-title" style="font-weight: 600; font-size: 32px; color: #2c3e50; ">Sales</h1>
            <div class="row g-4 justify-content-start">
                <!-- Total Sales Card -->
                <div class="col-6 col-md-4 col-lg-4">
                    <div class="card dashboard-card" style="background: linear-gradient(135deg, #ff9f43, #feca57);">
                        <div class="card-body text-center">
                            <div class="center d-flex justify-content-around align-center">
                                <img class="fas fa-boxes fa-4x" src="{{ asset('images/icons8-sales-50.png') }}" alt="">
                            <h6 class="card-title text-light" style="font-size: 25px; margin-right:50px;">Total Sales</h6>
                            </div>
                            <p class="fw-bold text-light" style="font-size: 20px;">₱{{ number_format($totalSales, 2) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Sales Today Card -->
                <div class="col-6 col-md-4 col-lg-4">
                    <div class="card dashboard-card" style="background: linear-gradient(135deg, #fd79a8, #e84393);">
                        <div class="card-body text-center">
                            <div class="center d-flex justify-content-around align-center">
                                <img class="fas fa-boxes fa-4x" src="{{ asset('images/icons8-sales-50.png') }}" alt="">
                            <h6 class="card-title text-light" style="font-size: 25px; margin-right:50px;">Today Sales</h6>
                            </div>
                            <p class="fw-bold text-light" style="font-size: 18px;">₱{{ number_format($todayTotalSales, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>








    </section>

    <section id="section2">

        <div class="container" style="margin-top: 80px;">
            <h1>Product List</h1>


            {{-- Success Message --}}
            @if (session('success'))
                <div class="alert alert-success" id="success-message"
                    style="position: absolute; right: 10px; z-index: 1000; opacity: 0; transition: opacity 0.5s;">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger"
                    style="position: absolute; right: 10px; z-index: 1000; opacity: 0; transition: opacity 0.5s;">
                    {{ session('error') }}
                </div>
            @endif

            <script>
                // Fade in the success message
                window.addEventListener('load', function() {
                    const successMessage = document.getElementById('success-message');
                    if (successMessage) {
                        successMessage.style.opacity = 1; // Triggers fade-in on page load
                    }
                });

                // Wait 5 seconds, then hide the success message
                setTimeout(function() {
                    const successMessage = document.getElementById('success-message');
                    if (successMessage) {
                        successMessage.style.transition = "opacity 0.2s";
                        successMessage.style.opacity = 0;
                        setTimeout(() => successMessage.remove(), 500); // Remove from DOM after fade-out
                    }
                }, 2000);
            </script>


    <!-- Search Input -->
    <div class="d-flex justify-content-between my-3" style="height: 40px">
        <button type="button" class="btn btn-primary " data-bs-toggle="modal"
        data-bs-target="#addProductModal" >
        Add New Product
        </button>
        <button onclick="window.location.href='{{ route('settings.stock-status') }}'" class="btn btn-secondary" style="margin-left: 20px;">
            View Stock Status
        </button>
        <div class="container" style="width:400px; margin-right:-200px;">
            <form action="{{ route('product.index') }}#section2" method="GET" class="d-flex" id="searchForm" >
                <input type="text" name="search" class="form-control"
                       placeholder="Search products..."
                       value="{{ request()->query('search') }}"
                       oninput="checkSearchInput(this)"
                       required >
                <button type="submit" class="btn btn-primary ms-2" style="height: 40px;">Search</button>
            </form>
        </div>

    </div>
    <script>
        // JavaScript function to auto-submit form when input is cleared
        function checkSearchInput(input) {
            if (input.value.trim() === '') {
                document.getElementById('searchForm').submit();
            }
        }
    </script>
{{-- Product table --}}
{{-- error message if the currennt product on sale cannot be deleted --}}
@if ($errors->any())
    <div class="custom-error-message" id="error-message">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<script>
    // Automatically fade out the error message after 5 seconds
    setTimeout(() => {
        const errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            errorMessage.style.transition = "opacity 0.2s ease";
            errorMessage.style.opacity = "0"; // Fade out
            setTimeout(() => errorMessage.remove(), 200); // Remove after fade-out
        }
    }, 2000);
</script>



<div id="product-section" class=" " style="max-height: 600px; overflow-y: auto; position: relative; width:1500px; border:2px solid rgb(174, 174, 174);">
    <table class="table table-hover align-middle text-left" id="productTable">
        <thead class="table-primary sticky-top text-center">
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Product Name</th>
                <th>Stock</th>
                <th>Barcode</th>
                <th>Price</th>
                <th>Discount</th> <!-- New column for discount -->
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr class="product-row text-center">
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td style="max-width: 90px;">
                        <input type="number"
                               class="form-control quantity-input @if($product->quantity == 0) text-danger fw-bold @endif"
                               value="{{ $product->quantity }}"
                               data-id="{{ $product->id }}"
                               min="0"
                               id="product-quantity-{{ $product->id }}"/>
                               @if ($product->quantity == 0)
                                    <span class="text-danger fw-bold">Out of Stock</span>
                                 @elseif ($product->quantity <= 10)
                                    <span class="text-warning fw-bold">Low Stock</span>
                                @endif
                    </td>


                    <td>{{ $product->barcode }}</td>
                    <td id="product-price-{{ $product->id }}" data-original-price="{{ $product->original_price ?? $product->price }}">
                        ₱{{ number_format($product->price, 2) }}
                    </td>
                    <td>
                        <input type="number" class="discount-input" data-id="{{ $product->id }}" value="{{ $product->discount ?? 0 }}">
                    </td>
                    <td class="text-center">
                            <!-- Button to trigger the modal -->
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal-{{ $product->id }}">
                                Edit
                            </button>

                        <!-- Delete Button -->
                        <form action="{{ route('product.destroy', $product->id) }}#section2" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm animated-button"
                                onclick="return confirm('Are you sure you want to delete this product?')">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </form>

                        <!-- Import Sales Button -->
                        <button type="button" class="btn btn-primary btn-sm animated-button" data-bs-toggle="modal"
                            data-bs-target="#salesModal{{ $product->id }}" data-price="{{ $product->price }}">
                            <i class="fas fa-cart-plus"></i> Import Sales
                        </button>
                    </td>
                </tr>



   {{-- Edit Modal --}}
   <div class="modal fade" id="editProductModal-{{ $product->id }}" tabindex="-1" aria-labelledby="editProductModalLabel-{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel-{{ $product->id }}">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('products.update', $product->id) }}#section2" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="code-{{ $product->id }}" class="form-label">Code</label>
                        <input type="text" name="code" class="form-control" id="code-{{ $product->id }}" value="{{ $product->code }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="product_name-{{ $product->id }}" class="form-label">Product Name</label>
                        <input type="text" name="product_name" class="form-control" id="product_name-{{ $product->id }}" value="{{ $product->product_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="barcode-{{ $product->id }}" class="form-label">Barcode</label>
                        <input type="text" name="barcode" class="form-control" id="barcode-{{ $product->id }}" value="{{ $product->barcode }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="price-{{ $product->id }}" class="form-label">Price</label>
                        <input type="number" step="0.01" name="price" class="form-control" id="price-{{ $product->id }}" value="{{ $product->price }}" required>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


                {{-- Sales Import Modal --}}
                <div class="modal fade" id="salesModal{{ $product->id }}" tabindex="-1" aria-labelledby="salesModalLabel{{ $product->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="salesModalLabel{{ $product->id }}">Import Sales for {{ $product->product_name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('product.import_sales', $product->id) }}#section2" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="quantity_sold" class="form-label">Quantity Sold</label>
                                        <input type="number" id="quantity_sold{{ $product->id }}" name="quantity_sold" class="form-control" min="1" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="total_price" class="form-label">Total Price</label>
                                        <input type="text" id="total_price{{ $product->id }}" name="total_price" class="form-control" readonly>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Record Sale</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>

            {{-- Pagination links --}}
            <div class="d-flex justify-content-center" style="margin-top:15px">
                {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>


            <script>

                //for discount of products
                document.querySelectorAll('.discount-input').forEach(function(input) {
    input.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            var productId = input.getAttribute('data-id');
            var originalPrice = parseFloat(document.getElementById('product-price-' + productId).getAttribute('data-original-price'));
            var discount = parseFloat(input.value) || 0;

            // Calculate the new price after applying the discount
            var discountedPrice = (discount > 0)
                ? originalPrice - (originalPrice * (discount / 100))  // Apply discount
                : originalPrice;  // Revert to original price if discount is zero

            // Update the price in the table
            document.getElementById('product-price-' + productId).textContent = '₱' + discountedPrice.toFixed(2);

            // Save the discount and price to the database
            updatePriceInDatabase(productId, discount, discountedPrice);
        }
    });
});

// Function to update the price and discount in the database
function updatePriceInDatabase(productId, discount, discountedPrice) {
    fetch('/product/update-price', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            product_id: productId,
            new_discount: discount,
            new_price: discountedPrice
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            console.log('Price and discount updated successfully!');
            // Reload the page after the price and discount are updated
            window.location.reload();
        } else {
            console.error('Failed to update price and discount');
        }
    })
    .catch(error => {
        console.error('Error updating price and discount:', error);
    });
}


</script>
<script>
                // end pf discounted price
                // for editing on product
                document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-product');
    const editProductModal = new bootstrap.Modal(document.getElementById('editProductModal'));
    const editForm = document.getElementById('editProductForm');

    // Populate the modal with product data
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.dataset.id;
            const code = this.dataset.code;
            const name = this.dataset.name;
            const quantity = this.dataset.quantity;
            const barcode = this.dataset.barcode;
            const price = this.dataset.price;

            document.getElementById('edit-product-id').value = productId;
            document.getElementById('edit-product-code').value = code;
            document.getElementById('edit-product-name').value = name;
            document.getElementById('edit-product-quantity').value = quantity;
            document.getElementById('edit-product-barcode').value = barcode;
            document.getElementById('edit-product-price').value = price;

            editProductModal.show();
        });
    });

    // Handle form submission
    editForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const productId = document.getElementById('edit-product-id').value;
        const code = document.getElementById('edit-product-code').value;
        const name = document.getElementById('edit-product-name').value;
        const quantity = document.getElementById('edit-product-quantity').value;
        const barcode = document.getElementById('edit-product-barcode').value;
        const price = document.getElementById('edit-product-price').value;

        fetch(`/products/${productId}/update`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                code,
                product_name: name,
                quantity,
                barcode,
                price
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Product updated successfully.');
                // Optionally, update the row data without refreshing the page
                document.querySelector(`#product-row-${productId} td:nth-child(2)`).textContent = code;
                document.querySelector(`#product-row-${productId} td:nth-child(3)`).textContent = name;
                document.querySelector(`#product-row-${productId} td:nth-child(4)`).textContent = quantity;
                document.querySelector(`#product-row-${productId} td:nth-child(5)`).textContent = barcode;
                document.querySelector(`#product-row-${productId} td:nth-child(6)`).textContent = `₱${parseFloat(price).toFixed(2)}`;
                editProductModal.hide();
            } else {
                alert('Failed to update product. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    });
});

                // end for editing
                // for the quantity of products editable
                document.addEventListener('DOMContentLoaded', function () {
    // Add event listener to all quantity input fields
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function () {
            const productId = this.dataset.id; // Get product ID
            const newQuantity = parseInt(this.value, 10); // Get new quantity as an integer

            if (isNaN(newQuantity) || newQuantity < 0) {
                alert('Invalid quantity. Please enter a value of 0 or greater.');
                this.value = 0; // Reset to 0 if invalid
                return;
            }

            // Send AJAX request to update the quantity
            fetch(`/products/${productId}/update-quantity`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ quantity: newQuantity })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to update quantity.');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Quantity updated successfully.');

                    // Update the UI dynamically
                    const stockRow = document.getElementById(`product-quantity-${productId}`);
                    let label = stockRow.nextElementSibling; // Assumes the label is after the input

                    // Handle "Out of Stock" case
                    if (newQuantity === 0) {
                        stockRow.classList.add('text-danger', 'fw-bold');
                        stockRow.style.outline = ''; // Remove yellow outline
                        if (!label || label.textContent !== 'Out of Stock') {
                            if (label) label.remove();
                            const outOfStockSpan = document.createElement('span');
                            outOfStockSpan.className = 'text-danger fw-bold';
                            outOfStockSpan.textContent = 'Out of Stock';
                            stockRow.parentNode.appendChild(outOfStockSpan);
                        }
                    }
                    // Handle "Low Stock" case
                    else if (newQuantity <= 10) { // Quantity is 10 or less
                        stockRow.classList.remove('text-danger', 'fw-bold');
                        stockRow.style.outline = '2px solid yellow'; // Add yellow outline for low stock
                        if (!label || label.textContent !== 'Low Stock') {
                            if (label) label.remove();
                            const lowStockSpan = document.createElement('span');
                            lowStockSpan.className = 'text-warning fw-bold';
                            lowStockSpan.textContent = 'Low Stock';
                            stockRow.parentNode.appendChild(lowStockSpan);
                        }
                    }
                    // Handle sufficient stock case
                    else {
                        stockRow.classList.remove('text-danger', 'fw-bold');
                        stockRow.style.outline = ''; // Remove yellow outline
                        if (label && (label.textContent === 'Out of Stock' || label.textContent === 'Low Stock')) {
                            label.remove();
                        }
                    }
                }
            })
            .catch(error => {
                console.error(error);
                alert('Error updating quantity. Please try again.');
            });
        });
    });
});




                // end of the product editable
                    $(document).ready(function() {
    $('#productTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('products.data') }}",  // Adjust route to point to an endpoint that fetches data
        "columns": [
            { "data": "id" },
            { "data": "code" },
            { "data": "product_name" },
            { "data": "quantity" },
            { "data": "barcode" },
            { "data": "price" },
            {
                "data": "actions",
                "orderable": false,
                "searchable": false
            }
        ]
    });
});
</script>
{{-- Modal for Adding Product --}}
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                {{-- Add Product Form --}}
                <form action="{{ route('product.store') }}#section2" method="POST" id="addProductForm">
                    @csrf

                    <div class="form-group mb-4">
                        <label for="code" class="h6">Product Code</label>
                        <input type="text" class="form-control form-control-lg" id="code" name="code" placeholder="Enter product code" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="product_name" class="h6">Product Name</label>
                        <input type="text" class="form-control form-control-lg" id="product_name" name="product_name" placeholder="Enter product name" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="quantity" class="h6">Quantity</label>
                        <input type="number" class="form-control form-control-lg" id="quantity" name="quantity" placeholder="Enter quantity" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="barcode" class="h6">Barcode</label>
                        <input type="text" class="form-control form-control-lg" id="barcode" name="barcode" placeholder="Enter barcode" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="price" class="h6">Price</label>
                        <input type="text" class="form-control form-control-lg" id="price" name="price" placeholder="Enter product price" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" form="addProductForm">
                    <i class="fas fa-plus-circle"></i> Add Product
                </button>
            </div>
        </div>
    </div>
</div>

    </section>

    <section id="section3">
        <div class="container" style="">
                    <div class="container" style="padding-top: 110px;">
                    </div>
                    <!-- Search Form Above Sales Table -->
                    <div id="search-container" class="mt-3 d-flex" style="width: 1530px">
                        @if(session('cashierName'))
    <h1 style="font-size: 30px">Cashier {{ session('cashierName') }}</h1>
@endif
                        <div class="info-container">
                            <label for="barcode-input">Scan:</label>
                            <input type="text" id="barcode-input" placeholder="Enter Barcode">
                            <button id="search-product-btn" style="margin-left: -15px;">Scan</button>
                        </div>
                    </div>

<!-- Modal for Quantity Input -->
<div id="quantityModal" class="modal">
    <div class="modal-content">
        <span class="close" id="close-modal">&times;</span>
        <label for="quantity-input">Enter Quantity:</label>
        <input type="number" id="quantity-input" min="1" />
        <button id="add-to-sales">Add to Sales</button>
        <button id="cancel-modal">Cancel</button>
    </div>
</div>
@if (session('success'))
<div class="alert alert-success" id="success-message"
    style="position: absolute; top: 10px; right: 10px; z-index: 1000; opacity: 0; transition: opacity 0.5s;">
    {{ session('success') }}
</div>
@elseif(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<script>
    // Fade in the success message
    window.addEventListener('load', function() {
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.opacity = 1; // Triggers fade-in on page load
        }
    });
    // Wait 5 seconds, then hide the success message
    setTimeout(function() {
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.transition = "opacity 0.2s";
            successMessage.style.opacity = 0;
            setTimeout(() => successMessage.remove(), 500); // Remove from DOM after fade-out
        }
    }, 2000);


</script>
    <div class="transaction" style="display: flex; justify-content:space-around; width:1550px;">
        <div class="table-side d-flex" style="background-color:rgb(243, 240, 240);">
                        <div class="table-responsive mt-1" style="max-height: 690px;  overflow-y: auto; position: relative; width:1250px">
                            <table class="table  table-bordered table-hover align-middle text-left" style="padding: 0;">
                                <thead class="table-primary " style="position: sticky;">
                                    <tr>
                                        <th>Sale ID</th>
                                        <th>Product Name</th>
                                        <th>Quantity Sold</th>
                                        <th>Unit Price</th>
                                        <th>Total Price</th>
                                        {{-- <th>Sale Date</th> --}}
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="salesTableBody" class="" style="font-weight: 600;">
                                    @foreach ($sales as $sale)
                                        <tr id="sale-row-{{ $sale->id }}">
                                            <td>{{ $sale->id }}</td>
                                            <td>{{ $sale->product->product_name }}</td>
                                            <td>
                                                <input type="number"
                                                       class="form-control sales-quantity"
                                                       value="{{ $sale->quantity }}"
                                                       data-sale-id="{{ $sale->id }}"
                                                       data-product-id="{{ $sale->product->id }}"
                                                       data-price-per-unit="{{ $sale->product->price }}"
                                                       min="1">
                                            </td>
                                            <td>{{$sale->product->price}}</td>
                                            <td id="total-price-{{ $sale->id }}">₱{{ number_format($sale->total_price, 2) }}</td>
                                            {{-- <td>{{ $sale->sale_date }}</td> --}}
                                            <td>
                                                <form action="{{ route('sales.destroy', $sale->id) }}#section3"
                                                    method="POST" style="display:inline;">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button type="submit" class="btn btn-danger btn-sm"
                                                          onclick="return confirm('Are you sure you want to delete this sale?')">
                                                      Delete
                                                  </button>
                                              </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="btn" style="display: flex; flex-direction:column;">
                        <div class="modern-container mb-3" style="text-align: center;">
                            <h6>Current Date and Time</h6>
                            <h4 id="current-time" style="font-weight: 600;"></h4>
                        </div>
                        <div class="history-clear" style="">
                            <div class="button py-5 modern-container">
                                <div class="container">
                                    <!-- View Transaction History Button -->
                                    <a href="{{ route('transaction.history') }}" class="btn btn-primary transaction modern-btn">View Transaction History</a>
                                </div>

                                <!-- Clear All Sales Button -->
                                <div class="container mt-3">
                                    <form action="{{ route('sales.clearAll') }}#section3" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger mb-3" onclick="return confirm('Are you sure you want to clear all sales?')">
                                            Clear All Sales
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                       <!-- Totals Box -->
                            <div class=" mt-3 modern-container">
                                <div class="totals-box ">
                                    <div class="totals text-center">
                                        <h6 class="text-muted">Subtotal: <span class="total-amount" id="subtotal-amount">₱{{ number_format($subtotal, 2) }}</span></h6>
                                        <h6 class="text-muted">Tax (5%): <span class="total-amount" id="tax-amount">₱{{ number_format($tax, 2) }}</span></h6>
                                        <h5 class="display-7 text-primary" id="total-price">
                                            Total: <span id="total-amount">₱{{ number_format($total, 2) }}</span>
                                        </h5>
                                        <div class="my-3">
                                            <button type="button" class="btn btn-submit-payment" data-bs-toggle="modal" data-bs-target="#paymentModal">
                                                Submit Payment
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>

                    <script>
                          function updateClock() {
        const now = new Date();

        // Get hours, minutes, and seconds
        let hours = now.getHours();
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');

        // Determine AM or PM
        const ampm = hours >= 12 ? 'PM' : 'AM';

        // Convert to 12-hour format
        hours = hours % 12 || 12; // Convert 0 to 12 for midnight

        // Get day, month, and year
        const day = now.getDate();
        const year = now.getFullYear();

        // Month names
        const monthNames = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        const month = monthNames[now.getMonth()]; // Get month name

        // Combine date and time
        const formattedTime = `${day} ${month} ${year}  ${hours}:${minutes}:${seconds} ${ampm}`;

        // Update the clock element
        document.getElementById('current-time').textContent = formattedTime;
    }

    // Update clock every second
    setInterval(updateClock, 1000);
    window.onload = updateClock; // Initialize clock immediately on page load

                          document.addEventListener('DOMContentLoaded', function () {
    const searchButton = document.getElementById('search-product-btn');
    const barcodeInput = document.getElementById('barcode-input');
    const quantityModal = document.getElementById('quantityModal');
    const addToSalesButton = document.getElementById('add-to-sales');
    const cancelModalButton = document.getElementById('cancel-modal');
    const quantityInput = document.getElementById('quantity-input');
    const closeModalButton = document.getElementById('close-modal');
    const salesTableBody = document.getElementById('salesTableBody');
    let selectedProduct = null;

    function openQuantityModal(product) {
        selectedProduct = product;
        quantityModal.style.display = 'block';
    }

    function closeQuantityModal() {
        quantityModal.style.display = 'none';
    }

    addToSalesButton.onclick = function () {
        const quantity = parseInt(quantityInput.value);

        if (quantity < 1 || isNaN(quantity)) {
            alert('Please enter a valid quantity.');
            return;
        }

        if (quantity > selectedProduct.quantity) {
            alert('Not enough stock for this product.');
            return;
        }

        const row = document.createElement('tr');
        row.id = `sale-row-${selectedProduct.id}`;
        row.innerHTML = `
            <td>${selectedProduct.id}</td>
            <td>${selectedProduct.product_name}</td>
            <td><input type="number" value="${quantity}" class="form-control sales-quantity" data-sale-id="${selectedProduct.id}" data-product-id="${selectedProduct.id}" data-price-per-unit="${selectedProduct.price}" min="1"></td>
            <td id="total-price-${selectedProduct.id}">₱${(selectedProduct.price * quantity).toFixed(2)}</td>
            <td>${new Date().toLocaleString()}</td>
            <td>
                <button class="btn btn-danger btn-sm remove-sale" data-sale-id="${selectedProduct.id}">Delete</button>
            </td>
        `;
        salesTableBody.appendChild(row);

        saveSaleToDatabase(selectedProduct.id, quantity);
        updateProductStock(selectedProduct.id, quantity);
        recalculateTotals();
        closeQuantityModal();
    };

    cancelModalButton.onclick = closeModalButton.onclick = closeQuantityModal;

    searchButton.onclick = function () {
        const barcode = barcodeInput.value;

        if (!barcode) {
            alert('Please enter a barcode.');
            return;
        }

        fetch(`/products/search/${barcode}`)
            .then(response => response.json())
            .then(data => {
                if (data.product) {
                    openQuantityModal(data.product);
                } else {
                    alert('Product not found.');
                }
            })
            .catch(error => {
                console.error('Error fetching product:', error);
            });
    };

    function saveSaleToDatabase(productId, quantitySold) {
        fetch('/sales/store', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                product_id: productId,
                quantity_sold: quantitySold
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // alert('Sale saved successfully.');
                    window.location.reload(); // Reload page
                } else {
                    alert('Error saving sale.');
                }
            })
            .catch(error => {
                console.error('Error saving sale:', error);
            });
    }

    function updateProductStock(productId, quantitySold) {
        fetch(`/products/${productId}/update-stock`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ quantity_sold: quantitySold })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Product stock updated successfully.');
                } else {
                    console.error('Error updating product stock.');
                }
            })
            .catch(error => {
                console.error('Error updating stock:', error);
            });
    }

    salesTableBody.addEventListener('click', function (event) {
        if (event.target && event.target.classList.contains('remove-sale')) {
            const button = event.target;
            const saleId = button.dataset.saleId;
            const row = button.closest('tr');
            const productId = row.querySelector('.sales-quantity').dataset.productId;
            const quantity = row.querySelector('.sales-quantity').value;

            fetch(`/sales/destroy/${saleId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        row.remove();
                        updateProductStockAfterRemoval(productId, quantity);
                        recalculateTotals();
                        window.location.reload(); // Reload page
                    } else {
                        alert('Error deleting sale. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error deleting sale:', error);
                    alert('Error deleting sale. Please try again.');
                });
        }
    });

    function updateProductStockAfterRemoval(productId, quantity) {
        fetch(`/products/${productId}/update-stock`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ quantity_sold: -quantity })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Product stock updated successfully after removal.');
                } else {
                    console.error('Error updating product stock after removal.');
                }
            })
            .catch(error => {
                console.error('Error updating stock after removal:', error);
            });
    }

    window.onclick = function (event) {
        if (event.target === quantityModal) {
            closeQuantityModal();
        }
    };

    salesTableBody.addEventListener('keydown', function (event) {
        if (event.target && event.target.classList.contains('sales-quantity') && event.key === 'Enter') {
            event.preventDefault();

            const input = event.target;
            const saleId = input.dataset.saleId;
            const productId = input.dataset.productId;
            const pricePerUnit = parseFloat(input.dataset.pricePerUnit);
            const newQuantity = parseInt(input.value);

            if (newQuantity < 1) {
                alert('Quantity must be at least 1.');
                input.value = 1;
                return;
            }

            const newTotalPrice = newQuantity * pricePerUnit;
            document.getElementById(`total-price-${saleId}`).innerText = `₱${newTotalPrice.toFixed(2)}`;
            recalculateTotals();

            fetch(`/sales/${saleId}/update-quantity`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    quantity: newQuantity,
                    total_price: newTotalPrice,
                    product_id: productId
                })
            })
                .then(response => response.json())
                .then(data => {
                    alert('Sale quantity updated.');
                    window.location.reload(); // Reload page
                })
                .catch(error => {
                    console.error(error);
                    alert('Error updating sale. Please try again.');
                });
        }
    });

    function recalculateTotals() {
        let subtotal = 0;

        document.querySelectorAll('#salesTableBody .sales-quantity').forEach(input => {
            const quantity = parseFloat(input.value || 0);
            const pricePerUnit = parseFloat(input.dataset.pricePerUnit || 0);
            subtotal += quantity * pricePerUnit;
        });

        const tax = subtotal * 0.05;
        const total = subtotal + tax;

        document.querySelector('#subtotal-amount').textContent = `₱${subtotal.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}`;
        document.querySelector('#tax-amount').textContent = `₱${tax.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}`;
        document.querySelector('#total-amount').textContent = `₱${total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}`;
    }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'F3') {
            event.preventDefault();
            document.querySelector('.btn-submit-payment').click();
        }
    });
});


                    </script>
                <!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Total Amount Due:</strong> ₱{{ number_format($total, 2) }}</p>
                  <!-- Discount Field -->
                  <div class="mb-3">
                    <label for="discount" class="form-label">Enter Discount Percentage:</label>
                    <input type="number" id="discount" class="form-control" placeholder="Enter discount percentage" oninput="updateDiscountedTotal()">
                    <div id="discountError" class="form-text text-danger" style="display: none;">
                        Discount must not be greater than 100%.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="paymentAmount" class="form-label">Enter Payment Amount:</label>
                    <input type="number" id="paymentAmount" class="form-control" placeholder="Enter amount paid" oninput="validatePayment()">
                    <div id="paymentError" class="form-text text-danger" style="display: none;">
                        Payment must be greater than or equal to the total amount.
                    </div>
                </div>



                <p><strong>Discounted Total:</strong> <span id="discountedTotal">₱{{ number_format($total, 2) }}</span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="calculateChangeBtn" onclick="calculateChange()" disabled>
                    Calculate Change
                </button>
            </div>
        </div>
    </div>
</div>

     <!-- Receipt Modal -->
<div class="modal fade" id="receiptModal" tabindex="-1" aria-labelledby="receiptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Receipt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="receipt" id="receiptContent">
                    <h5 class="text-center">Your Company Name</h5>
                    <p class="text-center">1234 Street Address, City, Country</p>
                    <p>-----------------------------------</p>
                    <p class="text-center"><strong>Reference ID:</strong><span id="receiptReferenceID"></span></p>
                    <p class="text-center"><strong>Date:</strong> <span id="receiptDate"></span></p>
                    <p>-----------------------------------</p>

                    <!-- Sales Items List -->
                    <div class="sales-items">
                        <p><strong>Items Purchased:</strong></p>
                        <table class="table table-sm table-borderless">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th class="text-end">Quantity</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $sale)
                                    <tr>
                                        <td>{{ $sale->product->product_name }}</td>
                                        <td class="text-end">{{ $sale->quantity }}</td>
                                        <td class="text-end">₱{{ number_format($sale->quantity * $sale->product->price, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <p>-----------------------------------</p>
                    <p class="text-end" style="color: #525050">SUBTOTAL: ₱{{ number_format($subtotal, 2) }}</p>
                    <p class="text-end" style="color: #525050">TAX (5%): ₱{{ number_format($tax, 2) }}</p>

                    <!-- Discount Information -->
                    <p class="text-end" style="color: #525050" id="receiptDiscountInfo">DISCOUNT: ₱0.00</p>

                    <p>-----------------------------------</p>
                    <p class="text-center" style="color: #070606; font-size:20px; font-weight:600;" id="receiptTotalAmountDue">TOTAL AMOUNT DUE: ₱{{ number_format($total, 2) }}</p>
                    <p>-----------------------------------</p>
                    <p class="text-end" style="color: #525050">PAYMENT RECEIVED: ₱<span id="receiptPayment"></span></p>
                    <p class="text-end" style="color: #525050">CHANGE GIVEN: ₱<span id="receiptChange"></span></p>
                    <p>-----------------------------------</p>
                    <div class="container d-flex justify-content-between">
                        @if(session('cashierName'))
                            <p>Cashier: {{ session('cashierName') }}</p>
                        @endif
                    </div>
                    <div class="container d-flex justify-content-between">
                        <p class="text-center">Signature:_________________</p>
                    </div>
                    <p>-----------------------------------</p>
                    <p class="text-center">Please see your receipt before you leave! Thank You!</p>
                </div>
            </div>

            <!-- Save Receipt Button in the Receipt Modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="printReceipt()">Print Receipt</button>
                <button type="button" class="btn btn-success" id="saveReceiptBtn" onclick="saveReceipt()">Confirm Transacion</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="resetReceiptModal()">Cancel</button>
            </div>
        </div>
    </div>
</div>






                    <!-- Custom JavaScript for Dynamic Total Price Calculation -->
                    <script>


                        document.addEventListener('DOMContentLoaded', function() {
                            // Add event listener to every modal button
                            document.querySelectorAll('button[data-bs-target^="#salesModal"]').forEach(button => {
                                button.addEventListener('click', function() {
                                    // Get product price from data attribute
                                    let productPrice = this.getAttribute('data-price');

                                    // Get the modal form fields
                                    let modal = document.querySelector(this.getAttribute('data-bs-target'));
                                    let quantitySoldField = modal.querySelector('[name="quantity_sold"]');
                                    let totalPriceField = modal.querySelector('[name="total_price"]');

                                    // Attach input event listener to quantity sold input field
                                    quantitySoldField.addEventListener('input', function() {
                                        let quantity = parseFloat(this.value) || 0;
                                        let totalPrice = quantity * parseFloat(productPrice);
                                        totalPriceField.value = totalPrice.toFixed(
                                            2); // Set total price with 2 decimal places
                                    });
                                });
                            });
                        });

                        // to calculate the total price with the payment of client
                    // Function to validate the payment input
                    let discount = 0;  // Initialize the discount value

// Function to update the discounted total in the payment modal
function updateDiscountedTotal() {
    const total = parseFloat(@json($total));
    const discountPercentage = parseFloat(document.getElementById('discount').value) || 0;

    if (discountPercentage > 100) {
        document.getElementById('discountError').style.display = 'block';
        return;
    } else {
        document.getElementById('discountError').style.display = 'none';
    }

    // Calculate the discount value
    discount = (discountPercentage / 100) * total;
    const discountedTotal = total - discount;
    document.getElementById('discountedTotal').textContent = '₱' + discountedTotal.toFixed(2);

    // Enable the Calculate Change button if the payment is valid
    validatePayment();
}

// Function to validate the payment input
function validatePayment() {
    const discountedTotal = parseFloat(document.getElementById('discountedTotal').textContent.replace('₱', ''));
    const paymentAmount = parseFloat(document.getElementById('paymentAmount').value);
    const errorElement = document.getElementById('paymentError');
    const calculateBtn = document.getElementById('calculateChangeBtn');

    if (isNaN(paymentAmount) || paymentAmount < discountedTotal) {
        errorElement.style.display = 'block';
        calculateBtn.disabled = true;
    } else {
        errorElement.style.display = 'none';
        calculateBtn.disabled = false;
    }
}

          // Function to generate a random 8-digit reference ID
          async function generateReferenceID() {
    let referenceID = 1; // Default for the first transaction

    try {
        const response = await fetch('/get-last-reference-id'); // Adjust route if necessary
        const data = await response.json();

        if (data.lastReferenceID) {
            referenceID = parseInt(data.lastReferenceID, 10) + 1; // Increment numeric part
        }
    } catch (error) {
        console.error('Error fetching last reference ID:', error);
    }

    // Format as 8-digit padded number
    return `REF-${referenceID.toString().padStart(8, '0')}`;
}





async function saveNewReferenceID(newReferenceID) {
    try {
        await fetch('/save-reference-id', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ reference_id: newReferenceID })
        });
    } catch (error) {
        console.error('Error saving new reference ID:', error);
    }
}




// Function to get the current date and time in a readable format
function getCurrentDateTime() {
    const date = new Date();
    return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
}

// Function to calculate change and generate receipt
async function calculateChange() {
    // Check if there are sales in the sales table
    const salesRows = document.querySelectorAll('#salesTableBody tr');
    if (salesRows.length === 0) {
        alert("No sales found! Please add sales before proceeding.");
        return; // Stop execution if no sales are present
    }

    const discountedTotal = parseFloat(document.getElementById('discountedTotal').textContent.replace('₱', ''));
    const paymentAmount = parseFloat(document.getElementById('paymentAmount').value);

    if (paymentAmount >= discountedTotal) {
        const change = paymentAmount - discountedTotal;

        // Wait for the reference ID to be generated
        const referenceID = await generateReferenceID();

        // Populate receipt details
        document.getElementById('receiptReferenceID').textContent = `${referenceID}`;
        document.getElementById('receiptDate').textContent = getCurrentDateTime();
        document.getElementById('receiptPayment').textContent = paymentAmount.toFixed(2);
        document.getElementById('receiptChange').textContent = change.toFixed(2);
        document.getElementById('receiptDiscountInfo').textContent = `DISCOUNT: ₱${discount.toFixed(2)}`;
        document.getElementById('receiptTotalAmountDue').textContent = `TOTAL AMOUNT DUE: ₱${discountedTotal.toFixed(2)}`;

        // Hide the payment modal
        const paymentModal = bootstrap.Modal.getInstance(document.getElementById('paymentModal'));
        paymentModal.hide();

        // Show the receipt modal
        const receiptModal = new bootstrap.Modal(document.getElementById('receiptModal'));
        receiptModal.show();
    } else {
        alert("Payment amount is not sufficient.");
    }
}



// Function to save the receipt to the database
function saveReceipt() {
    const referenceID = document.getElementById('receiptReferenceID').textContent;
    const date = document.getElementById('receiptDate').textContent;
    const paymentAmount = parseFloat(document.getElementById('receiptPayment').textContent);
    const discountedTotal = parseFloat(document.getElementById('discountedTotal').textContent.replace('₱', ''));

    // Collect sales data from the receipt
    const salesData = [];
    document.querySelectorAll('.sales-items tbody tr').forEach(row => {
        const item = row.children[0].textContent;
        const quantity = parseInt(row.children[1].textContent);
        const total = parseFloat(row.children[2].textContent.replace('₱', ''));
        salesData.push({ item, quantity, total });
    });

    // Send the transaction data to the server
    fetch('{{ route("transactionHistory.store") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            reference_id: referenceID,
            date: date,
            sales_data: salesData,
            total_amount: discountedTotal,
            discount: discount, // Include discount in the request
            payment_received: paymentAmount // Include payment received in the request
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Increment the reference ID only after saving the transaction
            let currentReferenceID = parseInt(localStorage.getItem('referenceID')) || 1;
            currentReferenceID++;  // Increment the reference ID
            localStorage.setItem('referenceID', currentReferenceID);

            // alert('Transaction saved successfully!');


            // Close the receipt modal after saving
            $('#receiptModal').modal('hide');

            // Optionally reset fields or other parts of the page
            resetReceiptModal();

            // Reload the current page to reflect changes
            location.reload();  // Reloads the page
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Function to reset the receipt modal and return to the original window
function resetReceiptModal() {
    // Restore the visibility of the entire page
    document.body.style.visibility = 'visible';

    // Clear receipt modal content
    document.getElementById('receiptReferenceID').textContent = '';
    document.getElementById('receiptDate').textContent = '';
    document.getElementById('receiptPayment').textContent = '';
    document.getElementById('receiptChange').textContent = '';

    // Clear items in the receipt
    document.querySelector('.sales-items tbody').innerHTML = '';

    // Optionally reset modal-specific styles
    const receiptModal = document.getElementById('receiptModal');
    if (receiptModal) {
        receiptModal.style.visibility = 'hidden'; // Hide modal content
    }

    // Reset any additional modifications made during printing or saving
    document.getElementById('receiptModal').style.visibility = ''; // Reset visibility

    // Close the modal if still open
    $('#receiptModal').modal('hide'); // Using Bootstrap's modal method
}

        </script>






    </section>
    <section id="section4">
        <div class="container" style="margin-top: 300px">
            <!-- Button to go to the Settings page -->
            <button onclick="window.location.href='{{ url('/settings') }}'" class="btn btn-primary">
                Go to Settings
            </button>
            <!-- Main page content here -->
        </div>


    </section>









    {{-- SCript for smooth Scrolling --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- Add these just before the closing </body> tag -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        // Function to show the Transaction History Modal
        function showTransactionHistoryModal() {
            document.getElementById('transactionHistoryModal').style.display = 'block';
            // Optionally, reset search inputs
            document.getElementById('searchReferenceId').value = '';
            document.getElementById('searchDate').value = '';
            filterTransactions(); // Reset filter on open
        }

        // Function to hide the Transaction History Modal
        function hideTransactionHistoryModal() {
            document.getElementById('transactionHistoryModal').style.display = 'none';
        }

        // Get search inputs and transaction container
        const searchReferenceId = document.getElementById('searchReferenceId');
        const searchDate = document.getElementById('searchDate');
        const transactionCards = document.querySelectorAll('.transaction-card');

        // Function to filter transactions
        function filterTransactions() {
            const referenceId = searchReferenceId.value.toLowerCase();
            const date = searchDate.value;

            transactionCards.forEach(card => {
                const cardReferenceId = card.getAttribute('data-reference-id').toLowerCase();
                const cardDate = card.getAttribute('data-date').substring(0, 10); // Get date in YYYY-MM-DD format

                // Check if card matches search criteria
                const matchesReferenceId = referenceId === '' || cardReferenceId.includes(referenceId);
                const matchesDate = date === '' || cardDate === date;

                if (matchesReferenceId && matchesDate) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Add event listeners to search inputs
        searchReferenceId.addEventListener('input', filterTransactions);
        searchDate.addEventListener('input', filterTransactions);
    </script>


</body>

</html>
