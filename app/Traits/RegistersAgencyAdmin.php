<?php

namespace App\Traits;

use App\User;
use App\Models\Agency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestMemberMail;

trait RegistersAgencyAdmin
{
    /**
     * Assign user as Agency Admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     *
     * @return \Illuminate\Http\Response
     */
    public function assignAgencyAdmin(Request $request, User $user)
    {
        $agency = Agency::findOrFail($request['agency']);

        //send mail
        $manager_user=User::where(array('agency_id'=>$agency->id,'role_id'=>2,'position'=>'Principal'))->select('email')->first();
        if(isset($manager_user->email) && $manager_user->email!=null){
            Mail::to($manager_user->email,$manager_user->name)
                ->queue(new RequestMemberMail($user));
        }else{

            Mail::to(config("mail.to_administrator"),"admin")
                ->queue(new RequestMemberMail($user));
        }

        User::where('id',$user->id)->update(array('role_id'=>2,'agency_id'=>$agency->id));

        //$agency->admins->attach($user->id);
        return response()->json();
    }
}
