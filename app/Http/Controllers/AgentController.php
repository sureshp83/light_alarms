<?php

namespace App\Http\Controllers;

use Exception;
use App\User;
use App\Models\Agency;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $agents = \Auth::user()->agency()->members();

        return view('agents.index', compact("agencies"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AgencyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgencyRequest $request)
    {
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function show(Agency $agency)
    {
        return view('agents.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function edit(Agency $agency)
    {
        return view('agents.edit');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agency $agency)
    {
        //
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
}
