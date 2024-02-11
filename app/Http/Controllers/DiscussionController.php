<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Discussion;
use App\Models\DiscussionUpVote;
use App\Models\DiscussionDownVote;

class DiscussionController extends Controller
{
    public function get_discussion($id)
    {
        $discussion = Discussion::findOrFail($id);

        return view('discussion.index', ['discussion' => $discussion]);
    }

    public function get_all_discussions()
    {
        $discussions = Discussion::all();

        return view('home.index', ['discussions' => $discussions ?? []]);
    }

    public function up_vote($discussion_id, Request $request)
    {
        $discussion = Discussion::findOrFail($discussion_id);

        $up_vote = new DiscussionUpVote;
        $up_vote->user_id = $request->user()->id;
        $discussion->up_votes()->save($up_vote);

        return abort(200);
    }

    public function delete_up_vote($discussion_id, Request $request)
    {
        $discussion = Discussion::findOrFail($discussion_id);

        $discussion->up_votes()->where('user_id', $request->user()->id)
            ->delete();

        return abort(200);
    }

    public function down_vote($discussion_id, Request $request)
    {
        $discussion = Discussion::findOrFail($discussion_id);

        $down_vote = new DiscussionDownVote;
        $down_vote->user_id = $request->user()->id;
        $discussion->down_votes()->save($down_vote);

        return abort(200);
    }

    public function delete_down_vote($discussion_id, Request $request)
    {
        $discussion = Discussion::findOrFail($discussion_id);
        $discussion->down_votes()->where('user_id', $request->user()->id)
            ->delete();

        return abort(200);
    }

    public function add_discussion(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:discussions|max:255',
            'description' => 'required',
        ]);

        $discussion = new Discussion;
        $discussion->title = $request->title;
        $discussion->description = $request->description;
        // $discussion->topics = explode(',', $request->topics);
        $discussion->topics = ['test'];
        $request->user()->discussions()->save($discussion);

        return redirect()->route('discussion', ['id' => $discussion->id]);
    }
}
