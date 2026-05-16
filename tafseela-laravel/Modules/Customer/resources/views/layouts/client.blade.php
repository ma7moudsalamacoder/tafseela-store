<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Tafsela | تفصيلة - الرئيسية' }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
    <style>
        #toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 8px;
            pointer-events: none;
        }
        .toast {
            pointer-events: auto;
            background: #1a1a1a;
            color: #fff;
            padding: 14px 24px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 700;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            transform: translateX(120%);
            opacity: 0;
            transition: transform 0.4s ease, opacity 0.4s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 260px;
            direction: rtl;
        }
        .toast.show {
            transform: translateX(0);
            opacity: 1;
        }
        .toast .material-symbols-outlined {
            font-size: 20px;
        }
        .toast-success {
            background: #065f46;
            border-right: 4px solid #34d399;
        }
        .toast-error {
            background: #991b1b;
            border-right: 4px solid #f87171;
        }
        @keyframes badgeBounce {
            0% { transform: scale(1); }
            30% { transform: scale(1.4); }
            60% { transform: scale(0.9); }
            100% { transform: scale(1); }
        }
        .badge-bounce {
            animation: badgeBounce 0.5s ease;
        }
        .added-product {
            background: #065f46 !important;
            color: #fff !important;
        }
        .added-product .btn-text {
            color: #fff !important;
        }
    </style>
</head>

<body class="transition-colors duration-300">

    <div id="toast-container"></div>

    <x-header :cartCount="$cartCount ?? 0" :wishlistCount="$wishlistCount ?? 0" />

    <main>
        {{ $slot }}
    </main>

    <x-footer />

    @stack('scripts')
    <script>
        function showToast(message, type, icon) {
            var container = document.getElementById('toast-container');
            var toast = document.createElement('div');
            toast.className = 'toast';
            if (type === 'error') {
                toast.classList.add('toast-error');
                icon = icon || 'error';
            } else {
                toast.classList.add('toast-success');
                icon = icon || 'check_circle';
            }
            toast.innerHTML = '<span class="material-symbols-outlined">' + icon + '</span>' + message;
            container.appendChild(toast);
            requestAnimationFrame(function() { toast.classList.add('show'); });
            setTimeout(function() {
                toast.classList.remove('show');
                setTimeout(function() { toast.remove(); }, 400);
            }, 3000);
        }

        function updateCartCount() {
            var badge = document.getElementById('cart-count-badge');
            if (!badge) return;
            @auth
            fetch('{{ route("cart.index") }}', {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                var cartData = data.data;
                if (cartData && typeof cartData.count === 'number') {
                    badge.textContent = cartData.count;
                } else if (cartData && cartData.items) {
                    badge.textContent = cartData.items.reduce(function(s, i) { return s + (i.quantity || 0); }, 0);
                }
            })
            .catch(function() {});
            @endauth
        }

        function addToCart(productId, button, productDetailId) {
            var btnText = button.querySelector('.btn-text');
            var originalText = btnText.textContent;

            button.disabled = true;
            btnText.textContent = 'جاري الإضافة...';

            @auth
                var body = {
                    product_id: productId,
                    quantity: 1,
                };
                if (productDetailId) {
                    body.product_detail_id = productDetailId;
                }

                fetch('{{ route('cart.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(body),
                })
                .then(function(res) {
                    if (!res.ok) throw new Error('Failed');
                    return res.json();
                })
                .then(function(data) {
                    var count = data.data && data.data.count;
                    var badge = document.getElementById('cart-count-badge');
                    if (badge && typeof count === 'number') {
                        badge.textContent = count;
                        badge.classList.remove('badge-bounce');
                        void badge.offsetWidth;
                        badge.classList.add('badge-bounce');
                    } else {
                        updateCartCount();
                    }
                    showToast('تمت إضافة المنتج إلى السلة');
                    btnText.textContent = 'تمت الإضافة';
                    button.classList.add('added-product');
                    setTimeout(function() {
                        btnText.textContent = originalText;
                        button.disabled = false;
                        button.classList.remove('added-product');
                    }, 2000);
                })
                .catch(function() {
                    showToast('حدث خطأ أثناء الإضافة', 'error');
                    btnText.textContent = originalText;
                    button.disabled = false;
                });
            @else
                fetch('{{ route('customer.cart.quick-add') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: 1,
                    }),
                })
                .then(function(res) { return res.json(); })
                .then(function(data) {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    }
                })
                .catch(function() {
                    btnText.textContent = originalText;
                    button.disabled = false;
                    showToast('حدث خطأ', 'error');
                });
            @endauth
        }

        function toggleWishlist(productId, button) {
            @auth
                button.disabled = true;
                var iconSpan = button.querySelector('.material-symbols-outlined');

                fetch('{{ route('customer.wishlist.toggle') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ product_id: productId }),
                })
                .then(function(res) {
                    if (!res.ok) throw new Error('Failed');
                    return res.json();
                })
                .then(function(data) {
                    iconSpan.style.fontVariationSettings = "'FILL' " + (data.is_in_wishlist ? 1 : 0);
                    var badge = document.getElementById('wishlist-count-badge');
                    if (badge) {
                        badge.textContent = data.count;
                    }
                    showToast(data.is_in_wishlist ? 'تمت الإضافة إلى المفضلة' : 'تمت الإزالة من المفضلة');
                    button.disabled = false;
                })
                .catch(function() {
                    showToast('حدث خطأ', 'error');
                    button.disabled = false;
                });
            @else
                window.location.href = '{{ route('auth.signin') }}';
            @endauth
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
        });
    </script>
</body>

</html>
