@if (session('newsletter_success'))
    <div class="mb-6 rounded-sm border border-green-200 bg-green-50 px-6 py-4 text-right text-sm font-medium text-green-800">
        {{ session('newsletter_success') }}
    </div>
@endif

@if ($errors->newsletter->any())
    <div class="mb-6 rounded-sm border border-red-200 bg-red-50 px-6 py-4 text-right text-sm font-medium text-red-800">
        {{ $errors->newsletter->first('email') }}
    </div>
@endif
