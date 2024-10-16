<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationResponse;

use Exception;

class MessageReservation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    private $email;
    private $guest_emails;
    private $transaction;
    private $id;
    public function __construct($email, $guest_emails, $transaction, $id)
    {
        $this->email = $email;
        $this->guest_emails = $guest_emails;
        $this->transaction = $transaction;
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new ReservationResponse($this->transaction, $this->id));

    if ($this->guest_emails != "") {
      $emails = explode(',', $this->guest_emails);

      array_pop($emails);

      foreach ($emails as $em) {
        $cleanEmail = str_replace(' ', '', $em);
        try {
          Mail::to($cleanEmail)->send(new ReservationResponse($this->transaction, $this->id));
        } catch (Exception $ex) {
          // Ignore
        }
      }
    }
    }
}
