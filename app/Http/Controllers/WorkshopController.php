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

    public function index(Request $request)
    {

        $searchFilter = $request->input('search');
        $topicFilter = $request->input('topics', []);
        $durationFilter = $request->input('duration', 'any');

        $startDuration = match($durationFilter){
            'short' => 0,
            'medium' => 120,
            'long' => 240,
            default => 0            
        };

        $endDuration = match($durationFilter){
            'short' => 120,
            'medium' => 240,
            'long' => 9999,
            default => 9999
        };

        $workshops = Workshop::with([
            'instructor' => function ($query) {
                $query->select('id', 'name', 'profile_picture_url')
                    ->withCount('ratings')
                    ->withAvg('ratings as average_rating', 'rate');
            },
            'topics' => function ($query) {
                $query->select('topics.id', 'topics.topic');
            },
        ])
            ->when($searchFilter, fn($filter) => $filter->where('title', 'like', "%{$filter}%"))
            ->when(!empty($topicFilter), function ($query) use ($topicFilter) {
                $query->whereHas('topics', function ($subQuery) use ($topicFilter) {
                    $subQuery->whereIn('topics.id', $topicFilter);
                });
            })
            ->when($durationFilter != 'any', fn($filter) => $filter->whereBetween('duration', [$startDuration, $endDuration]))
            ->paginate(9);

        $topTopics = Topic::withCount('workshops')
            ->orderByDesc('workshops_count')
            ->limit(5)
            ->get(['id' . 'name']);

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
        return view('pages.workshops-create');
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
        return view('pages.workshops-show', compact('workshop'));
    }

    public function payment(Workshop $workshop)
    {

        $taxes = $workshop->price * 0.06;
        $total = $workshop->price + $taxes;

        return view('pages.payment', compact('workshop', 'taxes', 'total'));
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
