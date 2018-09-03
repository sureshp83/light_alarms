<?php

namespace App\Http\Controllers;

use App\Mail\AgencyTBApprovalMail;
use Exception;
use App\Models\Agency;
use App\User;
use App\Http\Requests\AgencyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Caffeinated\Flash\Facades\Flash;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(\Auth::user()->role_id == 1) {
            /*$agencies = Agency::where('is_approved',1)->with('admin')->paginate(25);*/
            $awaiting_count = Agency::AwaitingApprovals()->count();
            return view('agencies.index', compact("agencies", "awaiting_count"));
        }else if(\Auth::user()->role_id == 2){
            $agencies = Agency::where('id',\Auth::user()->agency_id)->with('admin')->get();

            $awaiting_count = User::AwaitingApprovals()->where(array('agency_id'=>\Auth::user()->agency_id,'role_id'=>3))->count();
            return view('agencies.single_agny.index', compact("agencies", "awaiting_count"));
        }
    }

    public function AjaxIndex(Request $request)
    {

        if(\Auth::user()->role_id == 1) {
            $agency = Agency::where('is_approved', 1)->with('admin')->offset($request->offset)
                ->limit($request->pagesize)
                ->get();

            foreach ($agency as $key=> $age){
                $data[$key]['id']=$age->id;
                $data[$key]['avatar']=$age->avatar;
                $data[$key]['name']=$age->name;
                $data[$key]['address']=$age->address;
                $data[$key]['city']=$age->city;
                $data[$key]['state_province']=$age->state_province;
                $data[$key]['postal_code']=$age->postal_code;
                $data[$key]['website']=$age->website;
                $data[$key]['adminname']=$age->admin ? $age->admin->name : '-';
                $data[$key]['position']=$age->admin ? $age->admin->position : '-';
                $data[$key]['phone']=$age->admin ? $age->admin->phone : '-';
                $data[$key]['phone_ext']=$age->admin ? $age->admin->phone_ext: '-';
                $data[$key]['email']=$age->admin ? $age->admin->email : '-';
            }

        }else if(\Auth::user()->role_id == 2){
            $agency = User::where('id', '!=' , \Auth::user()->id)->where(array('agency_id'=>\Auth::user()->agency_id,'is_approved'=>1))->whereIn('role_id',array('2','3'))->offset($request->offset)
            ->limit($request->pagesize)
            ->get();

            foreach ($agency as $key=> $age){
                $data[$key]['id']=$age->id;
                $data[$key]['name']=$age->name;
                $data[$key]['ext']=$age->phone_ext ? $age->phone_ext : '-';
                $data[$key]['position']=$age->position ? $age->position : '-';
                $data[$key]['phone']=$age->phone ? $age->phone : '-';
                $data[$key]['email']=$age->email ? $age->email : '-';
                $data[$key]['marketing_formate']=$age->marketing_formate ? $age->marketing_formate : '-';
            }
        }

        $dataArr['data']=$data;

        //$awaiting_count = Agency::AwaitingApprovals()->count();

        return \Response::json($dataArr,200);
    }

    public function postAjaxAwaiting(Request $request){
        if(\Auth::user()->role_id == 1) {
            $agency = Agency::AwaitingApprovals()->with('admin')->offset($request->offset)->limit($request->pagesize)->get();

            foreach ($agency as $key=> $age){
                $data[$key]['id']=$age->id;
                $data[$key]['avatar']=$age->avatar;
                $data[$key]['name']=$age->name;
                $data[$key]['address']=$age->address;
                $data[$key]['city']=$age->city;
                $data[$key]['state_province']=$age->state_province;
                $data[$key]['postal_code']=$age->postal_code;
                $data[$key]['website']=$age->website;
                $data[$key]['adminname']=$age->admin ? $age->admin->name : '-';
                $data[$key]['position']=$age->admin ? $age->admin->position : '-';
                $data[$key]['phone']=$age->admin ? $age->admin->phone : '-';
                $data[$key]['email']=$age->admin ? $age->admin->email : '-';
            }

        }else if(\Auth::user()->role_id == 2){
            $agency = User::AwaitingApprovals()->where('id', '!=' , \Auth::user()->id)->offset($request->offset)->limit($request->pagesize)->get();

            foreach ($agency as $key=> $age){
                $data[$key]['id']=$age->id;
                $data[$key]['name']=$age->name;
                $data[$key]['ext']=$age->phone_ext ? $age->phone_ext : '-';
                $data[$key]['position']=$age->position ? $age->position : '-';
                $data[$key]['phone']=$age->phone ? $age->phone : '-';
                $data[$key]['email']=$age->email ? $age->email : '-';
                $data[$key]['marketing_formate']=$age->marketing_formate ? $age->marketing_formate : '-';
            }

        }


        $dataArr['data']=$data;
        return \Response::json($dataArr,200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AgencyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgencyRequest $request)
    {

        //dd($request->all());
        try {
            $path = '';
            $data = $request->except("_method", "_token");

            // Upload Agency avatar
            if ($request->hasFile('avatar')) {
                $path = $request->file('avatar')->store('agency');
            }

            // Create agency
            $agency = Agency::firstOrCreate([
                'name'           => $data['name'],
                'phone'          => $data['phone'],
                'address'        => $data['address'],
                'city'           => $data['city'],
                'state_province' => $data['state'],
                'postal_code'    => $data['postal_code'],
                'avatar'         => $path,
            ]);

            // Create team for this agency
            $teamModel = config('teamwork.team_model');

            $team = $teamModel::firstOrCreate([
                'owner_id' => 1,
                'name'     => 'Team '.$data['name'],
            ]);

            // Attach team to agency
            $agency->teams()->sync($team->id);


            //Send mail
            Mail::to(config("mail.to_administrator"),"admin")
                ->queue(new AgencyTBApprovalMail($agency));


            return response()->json([
                'message' => 'Agency created.',
                'data'    => $agency,
                'status'  => 200,
            ], 200);

        } catch (Exception $e) {
            return [
                "status"  => $e->getCode(),
                "message" => $e->getMessage(),
                "errors"  => ['error' => [$e->getMessage()]],
            ];
        }
    }

    public function  postApproved(Request $request){
        if(\Auth::user()->role_id == 1){
            $param=$request->all();
            $Approved=Agency::whereIn('id',$param)->update(array('is_approved'=>1));
            Flash::success("Agency approved successfully");
        }else if(\Auth::user()->role_id == 2){
            $param=$request->all();
            $Approved=User::whereIn('id',$param)->update(array('is_approved'=>1));
            Flash::success("Member approved successfully");
        }
         return \Response::json($Approved,200);
    }

    public function postDeleteMultiple(Request $request){
        if(\Auth::user()->role_id == 1) {
            $param = $request->all();
            $Approved = Agency::whereIn('id', $param)->delete();
            Flash::success("Agency deleted successfully");
        }else if(\Auth::user()->role_id == 2){
            $param = $request->all();
            $Approved = User::whereIn('id', $param)->delete();
            Flash::success("Agency deleted successfully");
        }
         return \Response::json($Approved,200);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function show(Agency $agency)
    {
        return view('agencies.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function edit(Agency $agency)
    {
        return view('agencies.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agency $agency)
    {

        $param=$request->all();
        $data = $request->except("id", "_token");
        try{
            if(\Auth::user()->role_id == 1){

            }else if(\Auth::user()->role_id == 2){
                User::where('id',$param['id'])->update($data);
            }

        }catch (ModelNotFoundException $e){
            Flash::error("Modal not found");
        }catch (Exception $e){
            Flash::error("ERROR {$e->getCode()}");
        }
        return \Response::json("Member updated successfully.!!",200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            if(\Auth::user()->role_id == 1){
                Agency::destroy($id);
                Flash::success("Agency deleted successfully");
            }else if(\Auth::user()->role_id == 2){
                User::destroy($id);
                Flash::success("Member deleted successfully");
            }
        }catch (ModelNotFoundException $e){
            Flash::error("Modal not found");
        }catch (Exception $e){
            Flash::error("ERROR {$e->getCode()}");
        }

        return redirect()->route("agencies.index");
    }


    /*
     |--------------------------------------------------------------------------
     | Ajax Methods
     |--------------------------------------------------------------------------
     |  Routes that will deal exclusively with ajax calls.
     */

    /**
     * AJAX requests
     */
    public function indexSelect()
    {
        return Agency::pluck('name', 'id');
    }


    public function postTeamDetail($id,Request $request){

        $data=User::where('agency_id',$id)->whereIn('role_id',array(2,3))->offset($request->offset)
            ->limit($request->pagesize)->get();
        return \Response::json($data,200);
    }

    public function SetManager(Request $request){

        $allusers=User::where(['agency_id'=>$request->get('agency_id'),'role_id'=>2])->update(array('role_id'=>3,'position'=>''));
        $data = User::where('id',$request->get('userid'))->update(array('position'=>'Manager','role_id'=>2));
        return \Response::json($data,200);
    }
}
