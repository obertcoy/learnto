<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {

        $workshops = Workshop::with([
            'instructor' => function ($query) {
                $query->select('id', 'name', 'profile_picture_url')
                    ->withCount('ratings')
                    ->withAvg('ratings as average_rating', 'rate');
            },
            'topics:topic'
        ])
        ->paginate(9);

        $topTopics = Topic::withCount('workshops')
                    ->orderByDesc('workshops_count')
                    ->limit(5)
                    ->get(['id'. 'name']);
        // $workshops = [];
        // $topTopics = [];

        return view('pages.explore', compact('workshops', 'topTopics'));
    }

    public function featured()
    {
        //

        $featureds = Workshop::with([
            'instructor' => function ($query) {
                $query->select('id', 'name', 'profile_picture_url')
                    ->withCount('ratings')
                    ->withAvg('ratings as average_rating', 'rate');
            },
            'topics:topic'
        ])->first()->take(3)->get();

        return view('pages.welcome', compact('featureds'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Workshop $workshop)
    {
        return view('pages.workshop-show', compact('workshop'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workshop $workshop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Workshop $workshop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workshop $workshop)
    {
        //
    }
}
