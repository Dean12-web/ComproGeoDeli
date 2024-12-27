<?php

namespace App\Http\Controllers;

use App\Models\Service;
use File;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cms.services.services');
    }

    /**
     * Display data by api
     */
    public function data(Request $request)
    {
        $title = $request->query("title", "");
        $sortBy = $request->query("sort_by", "id");
        $sortDirection = $request->query("sort_dir", "asc");
        $perPage = $request->query("per_page", 10);

        $query = Service::query();

        if (!empty($title)) {
            $query->where("title", "like", "%{$title}%");
        }

        $query->orderBy($sortBy, $sortDirection);

        $data = $query->paginate(($perPage));

        return response()->json([
            "message" => "Data successfully showed",
            "data" => $data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.services.form-add-services');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "title" => "required|max:255",
            "image" => "required|mimes:jpg,jpeg,png|file|max:1024",
            "description" => "required"
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . "_" . $file->getClientOriginalName();
            $imagePath = $file->move(public_path('storage/images/'), $fileName);
            $validatedData['image'] = $fileName;
        }

        Service::create($validatedData);

        return redirect()->route('cms.services')->with('success', 'Layanan berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service, Request $request)
    {
        $services = Service::findOrFail($request->id);

        return view('cms.services.form-edit-services',[
            "service" => $services
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validatedData = $request->validate([
            "title" => "required|max:255",
            "image" => "nullable|mimes:jpg,jpeg,png|file|max:1024",
            "description" => "required"
        ]);
    
        if ($request->hasFile('image')) {
            // Delete the previous image if it exists
            if ($service->image && File::exists(public_path('storage/images/' . $service->image))) {
                File::delete(public_path('storage/images/' . $service->image));
            }
    
            $file = $request->file('image');
            $fileName = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('storage/images/'), $fileName);
            $validatedData['image'] = $fileName;
        }
    
        $service->update($validatedData);
    
        return redirect()->route('cms.services')->with('success', 'Layanan berhasil diubah!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service, Request $request)
    {
        $id = $request->id;

        $services = $service->find($id);

        if(!$services){
            return response()->json(["error" => "Layanan tidak ditemukan"],404);
        }

        $filePath = public_path('storage/images/' . $services->image);

        // Delete the file if it exists
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $services->delete();

        return response()->json(["success" => "Layanan berhasil dihapus"],200);
    }
}
