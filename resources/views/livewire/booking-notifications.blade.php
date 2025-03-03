<div class="relative">
    <button wire:click="markAsRead" class="relative bg-blue-600 text-white px-4 py-2 rounded-md flex items-center">
        <i class="fa fa-bell"></i>
        @if($unreadCount > 0)
            <span class="absolute top-0 right-0 bg-red-600 text-white text-xs rounded-full px-2 py-1">
                {{ $unreadCount }}
            </span>
        @endif
    </button>

    @if($bookings->isNotEmpty())
        <div class="absolute top-12 right-0 w-64 bg-white shadow-lg rounded-lg p-3">
            <h4 class="text-gray-800 font-semibold mb-2">New Bookings</h4>
            <ul>
                @foreach($bookings as $booking)
                    <li class="border-b py-2 text-sm {{ $booking->read_at ? 'text-gray-500' : 'text-black' }}">
                        📅 New booking from {{ $booking->user->name }} on {{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}
                    </li>
                @endforeach
            </ul>
        </div>
    @else
        <p class="text-sm text-gray-500 mt-2">No new bookings.</p>
    @endif
</div>
