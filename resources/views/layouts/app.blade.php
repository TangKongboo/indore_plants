<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'IndorePlants'))</title>
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('images/favicon.svg') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cascadia+Code:ital,wght@0,200..700;1,200..700&family=Comic+Relief:wght@400;700&family=Inter:wght@400;500;600;700&family=Lobster&family=Outfit:wght@300;400;500;600;700;800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>
<body>
    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
    
    @include('partials.cart-drawer')

    <!-- Bootstrap Bundle JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- Custom Logic -->
    <script src="{{ asset('js/cart.js') }}"></script>
    <script src="{{ asset('js/search.js') }}"></script>
    <script src="{{ asset('js/theme-toggle.js') }}"></script>
    <script>
        // Set CSRF token for Axios/Fetch
        window.csrfToken = '{{ csrf_token() }}';

        function toggleWishlist(plantId, btn) {
            @guest
                window.location.href = "{{ route('login') }}";
                return;
            @endguest

            fetch('{{ route('wishlist.toggle') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.csrfToken
                },
                body: JSON.stringify({ plant_id: plantId })
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'added') {
                    if(btn) btn.innerHTML = '<i class="fa-solid fa-heart"></i>';
                } else if(data.status === 'removed') {
                    if(btn) {
                        btn.innerHTML = '<i class="fa-regular fa-heart"></i>';
                        // if we are on the wishlist page, remove the card
                        let itemCard = document.getElementById('wishlist-item-' + plantId);
                        if(itemCard) itemCard.remove();
                    }
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
    @stack('scripts')
</body>
</html>
