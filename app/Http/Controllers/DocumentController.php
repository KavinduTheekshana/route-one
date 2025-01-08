<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use setasign\Fpdi\Fpdi;
use Fpdf\Fpdf;



class DocumentController extends Controller
{
    public function generateMergedPDF(User $user)
    {
        // Fetch all documents for the user
        $documents = Document::where('user_id', $user->id)->get();

        if ($documents->isEmpty()) {
            return redirect()->back()->with('error', 'No documents found for this user.');
        }

        // Create a new FPDI instance
        $pdf = new Fpdi();

        foreach ($documents as $document) {
            $filePath = storage_path('app/public/' . $document->file_path);

            if (file_exists($filePath)) {
                $fileType = $document->file_type;

                // Check if the file is a PDF
                if (str_contains($fileType, 'pdf')) {
                    try {
                        $pageCount = $pdf->setSourceFile($filePath);

                        // Import all pages from the PDF
                        for ($i = 1; $i <= $pageCount; $i++) {
                            $templateId = $pdf->importPage($i);
                            $pdf->AddPage();
                            $pdf->useTemplate($templateId); // Use the template only once per page
                        }
                    } catch (\Exception $e) {
                        // Log the error and continue with the next document
                        Log::error('Failed to process PDF: ' . $filePath . ' - ' . $e->getMessage());
                        $pdf->AddPage();
                        $pdf->SetFont('Arial', 'B', 16);
                        $pdf->Cell(0, 10, 'Unsupported PDF compression: ' . $document->file_original_name, 0, 1, 'C');
                    }
                } elseif (str_contains($fileType, 'image')) {
                    // Handle image files
                    $pdf->AddPage();
                    $pdf->Image($filePath, 10, 10, 190); // Adjust image placement and size
                } else {
                    // For unsupported types, add a placeholder
                    $pdf->AddPage();
                    $pdf->SetFont('Arial', 'B', 16);
                    $pdf->Cell(0, 10, 'Unsupported file type: ' . $document->file_original_name, 0, 1, 'C');
                }
            } else {
                Log::error('File not found: ' . $filePath);
            }
        }

        // Define the merged PDF file name
        $mergedPdfName = 'Merged-Documents-' . $user->name . '.pdf';
        $mergedPdfPath = storage_path('app/public/' . $mergedPdfName);

        // Save the merged PDF to a file
        $pdf->Output($mergedPdfPath, 'F');

        // Return the merged PDF as a download
        return response()->download($mergedPdfPath)->deleteFileAfterSend(true);
    }


    public function generatePDF(User $user)
    {
        // Fetch all documents for the user
        $documents = Document::where('user_id', $user->id)->get();

        if ($documents->isEmpty()) {
            return redirect()->back()->with('error', 'No documents found for this user.');
        }

        // Prepare data for the PDF
        $data = [
            'user' => $user,
            'documents' => $documents
        ];

        // Load a Blade view and generate the PDF
        $pdf = Pdf::loadView('documents.pdf', $data);

        // Return the generated PDF as a download
        return $pdf->download('Documents-Checklist-' . $user->name . '.pdf');
    }

    public function downloadAll(User $user)
    {
        // Get all documents for the user
        $documents = Document::where('user_id', $user->id)->get();

        if ($documents->isEmpty()) {
            return redirect()->back()->with('error', 'No documents found for this user.');
        }

        // Define the temporary ZIP file path
        $zipFileName = 'Documents-' . $user->name . '.zip';
        $zipFilePath = storage_path('app/public/' . $zipFileName);

        // Create a ZIP file
        $zip = new ZipArchive;

        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            foreach ($documents as $document) {
                // Resolve the correct file path
                $filePath = storage_path('app/public/' . $document->file_path);

                if (file_exists($filePath)) {
                    // Add files to the ZIP
                    $zip->addFile($filePath, $document->file_original_name);
                } else {
                    Log::error('File not found: ' . $filePath);
                }
            }
            if (!$zip->close()) {
                return redirect()->back()->with('error', 'Failed to create ZIP file.');
            }
        } else {
            return redirect()->back()->with('error', 'Unable to create ZIP file.');
        }

        // Return the ZIP file as a download
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
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
