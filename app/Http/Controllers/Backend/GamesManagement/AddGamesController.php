<?php

namespace App\Http\Controllers\Backend\GamesManagement;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;
use ZipArchive;
use App\AddGame;
use App\User;
use Session;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Image;
use ElephantIO\Client,
    ElephantIO\Engine\SocketIO\Version1X,
    ElephantIO\Exception\ServerConnectionFailureException;

class AddGamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $games = AddGame::orderBy('order', 'desc')->paginate(1000);
        return view('backend.games-management.add-games.index', compact('games'));

    }
    function GameOrder(Request $r,$id){
        try {
            $new =$r->new_order;
            $old= $r->old_order;
            $edit_data = AddGame::where('order',$old)->first();
            if ($new == $old) {
                return redirect()->back();
            }
            if ($new < $old) {
                $data=AddGame::whereBetween('order',[$new,$old])->get();
                foreach ($data as $key => $value) {
                    $d=AddGame::find($value->id);
                    $d->order = $value->order+1;
                    $d->save();
                }
                /* dd($data);
                $i=0;
                for ($i = $new; $i < $old-1 ; $i++) {
                    $destination= $i+1;
                    $edit_data1 = AddGame::where('order',$i)->first();
                    echo 'new'.$edit_data1.'/des/';
                    $data=AddGame::find($edit_data1->id);
                    $data->order = $destination;
                    $data->save();
                }  */
            }

            if($new > $old){

                $data=AddGame::whereBetween('order',[$old,$new])->get();
                foreach ($data as $key => $value) {
                    $d=AddGame::find($value->id);
                    $d->order = $value->order-1;
                    $d->save();
                    /*   $i=0;
                      for ($i=$new; $i > $old ; $i--) {
                          $destination= $i-1;
                          $edit_data1 = AddGame::where('order',$i)->first();
                          $data=AddGame::where('id',$edit_data1->id)->update(['order'=> $destination]);
                      } */
                }
            }
            $data=AddGame::where('id',$edit_data->id)->update(['order'=> $new]);
            Toastr::success('Game order updated successfully');
            return redirect()->back();

        } catch (\Exception $e) {
            Toastr::error('Something went wrong ! please try again');
            return redirect()->back();
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.games-management.add-games.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        // set_time_limit(900);
        $request->validate([
            'game_title' => 'required|unique:add_games',
            'game_description' => 'required',
            'game_type' => 'required',
            'base_image' => 'required|mimes:jpeg,jpg,png',
            'game_file' => 'required|mimes:zip',
        ]);
        try {
            $file_name='';
            $requestData = $request->all();

            //Game Upload start
            $game_file = $request->game_file;
            if($game_file){
                $url = $request->game_title;
                $string = preg_replace("/[^a-z.\d ]/i", "", $url);
                $metaUrl = str_replace(' ', '-', strtolower($string));
                $game_url = str_replace('--', '-', strtolower($metaUrl));
                $file_name = $game_url.'-'.time().'.zip';
                $game_file->move('games/'.$game_url, $file_name);

                $zipArchive = new ZipArchive();
                $result = $zipArchive->open('games/'.$game_url. '/'. $file_name);
                if ($result === TRUE) {
                    $zipArchive ->extractTo('games/'.$game_url);
                    $zipArchive ->close();

                    $path = 'games/'.$game_url . '/Build/';

                    if(File::exists($path))
                    {
                        $files_in_folder = File::files($path);

                        foreach($files_in_folder as $item)
                        {
                            $file = pathinfo($item);
                            $dir = $file['dirname'];
                            try{
                                if($file['extension'] == 'json')
                                {
                                    $json_file = $file['filename'];
                                }
                            }
                            catch(\Exception $e){

                            }
                        }
                    }

                } else {
                    return redirect()->back();
                }

                $requestData['game_file']=$game_url;
                $requestData['json']=$json_file;
            }else {
                $url = $request->game_title;
                $string = preg_replace("/[^a-z.\d ]/i", "", $url);
                $metaUrl = str_replace(' ', '-', strtolower($string));
                $game_url = str_replace('--', '-', strtolower($metaUrl));
                $requestData['game_file']=$game_url;
            }
            //Game Upload end

            //Image Upload start
            $image=$request->base_image;
            if($image){
                // $imageName=time().'.'.$image->getClientOriginalName();
                // $image->move('games-banner', $imageName);
                // $requestData['base_image']=  $imageName;
                // using image intervention
                $image       = $request->file('base_image');
                $filename    = time().'.'.$image->getClientOriginalName();

                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(256, 180);
                $image_resize->save(base_path('games-banner/'.$filename));
                $requestData['base_image']=  $filename;
            }
            //Image Upload end
            $last = AddGame::max('order');
            $requestData['order']=isset($last) ? $last + 1: 1;
            $requestData['pay_data']='500,100,45/250,80,40/200,70,35/100,60,30/80,50,25/60,45,20/50,40,15/40,30,10/30,25,10/150,100,50/18,12,7/64,10,5';
            $requestData['prob_data']='7,7,8,9,10,10,13,13,16,3,2,2';
            AddGame::create($requestData);

            $directory='games/'.$game_url.'/'.$file_name;
            if(File::exists($directory))
            {
                File::delete($directory);
            }
            $request->session()->flash('alert-success', 'Successfully Added!');
            return redirect()->route('add-games.index');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong ! please try again'.$e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {

        $addgame = AddGame::findOrFail($id);

        $directory = 'games/'.$addgame->game_file . '/TemplateData/';

        if(File::exists($directory))
        {
            $files_in_folder = File::files($directory);
        }else {
            $files_in_folder = [];
        }


        return view('backend.games-management.add-games.show', compact('addgame', 'files_in_folder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $addgame = AddGame::findOrFail($id);
        return view('backend.games-management.add-games.edit', compact('addgame'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'game_title' => 'required',
//            'game_description' => 'required',
//            'base_image' => 'mimes:jpeg,jpg,png',
//            'game_file' => 'mimes:zip',
        ]);

        $gmae = AddGame::findOrFail($id);

        if ($request->game_file)
        {
            //Game delete start
            $directory = 'games/'.$gmae->game_file;
            File::deleteDirectory($directory);
            //Game delete end
        }

        if ($request->base_image)
        {
            // Image Delete start
            $image_path = base_path('games-banner/'.$gmae->base_image);
            if(File::exists($image_path)) {
                File::delete($image_path);
               // unlink($image_path);
            }
            // Image Delete end
        }

        $requestData = $request->all();
        //Game Upload start

        @$game_file = $request->game_file;
        if(@$game_file){
            $url = $request->game_title;
            $string = preg_replace("/[^a-z.\d ]/i", "", $url);
            $metaUrl = str_replace(' ', '-', strtolower($string));
            $game_url = str_replace('--', '-', strtolower($metaUrl));
            $file_name = $game_url.'-'.time().'.zip';
            $game_file->move('games/'.$game_url, $file_name);

            $zipArchive = new ZipArchive();
            $result = $zipArchive->open('games/'.$game_url. '/'. $file_name);
            if ($result === TRUE) {
                $zipArchive ->extractTo('games/'.$game_url);
                $zipArchive ->close();
                $path = 'games/'.$game_url . '/Build/';

                if(File::exists($path))
                {
                    $files_in_folder = File::files($path);

                    foreach($files_in_folder as $item)
                    {
                        $file = pathinfo($item);
                        $dir = $file['dirname'];
                        try{
                            if($file['extension'] == 'json')
                            {
                                $json_file = $file['filename'];
                            }
                        }
                        catch(\Exception $e){

                        }
                    }
                }

            } else {
                return redirect()->back();
            }

            $requestData['game_file']=$game_url;
            $requestData['json']=$json_file;
        }else {
            $url = $request->game_title;
            $string = preg_replace("/[^a-z.\d ]/i", "", $url);
            $metaUrl = str_replace(' ', '-', strtolower($string));
            $game_url = str_replace('--', '-', strtolower($metaUrl));
            $requestData['game_file']=$game_url;
        }
        //Game Upload end

        //Image Upload start
        $image=$request->base_image;
        if($image){
            // $imageName=time().'.'.$image->getClientOriginalName();
            // $image->move('games-banner', $imageName);
            // $requestData['base_image'] =  $imageName;
            // using image intervention
            $image       = $request->file('base_image');
            $filename    = time().'.'.$image->getClientOriginalName();

            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(256, 180);
            $image_resize->save(base_path('games-banner/'.$filename));
            $requestData['base_image']=  $filename;
        }
        //Image Upload end


        // Update all new value
        $requestData['pay_data']=!empty($request->pay_data)?$request->pay_data:'500,100,45/250,80,40/200,70,35/100,60,30/80,50,25/60,45,20/50,40,15/40,30,10/30,25,10/150,100,50/18,12,7/64,10,5';
        $requestData['prob_data']=!empty($request->prob_data)?$request->prob_data:'7,7,8,9,10,10,13,13,16,3,2,2';

        $gmae->update($requestData);
        if (@$game_file) {

            $dir='games/'.$game_url.'/'.$file_name;
            if(File::exists($dir))
            {
                File::delete($dir);
            }
        }
        $request->session()->flash('alert-success', 'Successfully update!');
        return redirect()->route('add-games.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, $id)
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $gmae = AddGame::findOrFail($id);
        if (!is_null($gmae)) {
            $directory = 'games/'.$gmae->game_file;
            File::deleteDirectory($directory);
            // Image Delete start
            $image_path = 'games-banner/'.$gmae->base_image;
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            // Image Delete end

            $gmae->delete();

            $lastCheck = AddGame::get()->count();
            if ($lastCheck >=1 ) {
                $last = AddGame::orderBy('order', 'desc')->first();
                $data=AddGame::whereBetween('order',[$gmae->order,$last->order])->get();
                foreach ($data as $key => $value) {
                    $d=AddGame::find($value->id);
                    $d->order = $value->order-1;
                    $d->save();
                }
            }

            $request->session()->flash('alert-success', 'Successfully Deleted!');
            return redirect()->route('add-games.index');
        }
        //Game delete start

    }

    public function single_game(Request $request, $id)
    {
        $game = AddGame::where('game_file', $id)->first();
        if ($game)
        {
            return view('backend.games-management.slots.index', compact('game'));
        }else {
            $games = AddGame::all();
            return view('backend.games-management.add-games.index', compact('games'));
        }
    }

    public function game_icon_edit(Request $request, $id, $ex, $game)
    {
        $addgame = AddGame::where('game_file', $game)->first();

        return view('backend.games-management.add-games.update', compact('id', 'ex', 'game', 'addgame'));
    }
    public function game_icon_update(Request $request)
    {
        $request->validate([
            'file' => 'mimes:'.$request->ext,
        ]);

        // Image Delete start game_name
        $image_path = 'games/'.$request->game_name. '/TemplateData/' .$request->file;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        // Image Delete end

        //Image Upload start
        $image=$request->file;
        if($image){
            $imageName=$image->getClientOriginalName();
            $image->move('games/'.$request->game_name. '/TemplateData', $request->file_name);
        }
        //Image Upload end
        $request->session()->flash('alert-success', 'Successfully Updated!');
        return redirect()->route('add-games.index');
    }

    public function play_game(Request $request, $id)
    {
        try {
            if (Auth::check()) {
                $userWallet = \App\ProsixUserWallet::where('user_id' , Auth::user()->id)->first();
                $transferbonusreward = DB::table('mission_winnings_to_transfer')
                    ->where('user_id',Auth::user()->id)
                    ->where('status','0')
                    ->get();
                if ($transferbonusreward)
                {
                    foreach ($transferbonusreward as $reward)
                    {
                        $userWallet->usd += $reward->usd;
                        $userWallet->token += $reward->token;
                        $userWallet->free_spin += $reward->free_spin;
                        $userWallet->save();
                        $updatestatus = DB::table('mission_winnings_to_transfer')
                            ->where('id', $reward->id)
                            ->update(['status' => 1]);
                    }

                }
                $addgame = AddGame::where('game_title', str_replace('-', ' ',$id))->first();
                $banGameCheck = \App\UserBannedGame::where('game_id' , $addgame->id )->where('user_id' ,Auth::user()->id )->where('status','PlayerBanned' )->first();
                if($banGameCheck){
                    Toastr::error('You are banned to play this game');
                    return redirect()->back();
                }

                if ($addgame)
                {

                    $user = User::findOrFail(Auth::user()->id);
                    $user->game_status = 1;
                    $user->save();
                    Session::put('PlayModeState','PlayForMoney');
                    Session::put('game_id',$addgame->id);
                    Session::put('gametimestamp',time());
                    //Redis
                    Redis::set('PlayModeState','PlayForMoney');
                    Redis::set('game_id',$addgame->id);
                    Redis::set('gametimestamp',time());
                    $message = "propersix";
                    generatePush('playGame','receiver.'.Auth::user()->id,$message);
                    return view('frontend.games.play_game', compact('addgame'));
                    // return view('backend.games-management.add-games.play-game', compact('addgame'));
                }else {
                    return redirect('/');
                }
            }else {
                return redirect()->route('user.login');
            }



        }catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }

    }
    function test(Request $request){
        $url = $request->header('Referer');
        $baseurl=basename(dirname($url));
        if ($baseurl=='play')
        {
            $playmode="PlayForMoney";
        }
        else
        {
            $playmode="PlayForFun";
        }
        try {
            if (Auth::check()) {
                $user = DB::table('users')
                    /*->join('accounts', 'users.id', '=', 'accounts.user_id')*/
                    ->join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
                    ->select('users.id as user_id', 'users.user_name as username', 'user_profiles.base_image as profile_pic')
                    ->where('users.id', Auth::user()->id)
                    ->first();
                    if ($user)
                    {
                        if (Redis::get('PlayModeState')=='PlayForMoney')
                        {
                            $username=substr($user->username,0,12);
                        }
                        else{
                            $username=substr($user->username,0,8).'_demo';
                        }
                        $msg = [
                            'PlayModeState' => $playmode,
                            'username' =>$username,
                            'profile_pic' => ($user->profile_pic) ? $user->profile_pic : 'user/profile/avatar_new.png',
                        ];
                    }
            }
            else
            {
                $msg = [
                    'PlayModeState' => $playmode,
                    'username' => 'Guest_user',
                    'profile_pic' => 'user/profile/avatar_new.png',
                ];
            }
            if ($playmode!="") {
                return response()->json($msg, 200,[],JSON_UNESCAPED_SLASHES);
            }
            else {
                $msg =[
                    'PlayModeState' => 'no mode'
                ];
                return response()->json($msg, 200);
            }
        } catch (\Exception $e) {
            return response()->json(['error'=>'Please try again'],400);
        }
    }
    public function demo_play_game(Request $request, $id)
    {
        try {
            $addgame = AddGame::where('game_title', str_replace('-', ' ',$id))->first();
            if ($addgame)
            {
//                    Session::put('PlayModeState','PlayForFun');
                Redis::set('PlayModeState','PlayForFun');
                // \Elephant::emit('eventMsg', array('foo' => 'bar'));
                return view('frontend.games.play_game', compact('addgame'));
                // return view('backend.games-management.add-games.play-game', compact('addgame'));
            }else {
                return redirect('/');
            }
        }catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }

    public function socketConnect(){

    }
}
