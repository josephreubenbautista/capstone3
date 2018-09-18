<?php

namespace App\Http\Controllers;

use App\League;
use App\User;
use Illuminate\Http\Request;



class LeagueController extends Controller
{
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

    public function store(Request $request)
    {
        $league = new League;
        $league->name = $request->name;
        $league->save();
        return redirect('/leagues');
    }

    public function teams($id)
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


        return view('teams.show_teams', compact('league', 'teamswith'));
    }

    public function players($id)
    {
        $league = League::find($id);
        $teams = $league->teams;

        $players = $league->players;

        $users = User::all();

        return view('players.show_players', compact('league', 'players', 'teams', 'users'));
       
    }

    public function games($id)
    {
    
    }

    public function update(Request $request, $id)
    {
        $league = League::find($id);
        $league->name = $request->name;
        $league->save();


        // $artists = Artist::all();
    
        return redirect('/leagues');
    }

    public function destroy(Request $request, $id)
    {
        $league = League::find($id);
        $league->delete();

        return redirect('/leagues');
    }
}
