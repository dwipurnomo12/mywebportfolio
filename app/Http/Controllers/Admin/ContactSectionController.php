<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContactSectionController extends Controller
{
    public function index()
    {
        $contact = Contact::first();
        return view('admin.section-contact.index', [
            'contact'   => $contact
        ]);
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);
        $validator = Validator::make($request->all(), [
            'maps_link'     => 'required',
            'linkedIn_link' => 'required',
            'whatsapp_link' => 'required',
            'github_link'   => 'required',
        ],[
            'maps_link.required'     => 'Form Wajib Di Isi !',
            'linkedIn_link.required' => 'Form Wajib Di Isi !',
            'whatsapp_link.required' => 'Form Wajib Di Isi !',
            'github_link.required'   => 'Form Wajib Di Isi !',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $contact->update([
            'maps_link'     => $request->maps_link,
            'linkedIn_link' => $request->linkedIn_link,
            'whatsapp_link' => $request->whatsapp_link,
            'github_link'   => $request->github_link,
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data Berhasil Terupdate',
            'data'      => $contact
        ]);
    }
}
