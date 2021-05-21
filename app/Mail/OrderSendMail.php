<?php

namespace App\Mail;

use Illuminate\Support\Facades\DB;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderSendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $orders;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orders)
    {
        $this->orders=$orders;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $id=$this->orders->order_no;
        $path=$this->orders->path;
        $stock_order_details=DB::table('stock_order')->where('id','=',$id)->get();
        return $this->view('emails.demo')
                    ->subject('Order Parts')
                    ->attach('docs/uploaded/'.$path.'');
    }
}
