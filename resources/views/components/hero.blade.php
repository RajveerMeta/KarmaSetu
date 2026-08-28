<section class="relative pt-20 pb-24 lg:pt-32 lg:pb-36 overflow-hidden">
    <!-- Abstract bridge lines in background -->
    <svg class="absolute top-0 right-0 w-3/4 h-full -z-10 text-gold/20" viewBox="0 0 800 600" fill="none">
        <path d="M-100,500 Q300,100 900,400" stroke="currentColor" stroke-width="1.5" fill="none" class="bridge-path" />
        <path d="M0,600 Q400,200 1000,500" stroke="currentColor" stroke-width="1" fill="none" class="bridge-path" />
    </svg>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-12 lg:gap-16 items-center">
            
            <!-- Left Text Content -->
            <div class="lg:col-span-6 lg:pr-8">
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-serif text-forest leading-[1.1] tracking-tight mb-8">
                    Every good intention <br/><span class="italic font-light text-gold">needs a bridge.</span>
                </h1>
                <p class="text-lg md:text-xl text-charcoal-light mb-10 max-w-lg leading-relaxed font-light">
                    KarmaSetu connects people willing to help with causes, NGOs, and communities that need support.
                </p>

                <!-- Contribution Selector -->
                <div x-data="{ selected: 'money' }" class="bg-white p-6 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gold/10 mb-8">
                    <p class="text-sm font-semibold text-charcoal mb-4 uppercase tracking-wider">I want to contribute</p>
                    <div class="flex flex-wrap gap-2 mb-6">
                        <template x-for="type in [
                            {id: 'money', label: 'Money'},
                            {id: 'food', label: 'Food'},
                            {id: 'clothes', label: 'Clothes'},
                            {id: 'items', label: 'Useful Items'},
                            {id: 'time', label: 'Time'}
                        ]">
                            <button 
                                @click="selected = type.id"
                                :class="selected === type.id ? 'bg-forest text-ivory border-forest' : 'bg-ivory border-gold/30 text-charcoal hover:border-gold'"
                                class="px-4 py-2 rounded-full border text-sm font-medium transition-colors"
                                x-text="type.label">
                            </button>
                        </template>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/causes" class="bg-forest text-ivory hover:bg-forest-dark px-8 py-3.5 rounded-full font-medium transition-all shadow-md w-full sm:w-auto text-center inline-block">
                            Find a way to help
                        </a>
                        <a href="/causes" class="bg-transparent border border-forest text-forest hover:bg-forest/5 px-8 py-3.5 rounded-full font-medium transition-all w-full sm:w-auto text-center inline-block">
                            Explore causes
                        </a>
                    </div>
                </div>
                
                <div class="flex items-center gap-4 text-sm text-charcoal-light font-medium">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Not just about money
                    </span>
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Verified NGOs
                    </span>
                </div>
            </div>

            <!-- Right Image Content (Asymmetric) -->
            <div class="lg:col-span-6 mt-16 lg:mt-0 relative">
                <!-- Decorative elements -->
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-gold/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-forest/10 rounded-full blur-3xl"></div>
                
                <div class="relative rounded-t-full rounded-b-3xl overflow-hidden aspect-[4/5] md:aspect-[3/4] shadow-2xl border-4 border-white">
                    <!-- Placeholder for real community photo -->
                    <div class="absolute inset-0 bg-gradient-to-tr from-forest/80 to-transparent mix-blend-multiply z-10"></div>
                    <img src="https://images.unsplash.com/photo-1593113565694-c8f71b12b509?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Community Support" class="object-cover w-full h-full" />
                    
                    <div class="absolute bottom-0 left-0 right-0 p-8 z-20 bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                        <p class="text-white font-serif text-xl md:text-2xl italic">"Bridging the gap between a willing heart and a waiting hand."</p>
                    </div>
                </div>
                
                <!-- Floating stat card -->
                <div class="absolute top-1/4 -left-8 md:-left-16 bg-white p-4 rounded-2xl shadow-xl border border-gold/20 flex items-center gap-4 animate-bounce" style="animation-duration: 4s;">
                    <div class="w-12 h-12 bg-ivory rounded-full flex items-center justify-center text-forest">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-charcoal-light font-medium uppercase tracking-wider">Live Activity</p>
                        <p class="text-sm font-bold text-charcoal">50+ Meals Donated Today</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
