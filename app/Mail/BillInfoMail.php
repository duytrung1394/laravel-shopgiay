<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BillInfoMail extends Mailable
{
    use Queueable, SerializesModels;

 
    protected $customer;
    protected $cart;
    protected $total_price;
    protected $coupon;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer, $cart, $total_price, $coupon)
    {
        $this->customer = $customer;
        $this->cart = $cart;
        $this->total_price = $total_price;
        $this->coupon = $coupon;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.bill_info',['customer'=>$this->customer, 'cart'=> $this->cart, 'total_price'=>$this->total_price, 'coupon'=>$this->coupon]);
    }
}
