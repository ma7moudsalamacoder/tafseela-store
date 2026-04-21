<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email:rfc,dns', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator, 'newsletter')
                ->withInput();
        }

        return redirect()
            ->back()
            ->with('newsletter_success', 'تم استلام بريدك الإلكتروني بنجاح. سنشاركك أحدث العروض قريباً.');
    }
}
