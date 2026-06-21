<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobController extends Controller
{

    public function index()
    {
    
        $jobs = Job::with('user')->latest()->get();

        return Inertia::render('Jobs/Index', [
            'jobs' => $jobs
        ]);
    }
    
    public function create()
    {
        return Inertia::render('Jobs/Create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'budget' => 'required|numeric', 
        ]);

        Job::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'budget' => $request->budget,
        ]);

        

        
       return redirect()->route('jobs.index')->with('success', 'success_message');
    }

    
public function destroy(Job $job)
{
    
    if ($job->user_id !== auth()->id()) {
        abort(403);
    }

    $job->delete();

    
    return redirect()->back()->with('success', 'delete_success');
}


public function edit(Job $job)
{
   
    if ($job->user_id !== auth()->id()) {
        abort(403);
    }
    return Inertia::render('Jobs/Edit', [
        'job' => $job
    ]);
}


public function update(Request $request, Job $job)
{
    if ($job->user_id !== auth()->id()) {
        abort(403);
    }

    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'budget' => 'required|numeric',
    ]);

    $job->update($request->all());

    return redirect()->route('jobs.index')->with('success', 'update_success');
}
}