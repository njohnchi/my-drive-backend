<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFolderRequest;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFolderRequest $request)
    {
        $data = $request->validated();
        $parent = $request->parent;
        if (!$parent) {
            $parent = $this->getRoot();
        }

        $file = new File();
        $file->name = $data['name'];
        $file->is_folder = true;
        $file->save();

        $parent->appendNode($file);

        return response()->json($file);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    protected function getRoot(): File
    {
        return File::query()
            ->where('created_by', Auth::id())
            ->where('is_folder', true)
            ->whereNull('parent_id')
            ->first();
    }
}
