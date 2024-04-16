<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
</head>
<body>
    <h1>Products</h1>
    <ul>
        @if ($products->count() > 0)
            @foreach ($products as $product)
                <li>{{ $product->title }} - {{ $product->price }}</li>
            @endforeach
        @else
            <p>No products found</p>
        @endif
    </ul>

</body>
</html>
