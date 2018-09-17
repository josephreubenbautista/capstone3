<?php

namespace App\Http\Controllers;

use App\League;
use App\Team;
use Illuminate\Http\Request;
// use Session;
use App\Player;

class LeagueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leagues = League::all();
      
        // $teams = count(Team::where('league_id','=', 1)->get());
        // $countteams = [];
        // $leagues as $id => $name
        $leagueswith = [];
        foreach($leagues as $league) {
            $league->count = count($league->teams);
            $leagueswith[] = $league;
        }

        // dd($leagueswith);
        return view('leagues.show_leagues', compact('leagueswith'));

    
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
        $league = new League;
        $league->name = $request->name;
        $league->save();
        return redirect('/leagues');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\League  $league
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $league = League::find($id);
        // $teams = Team::where('league_id', $id)->get();
        $teams = $league->teams;
        // dd($teams);
        // $count = count($teams);

        $teamswith = [];
        foreach($teams as $team) {

            
            $team->count = count($team->players);
            $teamswith[] = $team;
        }

        // dd($teamswith);
        // $leagueswith = [];
        // for($x=0; $x<$count;$x++) {
            // $leaguess = League::find($x+1);
            // $teams = Team::where('league_id', $x+1)->get();
            // $leaguess->count = count($teams);
            // $leagueswith[] = $leaguess;
        // }


        return view('leagues.league_details', compact('league', 'teamswith'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\League  $league
     * @return \Illuminate\Http\Response
     */
    public function edit(League $league)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\League  $league
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, League $league)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\League  $league
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $league = League::find($id);
        $league->delete();

        return redirect('/leagues');
    }
}
