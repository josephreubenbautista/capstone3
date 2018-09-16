<?php

namespace App\Http\Controllers;

use App\League;
use App\Team;
use Illuminate\Http\Request;
use Session;

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
        $count = count($leagues);
        // $teams = count(Team::where('league_id','=', 1)->get());
        // $countteams = [];
        // $leagues as $id => $name
        $leagueswith = [];
        for($x=0; $x<$count;$x++) {
            $leaguess = League::find($x+1);
            $teams = Team::where('league_id', $x+1)->get();
            $leaguess->count = count($teams);
            $leagueswith[] = $leaguess;
        }

        // dd($leagueswith);
        return view('admin.leagues.show_leagues', compact('leagueswith'));

    
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
    public function show(League $league)
    {
        //
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
    public function destroy(League $league)
    {
        //
    }
}
