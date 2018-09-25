<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
class UserController extends Controller
{
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->contact_number = $request->contact_number;
        $user->description = $request->description;
     
        // $user->save();

        if($request->hasFile('image')) {
            // $filename = $request->image->getClientOriginalName();
            // $request->image->storeAs('public/images/users/', $filename);
            // $artist->image = 'images/users/'.$filename; 

            $extension = $request->image->getClientOriginalExtension();
           	$request->image->storeAs('public/images/users', "$id.$extension");
            $user->image = "/storage/images/users/$id.$extension";
        }
        $user->save();

         
        Session::flash('success_message', "User Edited successfully");

        // $artists = Artist::all();
    
        return redirect("/users");
    }

    public function show()
    {
        $users = User::all();
        

         
        
        return compact("users");
    }
}
