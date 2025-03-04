<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $start_date;
    public $end_date;
    public $price;

    public function __construct($name, $start_date, $end_date , $price)
    {
        $this->name = $name;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->price = $price;
    }

    public function build()
    {
        return $this->subject('booking confirmation')
                    ->view('emails.booking_confirmation')
                    ->with([
                        'name' => $this->name,
                        'start_date' => $this->start_date,
                        'end_date' => $this->end_date,
                        'price' => $this->price,
                    ]);
    }
}
