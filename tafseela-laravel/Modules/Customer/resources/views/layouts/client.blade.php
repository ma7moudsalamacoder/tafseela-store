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
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .drawer-open { overflow: hidden; }
        .detail-chip-active {
            background-color: #8C6239 !important;
            color: #fff !important;
            border-color: #8C6239 !important;
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

    {{-- Cart Off-Canvas Drawer --}}
    <div id="cart-drawer-overlay" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[60] hidden opacity-0 transition-opacity duration-300" onclick="closeCartDrawer()"></div>
    <aside id="cart-drawer" class="fixed top-0 right-0 h-full w-full max-w-[450px] bg-white z-[70] shadow-2xl flex flex-col translate-x-full transition-transform duration-500 ease-in-out">
        <div class="bg-primary-dark text-white p-6 flex items-center justify-between flex-shrink-0">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined">shopping_bag</span>
                <h2 class="text-xl font-bold tracking-tight">حقيبة التسوق</h2>
                <span id="cart-drawer-count" class="bg-white/20 text-[10px] px-2 py-0.5 rounded-full font-bold">0</span>
            </div>
            <button onclick="closeCartDrawer()" class="hover:rotate-90 transition-transform duration-300" type="button">
                <span class="material-symbols-outlined text-3xl">close</span>
            </button>
        </div>
        <div id="cart-drawer-items" class="flex-grow overflow-y-auto p-6 space-y-6 hide-scrollbar">
            <div class="flex items-center justify-center h-full text-gray-400 text-sm">جاري التحميل...</div>
        </div>
        <div id="cart-drawer-footer" class="p-6 border-t border-gray-100 bg-white flex-shrink-0 hidden">
            <div class="flex justify-between items-center mb-6">
                <span class="text-gray-500 font-medium">المجموع الفرعي</span>
                <span id="cart-drawer-total" class="text-xl font-bold text-neutral-charcoal">0 جنيه</span>
            </div>
            <p class="text-[11px] text-gray-400 mb-6 text-center">الشحن والضرائب يتم حسابها عند إتمام الدفع</p>
            <button onclick="checkout()" class="w-full bg-primary text-white py-5 font-extrabold text-sm tracking-[0.2em] hover:bg-primary-dark transition-colors flex items-center justify-center gap-3 shadow-lg" type="button">
                إتمام الشراء
                <span class="material-symbols-outlined">arrow_back</span>
            </button>
        </div>
    </aside>

    {{-- Wishlist Off-Canvas Drawer --}}
    <div id="wishlist-drawer-overlay" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[60] hidden opacity-0 transition-opacity duration-300" onclick="closeWishlistDrawer()"></div>
    <aside id="wishlist-drawer" class="fixed top-0 right-0 h-full w-full max-w-[450px] bg-white z-[70] shadow-2xl flex flex-col translate-x-full transition-transform duration-500 ease-in-out">
        <div class="flex items-center justify-between px-8 py-6 border-b border-gray-100 flex-shrink-0">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-primary text-3xl">favorite</span>
                <h2 class="text-2xl font-extrabold text-neutral-charcoal">المفضلة</h2>
                <span id="wishlist-drawer-count" class="bg-primary/10 text-primary text-xs font-bold px-2 py-0.5 rounded-full">0</span>
            </div>
            <button onclick="closeWishlistDrawer()" class="p-2 hover:bg-gray-50 transition-colors" type="button">
                <span class="material-symbols-outlined text-gray-400">close</span>
            </button>
        </div>
        <div id="wishlist-drawer-items" class="flex-grow overflow-y-auto p-8 space-y-6 hide-scrollbar">
            <div class="flex items-center justify-center h-full text-gray-400 text-sm">جاري التحميل...</div>
        </div>
        <div id="wishlist-drawer-footer" class="p-8 border-t border-gray-100 flex-shrink-0 space-y-4">
            <button onclick="addAllWishlistToCart()" class="w-full bg-neutral-charcoal text-white py-5 font-extrabold text-sm tracking-widest uppercase hover:bg-primary transition-colors flex justify-center items-center gap-3" type="button">
                أضف الكل إلى السلة
                <span class="material-symbols-outlined text-lg">shopping_cart_checkout</span>
            </button>
            <button onclick="closeWishlistDrawer()" class="w-full bg-white border border-gray-200 text-gray-500 py-4 font-bold text-xs tracking-widest uppercase hover:border-primary hover:text-primary transition-all" type="button">
                متابعة التسوق
            </button>
        </div>
    </aside>

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

        function openCartDrawer() {
            var overlay = document.getElementById('cart-drawer-overlay');
            var drawer = document.getElementById('cart-drawer');
            overlay.classList.remove('hidden');
            document.body.classList.add('drawer-open');
            requestAnimationFrame(function() {
                overlay.classList.remove('opacity-0');
                drawer.classList.remove('translate-x-full');
            });
            loadCartDrawer();
        }

        function closeCartDrawer() {
            var overlay = document.getElementById('cart-drawer-overlay');
            var drawer = document.getElementById('cart-drawer');
            overlay.classList.add('opacity-0');
            drawer.classList.add('translate-x-full');
            document.body.classList.remove('drawer-open');
            setTimeout(function() { overlay.classList.add('hidden'); }, 500);
        }

        function loadCartDrawer() {
            var container = document.getElementById('cart-drawer-items');
            var footer = document.getElementById('cart-drawer-footer');
            container.innerHTML = '<div class="flex items-center justify-center h-full text-gray-400 text-sm">جاري التحميل...</div>';
            footer.classList.add('hidden');

            fetch('{{ route("cart.index") }}', {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                var cartData = data.data;
                if (!cartData || !cartData.items || cartData.items.length === 0) {
                    container.innerHTML = '<div class="flex flex-col items-center justify-center h-full text-gray-400"><span class="material-symbols-outlined text-5xl mb-4">shopping_bag</span><p class="text-sm">سلة التسوق فارغة</p></div>';
                    return;
                }
                renderCartItems(cartData);
                footer.classList.remove('hidden');
            })
            .catch(function() {
                container.innerHTML = '<div class="flex items-center justify-center h-full text-gray-400 text-sm">حدث خطأ في تحميل السلة</div>';
            });
        }

        function renderCartItems(cartData) {
            var container = document.getElementById('cart-drawer-items');
            var lookup = cartData.product_details_lookup || {};
            var html = '';
            cartData.items.forEach(function(item) {
                var details = lookup[item.product_id] || [];
                var priceDisplay = item.discounted_price && item.discounted_price < item.price
                    ? '<span class="font-bold text-primary">' + (item.discounted_price * item.quantity).toLocaleString('ar-EG') + ' جنيه</span> <span class="text-[10px] text-gray-300 line-through">' + (item.price * item.quantity).toLocaleString('ar-EG') + ' جنيه</span>'
                    : '<span class="font-bold text-primary">' + (item.price * item.quantity).toLocaleString('ar-EG') + ' جنيه</span>';

                var detailImg = null;
                if (item.product_detail_id && lookup[item.product_id]) {
                    var curDetail = lookup[item.product_id].find(function(d) { return d.id === item.product_detail_id; });
                    if (curDetail && curDetail.cover_image) detailImg = curDetail.cover_image;
                }
                var imgSrc = detailImg || item.cover_image || item.image || 'https://via.placeholder.com/96x128';

                html += '<div class="flex gap-4 group" data-cart-item data-product-id="' + item.product_id + '" data-detail-id="' + (item.product_detail_id || '') + '">';
                html += '<div class="w-24 h-32 flex-shrink-0 bg-gray-50 overflow-hidden">';
                html += '<img src="' + imgSrc + '" alt="' + item.product_name + '" class="w-full h-full object-cover">';
                html += '</div>';
                html += '<div class="flex-grow flex flex-col justify-between py-1 min-w-0">';
                html += '<div>';
                html += '<div class="flex justify-between items-start">';
                html += '<h3 class="font-bold text-sm text-neutral-charcoal truncate">' + item.product_name + '</h3>';
                html += '<button onclick="cartRemoveItem(' + item.product_id + ',' + (item.product_detail_id || 'null') + ')" class="text-gray-400 hover:text-red-500 transition-colors flex-shrink-0" type="button">';
                html += '<span class="material-symbols-outlined text-lg">delete</span></button>';
                html += '</div>';

                var displayColors = [];
                var displaySizes = [];
                var hasMultipleColors = false;
                var hasMultipleSizes = false;

                if (details.length > 0) {
                    var colorSeen = {}, sizeSeen = {};
                    details.forEach(function(d) {
                        if (d.color && !colorSeen[d.color]) { colorSeen[d.color] = true; displayColors.push(d.color); }
                        if (d.size && !sizeSeen[d.size]) { sizeSeen[d.size] = true; displaySizes.push(d.size); }
                    });
                    hasMultipleColors = displayColors.length > 1;
                    hasMultipleSizes = displaySizes.length > 1;
                } else {
                    if (item.color) displayColors.push(item.color);
                    if (item.size) displaySizes.push(item.size);
                }

                if (displayColors.length > 0 || displaySizes.length > 0) {
                    html += '<div class="mt-3 space-y-2">';

                    if (displayColors.length > 0) {
                        html += '<div class="flex flex-wrap gap-2">';
                        displayColors.forEach(function(c) {
                            var isSelected = c === item.color;
                            var borderCls = isSelected ? 'ring-2 ring-primary ring-offset-1' : 'border border-gray-300' + (hasMultipleColors ? ' hover:border-primary cursor-pointer' : '');
                            if (hasMultipleColors) {
                                var targetD = details.find(function(dd) { return dd.color === c && dd.size === item.size; }) || details.find(function(dd) { return dd.color === c; });
                                html += '<button onclick="cartChangeDetail(' + item.product_id + ',' + (item.product_detail_id || 'null') + ',' + (targetD ? targetD.id : 'null') + ',' + item.quantity + ')" class="flex flex-col items-center gap-0.5" type="button" title="' + c + '">';
                            } else {
                                html += '<span class="flex flex-col items-center gap-0.5">';
                            }
                            html += '<span class="block w-6 h-6 rounded-full ' + borderCls + '" style="background-color:' + c + ';"></span>';
                            html += hasMultipleColors ? '</button>' : '</span>';
                        });
                        html += '</div>';
                    }

                    if (displaySizes.length > 0) {
                        html += '<div class="flex flex-wrap gap-1.5">';
                        displaySizes.forEach(function(s) {
                            var isSelected = s === item.size;
                            var cls = isSelected ? 'detail-chip-active' : 'border-gray-200' + (hasMultipleSizes ? ' hover:border-primary cursor-pointer' : '');
                            if (hasMultipleSizes) {
                                var targetD = details.find(function(dd) { return dd.size === s && dd.color === item.color; }) || details.find(function(dd) { return dd.size === s; });
                                html += '<button onclick="cartChangeDetail(' + item.product_id + ',' + (item.product_detail_id || 'null') + ',' + (targetD ? targetD.id : 'null') + ',' + item.quantity + ')" class="text-[11px] px-3 py-1 border ' + cls + ' transition-colors rounded" type="button">' + s + '</button>';
                            } else {
                                html += '<span class="text-[11px] px-3 py-1 border ' + cls + ' rounded">' + s + '</span>';
                            }
                        });
                        html += '</div>';
                    }

                    html += '</div>';
                }

                html += '</div>';
                html += '<div class="flex justify-between items-center mt-2">';
                html += '<div class="flex items-center border border-gray-200">';
                html += '<button onclick="cartUpdateQty(' + item.product_id + ',' + (item.product_detail_id || 'null') + ',' + (item.quantity - 1) + ')" class="px-2 py-1 hover:bg-gray-100 transition-colors" type="button"' + (item.quantity <= 1 ? ' disabled style="opacity:0.4"' : '') + '>';
                html += '<span class="material-symbols-outlined text-xs">remove</span></button>';
                html += '<span class="px-3 text-xs font-bold font-sans" data-qty>' + item.quantity + '</span>';
                html += '<button onclick="cartUpdateQty(' + item.product_id + ',' + (item.product_detail_id || 'null') + ',' + (item.quantity + 1) + ')" class="px-2 py-1 hover:bg-gray-100 transition-colors" type="button">';
                html += '<span class="material-symbols-outlined text-xs">add</span></button>';
                html += '</div>';
                html += '<div>' + priceDisplay + '</div>';
                html += '</div>';
                html += '</div></div>';
            });
            container.innerHTML = html;
            document.getElementById('cart-drawer-count').textContent = cartData.count + ' قطعة';
            document.getElementById('cart-drawer-total').textContent = cartData.total.toLocaleString('ar-EG') + ' جنيه';
        }

        function cartUpdateQty(productId, detailId, qty) {
            if (qty < 1) return;
            fetch('{{ route("cart.update", 0) }}', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    product_id: productId,
                    product_detail_id: detailId,
                    quantity: qty,
                }),
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                renderCartItems(data.data);
                updateCartCount();
            })
            .catch(function() {
                showToast('حدث خطأ أثناء التحديث', 'error');
            });
        }

        function cartRemoveItem(productId, detailId) {
            fetch('{{ route("cart.destroy", 0) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-HTTP-Method-Override': 'DELETE',
                },
                body: JSON.stringify({
                    product_id: productId,
                    product_detail_id: detailId,
                }),
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                var cartData = data.data || data;
                if (cartData.items) {
                    renderCartItems(cartData);
                } else {
                    document.getElementById('cart-drawer-items').innerHTML = '<div class="flex flex-col items-center justify-center h-full text-gray-400"><span class="material-symbols-outlined text-5xl mb-4">shopping_bag</span><p class="text-sm">سلة التسوق فارغة</p></div>';
                    document.getElementById('cart-drawer-footer').classList.add('hidden');
                }
                updateCartCount();
                showToast('تمت إزالة المنتج من السلة');
            })
            .catch(function() {
                showToast('حدث خطأ أثناء الإزالة', 'error');
            });
        }

        function cartChangeDetail(productId, oldDetailId, newDetailId, qty) {
            if (oldDetailId === newDetailId) return;
            fetch('{{ route("cart.change-detail") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    product_id: productId,
                    old_product_detail_id: oldDetailId,
                    new_product_detail_id: newDetailId,
                    quantity: qty,
                }),
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                renderCartItems(data.data);
                updateCartCount();
            })
            .catch(function() {
                showToast('حدث خطأ أثناء التغيير', 'error');
            });
        }

        function openWishlistDrawer() {
            var overlay = document.getElementById('wishlist-drawer-overlay');
            var drawer = document.getElementById('wishlist-drawer');
            overlay.classList.remove('hidden');
            document.body.classList.add('drawer-open');
            requestAnimationFrame(function() {
                overlay.classList.remove('opacity-0');
                drawer.classList.remove('translate-x-full');
            });
            loadWishlistDrawer();
        }

        function closeWishlistDrawer() {
            var overlay = document.getElementById('wishlist-drawer-overlay');
            var drawer = document.getElementById('wishlist-drawer');
            overlay.classList.add('opacity-0');
            drawer.classList.add('translate-x-full');
            document.body.classList.remove('drawer-open');
            setTimeout(function() { overlay.classList.add('hidden'); }, 500);
        }

        var wishlistData = null;
        var wishlistSelectedDetails = {};

        function loadWishlistDrawer() {
            var container = document.getElementById('wishlist-drawer-items');
            container.innerHTML = '<div class="flex items-center justify-center h-full text-gray-400 text-sm">جاري التحميل...</div>';

            fetch('{{ route("customer.wishlist.items") }}', {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                wishlistData = data;
                if (!data.items || data.items.length === 0) {
                    container.innerHTML = '<div class="flex flex-col items-center justify-center h-full text-gray-400"><span class="material-symbols-outlined text-5xl mb-4">favorite</span><p class="text-sm">قائمة المفضلة فارغة</p></div>';
                    document.getElementById('wishlist-drawer-count').textContent = '0';
                    return;
                }

                data.items.forEach(function(p) {
                    if (!wishlistSelectedDetails[p.id]) {
                        var first = p.details && p.details.length > 0 ? p.details[0] : null;
                        wishlistSelectedDetails[p.id] = first ? first.id : null;
                    }
                });

                var html = '';
                data.items.forEach(function(product) {
                    var details = product.details || [];
                    var selectedId = wishlistSelectedDetails[product.id];
                    var selectedDetail = details.find(function(d) { return d.id === selectedId; }) || details[0] || null;

                    var imgSrc = (selectedDetail && selectedDetail.cover_image) || product.image || 'https://via.placeholder.com/96x128';

                    var priceHtml = product.discounted_price && product.discounted_price < product.price
                        ? '<div class="flex flex-col"><span class="font-bold text-primary">' + product.discounted_price.toLocaleString('ar-EG') + ' جنيه</span><span class="text-[10px] text-gray-300 line-through">' + product.price.toLocaleString('ar-EG') + ' جنيه</span></div>'
                        : '<span class="font-bold text-primary">' + product.price.toLocaleString('ar-EG') + ' جنيه</span>';

                    html += '<div class="flex gap-4 group" data-wishlist-item data-product-id="' + product.id + '">';
                    html += '<div class="w-24 h-32 flex-shrink-0 overflow-hidden bg-gray-50">';
                    html += '<img id="wishlist-img-' + product.id + '" src="' + imgSrc + '" alt="' + product.name + '" class="w-full h-full object-cover">';
                    html += '</div>';
                    html += '<div class="flex-grow flex flex-col min-w-0">';
                    html += '<div class="flex justify-between items-start mb-1">';
                    html += '<h3 class="font-bold text-sm text-neutral-charcoal hover:text-primary transition-colors cursor-pointer truncate">' + product.name + '</h3>';
                    html += '<button onclick="wishlistRemoveItem(' + product.id + ', this)" class="text-gray-300 hover:text-red-500 transition-colors flex-shrink-0" type="button">';
                    html += '<span class="material-symbols-outlined text-lg">delete</span></button>';
                    html += '</div>';

                    if (details.length > 0) {
                        var colors = [], sizes = [];
                        var cSeen = {}, sSeen = {};
                        details.forEach(function(d) {
                            if (d.color && !cSeen[d.color]) { cSeen[d.color] = true; colors.push(d); }
                            if (d.size && !sSeen[d.size]) { sSeen[d.size] = true; sizes.push(d); }
                        });

                        var hasMultiColors = colors.length > 1;
                        var hasMultiSizes = sizes.length > 1;

                        html += '<div class="mt-2 space-y-1.5">';

                        if (colors.length > 0) {
                            html += '<div class="flex flex-wrap gap-1.5">';
                            colors.forEach(function(cd) {
                                var isSel = selectedDetail && selectedDetail.id === cd.id;
                                var borderCls = isSel ? 'ring-2 ring-primary ring-offset-1' : 'border border-gray-300';
                                if (hasMultiColors) {
                                    html += '<button data-detail-id="' + cd.id + '" onclick="wishlistSelectDetail(' + product.id + ',' + cd.id + ')" class="flex flex-col items-center gap-0.5" type="button" title="' + cd.color + '">';
                                } else {
                                    html += '<span class="flex flex-col items-center gap-0.5">';
                                }
                                html += '<span class="block w-5 h-5 rounded-full ' + borderCls + '" style="background-color:' + cd.color + ';"></span>';
                                html += hasMultiColors ? '</button>' : '</span>';
                            });
                            html += '</div>';
                        }

                        if (sizes.length > 0) {
                            html += '<div class="flex flex-wrap gap-1">';
                            sizes.forEach(function(sd) {
                                var isSel = selectedDetail && selectedDetail.id === sd.id;
                                var cls = isSel ? 'detail-chip-active' : 'border-gray-200';
                                if (hasMultiSizes) {
                                    html += '<button data-detail-id="' + sd.id + '" onclick="wishlistSelectDetail(' + product.id + ',' + sd.id + ')" class="text-[10px] px-2 py-0.5 border ' + cls + ' transition-colors rounded" type="button">' + sd.size + '</button>';
                                } else {
                                    html += '<span class="text-[10px] px-2 py-0.5 border ' + cls + ' rounded">' + sd.size + '</span>';
                                }
                            });
                            html += '</div>';
                        }

                        if (selectedDetail && typeof selectedDetail.stock_qty !== 'undefined') {
                            var stockLabel = selectedDetail.stock_qty > 0 ? '<span class="text-green-600 font-bold">المخزون: ' + selectedDetail.stock_qty + '</span>' : '<span class="text-red-500 font-bold">غير متوفر</span>';
                            html += '<div class="text-[10px]" data-wishlist-stock>' + stockLabel + '</div>';
                        }

                        html += '</div>';
                    }

                    html += '<div class="mt-auto flex items-center justify-between pt-1">';
                    html += priceHtml;
                    html += '<button data-wishlist-add-cart onclick="wishlistAddToCart(' + product.id + ', ' + (selectedDetail ? selectedDetail.id : null) + ', this)" class="bg-primary text-white text-[10px] font-bold px-3 py-1.5 hover:bg-primary-dark transition-colors flex items-center gap-1.5" type="button">';
                    html += '<span class="material-symbols-outlined text-xs">shopping_bag</span> أضف للسلة</button>';
                    html += '</div>';
                    html += '</div></div>';
                });
                container.innerHTML = html;
                document.getElementById('wishlist-drawer-count').textContent = data.count + ' قطع';
            })
            .catch(function() {
                container.innerHTML = '<div class="flex items-center justify-center h-full text-gray-400 text-sm">حدث خطأ في تحميل المفضلة</div>';
            });
        }

        function wishlistSelectDetail(productId, detailId) {
            wishlistSelectedDetails[productId] = detailId;

            if (!wishlistData || !wishlistData.items) return;

            var product = wishlistData.items.find(function(p) { return p.id === productId; });
            if (!product) return;

            var detail = (product.details || []).find(function(d) { return d.id === detailId; });
            var newSrc = (detail && detail.cover_image) || product.image || 'https://via.placeholder.com/96x128';
            var img = document.getElementById('wishlist-img-' + productId);
            if (img) img.src = newSrc;

            var addBtn = document.querySelector('[data-wishlist-item][data-product-id="' + productId + '"] [data-wishlist-add-cart]');
            if (addBtn) {
                addBtn.setAttribute('onclick', 'wishlistAddToCart(' + productId + ',' + detailId + ', this)');
            }

            var item = document.querySelector('[data-wishlist-item][data-product-id="' + productId + '"]');
            if (!item) return;

            item.querySelectorAll('[data-detail-id]').forEach(function(chip) {
                var did = parseInt(chip.getAttribute('data-detail-id'));
                var isSelected = did === detailId;

                var colorSpan = chip.querySelector('.rounded-full');
                if (colorSpan) {
                    chip.className = 'flex flex-col items-center gap-0.5';
                    colorSpan.className = isSelected
                        ? 'block w-5 h-5 rounded-full ring-2 ring-primary ring-offset-1'
                        : 'block w-5 h-5 rounded-full border border-gray-300';
                } else if (chip.tagName === 'BUTTON') {
                    chip.className = isSelected
                        ? 'text-[10px] px-2 py-0.5 border detail-chip-active transition-colors rounded'
                        : 'text-[10px] px-2 py-0.5 border border-gray-200 transition-colors rounded';
                }
            });

            var stockEl = item.querySelector('[data-wishlist-stock]');
            if (stockEl && detail && typeof detail.stock_qty !== 'undefined') {
                stockEl.innerHTML = detail.stock_qty > 0
                    ? '<span class="text-green-600 font-bold">المخزون: ' + detail.stock_qty + '</span>'
                    : '<span class="text-red-500 font-bold">غير متوفر</span>';
            }
        }

        function wishlistRemoveItem(productId, btn) {
            btn.disabled = true;
            delete wishlistSelectedDetails[productId];
            fetch('{{ route("customer.wishlist.toggle") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ product_id: productId }),
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                var headerBadge = document.getElementById('wishlist-count-badge');
                if (headerBadge) headerBadge.textContent = data.count;
                showToast('تمت الإزالة من المفضلة');
                loadWishlistDrawer();
            })
            .catch(function() {
                showToast('حدث خطأ', 'error');
                btn.disabled = false;
            });
        }

        function wishlistAddToCart(productId, detailId, btn) {
            btn.disabled = true;
            var originalHtml = btn.innerHTML;
            btn.innerHTML = '<span class="material-symbols-outlined text-sm">check</span> جاري...';

            var body = { product_id: productId, quantity: 1 };
            if (detailId) body.product_detail_id = detailId;

            fetch('{{ route("cart.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(body),
            })
            .then(function(r) { return r.json(); })
            .then(function() {
                updateCartCount();
                showToast('تمت إضافة المنتج إلى السلة');
                btn.innerHTML = '<span class="material-symbols-outlined text-sm">check</span> تم';
                setTimeout(function() {
                    btn.innerHTML = originalHtml;
                    btn.disabled = false;
                }, 2000);
            })
            .catch(function() {
                showToast('حدث خطأ', 'error');
                btn.innerHTML = originalHtml;
                btn.disabled = false;
            });
        }

        function addAllWishlistToCart() {
            var btn = event.target;
            btn.disabled = true;
            var originalText = btn.innerHTML;
            btn.innerHTML = 'جاري الإضافة... <span class="material-symbols-outlined text-lg">sync</span>';

            var data = wishlistData;
            if (!data || !data.items || data.items.length === 0) {
                btn.innerHTML = originalText;
                btn.disabled = false;
                return;
            }
            var promises = data.items.map(function(product) {
                var selectedId = wishlistSelectedDetails[product.id];
                var body = { product_id: product.id, quantity: 1 };
                if (selectedId) {
                    body.product_detail_id = selectedId;
                } else if (product.details && product.details.length > 0) {
                    body.product_detail_id = product.details[0].id;
                }
                return fetch('{{ route("cart.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(body),
                });
            });
            Promise.all(promises)
            .then(function() {
                updateCartCount();
                showToast('تمت إضافة جميع المنتجات إلى السلة');
                setTimeout(function() { btn.innerHTML = originalText; btn.disabled = false; }, 2000);
            })
            .catch(function() {
                showToast('حدث خطأ', 'error');
                btn.innerHTML = originalText;
                btn.disabled = false;
            });
        }

        function checkout() {
            window.location.href = '{{ route('cart') }}';
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();

            document.querySelector('[data-cart-toggle]').addEventListener('click', function() {
                @auth
                    openCartDrawer();
                @else
                    window.location.href = '{{ route('auth.signin') }}';
                @endauth
            });

            document.querySelector('[data-wishlist-toggle]').addEventListener('click', function() {
                @auth
                    openWishlistDrawer();
                @else
                    window.location.href = '{{ route('auth.signin') }}';
                @endauth
            });
        });
    </script>
</body>

</html>
