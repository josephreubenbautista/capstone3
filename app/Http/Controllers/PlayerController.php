<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;
use Session;
class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $player = new Player;
        $player->jersey_number = $request->jersey_number;
        $player->user_id = $request->user_id;
        $player->team_id = $request->team_id;
        $player->league_id = $request->league_id;
        $player->ppg = NULL;
        $player->rpg = NULL;
        $player->apg = NULL;
        $player->bpg = NULL;
        $player->spg = NULL;
        $player->save();
        Session::flash('success_message', "Player Added successfully");
        return redirect("/leagues/$request->league_id/players");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $player = Player::find($id);
        $player->delete();
        Session::flash('success_message', "Player Deleted successfully");
        return redirect("/leagues/$request->leagueid/players/$request->teamid");
    }
}
