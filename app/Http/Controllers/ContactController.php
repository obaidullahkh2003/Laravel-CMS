<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Http\Requests\StoreContactMessageRequest;

class ContactController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->take(3)->get();

        return view('admin.dashboard', compact('messages'));
    }



    public function store(StoreContactMessageRequest $request)
    {
        $data = $request->validated();

        ContactMessage::create($data);

        return back()->with('success', 'Your message has been sent successfully!');
    }

    public function show($id)
    {
        $contactMessage = ContactMessage::findOrFail($id);
        return view('contact.show', compact('contactMessage'));
    }

    public function destroy($id)
    {
        $contactMessage = ContactMessage::findOrFail($id);
        $contactMessage->delete();
        return redirect()->route('contacts.index')->with('success', 'Contact message deleted successfully!');
    }
}
