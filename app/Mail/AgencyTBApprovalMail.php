<?php

namespace App\Mail;
use App\Models\Agency;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AgencyTBApprovalMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $data;


    /**
     * Create a new message instance.
     *
     * @param  \App\Http\Requests\AgencyRequest  $request
     * @return \Illuminate\Http\Response
     *
     * @return void
     */
    public function __construct(Agency $data)
    {
        $this->data=$data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.AgencyTBApproval')
                    ->attach(storage_path('/app').'/'.$this->data['avatar'])
                    ->with([
                        'distributor_logo'  => $this->data['avatar'],
                        'name_of_agency'   => $this->data['name'],
                        'contactno'    => $this->data['phone'],
                        'address'   => $this->data['address'],
                        'city' => $this->data['city'],
                        'state' => $this->data['state_province'],
                        'zip_code' => $this->data['postal_code'],
                        'special_instructions' => "This is notify you that you need to approve T & B Approval.",
                    ]);

    }
}
