<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:2000',
        ]);

        // Wysyłanie maila
        Mail::to(config('site.email'))->send(new ContactFormMail($validated));

        return redirect()->route('contact.success');
    }
}
