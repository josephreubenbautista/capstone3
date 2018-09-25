<?php

namespace App\Http\Controllers;

use App\Game;
use App\Statistic;
use App\Team;
Use App\League;
use Session;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

     public function viewteams(Request $request)
    {
        $league = League::find($request->leagueid);
        $teamed = $league->teams;
        // $teamed = Team::where('league_id', $request->leagueid)->get();
        return compact('teamed');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request);
        $game = new Game;
        $game->date = $request->date;
        $game->time = $request->time;
        $game->venue = $request->venue;
        $game->league_id = $request->league_id;
        $game->home_team_id = $request->home_team_id;
        $game->away_team_id = $request->away_team_id;
        $game->home_team_score = 0;
        $game->away_team_score = 0;
        $game->save();

        $games = Game::find($game->id);
        foreach($games->hometeam->players as $player){
            $statistic = new Statistic;
            $statistic->game_id = $games->id;
            $statistic->player_id = $player->id;
            $statistic->league_id = $games->league_id;
            $statistic->points = 0;
            $statistic->assists = 0;
            $statistic->steals = 0;
            $statistic->blocks = 0;
            $statistic->rebounds = 0;
            $statistic->save();

        }

        foreach($games->awayteam->players as $player){
            $statistic = new Statistic;
            $statistic->game_id = $games->id;
            $statistic->player_id = $player->id;
            $statistic->league_id = $games->league_id;
            $statistic->points = 0;
            $statistic->assists = 0;
            $statistic->steals = 0;
            $statistic->blocks = 0;
            $statistic->rebounds = 0;
            $statistic->save();

        }
        
        
        Session::flash('success_message', "Game Added successfully");

        return redirect("/leagues/$request->league_id/games");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //
    }
}
