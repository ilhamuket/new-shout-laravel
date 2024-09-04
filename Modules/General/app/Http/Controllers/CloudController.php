<?php

namespace Modules\General\Http\Controllers;

use App\Http\Controllers\Controller;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CloudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('general::index');
    }

    public function upload(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
            ]);

            $path = 'laravel-cloud';
            $file = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($file, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $publicId = date('Y-m-d') . '/' . $fileName;

            $upload = Cloudinary::upload($request->file('image')->getRealPath(), [
                'folder' => $path,
                'public_id' => $publicId,
                'overwrite' => TRUE,
                'resource_type' => 'image'
            ])->getSecurePath();

            return response()->json(['url' => $upload], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('general::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('general::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('general::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
