<?php

namespace Sso\SsoSdk\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SsoRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (config('sso.enabled')) {
            return true;
        }
        return Auth::check();
    }
}