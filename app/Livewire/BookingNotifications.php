<?php

namespace App\Livewire;

use App\Models\Booking;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class BookingNotifications extends Component
{
    public $bookings;
    public $unreadCount = 0;

    protected $listeners = ['bookingCreated' => 'loadBookings'];

    public function mount()
    {
        $this->loadBookings();
    }

    public function loadBookings()
    {
        $this->bookings = Booking::whereHas('room', function ($query) {
            $query->where('user_id', auth()->id());
        })
            ->whereNull('read_at')
            ->latest()
            ->get();

        $this->unreadCount = $this->bookings->count();
    }

    public function markAsRead()
    {
        Booking::whereHas('room', function ($query) {
            $query->where('user_id', auth()->id());
        })
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        $this->loadBookings();
    }
    public function render()
    {
        return view('livewire.booking-notifications');
    }
}
