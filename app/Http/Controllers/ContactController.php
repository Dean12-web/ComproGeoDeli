<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contact = Contact::all();
        return view("cms.contacts.contacts", [
            'contact' => $contact
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("cms.contacts.form-add-contacts");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "address" => "required",
            "phone_number" => "required",
            "email" => "required",
            "instagram" => "required",
            "facebook" => "required",
            "twitter" => "required",
            "whatsapp" => "required"
        ]);

        Contact::create($validatedData);
        return redirect()->route('cms.contact')->with("success", "Contact berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $contacts = Contact::findOrFail($request->id);

        return view('cms.contacts.form-edit-contacts', ["contacts" => $contacts]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $validatedData = $request->validate([
            "address" => "required",
            "phone_number" => "required",
            "email" => "required",
            "instagram" => "required",
            "facebook" => "required",
            "twitter" => "required",
            "whatsapp" => "required"
        ]);

        $contact->update($validatedData);

        return redirect()->route('cms.contact')->with("success", 'Kontak perusahaan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
