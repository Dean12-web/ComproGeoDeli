<?php

namespace App\Http\Controllers;

use App\Models\CompanyInfo;
use File;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyInfos = CompanyInfo::all();
        return view('cms.info.info', ['companyInfos' => $companyInfos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.info.form-add-info');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "company_name" => "required|max:255",
            "company_description" => "required",
            "company_vision" => "required",
            "company_mission" => "required",
            "company_logo" => "nullable|mimes:jpg,jpeg,png|file|max:1024",
        ]);

        if ($request->hasFile("company_logo")) {
            $file = $request->file("company_logo");
            $fileName = time() . "_" . $file->getClientOriginalName();
            $imagePath = $file->move(public_path('storage/images/'), $fileName);
            $validatedData["company_logo"] = $fileName;
        }

        CompanyInfo::create($validatedData);

        return redirect()->route('cms.info')->with('success', 'Informasi perusahaan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $companyInfo = CompanyInfo::findOrFail($request->id);

        return view('cms.info.preview-info', [
            'companyInfo' => $companyInfo
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyInfo $company, Request $request)
    {
        $companyInfo = CompanyInfo::findOrFail($request->id);

        return view('cms.info.form-edit-info', [
            'companyInfo' => $companyInfo
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CompanyInfo $company)
    {
        $validatedData = $request->validate([
            "company_name" => "required|max:255",
            "company_description" => "required",
            "company_vision" => "required",
            "company_mission" => "required",
            "company_logo" => "nullable|mimes:jpg,jpeg,png|file|max:1024",
        ]);

        if ($request->hasFile('company_logo')) {
            // Delete the previous image if it exists
            if ($company->company_logo && File::exists(public_path('storage/images/' . $company->company_logo))) {
                File::delete(public_path('storage/images/' . $company->company_logo));
            }

            $file = $request->file('company_logo');
            $fileName = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('storage/images/'), $fileName);
            $validatedData['company_logo'] = $fileName;
        }

        $company->update($validatedData);

        return redirect()->route('cms.info')->with("success", 'Informasi perusahaan berhasil diubah!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyInfo $company, Request $request)
    {
        // Check if the company exists (route-model binding handles this automatically)
        if (!$company) {
            return redirect()->route('cms.info')->with("error", "Informasi tidak ditemukan");
        }

        // File path for the logo
        $filePath = public_path('storage/images/' . $company->company_logo);

        // Delete the file if it exists
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        // Delete the company info
        $company->delete();

        return redirect()->route('cms.info')->with("success", "Informasi berhasil dihapus");
    }
}
