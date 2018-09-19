<?php

namespace App\Http\Controllers;

use App\League;
use App\User;
use App\Team;
use App\Game;
use App\Player;
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

    public function teamplayers($leagueid, $teamid)
    {
        $league = League::find($leagueid);
        $team = Team::find($teamid);

        $teams = $league->teams;

        $team_id = $teamid;

        $players = $team->players;

        $users = User::all();

        return view('players.show_teamplayers', compact('league', 'players', 'users', 'teams', 'team_id'));
       
    }

    public function games($id)
    {
        $league = League::find($id);
    
        $games = $league->games;

        return view('games.show_games', compact('league', 'games'));
    }


    public function gamedetails($leagueid, $gameid)
    {
        $league = League::find($leagueid);
        $game = Game::find($gameid);

        $statistics = $game->statistics;

        $hometeam = $game->hometeam;
        // $homeplayers = $hometeam->players;

        $awayteam = $game->awayteam;
        // $awayplayers = $awayteam->players;
        return view('games.show_gamedetails', compact('league', 'game', 'hometeam', 'awayteam', 'statistics'));
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
