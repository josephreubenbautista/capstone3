<?php

namespace App\Http\Controllers;

use App\League;
use App\User;
use App\Team;
use App\Game;
use App\Player;
use App\Statistic;
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

        // $statisticshome = $game->statistics->where($game->statistics->player->hometeam);

        $hometeam = $game->hometeam;
        // $homeplayers = $hometeam->players;

        $awayteam = $game->awayteam;
        // $awayplayers = $awayteam->players;
        return view('games.show_gamedetails', compact('league', 'game', 'hometeam', 'awayteam', 'statistics'));
    }

    public function gamedetailsedit($leagueid, $gameid)
    {
        $league = League::find($leagueid);
        $game = Game::find($gameid);

        $statistics = $game->statistics;

        // $statisticshome = $game->statistics->where($game->statistics->player->hometeam);

        $hometeam = $game->hometeam;
        // $homeplayers = $hometeam->players;

        $awayteam = $game->awayteam;
        // $awayplayers = $awayteam->players;
        return view('games.update_gamedetails', compact('league', 'game', 'hometeam', 'awayteam', 'statistics'));
    }


    public function gamedetailsupdate(Request $request, $leagueid, $gameid, $statid)
    {
        $league = League::find($leagueid);
        $game = Game::find($gameid);
        $statistic = Statistic::find($statid);

        if($request->has('points')){
            $statistic->points = $request->points;
        }
        if($request->has('rebounds')){
            $statistic->rebounds = $request->rebounds;
        }
        if($request->has('assists')){
            $statistic->assists = $request->assists;
        }
        if($request->has('steals')){
            $statistic->steals = $request->steals;
        }
        if($request->has('blocks')){
            $statistic->blocks = $request->blocks;
        }

        $statistic->save();

        $statistics = $game->statistics;

        // $statisticshome = $game->statistics->where($game->statistics->player->hometeam);

        $hometeam = $game->hometeam;
        // $homeplayers = $hometeam->players;

        $awayteam = $game->awayteam;
        // $awayplayers = $awayteam->players;
        $homescore = 0;
        $awayscore = 0;

        foreach ($statistics as $stat) {
            if($stat->player->team->id==$hometeam->id){
                $homescore+=$stat->points;
            }
            if($stat->player->team->id==$awayteam->id){
                $awayscore+=$stat->points;
            }

        }

        $game->home_team_score = $homescore;
        $game->away_team_score = $awayscore;

        $game->save();

       

        return compact('league', 'game', 'hometeam', 'awayteam', 'statistics', 'homescore', 'awayscore');
    }


    public function standings(Request $request, $leagueid, $gameid){
        $league = League::find($leagueid);
        $game = Game::find($gameid);

        $homescore = $request->homescore;
        $awayscore = $request->awayscore;

        $homestand = Team::find($game->hometeam->id);
        $homewin = $homestand->win;
        $homelose = $homestand->lose;

        $awaystand = Team::find($game->awayteam->id);
        $awaywin = $awaystand->win;
        $awaylose = $awaystand->lose;

        if($homescore>$awayscore){
            $homewin +=1;
            $awaylose +=1;
        }else if($homescore<$awayscore){
            $awaywin +=1;
            $homelose +=1;
        }else{

        }

        $homestand->win = $homewin;
        $homestand->lose = $homelose;
        $homestand->save();

        $awaystand->win = $awaywin;
        $awaystand->lose = $awaylose;
        $awaystand->save();

        $statistics = $game->statistics;

        // $statisticshome = $game->statistics->where($game->statistics->player->hometeam);

        $hometeam = $game->hometeam;
        // $homeplayers = $hometeam->players;

        $awayteam = $game->awayteam;
        // $awayplayers = $awayteam->players;

        $games = Game::all();

        // $statistics = Statistic::all();
        // foreach ($statistics as $statistic) {
        //     $player = Player::find($statistic)
        // }

        $players = Player::all();
        foreach ($players as $player) {
            $stats = $player->statistics;
            $ppg = $player->statistics->avg('points');
            $rpg = $player->statistics->avg('rebounds');
            $apg = $player->statistics->avg('assists');
            $bpg = $player->statistics->avg('blocks');
            $spg = $player->statistics->avg('steals');

            $player->ppg = $ppg;
            $player->rpg = $rpg;
            $player->apg = $apg;
            $player->bpg = $bpg;
            $player->spg = $spg;
            $player->save();
            // foreach ($statistics as $statistic->ha) {
            //     $statistic
            // }

        }
       
       return redirect("/leagues/$leagueid/games");

     
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
