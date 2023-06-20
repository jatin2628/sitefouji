<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;
use App\Models\User;

class DataController extends Controller
{
    public function upload(Request $request)
    {
        $files = $request->file('files');
        
        foreach ($files as $file) {
            // Get the original file name
            $originalName = $file->getClientOriginalName();
            
            // Save the file with the original name
            $file->move('assets', $originalName);
            
            // Store the file information in the database
            $fileModel = new Data;
            $fileModel->filename = $originalName;
            $fileModel->status= 0;
            $fileModel->user_id= 1;
            $fileModel->save();
        }
        
        return redirect()->back();
    }

    public function getdata()
{
    $files = Data::where('user_id', 1)->get();
    $user = User::where('id', 1)->first();
    
    $statusCounts = [
        'totalFiles' => $files->count(),
        'approved' => $files->where('status', 1)->count(),
        'partiallyApproved' => $files->where('status', 2)->count(),
        'pending' => $files->where('status', 0)->count(),
        'declined' => $files->where('status', 3)->count()
    ];

    return view('user', ['files' => $files, 'user' => $user, 'statusCounts' => $statusCounts]);
}
}
