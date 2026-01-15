<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use App\Mail\ContactFormMail;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function service($slug)
    {
        $services = ['websites', 'ecommerce', 'webapps'];
        
        if (!in_array($slug, $services)) {
            abort(404);
        }
        
        return view('services.show', ['service' => $slug]);
    }

    public function contact(Request $request)
    {
        // ==========================================
        // ANTI-SPAM: Honeypot - jeśli wypełnione = bot
        // ==========================================
        if ($request->filled('website')) {
            // Bot wykryty - udajemy sukces ale nic nie wysyłamy
            return redirect()->route('contact.success');
        }

        // ==========================================
        // ANTI-SPAM: Sprawdzenie czasu wypełnienia
        // ==========================================
        $formTime = $request->input('_form_time');
        if ($formTime) {
            $timeTaken = time() - (int)$formTime;
            if ($timeTaken < 3) {
                // Wypełnione w mniej niż 3 sekundy = prawdopodobnie bot
                return redirect()->route('contact.success');
            }
        }

        // ==========================================
        // ANTI-SPAM: Rate limiting (max 5 na godzinę)
        // ==========================================
        $key = 'contact-form:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors([
                'rate_limit' => __('site.contact.form.rate_limit', ['minutes' => ceil($seconds / 60)])
            ]);
        }
        RateLimiter::hit($key, 3600); // 1 godzina

        // ==========================================
        // Walidacja formularza
        // ==========================================
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Wysyłanie maila
        Mail::to(config('site.email'))->send(new ContactFormMail($validated));

        return redirect()->route('contact.success');
    }
}
