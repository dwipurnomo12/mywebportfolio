<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactSectionController extends Controller
{
    public function index()
    {
        $contact = Contact::first();
        return view('admin.section-contact.index', [
            'contact'   => $contact
        ]);
    }
}
