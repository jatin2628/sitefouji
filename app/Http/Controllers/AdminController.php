<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Data;

class AdminController extends Controller
{
    public function userdata()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    public function showFiles($id)
    {   $user = User::find($id);
        $files = Data::where('user_id', $id)->get();
        return view('usersfiles', ['files'=>$files,'user'=>$user]);
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
}

