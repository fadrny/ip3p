<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function  __construct()
    {
        $this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::all();
        return view("rooms.index")->with("rooms", $rooms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->admin)
            return redirect(url("/room"));
        return view("rooms.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->admin)
            return redirect(url("/room"));
        $this->validate($request, [
            "name" => "required",
            "no" => "numeric|required",
            "phone" => "nullable|numeric"
        ]);

        $room = new Room;
        $room->name = $request->input("name");
        $room->no = $request->input("no");
        $room->phone = $request->input("phone");
        $room->save();

        return redirect(url("/room"))->with("success", "vytvořeno");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::find($id);
        if(is_null($room))
            return redirect(url("/room"));
        $average = $room->userRel->average("wage");
        return view("rooms.show")->with("room", $room)->with("title", "Místnost " . $room->no)->with("average", $average);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::user()->admin)
            return redirect(url("/room/".$id))->with("error", "práva");
        $room = Room::findOrFail($id);
        if(is_null($room))
            return redirect(url("/room"));
        return view("rooms.edit")->with("room", $room);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!Auth::user()->admin)
            return redirect(url("/room/".$id))->with("error", "práva");
        $this->validate($request, [
            "name" => "required",
            "number" => "numeric|required",
            "phone" => "nullable|numeric"
        ]);

        $room = Room::find($id);
        $room->name = $request->input("name");
        $room->no = $request->input("number");
        $room->phone = $request->input("phone");
        $room->save();

        return redirect(url("/room/".$id))->with("success", "Místnost zaktualizována");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->admin)  return redirect(url("/room/".$id))->with("error", "Nemáš právo to udělat");
        $room = Room::find($id);
        if(count($room->userRel) > 0) return redirect(url("/room/".$id))->with("error", "V místnosti jsou nějací lidé");
        if(count($room->keyRel) > 0) return redirect(url("/room/".$id))->with("error", "K místnosti má někd klíče");
        $room->delete();
        return redirect(url("/room"))->with("success", "Místnost smazána");
    }
}
