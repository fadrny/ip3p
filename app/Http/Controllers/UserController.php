<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        $users = User::all();
        return view("users.index")->with("users", $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->admin)
            return redirect(url("/user"))->with("error", "no to ne?");
        return view("users.create")->with("rooms", Room::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->admin)  return redirect(url("/user"))->with("error", "nelze");
        $this->validate($request, [
            "name" => "required|string",
            "surname" => "required|string",
            "email" => "required|unique:users",
            "password" => "required",
            "job" => "required|string",
            "wage" => "numeric|required",
            "mistnost" => "numeric|required",
            "admin" => "boolean",
        ]);

        $user = new User;
        $this->setAll($user, $request);
        return redirect(url("/user"))->with("ok", "vytvořeno");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        if(is_null($user))
            return redirect(url("/user"))->with("error", "neexistuje");
        return view("users.show")->with("user", $user)->with("title", "Karta osoby: " . $user->surname . " " . $user->name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if(!Auth::user()->admin)
            return redirect(url("/user"));
        return view("users.edit")->with("rooms", Room::all())->with("user", $user);
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
        if(!Auth::user()->admin)  return redirect(url("/user"))->with("error", "Nemáš právo to udělat");
        $this->validate($request, [
            "name" => "required|string",
            "surname" => "required|string",
            "email" => "required",
            "password" => "required",
            "job" => "required|string",
            "wage" => "numeric|required",
            "mistnost" => "numeric|required",
            "admin" => "boolean",
        ]);

        $user = User::findOrFail($id);
        $this->setAll($user, $request);
        return redirect(url("/user/".$id))->with("ok", "upraveno");
    }

    private function setAll($user, $request){
        $user->name = $request->input("name");
        $user->surname = $request->input("surname");
        $user->email = $request->input("email");
        $user->password = Hash::make($request->input("password"));
        $user->job = $request->input("job");
        $user->wage = $request->input("wage");
        $user->room = $request->input("mistnost");
        $user->admin = $request->input("admin") ?? "0";
        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->admin)
            return redirect(url("/user/".$id));
        $user = User::findOrFail($id);
        if($user->id === Auth::user()->id)
            return redirect(url("/user/".$id))->with("error", "Sebevražda?");
        if(count($user->keyRel) > 0)
            return redirect(url("/user/".$id))->with("error", "někde ještě visí klíče");
        $user->delete();
        return redirect(url("/user"))->with("ok", "smazáno");
    }
}
