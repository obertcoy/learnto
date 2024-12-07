<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(User $user, Request $request)
    {

        $tabs = ['Joined Workshops', 'Created Workshops'];

        $activeTab = $request->query('tab', 'Joined Workshops');

        $data = match ($activeTab) {
            'Joined Workshops' => $this->getJoinedWorkshops($user),
            'Created Workshops' => $this->getCreatedWorkshops($user),
            default => []
        };

        $totalSumOfRatings = Workshop::with('ratings')
            ->get()
            ->sum(function ($workshop) {
                return $workshop->ratings->sum('rate');
            });

        $totalStudents = Workshop::with('users')
            ->get()
            ->sum(function ($workshop) {
                return $workshop->users->count();
            });

        $averageRating = $totalStudents > 0 ? $totalSumOfRatings / $totalStudents : 0;

        $createdWorkshops = $user->createdWorkshopsCount();

        return view('pages.users-show', compact('user', 'tabs', 'activeTab', 'data', 'averageRating', 'totalStudents', 'createdWorkshops'));
    }

    private function getJoinedWorkshops(User $user)
    {
        $workshops = $user->workshops()
            ->orderBy('date', 'desc')
            ->get();

        return $workshops;
    }

    private function getCreatedWorkshops(User $user)
    {
        $workshops = $user->instructor()
            ->orderBy('date', 'desc')
            ->get();

        return $workshops;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if (!Gate::allows('current-user', $user)) {
            abort(403, 'Unauthorized action.');
            return redirect()->back()->with('failed', 'Unauthorized action.');
        }

        if ($request->input('become_instructor')) {
            if (strlen($user->biography) < 50) {
                return back()->with('failed', 'Your bio must be at least 50 characters long to become an instructor.');
            }

            $user->update([
                'is_instructor' => true,
            ]);
            
            return redirect()
            ->back()
            ->with('success', 'Congratulations! You are now an instructor.');
        }
        
        if ($request->input('biography')) {

            $user->biography = $request->input('biography');
            $user->save();
        }

        return redirect()
            ->back()
            ->with('success', 'Bio updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
