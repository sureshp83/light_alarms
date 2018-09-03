<?php

namespace App\Mail;

use App\Models\RequestDisplayBoard;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DisplayBoardMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels, InteractsWithQueue;

    protected $data;

    protected $logo;

    /**
     * Create a new message instance.
     *
     * @param RequestDisplayBoard  $data
     * @param String  $logo
     *
     * @return void
     */
    public function __construct(RequestDisplayBoard $data, String $logo)
    {
        $this->data = $data;
        $this->logo = $logo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.display_board')
                    ->attach( storage_path('/app').'/'.$this->logo )
                    ->with([
                        'distributor_logo'     => $this->logo,
                        'name_of_distributor'  => $this->data['name_of_distributor'],
                        'quantity'             => $this->data['quantity'],
                        'product_ids'          => $this->data['product_ids'],
                        'contact_name'         => $this->data['contact_name'],
                        'contact_phone_number' => $this->data['contact_phone_number'],
                        'company'              => $this->data['company'],
                        'ship_date'            => $this->data['ship_date'],
                        'address'              => $this->data['address'],
                        'city'                 => $this->data['city'],
                        'state'                => $this->data['state'],
                        'zip_code'             => $this->data['zip_code'],
                        'special_instructions' => $this->data['special_instructions'],
                    ]);
    }
}
