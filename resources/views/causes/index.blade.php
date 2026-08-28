@extends('layouts.app')

@section('content')
    <!-- 01 - Page Introduction -->
    <section class="relative pt-16 pb-12 overflow-hidden bg-ivory">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <span class="text-gold font-bold tracking-widest uppercase text-xs">Current Needs</span>
            <h1 class="mt-3 text-5xl md:text-6xl font-serif text-forest mb-6">Where help is needed.</h1>
            <p class="text-xl text-charcoal-light font-light max-w-2xl">
                Discover verified causes and choose the kind of contribution that feels right for you.
            </p>
        </div>
        
        <!-- Subtle bridge line -->
        <svg class="absolute top-1/2 left-0 w-full h-32 -translate-y-1/2 opacity-20 pointer-events-none text-gold" preserveAspectRatio="none" viewBox="0 0 1000 100">
            <path d="M0,50 Q250,90 500,50 T1000,50" stroke="currentColor" stroke-width="1" stroke-dasharray="4 4" fill="none" />
        </svg>
    </section>

    <!-- Alpine wrapper for filtering -->
    <div x-data="{ 
        contributionType: 'all', 
        searchQuery: '',
        location: 'all',
        sort: 'urgent' 
    }">
        
        <!-- 02 & 03 - Filters and Toolbar -->
        <x-causes.cause-filters />
        
        <!-- 04 - Featured Urgent Need -->
        <x-causes.featured-cause />
        
        <!-- 05 - Cause Discovery Grid -->
        <section class="py-16 bg-ivory relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-serif text-forest mb-10">Explore current needs</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Cause 1 -->
                    <x-causes.cause-card 
                        id="8"
                        title="Children's Education Support"
                        need-text="Books + educational materials"
                        location="Vadodara"
                        :progress="45"
                        :accepts="['books', 'items', 'money']"
                        cta-text="See how you can help"
                        status="active"
                    />
                    
                    <!-- Cause 2 -->
                    <x-causes.cause-card 
                        id="5"
                        title="Winter Clothing Collection"
                        need-text="500 clothing items"
                        location="Surat"
                        :progress="64"
                        :accepts="['clothes']"
                        cta-text="Give Clothes"
                        status="active"
                    />
                    
                    <!-- Cause 3 -->
                    <x-causes.cause-card 
                        id="4"
                        title="Community Meal Program"
                        need-text="Food supplies"
                        location="Ahmedabad"
                        :progress="72"
                        :accepts="['food', 'money']"
                        cta-text="Support Meals"
                        status="urgent"
                    />
                    
                    <!-- Cause 4 -->
                    <x-causes.cause-card 
                        id="3"
                        title="Community Health Assistance"
                        need-text="Medical/community resources"
                        location="Rajkot"
                        :progress="30"
                        :accepts="['money', 'items', 'time']"
                        cta-text="View Cause"
                        status="active"
                    />
                    
                    <!-- Cause 5 -->
                    <x-causes.cause-card 
                        id="1"
                        title="Shelter Home Repair"
                        need-text="Building materials & funds"
                        location="Mumbai"
                        :progress="90"
                        :accepts="['money', 'items']"
                        cta-text="Help Finish"
                        status="nearly-complete"
                    />
                    
                    <!-- Cause 6 -->
                    <x-causes.cause-card 
                        id="2"
                        title="Weekend Teaching Camp"
                        need-text="Volunteer educators"
                        location="Pune"
                        :progress="100"
                        :accepts="['time']"
                        cta-text="Completed"
                        status="completed"
                    />
                </div>
            </div>
        </section>
        
    </div>

    <!-- 06 - Contribution Matcher -->
    <x-causes.contribution-matcher />

    <!-- 07 - Verification Trust Section -->
    <x-causes.verification-info />

    <!-- 09 - Final Discovery CTA -->
    <section class="py-24 bg-forest text-ivory text-center">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-serif mb-6">Can't find what you're looking for?</h2>
            <p class="text-ivory/80 text-lg mb-10 font-light">
                Explore verified NGOs and discover the work happening behind each cause. Or, if you have time to give, find out how you can volunteer.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <button class="bg-gold text-forest hover:bg-white px-8 py-3.5 rounded-full font-bold transition-colors">
                    Explore NGOs &rarr;
                </button>
                <button class="bg-transparent border border-ivory/30 hover:border-ivory px-8 py-3.5 rounded-full font-medium transition-colors">
                    Become a Volunteer &rarr;
                </button>
            </div>
        </div>
    </section>
@endsection
