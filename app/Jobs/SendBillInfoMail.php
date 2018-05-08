<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use App\Mail\BillInfoMail;
class SendBillInfoMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 3;
    protected $customer;
    protected $cart;
    protected $total_price;
    protected $coupon;
    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new BillInfoMail($this->customer, $this->cart, $this->total_price, $this->coupon);
        Mail::to($this->customer->email)->send($email);
    }
}
