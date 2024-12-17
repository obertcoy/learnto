<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {

        $searchFilter = $request->input('search');
        $topicFilter = $request->input('topics', []);
        $topicFilter = array_filter($topicFilter, function ($value) {
            return !is_null($value) && $value !== '';
        });
        $durationFilter = $request->input('duration', 'any');

        $startDuration = match ($durationFilter) {
            'short' => 0,
            'medium' => 120,
            'long' => 240,
            default => 0
        };

        $endDuration = match ($durationFilter) {
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
            ->when($searchFilter, function ($query) use ($searchFilter) {
                $query->where('name', 'like', "%{$searchFilter}%");
            })->when(!empty($topicFilter), function ($query) use ($topicFilter) {
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
        $topics = Topic::all();
        $times = [];
        for ($hour = 0; $hour < 24; $hour++) {
            foreach (["00", "30"] as $minute) {
                $times[] = sprintf("%02d:%s", $hour, $minute);
            }
        }

        return view('pages.workshops-create', compact('topics', 'times'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'create-name-input' => 'required|string|max:255',
            'create-description-input' => 'required|string',
            'create-objectives-input' => 'required|string|max:255',
            'create-topic-select' => 'required|exists:topics,id',
            'create-date-input' => 'required|date|after:now',
            'create-time-select' => 'required|date_format:H:i',
            'create-duration-input' => 'required|integer|min:1',
            'create-price-input' => 'required|integer|min:0',
            'create-link-input' => 'required|url',
        ]);

        $objectives = explode("-", $validated['create-objectives-input']);
        $objectives = array_filter($objectives, fn($objective) => !empty(trim($objective)));
        $objectives = array_map(fn($objective) => trim($objective), $objectives);

        $objectives = array_values($objectives);


        $datetime = $validated['create-date-input'] . ' ' . $validated['create-time-select'];

        $workshop = Workshop::create([
            'name' => $validated['create-name-input'],
            'description' => $validated['create-description-input'],
            'objectives' => $objectives,
            'date' => $datetime,
            'duration' => $validated['create-duration-input'],
            'price' => $validated['create-price-input'],
            'vc_link' => $validated['create-link-input'],
            'instructor_id' => Auth::user()->id,
        ]);

        $workshop->topics()->attach($validated['create-topic-select']);
        $workshop->update(['objectives' => $objectives]);


        return redirect()->route('workshops.show', $workshop)->with('success', 'Workshop created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Workshop $workshop)
    {
        if (!Gate::allows('current-user', $workshop->instructor_id)) {
            return view('pages.workshops-show', compact('workshop'));
        }

        $attendees = $workshop->users()->paginate(9);
        $showCongratulationsModal = false;

        if(Auth::user()->id != $workshop->instructor_id && $workshop->status == 'Completed'){
            
            $userPivot = $workshop->users()->where('user_id', '=', Auth::user()->id)->first();

            $showCongratulationsModal = !$userPivot->pivot->is_congratulations_shown;

        }

        return view('pages.workshops-show', compact('workshop', 'attendees', 'showCongratulationsModal'));
    }

    public function payment(Workshop $workshop)
    {
        if ($workshop->users->contains(Auth::user())) {
            return redirect()->back()->with('failed', 'You have already registered for this workshop.');
        }

        $taxes = $workshop->price * 0.06;
        $total = $workshop->price + $taxes;

        return view('pages.workshops-payment', compact('workshop', 'taxes', 'total'));
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
        if (!Gate::allows('current-user', $workshop->instructor_id)) {
            return back()->with('failed', 'Unauthorized action.');
        }

        if ($request->input('complete_workshop')) {
            if (!$request->input('complete_workshop')) {
                return back()->with('failed', 'Workshop can be completed after the planned date.');
            }

            $workshop->update([
                'status' => 'Completed',
            ]);

            return redirect()
                ->back()
                ->with('success', 'Workshop completed successfully.');
        }


        return redirect()
            ->back()
            ->with('success', 'Workshop updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workshop $workshop)
    {
        //
    }
}
