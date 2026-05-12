<x-auth-layout :title="__('identity::auth.otp_title')">
    <div class="text-center mb-8">
        <p class="text-sm text-gray-500">{{ __('identity::auth.otp_description') }}</p>
    </div>

    <form method="POST" action="{{ route('auth.otp') }}">
        @csrf

        <div class="mb-8">
            <x-auth-input name="code" type="text" :placeholder="__('identity::auth.otp_placeholder')" class="text-center text-2xl tracking-[1em] font-bold" maxlength="6" required autofocus />
        </div>

        <div class="text-center mb-8">
            <div id="countdown" class="text-xl font-bold text-[#A67C52]">15:00</div>
            <p class="text-xs text-gray-400 mt-2 uppercase tracking-widest">{{ __('identity::auth.code_expires_in') }}</p>
        </div>

        <div>
            <button type="submit" class="w-full btn-primary py-3 px-4 text-sm font-bold tracking-widest uppercase">
                {{ __('identity::auth.verify_button') }}
            </button>
        </div>
    </form>

    <div class="mt-8 text-center">
        <form method="POST" action="{{ route('auth.otp') }}">
            @csrf
            <button type="button" id="resend-btn" class="text-sm text-gray-400 cursor-not-allowed uppercase tracking-widest font-bold" disabled>
                {{ __('identity::auth.resend_code') }}
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let timeLeft = 15 * 60;
            const display = document.querySelector('#countdown');
            const resendBtn = document.querySelector('#resend-btn');

            const timer = setInterval(function() {
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;

                display.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                if (--timeLeft < 0) {
                    clearInterval(timer);
                    display.textContent = "00:00";
                    display.classList.remove('text-[#A67C52]');
                    display.classList.add('text-red-600');
                    resendBtn.disabled = false;
                    resendBtn.classList.remove('text-gray-400', 'cursor-not-allowed');
                    resendBtn.classList.add('text-[#A67C52]', 'cursor-pointer', 'hover:underline');
                }
            }, 1000);
        });
    </script>
</x-auth-layout>
