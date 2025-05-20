<!-- resources/views/products/partials/product_table.blade.php -->
@foreach ($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->code }}</td>
        <td>{{ $product->product_name }}</td>
        <td>{{ $product->quantity }}</td>
        <td>{{ $product->barcode }}</td>
        <td>${{ number_format($product->price, 2) }}</td>
        <td class="d-flex justify-content-around flex-wrap">
            {{-- Actions --}}
        </td>
    </tr>
@endforeach
