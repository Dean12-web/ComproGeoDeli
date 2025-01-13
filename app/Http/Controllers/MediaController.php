<?php

namespace App\Http\Controllers;

use App\Models\Media;
use File;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("cms.medias.medias");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("cms.medias.form-add-medias");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "file" => "required|file|mimes:jpg,jpeg,png,pdf|max:2048"
        ]);

        if ($request->hasFile("file")) {
            $file = $request->file("file");
            $fileName = time() . "_" . $file->getClientOriginalName();

            $filePath = $file->storeAs("images", $fileName, "public");

            $fileType = $file->getClientMimeType();

            Media::create([
                "file_name" => $fileName,
                "file_path" => $filePath,
                "file_type" => $fileType
            ]);
        }
        return redirect()->route('cms.media')->with("success", "Faq berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(Media $media, Request $request)
    {
        $fileName = $request->query("file_name", "");
        $sortBy = $request->query("sort_by", "id");
        $sortDirection = $request->query("sort_dir", "asc");

        $perPage = $request->query("per_page", 10);

        $query = Media::query();

        if (!empty($fileName)) {
            $query->where("file_name", "like", "%{$fileName}%");
        }

        $query->orderBy($sortBy, $sortDirection);

        $data = $query->paginate($perPage);

        return response()->json([
            "message" => "Data successfully showed",
            "data" => $data,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Media $media, Request $request)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $media, Request $request)
    {
        $id = $request->id;

        $medias = $media->find($id);

        if(!$medias){
            return response()->json(["error" => "Media tidak ditemukan"],404);
        }

        $filePath = public_path('storage/images/' . $medias->file_name);

        // Delete the file if it exists
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
        $medias->delete();

        return response()->json(["success" => "Media berhasil dihapus"],200);
    }
}
