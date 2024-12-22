<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Kreait\Laravel\Firebase\Facades\Firebase;

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
            ->where('instructor_id', $user->id)
            ->get()
            ->sum(function ($workshop) {
                return $workshop->ratings->sum('rating');
            });

        $totalStudents = Workshop::with('users')
            ->where('instructor_id', $user->id)
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

        if ($request->hasFile('profile-picture') && $request->file('profile-picture')->isValid()) {

            $file = $request->file('profile-picture');

            $fileName = $file->getClientOriginalName();
            $path = 'learnto/users/' . $user->id . '/'. $fileName;

            $storage = Firebase::storage();
            $bucket = $storage->getBucket();
            $bucket->upload(
                fopen($file->getRealPath(), 'r'),
                [
                    'name' => $path,
                ]
            );
            $fileUrl = $storage->getBucket()->object($path)->signedUrl(new \DateTime('tomorrow'));

            $user->profile_picture_url = $fileUrl;
            $user->save();

        }

        if ($request->input('biography')) {

            $user->biography = $request->input('biography');
            $user->save();
        }

        return redirect()
            ->back()
            ->with('success', 'User information updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function joinWorkshop(Workshop $workshop)
    {

        if ($workshop->users->contains(Auth::user()->id)) {
            return redirect()->back()->with('failed', 'You are already registered for this workshop!');
        }

        if ($workshop->status == 'Completed') {
            return redirect()->back()->with('failed', 'This workshop is already completed!');
        }

        $workshop->users()->attach(Auth::user()->id);

        return redirect()->route('workshops.show', $workshop)->with('success', 'You have successfully joined the workshop!');
    }
}
