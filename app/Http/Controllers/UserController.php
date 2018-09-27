<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;

use App\Player;
class UserController extends Controller
{
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->contact_number = $request->contact_number;
        $user->description = $request->description;

        if($request->hasFile('image')) {
            // $filename = $request->image->getClientOriginalName();
            // $request->image->storeAs('public/images/users/', $filename);
            // $artist->image = 'images/users/'.$filename; 

            $extension = $request->image->getClientOriginalExtension();
            $request->image->move('storage/images/users', "$id.$extension");
            $user->image = "/storage/images/users/$id.$extension";
        }
        $user->save();

         
        Session::flash('success_message', "User Edited successfully");

        // $artists = Artist::all();
    
        return redirect("/users");
    }

    public function show(Request $request)
    {
        $users_email = User::where('email', $request->email)->get();
        $users_username = User::where('username', $request->username)->get();
        $result_email = 'true';
        $result_username = 'true';
        if(count($users_email)==0){
            $result_email='false';
        }
        if(count($users_username)==0){
            $result_username='false';
        }
        // $users = User::all();
        // echo $result;
        return compact('result_email', 'result_username');
        
    }

    public function showleagues($id){
        $players = Player::where('user_id', $id)->get();
        // dd($players);

         return view('users.show_myleagues', compact('players'));
    }


}
