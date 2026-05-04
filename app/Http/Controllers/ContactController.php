<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use App\Models\ProfileInfo;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        ContactSubmission::create($validated);

        // Send Email to Company
        $profile = ProfileInfo::first();
        if ($profile && $profile->email) {
            Mail::to($profile->email)->send(new ContactFormMail($validated));
        }

        return back()->with('success', 'Your message has been sent successfully!');
    }
}
