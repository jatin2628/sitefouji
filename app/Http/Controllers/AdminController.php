<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Data;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function userdata()
    {
        $users = User::where('account_type','1')->get();
        return view('users', compact('users'));
    }

    public function showFiles($id)
    {   $user = User::find($id);
        $files = Data::where('user_id', $id)->get();


        $excelFiles = $files->filter(function ($file) {
            return $this->getFileExtension($file->filename) === 'xlsx';
        });
    
        $totalEntries=[];
        $uniqueEntries = [];
    
        foreach ($files as $file) {
            $totalEntries[$file->id] = 0;
            $uniqueEntries[$file->id] = 0;
    
        }
    
        foreach ($excelFiles as $file) {
            $filePath = Storage::disk('storage')->path('uploads/' . $file->filename);
            $segments = explode('/', $filePath);
            $cleanSegments = array_filter($segments);
    
            $entries = Excel::toArray([], $cleanSegments[0].'\uploads\\'.$file->filename);
            $totalEntries[$file->id] = count($entries)-1;
            $flattenedEntries = Arr::flatten($entries); // Flatten the entries to get an array of strings
            $uniqueEntries[$file->id] = collect($entries)->unique()->count()-1;
    
        }



        return view('usersfiles', ['files'=>$files,'user'=>$user,
        'totalEntries'=>$totalEntries,
        'uniqueEntries'=>$uniqueEntries]);
    }

    public function download(Request $request,$filename)
    {   return response()->download(public_path('assets/'.$filename));
    }

    public function updateStatus($id, $status)
    {
        $file = Data::find($id);

        if (!$file) {
            return response()->json(['error' => 'file not found'], 404);
        }

        // Set the user's status based on the provided status parameter
        switch ($status) {
            case 1:
                $file->status = '1';
                break;
            case 2:
                $file->status = '2';
                break;
            case 3:
                $file->status = '3';
                break;
            default:
                return response()->json(['error' => 'Invalid status'], 400);
        }

        $file->save();

        return redirect()->back();
    }

    public function viewFile($id)
    {
        $file = Data::find($id);

        if (!$file) {
            return response()->json(['error' => 'File not found'], 404);
        }

        $filePath = public_path('assets/' . $file->filename);

        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        return response()->file($filePath);
    }

    

private function getContentType($filePath)
{
    $mimeTypes = [
        'pdf' => 'application/pdf',
        'doc' => 'application/msword',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'xls' => 'application/vnd.ms-excel',
        'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    ];

    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
    if (isset($mimeTypes[$extension])) {
        return $mimeTypes[$extension];
    }

    return 'application/octet-stream';
}

private function getFileExtension($filename)
{
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    return strtolower($extension);
}



}

