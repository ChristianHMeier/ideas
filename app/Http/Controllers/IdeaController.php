<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function store() {

        $validated = request()->validate([
            'content' => 'required|min:5|max:240',
        ]);

        $validated['user_id'] = auth()->id();

        // $idea = Idea::create(['content' => request()->get('content', '')]);
        Idea::create($validated);
        //$idea->save();

        return redirect()->route('dashboard')->with('success', 'Idea created successfully.');
    }

    public function destroy(Idea $idea) {
        // Idea::where('id', $id)->firstOrFail()->delete();
        if(auth()->id() !== $idea->user_id) {
            abort(401);
        }
        $idea->delete();

        return redirect()->route('dashboard')->with('success', 'Idea deleted successfully.');
    }

    public function show(Idea $idea) {
        return view('ideas.show', compact('idea'));
    }

    public function edit(Idea $idea) {
        if(auth()->id() !== $idea->user_id) {
            abort(401);
        }
        $editing = true;

        return view('ideas.show', compact('idea', 'editing'));
    }

    public function update(Idea $idea) {
        if(auth()->id() !== $idea->user_id) {
            abort(401);
        }

        request()->validate([
            'content' => 'required|min:5|max:240',
        ]);

        $idea->content = request()->get('content', '');
        $idea->save();

        return redirect()->route('ideas.show', $idea->id)->with('success', 'Idea updated successfully.');
    }
}
