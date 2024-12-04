<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Workshop;
use Illuminate\Http\Request;

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

        return view('pages.users-show', compact('user', 'tabs', 'activeTab', 'data'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
