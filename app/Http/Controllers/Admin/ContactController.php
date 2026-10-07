<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function markRead(Contact $contact)
    {
        $contact->update(['is_read' => true]);

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Pesan ditandai sudah dibaca!');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Pesan berhasil dihapus!');
    }
}
