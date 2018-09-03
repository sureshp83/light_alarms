<?php

namespace App\Mail;

use App\Models\RequestSalesLiterature;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SalesLiteratureMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels, InteractsWithQueue;

    protected $data;

    /**
     * Create a new message instance.
     *
     * @param $data
     *
     * @return void
     */
    public function __construct(RequestSalesLiterature $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.sales_literature')
                    ->subject( __('strings.sales_literature.title') )
                    ->with( $this->data->toArray() );
    }
}
