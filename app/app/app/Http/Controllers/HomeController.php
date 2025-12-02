<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:2000',
        ]);

        // Tutaj można dodać logikę wysyłania maila lub zapisywania do bazy

        return back()->with('success', 'Dziękujemy za wiadomość! Skontaktujemy się wkrótce.');
    }
}
