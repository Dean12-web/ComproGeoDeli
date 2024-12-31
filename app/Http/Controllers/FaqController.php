<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cms.faqs.faqs');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.faqs.form-add-faq');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $validatedData =  $request->validate([
            "question" => "required | max:255",
            "answer"   => "required"
        ]);

        Faq::create($validatedData);
        return redirect()->route('cms.faqs')->with("success", "Faq berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $question = $request->query("question","");
        $sortBy   = $request->query("sort_by", "id");
        $sortDirection  =   $request->query("sort_dir","asc");
        $perPage        =   $request->query("per_page",10);

        $query = Faq::query();

        if(!empty($title)){
            $query->where("question", "like", "%{$question}%");
        }

        $query->orderBy($sortBy, $sortDirection);

        $data = $query->paginate($perPage);

        return response()->json([
            "message"   => "Data succesfully showed",
            "data"      => $data,
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq, Request $request)
    {
        $faqs = Faq::findOrFail($request->id);
        
        return view('cms.faqs.form-edit-faq',[
            "faqs" => $faqs
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        $validatedData =  $request->validate([
            "question" => "required | max:255",
            "answer"   => "required"
        ]);

        $faq->update($validatedData);

        return redirect()->route('cms.faqs')->with('success', 'Faqs berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq, Request $request)
    {
        $id = $request->id;

        $faqs = $faq->find($id);

        if(!$faqs){
            return response()->json(["error" => "Layanan tidak ditemukan"],404);
        }

        $faqs->delete();

        return response()->json(["success" => "Layanan berhasil dihapus"],200);
    }
}
