<?php

namespace App\Mail;

use Illuminate\Support\Facades\DB;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
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
        $stock_order_details=DB::table('stock_order')->where('id','=',$id)->get();
        $stock_order_list=DB::table('stock_order_list')->where('order_no','=',$id)->get();
        return $this->view('emails.consumables')
                    ->subject('Order List')
                    ->with(['stock_details'=>$stock_order_details,'stock_list'=>$stock_order_list]);
    }
}
