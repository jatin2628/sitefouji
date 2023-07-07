<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;



class DataController extends Controller
{
    public function upload(Request $request)
    {
        $user = Session::get('user');
       
        $files = $request->file('files');
        
        foreach ($files as $file) {
            // Get the original file name
            $originalName = $file->getClientOriginalName();
            $path = $file->storeAs('uploads', $file->getClientOriginalName());
                

            $fileModel = new Data;
            $fileModel->folder_type = $request->folder;
            $fileModel->filename = $originalName;
            $fileModel->status= 0;
            $fileModel->user_id= $user->id;
            $fileModel->location = $request->structuredValue;
            $fileModel->designation = $request->structuredValue;
                
            $fileModel->save();
        }
        
        return redirect()->back();
    }

    public function getdata(Request $request)
{
    $user = Session::get('user');

    $files = Data::where('user_id', $user->id)->get();
    $user = User::where('id', $user->id)->first();

    $statusCounts = [
        'totalFiles' => $files->count(),
        'approved' => $files->where('status', 1)->count(),
        'partiallyApproved' => $files->where('status', 2)->count(),
        'pending' => $files->where('status', 0)->count(),
        'declined' => $files->where('status', 3)->count(),
    ];

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

    $excelFiles = $files->filter(function ($file) {
        return $this->getFileExtension($file->filename) === 'xlsx';
    })->count();

    $wordFiles = $files->filter(function ($file) {
        return $this->getFileExtension($file->filename) === 'docx';
    })->count();

    $pdfFiles = $files->filter(function ($file) {
        return $this->getFileExtension($file->filename) === 'pdf';
    })->count();


    return view('user', [
        'files' => $files,
        'user' => $user,
        'statusCounts' => $statusCounts,
        'excelFiles' => $excelFiles,
        'wordFiles' => $wordFiles,
        'pdfFiles' => $pdfFiles,
        'totalEntries'=>$totalEntries,
        'uniqueEntries'=>$uniqueEntries
    ]);
}

private function countUniqueEntries($entries)
{
    $uniqueEntries = [];
    foreach ($entries as $entry) {
        unset($entry['S.NO']); // Exclude the "S.NO" column from comparison
        $uniqueEntries[serialize($entry)] = $entry;
    }
    return count($uniqueEntries);
}

private function getFileExtension($filename)
{
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    return strtolower($extension);
}



public function unstructure(Request $request)
{
    $user = Session::get('user');

    $files = Data::where('user_id', $user->id)->where('folder_type','unstructured')->get();
    $user = User::where('id', $user->id)->first();

    $statusCounts = [
        'totalFiles' => $files->count(),
        'approved' => $files->where('status', 1)->count(),
        'partiallyApproved' => $files->where('status', 2)->count(),
        'pending' => $files->where('status', 0)->count(),
        'declined' => $files->where('status', 3)->count(),
    ];

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

    $excelFiles = $files->filter(function ($file) {
        return $this->getFileExtension($file->filename) === 'xlsx';
    })->count();

    $wordFiles = $files->filter(function ($file) {
        return $this->getFileExtension($file->filename) === 'docx';
    })->count();

    $pdfFiles = $files->filter(function ($file) {
        return $this->getFileExtension($file->filename) === 'pdf';
    })->count();


    return view('user', [
        'files' => $files,
        'user' => $user,
        'statusCounts' => $statusCounts,
        'excelFiles' => $excelFiles,
        'wordFiles' => $wordFiles,
        'pdfFiles' => $pdfFiles,
        'totalEntries'=>$totalEntries,
        'uniqueEntries'=>$uniqueEntries
    ]);
}

public function location(Request $request)
{
    $user = Session::get('user');

    $files = Data::where('user_id', $user->id)->where('location','<>','null')->get();
    $user = User::where('id', $user->id)->first();

    $statusCounts = [
        'totalFiles' => $files->count(),
        'approved' => $files->where('status', 1)->count(),
        'partiallyApproved' => $files->where('status', 2)->count(),
        'pending' => $files->where('status', 0)->count(),
        'declined' => $files->where('status', 3)->count(),
    ];

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

    $excelFiles = $files->filter(function ($file) {
        return $this->getFileExtension($file->filename) === 'xlsx';
    })->count();

    $wordFiles = $files->filter(function ($file) {
        return $this->getFileExtension($file->filename) === 'docx';
    })->count();

    $pdfFiles = $files->filter(function ($file) {
        return $this->getFileExtension($file->filename) === 'pdf';
    })->count();

    $fv = 'Location';
    return view('usertwo', [
        'files' => $files,
        'user' => $user,
        'statusCounts' => $statusCounts,
        'excelFiles' => $excelFiles,
        'wordFiles' => $wordFiles,
        'pdfFiles' => $pdfFiles,
        'totalEntries'=>$totalEntries,
        'uniqueEntries'=>$uniqueEntries,
        'fieldvalue'=>$fv
    ]);
}


public function designation(Request $request)
{
    $user = Session::get('user');

    $files = Data::where('user_id', $user->id)->where('designation','<>','null')->get();
    $user = User::where('id', $user->id)->first();

    $statusCounts = [
        'totalFiles' => $files->count(),
        'approved' => $files->where('status', 1)->count(),
        'partiallyApproved' => $files->where('status', 2)->count(),
        'pending' => $files->where('status', 0)->count(),
        'declined' => $files->where('status', 3)->count(),
    ];

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

    $excelFiles = $files->filter(function ($file) {
        return $this->getFileExtension($file->filename) === 'xlsx';
    })->count();

    $wordFiles = $files->filter(function ($file) {
        return $this->getFileExtension($file->filename) === 'docx';
    })->count();

    $pdfFiles = $files->filter(function ($file) {
        return $this->getFileExtension($file->filename) === 'pdf';
    })->count();


    return view('usertwo', [
        'files' => $files,
        'user' => $user,
        'statusCounts' => $statusCounts,
        'excelFiles' => $excelFiles,
        'wordFiles' => $wordFiles,
        'pdfFiles' => $pdfFiles,
        'totalEntries'=>$totalEntries,
        'uniqueEntries'=>$uniqueEntries,
        'fieldvalue'=>'Designation'
    ]);
}


public function structure(Request $request)
{
    $user = Session::get('user');

    $files = Data::where('user_id', $user->id)->where('folder_type','structured')->get();
    $user = User::where('id', $user->id)->first();

    $statusCounts = [
        'totalFiles' => $files->count(),
        'approved' => $files->where('status', 1)->count(),
        'partiallyApproved' => $files->where('status', 2)->count(),
        'pending' => $files->where('status', 0)->count(),
        'declined' => $files->where('status', 3)->count(),
    ];

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

    $excelFiles = $files->filter(function ($file) {
        return $this->getFileExtension($file->filename) === 'xlsx';
    })->count();

    $wordFiles = $files->filter(function ($file) {
        return $this->getFileExtension($file->filename) === 'docx';
    })->count();

    $pdfFiles = $files->filter(function ($file) {
        return $this->getFileExtension($file->filename) === 'pdf';
    })->count();


    return view('user2', [
        'files' => $files,
        'user' => $user,
        'statusCounts' => $statusCounts,
        'excelFiles' => $excelFiles,
        'wordFiles' => $wordFiles,
        'pdfFiles' => $pdfFiles,
        'totalEntries'=>$totalEntries,
        'uniqueEntries'=>$uniqueEntries
    ]);
}

    
}
