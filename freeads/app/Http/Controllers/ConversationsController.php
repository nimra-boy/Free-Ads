<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ConversationsController extends Controller
{
    private $r;

    public function __construct()
    {

    }

    public function index()
    {
        $users = User::select('name', 'id')->where('id', '!=', Auth::user()->id)->get();
        $unread = $this->unreadCount(Auth::user()->id);
        return view('conversations/index', compact('users', 'unread'));
    }

    public function show(User $user)
    {
        $userA = Auth::user()->id;
        $userB = $user->id;
        $users = User::select('name', 'id')->where('id', '!=', Auth::user()->id)->get();
        $unread = $this->unreadCount(Auth::user()->id);
        $messages = Message::whereRaw("((from_id = $userA AND to_id = $userB) OR (from_id = $userB AND to_id = $userA))")->orderBy('created_at', 'desc')->get()->reverse();
        if (isset($unread[$user->id]))
        {
            $this->readAllFrom($userB, $userA);
            unset($unread[$user->id]);
        }
        
        return view('conversations/show', compact('users', 'user', 'messages', 'unread'));
    }

    public function store(User $user, Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $post = Message::create([
            'from_id' => Auth::user()->id,
            'to_id' => $user->id,
            'content' => request('content'),
        ]);

        return redirect()->route('conversations.show', $user->id);
    }

    public function unreadCount($id)
    {
        $nb = Message::where('to_id', $id)
            ->groupBy('from_id')
            ->selectRaw('from_id, COUNT(id) as count')
            ->whereRaw('read_at IS NULL')
            ->get()
            ->pluck('count', 'from_id');
        return $nb;
    }

    public function readAllFrom($id, $toId)
    {
        Message::where('from_id', $id)->where('to_id', $toId)->update([ 'read_at' => Carbon::now()]);
    }
}
