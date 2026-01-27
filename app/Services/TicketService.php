<?php

namespace App\Services;

use App\Helpers\LogHelper;
use App\Models\Ticket;
use Illuminate\Http\UploadedFile;

class TicketService
{
    private Ticket $ticket;

    public function setTicket(Ticket $ticket): self
    {
        $this->ticket = $ticket;
        return $this;
    }

    public function getObject(): Ticket
    {
        return $this->ticket->fresh();
    }

}
