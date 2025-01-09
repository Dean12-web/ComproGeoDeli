<?php

namespace App\Http\Controllers;

use App\Models\Testimony;
use Illuminate\Http\Request;

class TestimonyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cms.testimonies.testimonies');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.testimonies.form-add-testimonies');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "client_name" => "required|max:100",
            "client_email" => "required|max:100|email",
            "client_photo" => "nullable|mimes:jpg,jpeg,png|file|max:1024",
            "testimonial" => "required"
        ]);

        try {
            // Handle client photo upload if provided
            if ($request->hasFile('client_photo')) {
                $file = $request->file('client_photo');
                $fileName = time() . "_" . $file->getClientOriginalName();
                $file->move(public_path('storage/images/'), $fileName);
                $validatedData['client_photo'] = $fileName;
            }

            // Default `is_approved` to false
            $validatedData['is_approved'] = false;

            // Create the testimony record
            Testimony::create($validatedData);

            return response()->json(["success" => "Testimoni berhasil ditambahkan, Menunggu persetujuan."], 200);
        } catch (\Exception $e) {
            return response()->json(["error" => "Gagal menambahkan testimoni."], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $name = $request->query("client_name", "");
        $sortBy = $request->query("sort_by", "id");
        $sortDirection = $request->query("sort_dir", "asc");
        $perPage    = $request->query("per_page",10);

        $query = Testimony::query();

        if(!empty($name)){
            $query->where("client_name", "like", "%{$name}%");
        }

        $query->orderBy($sortBy, $sortDirection);

        $data = $query->paginate($perPage);

        return response()->json([
            "message" => "Data successfully showed",
            "data"  => $data
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimony $testimony, Request $request)
    {
        $testimony = Testimony::findOrFail($request->id);

        return view('cms.testimonies.preview-testimonies',
    ["testimony" => $testimony]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimony $testimony)
    {
        $validated = $request->validate([
            'is_approved' => 'required|boolean',
        ]);
    
        $testimony->update(['is_approved' => $validated['is_approved']]);
    
        return redirect()->route('cms.testimony')->with('success', 'Layanan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimony $testimony)
    {
        //
    }
}
