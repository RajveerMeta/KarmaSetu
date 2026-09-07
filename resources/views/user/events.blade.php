@extends('layouts.app')

@section('content')
@php
    // DUMMY DATA FOR PHASE 1
    $summaries = (object)[
        'upcoming_events' => 2,
        'tickets_booked' => 3,
        'events_attended' => 1
    ];

    $myTickets = [
        [
            'event_id' => 1,
            'ticket_id' => 'KS-TKT-10001',
            'quantity' => 1,
            'booking_status' => 'Confirmed',
            'type' => 'upcoming'
        ],
        [
            'event_id' => 2,
            'ticket_id' => 'KS-TKT-10002',
            'quantity' => 2,
            'booking_status' => 'Confirmed',
            'type' => 'upcoming'
        ],
        [
            'event_id' => 3,
            'ticket_id' => 'KS-TKT-09991',
            'quantity' => 1,
            'booking_status' => 'Attended',
            'type' => 'past'
        ],
        [
            'event_id' => 4,
            'ticket_id' => 'KS-TKT-09982',
            'quantity' => 1,
            'booking_status' => 'Attended',
            'type' => 'past'
        ],
    ];

    $userEvents = [];
    $eventsCollection = collect($events);

    foreach ($myTickets as $ticket) {
        $eventData = $eventsCollection->firstWhere('id', $ticket['event_id']);
        if ($eventData) {
            // Merge ticket info with event info. We cast to object for easy Blade access.
            $userEvents[] = (object) array_merge($ticket, $eventData);
        }
    }
    $hasEvents = count($userEvents) > 0;
@endphp

<div class="bg-ivory/40 min-h-screen py-10 lg:py-16" x-data="{ currentTab: 'all', ticketModalOpen: false, selectedTicket: null }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-10">
            <h1 class="text-3xl lg:text-4xl font-serif font-bold text-forest mb-2">My Events & Tickets</h1>
            <p class="text-charcoal-light">Keep track of the fundraising events you've joined through KarmaSetu.</p>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 lg:gap-6 mb-10">
            <!-- Card 1 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gold/20 flex flex-col justify-center relative overflow-hidden transition-shadow hover:shadow-md">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-gold/10 rounded-full blur-xl pointer-events-none"></div>
                <p class="text-xs font-bold uppercase tracking-widest text-charcoal-light mb-1 relative z-10">Upcoming Events</p>
                <p class="text-3xl font-serif font-bold text-forest relative z-10">{{ $summaries->upcoming_events }}</p>
            </div>
            <!-- Card 2 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gold/20 flex flex-col justify-center transition-shadow hover:shadow-md">
                <p class="text-xs font-bold uppercase tracking-widest text-charcoal-light mb-1">Tickets Booked</p>
                <p class="text-3xl font-serif font-bold text-forest">{{ $summaries->tickets_booked }}</p>
            </div>
            <!-- Card 3 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gold/20 flex flex-col justify-center transition-shadow hover:shadow-md">
                <p class="text-xs font-bold uppercase tracking-widest text-charcoal-light mb-1">Events Attended</p>
                <p class="text-3xl font-serif font-bold text-forest">{{ $summaries->events_attended }}</p>
            </div>
        </div>

        @if($hasEvents)
            <!-- Tabs -->
            <div class="flex items-center gap-2 mb-8 border-b border-charcoal/10 pb-4 overflow-x-auto">
                <button @click="currentTab = 'all'" :class="currentTab === 'all' ? 'bg-forest text-ivory shadow-sm' : 'bg-white text-charcoal hover:bg-ivory border border-gold/20'" class="px-6 py-2.5 rounded-full font-bold text-sm transition-colors whitespace-nowrap">
                    All Events
                </button>
                <button @click="currentTab = 'upcoming'" :class="currentTab === 'upcoming' ? 'bg-forest text-ivory shadow-sm' : 'bg-white text-charcoal hover:bg-ivory border border-gold/20'" class="px-6 py-2.5 rounded-full font-bold text-sm transition-colors whitespace-nowrap">
                    Upcoming
                </button>
                <button @click="currentTab = 'past'" :class="currentTab === 'past' ? 'bg-forest text-ivory shadow-sm' : 'bg-white text-charcoal hover:bg-ivory border border-gold/20'" class="px-6 py-2.5 rounded-full font-bold text-sm transition-colors whitespace-nowrap">
                    Past
                </button>
            </div>

            <!-- Event List -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                @foreach($userEvents as $event)
                    <div x-show="currentTab === 'all' || currentTab === '{{ $event->type }}'" 
                         x-transition.opacity
                         class="bg-white rounded-2xl shadow-sm border border-gold/20 overflow-hidden flex flex-col transition-all hover:shadow-md h-full">
                        
                        <!-- Event Image -->
                        <div class="w-full h-[220px] shrink-0 relative bg-forest/5">
                            <img src="{{ $event->image }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                            <div class="absolute top-4 left-4">
                                @if($event->booking_status === 'Confirmed')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest bg-green-50 text-forest border border-green-200 shadow-sm backdrop-blur-md bg-opacity-90">Ticket {{ $event->booking_status }}</span>
                                @elseif($event->booking_status === 'Attended')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest bg-gray-50 text-gray-700 border border-gray-200 shadow-sm backdrop-blur-md bg-opacity-90">{{ $event->booking_status }}</span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest bg-red-50 text-red-700 border border-red-200 shadow-sm backdrop-blur-md bg-opacity-90">{{ $event->booking_status }}</span>
                                @endif
                            </div>
                        </div>

                        <!-- Event Details & Actions -->
                        <div class="p-6 md:p-8 flex-1 flex flex-col">
                            
                            <h3 class="text-xl md:text-2xl font-serif font-bold text-forest mb-1">{{ $event->title }}</h3>
                            <p class="text-sm font-medium text-forest/80 mb-5">{{ $event->ngo_name }}</p>
                            
                            <div class="space-y-3 mb-6">
                                <div class="flex items-start gap-3 text-sm">
                                    <svg class="w-5 h-5 text-gold shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="font-medium text-charcoal pt-0.5">{{ $event->date }}</span>
                                </div>
                                <div class="flex items-start gap-3 text-sm">
                                    <svg class="w-5 h-5 text-gold shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span class="font-medium text-charcoal pt-0.5">{{ $event->time }}</span>
                                </div>
                                <div class="flex items-start gap-3 text-sm">
                                    <svg class="w-5 h-5 text-gold shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                    <span class="font-medium text-charcoal pt-0.5">{{ $event->location }}</span>
                                </div>
                            </div>
                            
                            <!-- Ticket Info -->
                            <div class="bg-ivory/50 rounded-xl p-4 border border-gold/10 mb-6 mt-auto">
                                <div class="flex flex-wrap justify-between items-center gap-4 mb-3 pb-3 border-b border-charcoal/5">
                                    <div>
                                        <span class="block text-[10px] font-bold text-charcoal-light uppercase tracking-widest mb-0.5">Ticket Price</span>
                                        <span class="font-bold text-forest text-sm">{{ $event->entry_fee }}</span>
                                    </div>
                                    <div>
                                        <span class="block text-[10px] font-bold text-charcoal-light uppercase tracking-widest mb-0.5">Quantity</span>
                                        <span class="font-bold text-forest text-sm">{{ $event->quantity }} {{ $event->quantity > 1 ? 'Tickets' : 'Ticket' }}</span>
                                    </div>
                                </div>
                                <div>
                                    <span class="inline-block text-[10px] font-bold text-charcoal-light uppercase tracking-widest mr-2">Ticket ID:</span>
                                    <span class="font-mono text-sm font-bold text-charcoal">{{ $event->ticket_id }}</span>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row items-center gap-3 pt-2">
                                @if($event->booking_status === 'Confirmed')
                                    <button @click="selectedTicket = '{{ $event->ticket_id }}'; ticketModalOpen = true" class="w-full sm:w-1/2 px-4 py-3 bg-forest text-ivory hover:bg-forest-light rounded-xl font-bold text-sm transition-colors text-center shadow-md flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                                        View Ticket
                                    </button>
                                    <a href="/events/{{ $event->event_id }}" class="w-full sm:w-1/2 px-4 py-3 bg-white border border-forest/30 text-forest hover:bg-forest hover:text-ivory rounded-xl font-bold text-sm transition-colors text-center shadow-sm">
                                        View Event
                                    </a>
                                @else
                                    <a href="/events/{{ $event->event_id }}" class="w-full px-4 py-3 bg-white border border-forest/30 text-forest hover:bg-forest hover:text-ivory rounded-xl font-bold text-sm transition-colors text-center shadow-sm">
                                        View Event
                                    </a>
                                @endif
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Hidden by Default Empty State if Tabs Filter to None -->
            <div x-show="!Array.from(document.querySelectorAll('.space-y-6 > div')).some(el => el.style.display !== 'none')" style="display: none;" class="bg-white rounded-2xl p-10 shadow-sm border border-gold/20 text-center flex flex-col items-center justify-center py-16">
                 <div class="h-16 w-16 bg-forest/5 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-forest/40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-xl font-serif font-bold text-forest mb-2">No events found</h3>
                <p class="text-charcoal-light max-w-sm mx-auto mb-6">You don't have any events matching this category.</p>
                <button @click="currentTab = 'all'" class="px-6 py-2 border border-charcoal/20 text-sm font-bold rounded-full shadow-sm text-charcoal bg-white hover:bg-ivory transition-colors">
                    View All
                </button>
            </div>
            
        @else
            <!-- Global Empty State -->
            <div class="bg-white rounded-2xl p-10 md:p-16 shadow-sm border border-gold/20 text-center flex flex-col items-center justify-center min-h-[400px]">
                <div class="h-20 w-20 bg-forest/5 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-forest/40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                </div>
                <h3 class="text-2xl font-serif font-bold text-forest mb-2">No Events Yet</h3>
                <p class="text-charcoal-light max-w-md mx-auto mb-8">Events you book through KarmaSetu will appear here. Start discovering meaningful events in your community!</p>
                <a href="/events" class="inline-flex justify-center px-6 py-3 border border-transparent text-sm font-bold rounded-full shadow-md text-white bg-forest hover:bg-forest-light transition-all">
                    Explore Events
                </a>
            </div>
        @endif

    </div>

    <!-- Frontend Simple Ticket Modal -->
    <div x-show="ticketModalOpen" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-charcoal/60 backdrop-blur-sm" x-transition.opacity>
        <div class="bg-white rounded-3xl p-8 max-w-sm w-full shadow-2xl relative border border-gold/20 text-center" @click.away="ticketModalOpen = false">
            <button @click="ticketModalOpen = false" class="absolute top-4 right-4 text-charcoal-light hover:text-charcoal transition-colors">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            
            <div class="w-16 h-16 bg-green-50 text-forest rounded-full flex items-center justify-center mx-auto mb-4 border border-green-200">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            
            <h3 class="text-2xl font-serif text-forest mb-2">Ticket Confirmed</h3>
            <p class="text-sm text-charcoal-light mb-6">Your ticket is ready for the event. Please present this ID at the venue.</p>
            
            <div class="bg-ivory border border-gold/30 rounded-xl p-4 mb-6">
                <span class="block text-xs font-bold text-gold uppercase tracking-widest mb-2">Ticket ID</span>
                <span class="block text-2xl font-mono font-bold text-charcoal tracking-widest" x-text="selectedTicket"></span>
            </div>
            
            <button @click="ticketModalOpen = false" class="w-full bg-forest text-ivory hover:bg-forest-light px-4 py-3 rounded-xl font-bold transition-colors">
                Close
            </button>
        </div>
    </div>
</div>
@endsection
