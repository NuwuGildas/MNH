<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        /* if(request()->ajax())
        { */
            return Datatables()->of(User::latest()->get())
            ->addColumn('action',function($data){
                $button = '<button id="'.$data->id.'" class="modal-open bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                            Transaction
                            </button>';
                if($data->confirm_account == 0){
                    $button .= '&nbsp;&nbsp;'; 
                    $button .= '<button id="'.$data->id.'" class="update bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                confirm
                                </button>';
                }
                return $button;
            })->rawColumns(['action'])->make(true);
        
        /* */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = DB::table('users')->get();
        $role = DB::table('roles')->get();
        $wallet = DB::table('wallets')->get(); 

        return response()->json(array('success' => true, 'user' => $user, 
                                                         'role' => $role, 
                                                         'wallet' => $wallet));
        return view('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        //dd($request);
        $vart = null;
        $user = USER::where('id',$request->hidden)->first();
        $temp = $user->current_amount;
        //dd($user);
        if(!empty($request->toggle)){
            //dd('credit : '.$request->credit_amount);
            $vart = $request->credit_amount;
            $total = $temp + $vart;
            //dd('total : '.$total);
            $verify = DB::update('update users set current_amount = ? where id = ?',[$total,$user->id]);
            $data=array('total_amount'=>$total,"operation"=>"credit in de votre compte","amount"=>$vart,"from_id"=>$user->id);    
            DB::table('wallets')->insert($data);   
        }else{
            //dd('debit : '.$request->debit_amount);
            $vart = $request->debit_amount;
            $total = $temp - $vart;
            $verify = DB::update('update users set current_amount = ? where id = ?',[$total,$user->id]);
            $data=array('total_amount'=>$total,"operation"=>"credit out de votre compte","amount"=>$vart,"from_id"=>$user->id);
            DB::table('wallets')->insert($data);
            //dd('total : '.$total);
        }
        exit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    { 
        $editid = $request->input('editid');
        
        $user = User::where('id', $editid)->first();
        
        $Boss = User::where('boss_code', $user->My_boss_code)->first();
        //
        $data = 1;
        $verify = DB::update('update users set confirm_account = ? where id = ?',[$data,$editid]);

        if($verify){
            $data=array('total_amount'=>$user->amount,"operation"=>"compte confirmer avec montant initial de ","amount"=>$user->amount,"from_id"=>$editid);
            DB::table('wallets')->insert($data);
        }
        if(!empty($Boss)){  
            $boss_amount = $Boss->current_amount + ($user->amount/2);
            //dd('$verify');
            $verify = DB::update('update users set current_amount = ? where id = ?',[$boss_amount,$Boss->id]);
            $verify = DB::update('update users set preboss = ? where id = ?',[$Boss->preboss + 1,$Boss->id]);
            if($verify){
                $data=array('total_amount'=>$boss_amount,"operation"=>"compte crediter nouveau  Preboss","amount"=>$Boss->amount,"from_id"=>$Boss->id);
                DB::table('wallets')->insert($data);
            }
            $BossBoss = User::where('boss_code', $Boss->My_boss_code)->first();
            if(!empty($BossBoss)){
                $Superboss_amount = $BossBoss->current_amount + ($user->amount/4);
                $verify = DB::update('update users set current_amount = ?  where id = ?',[$Superboss_amount,$BossBoss->id]);
                $verify = DB::update('update users set injector_boss = ? where id = ?',[$BossBoss->injector_boss + 1,$BossBoss->id]);
                if($verify){
                    $data=array('total_amount'=>$Superboss_amount,"operation"=>"compte crediter nouveau injector boss","amount"=>$BossBoss->amount,"from_id"=>$BossBoss->id);
                    DB::table('wallets')->insert($data);
                }
                $AdvancedBoss = User::where('boss_code', $BossBoss->My_boss_code)->first();
                
                if(!empty($AdvancedBoss)){
 
                    if($AdvancedBoss->amount > 100000){
                        $Superboss_Advancedamount = $AdvancedBoss->current_amount + ($user->amount/4);
                        $verify = DB::update('update users set current_amount = ? where id = ?',[$Superboss_Advancedamount,$AdvancedBoss->id]);
                        $verify = DB::update('update users set advanced_boss = ? where id = ?',[$AdvancedBoss->advanced_boss +1,$AdvancedBoss->id]);
                        if($verify){
                            $data=array('total_amount'=>$Superboss_Advancedamount,"operation"=>"compte crediter nouveau injector boss","amount"=>$AdvancedBoss->amount,"from_id"=>$AdvancedBoss->id);
                            DB::table('wallets')->insert($data);
                        }
                    }
                }
            } 

           
        } 
    
        exit; 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function elements($id)
    {
        
        $user = USER::where('My_boss_code',$id)->get();
       // $role = role::where('boss_code',$id)->get(); 

        return response()->json(array('success' => true, 'user' => $user));
    }
    public function elementsinject($id)
    {
        $injectors = null;
        $user = null;

        $injectors = USER::where('My_boss_code',$id)->first();
        if(!empty($injectors)){
            $user = USER::where('My_boss_code',$injectors->boss_code)->get(); 
        }
        
        return response()->json(array('success' => true, 'user' => $user));
    }
    public function elementsadvanced($id)
    {
        $preBoss = null;
        $injectors = null;
        $user = null;

        $preBoss = USER::where('My_boss_code',$id)->first();
        if(!empty($preBoss)){
            $injectors = USER::where('My_boss_code',$preBoss->boss_code)->get();
            if(!empty($injectors)){
                $user = USER::where('My_boss_code',$injectors->boss_code)->get(); 
            }
        }
        
        
        return response()->json(array('success' => true, 'user' => $user));
    }




    public function destroy($id)
    {
        //
    }
}
