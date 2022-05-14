<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    protected $order;
    protected $subtotal;
    protected $shippingCost;

    /**
     * Create a new message instance.
     * 
     * @param \App\Models\Order $order
     * @return void
     */
    public function __construct(Order $order, $subtotal, $shippingCost)
    {
        $this->order = $order;
        $this->subtotal = $subtotal;
        $this->shippingCost = $shippingCost;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(__('Order confirmation'))->view('emails.orders.placed')
        ->with([
            'order' => $this->order,
            'subtotal' => $this->subtotal,
            'shippingCost' => $this->shippingCost
        ]);
    }
}
