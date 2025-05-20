<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f2f4f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .transaction-history {
            margin-top: 50px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .transaction-history h2 {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .transaction-group {
            margin-bottom: 30px;
        }

        .transaction-group h3 {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-size: 1.25rem;
            margin-bottom: 10px;
            text-align: center;
        }

        .transaction-history table {
            width: 100%;
            border-collapse: collapse;
        }

        .transaction-history table th,
        .transaction-history table td {
            padding: 16px;
            text-align: left;
            vertical-align: middle;
        }

        .transaction-history .btn-view-details {
            background-color: #0dcaf0;
            color: white;
            font-size: 0.9rem;
            padding: 8px 16px;
            border-radius: 6px;
        }

        .search-inputs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 1;
            padding: 10px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .search-inputs input {
            border: 1px solid #007bff;
            border-radius: 8px;
            padding: 12px;
            font-size: 1rem;
            width: 100%;
            transition: border-color 0.3s ease;
        }

        .search-inputs input:focus {
            border-color: #0056b3;
            outline: none;
        }

        .search-inputs input::placeholder {
            color: #6c757d;
        }

        /* Styles for Action Button */
        .transaction-history .btn-view-details {
            background-color: #007bff;
            color: white;
            font-size: 0.9rem;
            padding: 10px 18px;
            border-radius: 6px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);
            transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
        }

        .transaction-history .btn-view-details:hover {
            background-color: #0056b3;
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 86, 179, 0.3);
            color: #fff;
        }

        .transaction-history .btn-view-details:active {
            transform: scale(0.98);
            background-color: #004494;
        }

        /* Animation for modal fade-in and zoom */
.animated-modal {
    opacity: 0;
    transform: scale(0.95);
    transition: opacity 0.4s ease, transform 0.4s ease;
}

.modal.fade.show .animated-modal {
    opacity: 1;
    transform: scale(1);
}

/* Transition for hover effect */
.table-hover tbody tr:hover {
    background-color: #f8f9fa;
    transition: background-color 0.3s ease;
}

.modal-header {
    position: relative;
    padding: 1rem;
    background-color: #007bff;
    color: #fff;
}

.modal-header .btn-close {
    position: absolute;
    right: 1rem;
    top: 1rem;
    opacity: 0.8;
    transition: opacity 0.3s;
}

.modal-header .btn-close:hover {
    opacity: 1;
}

/* Scrollable table with custom scrollbar */
.scrollable-table {
    scrollbar-width: thin;
    scrollbar-color: #007bff #e9ecef;
}

.scrollable-table::-webkit-scrollbar {
    width: 8px;
}

.scrollable-table::-webkit-scrollbar-thumb {
    background-color: #007bff;
    border-radius: 4px;
}

/* Transition on modal background */
.modal-backdrop.show {
    opacity: 0.8;
    transition: opacity 0.3s;
}

/* Subtle shadows and rounded corners */
.table {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

.modal-content {
    border-radius: 8px;
    overflow: hidden;
}
.total-sales {
    background-color: #f8f9fa; /* Light background for contrast */
    border: 2px solid #007bff; /* Blue border to match the theme */
    border-radius: 10px; /* Rounded corners */
    padding: 15px; /* Adequate padding for readability */
    margin-bottom: 20px; /* Space below the section */
    font-size: 18px; /* Slightly larger font for prominence */
    color: #007bff; /* Blue text color */
    font-weight: bold; /* Make the text bold */
    box-shadow: 0 2px 10px rgba(0, 123, 255, 0.2); /* Subtle shadow effect */
    display: flex; /* To align content inside */
    justify-content: space-between; /* Space between label and value */
    align-items: center; /* Center the content vertically */
}

.total-sales strong {
    font-size: 20px; /* Larger font size for the strong part */
}

.total-sales span {
    font-size: 20px; /* Larger font size for the amount */
    font-weight: bold;
}

/* Smooth Transition for Accordion and Dropdowns */
.transition-collapse {
    transition: height 0.4s ease-out, opacity 0.4s ease-out;
}

.accordion-item {
    border-radius: 10px;
    overflow: hidden;
}

.accordion-button {
    border: none;
    padding: 1rem;
    font-size: 1.2rem;
    text-transform: capitalize;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

.accordion-button:hover {
    background-color: #f8f9fa;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
}

.accordion-collapse .accordion-body {
    border-top: 1px solid #e0e0e0;
    padding: 1rem 1.5rem;
    background-color: #fff;
}

.list-group-item {
    border: none;
    transition: box-shadow 0.3s ease, transform 0.2s ease;
}

.list-group-item:hover {
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

/* Style Badges */
.badge {
    font-size: 1rem;
    padding: 0.5rem 0.75rem;
}
/* Add smoother scrolling inside transaction dropdowns */
.list-group {
    scrollbar-width: thin; /* For Firefox */
    scrollbar-color: #cfd8dc #f5f5f5; /* Thumb and track color */
}

.list-group::-webkit-scrollbar {
    width: 8px; /* For Webkit browsers */
}

.list-group::-webkit-scrollbar-thumb {
    background-color: #cfd8dc;
    border-radius: 4px;
}

.list-group::-webkit-scrollbar-track {
    background-color: #f5f5f5;
}

    </style>
</head>
<body>

<!-- Main Container -->
<div class="container my-5">
    <div class="transaction-history table-responsive" style="max-height: 900px; overflow-y: auto; position: relative;">
        <h2>Transaction History</h2>
        <div class="header d-flex justify-content-between">
            <a href="{{ route('product.index') }}#section3" class="btn btn-primary mb-4">Go back</a>
            <!-- Grouped Transactions by Cashier -->
                        @php
                        // Group transactions by cashier
                        $groupedTransactionsByCashier = $transactions->groupBy('cashier_name');
                        @endphp

                        <!-- Button to View All Transactions -->
                        <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#allSalesModal" style="color: white">
                            View All Transactions By Cashiers Sale
                        </button>

                        <!-- Modal for Viewing All Transactions -->
                        <div class="modal fade" id="allSalesModal" tabindex="-1" aria-labelledby="allSalesModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content shadow-lg border-0 animated-modal">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="allSalesModalLabel">All Transactions by Cashier</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body bg-light p-4">
                                        <!-- Accordion for Cashier Groups -->
                                        <div class="accordion" id="cashierAccordion">
                                            @foreach ($groupedTransactionsByCashier as $cashierName => $transactionsForCashier)
                                                <div class="accordion-item rounded border-0 shadow-sm mb-3">
                                                    <h2 class="accordion-header" id="heading-{{ $loop->index }}">
                                                        <button class="accordion-button bg-white text-primary fw-bold {{ $loop->first ? '' : 'collapsed' }}"
                                                                type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapse-{{ $loop->index }}"
                                                                aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                                                aria-controls="collapse-{{ $loop->index }}">
                                                            Transactions by {{ $cashierName }}
                                                            <span class="ms-3 badge bg-success">₱{{ number_format($transactionsForCashier->sum('total_amount'), 2) }}</span>
                                                        </button>
                                                    </h2>
                                                    <div id="collapse-{{ $loop->index }}"
                                                        class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }} transition-collapse"
                                                        aria-labelledby="heading-{{ $loop->index }}"
                                                        data-bs-parent="#cashierAccordion">
                                                        <div class="accordion-body">
                                                            <!-- Transactions List -->
                                                            <ul class="list-group" style="max-height: 500px; overflow-y: auto;">
                                                                @foreach ($transactionsForCashier as $transaction)
                                                                    <li class="list-group-item shadow-sm mb-2">
                                                                        <button class="btn btn-link text-start w-100 text-decoration-none text-dark"
                                                                                type="button"
                                                                                data-bs-toggle="collapse"
                                                                                data-bs-target="#transaction-{{ $transaction->id }}"
                                                                                aria-expanded="false"
                                                                                aria-controls="transaction-{{ $transaction->id }}">
                                                                            {{ $transaction->reference_id }}
                                                                            <span class="badge bg-info float-end">₱{{ number_format($transaction->total_amount, 2) }}</span>
                                                                        </button>
                                                                        <div id="transaction-{{ $transaction->id }}"
                                                                            class="collapse mt-2 px-3 transition-collapse">
                                                                            <p><strong>Tax:</strong> ₱{{ number_format($transaction->tax, 2) }}</p>
                                                                            <p><strong>Cashier:</strong> {{ $transaction->cashier_name }}</p>
                                                                            <div style="max-height: 100px; overflow-y: auto;" class="bg-light rounded p-2 border">
                                                                                @foreach (json_decode($transaction->sales_data) as $item)
                                                                                    <p><strong>{{ $item->item }}</strong> - {{ $item->quantity }} pcs - ₱{{ number_format($item->total, 2) }}</p>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
</div>

        <!-- Search Fields -->
        <div class="search-inputs">
            <input type="text" id="searchReference" class="form-control" placeholder="Search by Reference ID">
            <input type="date" id="searchDate" class="form-control" placeholder="Search by Date">
        </div>

        <!-- Grouped Transactions by Date -->
        @php
        // Sort transactions by date in descending order
        $sortedTransactions = $transactions->sortByDesc('date');

        // Group transactions by formatted date
        $groupedTransactions = $sortedTransactions->groupBy(function($transaction) {
            return \Carbon\Carbon::parse($transaction->date)->format('F j, Y');
        });
    @endphp


@foreach ($groupedTransactions as $date => $transactionsForDate)
<div class="transaction-group" data-date="{{ \Carbon\Carbon::parse($date)->format('Y-m-d') }}" style="max-height: 500px; overflow-y: auto;">
    <h3>{{ $date }}</h3>

    <!-- Button to View All Sales for the Day -->
    <button class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#salesModal-{{ \Carbon\Carbon::parse($date)->format('Y-m-d') }}">
        View All Transactions for {{ $date }}
    </button>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Reference ID</th>
                <th>Sales Data</th>
                <th>Total Amount</th>
                <th>Tax</th>
                <th>Discount</th>
                <th>Payment Received</th>
                <th>Cashier</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactionsForDate as $transaction)
            <tr>
                <td>{{ $transaction->reference_id }}</td>
                <td>
                    <div style="max-height: 100px; overflow-y: auto;">
                        @foreach (json_decode($transaction->sales_data) as $item)
                            <p><strong>{{ $item->item }}</strong> - {{ $item->quantity }} pcs - ₱{{ number_format($item->total, 2) }}</p>
                        @endforeach
                    </div>
                </td>
                <td class="total-amount">₱{{ number_format($transaction->total_amount, 2) }}</td>
                <td>₱{{ number_format($transaction->tax, 2) }}</td>
                <td>₱{{ number_format($transaction->discount, 2) }}</td> <!-- Discount -->
                <td>₱{{ number_format($transaction->payment_received, 2) }}</td> <!-- Payment Received -->
                <td>{{$transaction->cashier_name}}</td>
                <td>
                    <button class="btn-view-details" data-bs-toggle="modal" data-bs-target="#transactionModal-{{ $transaction->id }}">
                        View Details
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

    <!-- Modal for Viewing All Transactions on a Specific Day -->
    <div class="modal fade" id="salesModal-{{ \Carbon\Carbon::parse($date)->format('Y-m-d') }}" tabindex="-1" aria-labelledby="salesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content shadow-lg border-0 animated-modal">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="salesModalLabel">Transactions on {{ $date }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-light p-4">
                    <!-- Total Sales for the Day -->
                    <div class="total-sales mb-4">
                        <span>Total Sales for {{ $date }}:</span>
                        <span>₱{{ number_format($transactionsForDate->sum('total_amount'), 2) }}</span>
                    </div>
                    <!-- Transaction Data for the Day -->
                    <h5 class="text-primary border-bottom pb-2 mb-3">Transaction Data for {{ $date }}</h5>
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>Reference ID</th>
                                <th>Sales Data</th>
                                <th>Total Amount</th>
                                <th>Tax</th>
                                <th>Cashier</th> <!-- Add column for Cashier Name -->
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($transactionsForDate as $transaction)
                                <tr>
                                    <td>{{ $transaction->reference_id }}</td>
                                    <td>
                                        <div style="max-height: 100px; overflow-y: auto;">
                                            @foreach (json_decode($transaction->sales_data) as $item)
                                                <p><strong>{{ $item->item }}</strong> - {{ $item->quantity }} pcs - ₱{{ number_format($item->total, 2) }}</p>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>₱{{ number_format($transaction->total_amount, 2) }}</td>
                                    <td>₱{{ number_format($transaction->tax, 2) }}</td>
                                    <td>{{$transaction->cashier_name}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

    <!-- Modal for Transaction Details -->
    @foreach ($transactions as $transaction)
    <div class="modal fade" id="transactionModal-{{ $transaction->id }}" tabindex="-1" aria-labelledby="transactionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content shadow-lg border-0 animated-modal">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="transactionModalLabel">Transaction Details - {{ $transaction->reference_id }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-light p-4">
                    <!-- Transaction Information Section -->
                    <h5 class="text-primary border-bottom pb-2 mb-3">Transaction Information</h5>
                    <table class="table table-borderless mb-4">
                        <tbody>
                            <tr>
                                <td class="text-muted"><strong>Date:</strong></td>
                                <td>{{ \Carbon\Carbon::parse($transaction->date)->format('F j, Y, g:i a') }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted"><strong>Tax (5%):</strong></td>
                                <td>₱{{ number_format($transaction->tax, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted"><strong>Total Amount:</strong></td>
                                <td>₱{{ number_format($transaction->total_amount, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted"><strong>Discout:</strong></td>
                                <td>₱{{ number_format($transaction->discount, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted"><strong>Payment Received:</strong></td>
                                <td>₱{{ number_format($transaction->payment_received, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Sales Data Section -->
                    <h5 class="text-primary border-bottom pb-2 mb-3">Sales Data</h5>
                    <div class="scrollable-table" style="max-height: 300px; overflow-y: auto;">
                        <table class="table table-hover table-striped align-middle">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach (json_decode($transaction->sales_data) as $item)
                                    <tr>
                                        <td class="text-start"><strong>{{ $item->item }}</strong></td>
                                        <td>{{ $item->quantity }} pcs</td>
                                        <td>₱{{ number_format($item->total, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>












<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<!-- JavaScript for Search Functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchReference = document.getElementById('searchReference');
        const searchDate = document.getElementById('searchDate');
        const transactionGroups = document.querySelectorAll('.transaction-group');

        function filterTransactions() {
            const referenceFilter = searchReference.value.toLowerCase();
            const dateFilter = searchDate.value;

            transactionGroups.forEach(group => {
                const groupDate = group.getAttribute('data-date');
                const rows = group.querySelectorAll('tbody tr');
                let groupVisible = false;

                rows.forEach(row => {
                    const referenceID = row.querySelector('td').textContent.toLowerCase();
                    const matchesReference = referenceID.includes(referenceFilter);
                    const matchesDate = !dateFilter || dateFilter === groupDate;

                    if (matchesReference && matchesDate) {
                        row.style.display = '';
                        groupVisible = true;
                    } else {
                        row.style.display = 'none';
                    }
                });

                group.style.display = groupVisible ? '' : 'none';
            });
        }

        searchReference.addEventListener('input', filterTransactions);
        searchDate.addEventListener('change', filterTransactions);
    });
</script>

</body>
</html>
