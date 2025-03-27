<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function privacyPolicy()
    {
        return view('privacy-policy');
    }
    public function aboutUs()
    {
        return view('about_us');
    }
    public function contactUs()
    {
        return view('contact_us');
    }

    public function submitContactForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        // ڈیٹا بیس میں اسٹور کریں
        ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Your message has been sent successfully!');
    }
    public function viewMessages()
    {
        $messages = ContactMessage::latest()->paginate(10);
        return view('contact_messages', compact('messages'));
    }

}
