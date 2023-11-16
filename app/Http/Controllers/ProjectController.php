<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'required|file|max:1024', // Max 1 megabyte (1024 kilobytes)

        ]);

        // TASK: change the below line so that $filename would contain only filename
        // The same filename as the original uploaded file

        $originalFilename = $request->file('logo')->getClientOriginalName();
        $filename = pathinfo($originalFilename, PATHINFO_FILENAME);
        $extension = $request->file('logo')->getClientOriginalExtension();

        $request->file('logo')->storeAs('logos', $filename . '.' . $extension);

        Project::create([
            'name' => $request->name,
            'logo' => $filename . '.' . $extension,
        ]);

        return 'Success';
    }
}
