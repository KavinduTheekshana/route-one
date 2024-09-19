<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
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
    public function store(Request $request)
    {
        $request->validate([
            'document_type' => 'required',
            'user_id' => 'required',
            'file_name' => 'string|max:255',
            'file' => 'required|mimes:jpeg,png,pdf|max:2048',
        ]);

        $document_type = $request->input('document_type');
        $user_id = $request->input('user_id');
        $file_name = $request->input('file_name');
        $file = $request->file('file');

        // Check if the user already has a document of the same type
        // $existingDocument = Document::where('user_id', $user_id)
        //     ->where('document_type', $document_type)
        //     ->first();

        // if ($existingDocument) {
        //     return redirect()->back()->withErrors(['document_type' => 'You have already uploaded a document of this type.']);
        // }

        $filePath = $request->file('file')->store('Documents', 'public');
        $fileOriginalName = $file->getClientOriginalName();
        $fileSize = $file->getSize(); // Get file size in bytes
        $fileMimeType = $file->getMimeType(); // Get MIME type

        // Debugging: Check if file is present
        if (!$file) {
            return redirect()->back()->withErrors(['file' => 'File is not uploaded']);
        }

        Document::create([
            'user_id' => $user_id, // Assuming user is authenticated
            'document_type' => $document_type,
            'file_name' => $file_name,
            'file_path' => $filePath,
            'file_original_name' => $fileOriginalName,
            'file_size' => $fileSize,
            'file_type' => $fileMimeType, // Store MIME type
        ]);

        return redirect()->back()->with('success', 'Document uploaded successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    public function destroy(Document $document)
    {
        Storage::delete($document->file_path);
        $document->delete();

        return redirect()->back()->with('success', 'Document deleted successfully!');
    }
}
