<?php

namespace App\Http\Controllers;

use App\Models\Key;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeyController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $default = filter_input(INPUT_GET, 'employee', FILTER_VALIDATE_INT, array("options" => array("default" => 0)));
        if(!Auth::user()->admin)  return redirect(url("/user/".$default))->with("error", "Nemáš právo to udělat");

        $users = array();
        foreach (User::all() as $user) {
            $users[$user->id] = $user->surname . " " . $user->name;
        }
        $rooms = array();
        foreach (Room::all() as $room) {
            $rooms[$room->id] = $room->name . " (" . $room->no . ")";
        }
        return view("keys.create")->with("users", $users)->with("rooms", $rooms)->with("default", $default);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->admin)  return redirect(url("/user"))->with("error", "Nemáš právo to udělat");
        $this->validate($request, [
            "room" => "required|numeric",
            "user" => "required|numeric",
        ]);

        $key = new Key;
        $key->employee = $request->input("user");
        $key->room = $request->input("room");
        $key->save();

        return redirect(url("/user/".$key->employee))->with("success", "Klíč vytvořen");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->admin)  return redirect(url("/user"))->with("error", "Nemáš právo to udělat");
        $key = Key::find($id);
        $userId = $key->userRel->id;
        $key->delete();
        return redirect(url("/user/".$userId))->with("success", "Klíč smazán");
    }
}
