<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'تفصيلة - Tafsela' }}</title>
    <meta name="description" content="{{ $description ?? 'متجر تفصيلة للأزياء العصرية والفاخرة' }}">
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#A67C52",
                        "primary-dark": "#7D5A39",
                        "accent-gold": "#A67C52",
                        "background-light": "#FDFCFB",
                        "background-dark": "#121212",
                        "neutral-charcoal": "#1A1A1A",
                        "neutral-beige": "#F7F3F0",
                    },
                    fontFamily: {
                        "display": ["Almarai", "sans-serif"],
                        "body": ["IBM Plex Sans Arabic", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0px",
                        "lg": "0px",
                        "xl": "0px",
                        "full": "9999px"
                    }
                }
            }
        }
    </script>
    
    <style>
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .luxury-button-hover { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        .product-card-shadow { transition: box-shadow 0.3s ease; }
        .product-card-shadow:hover { box-shadow: 0 20px 40px -15px rgba(0,0,0,0.08); }
        .drawer-open { overflow: hidden; }
        [data-drawer].is-open { display: block; pointer-events: auto; }
        [data-drawer].is-open [data-drawer-overlay] { opacity: 1; }
        [data-drawer].is-open aside { transform: translateX(0); }
    </style>
    
    @stack('styles')
</head>
<body class="font-body text-neutral-charcoal bg-background-light dark:bg-background-dark dark:text-gray-100 antialiased transition-colors duration-300">
    <x-customer::components.client.favorites-drawer />
    <x-customer::components.client.cart-drawer />

    <x-customer::components.client.header />
    
    <main>
        {{ $slot }}
    </main>
    
    <x-customer::components.client.footer />
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const body = document.body;
            const drawers = Array.from(document.querySelectorAll('[data-drawer]'));
            const triggers = Array.from(document.querySelectorAll('[data-drawer-target]'));

            const closeDrawers = () => {
                drawers.forEach((drawer) => {
                    drawer.classList.remove('is-open');
                    drawer.setAttribute('aria-hidden', 'true');
                });

                triggers.forEach((trigger) => {
                    trigger.setAttribute('aria-expanded', 'false');
                });

                body.classList.remove('drawer-open');
            };

            const openDrawer = (target) => {
                const drawer = document.querySelector(`[data-drawer="${target}"]`);

                if (!drawer) {
                    return;
                }

                closeDrawers();
                drawer.classList.add('is-open');
                drawer.setAttribute('aria-hidden', 'false');
                body.classList.add('drawer-open');

                triggers
                    .filter((trigger) => trigger.dataset.drawerTarget === target)
                    .forEach((trigger) => trigger.setAttribute('aria-expanded', 'true'));
            };

            triggers.forEach((trigger) => {
                trigger.addEventListener('click', () => {
                    const target = trigger.dataset.drawerTarget;
                    const drawer = document.querySelector(`[data-drawer="${target}"]`);

                    if (drawer?.classList.contains('is-open')) {
                        closeDrawers();
                        return;
                    }

                    openDrawer(target);
                });
            });

            drawers.forEach((drawer) => {
                drawer.querySelector('[data-drawer-overlay]')?.addEventListener('click', closeDrawers);

                drawer.querySelectorAll('[data-drawer-close]').forEach((button) => {
                    button.addEventListener('click', closeDrawers);
                });
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    closeDrawers();
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
