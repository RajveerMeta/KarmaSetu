<!-- 06 - Contribution Matcher -->
<section class="py-24 bg-white border-y border-gold/10 overflow-hidden relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-serif text-forest mb-4">What do you have to give?</h2>
            <p class="text-charcoal-light text-lg font-light max-w-2xl mx-auto">
                KarmaSetu helps you find a purpose for what you already have. Select an item to see how it connects to real needs.
            </p>
        </div>

        <div class="relative max-w-4xl mx-auto" x-data="{ activeMatch: 'clothes' }">
            
            <!-- Abstract center connecting line -->
            <div class="absolute left-1/2 top-0 bottom-0 w-px bg-gold/20 -translate-x-1/2 hidden md:block z-0"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-24 relative z-10">
                
                <!-- Left Side: "I have..." -->
                <div class="space-y-4">
                    <h3 class="text-sm font-bold text-charcoal uppercase tracking-widest mb-6 md:text-right px-6 md:px-0">I have...</h3>
                    
                    <template x-for="item in [
                        { id: 'clothes', label: 'Clothes' },
                        { id: 'books', label: 'Books & Stationery' },
                        { id: 'food', label: 'Food Rations' },
                        { id: 'items', label: 'Household Items' },
                        { id: 'time', label: 'Free Time' },
                        { id: 'money', label: 'Money' }
                    ]">
                        <button 
                            @click="activeMatch = item.id"
                            :class="activeMatch === item.id 
                                ? 'bg-forest text-ivory border-forest shadow-md scale-105' 
                                : 'bg-ivory border-gold/30 text-charcoal hover:border-gold'"
                            class="w-full md:text-right px-6 py-4 rounded-2xl border font-serif text-xl transition-all relative flex justify-between md:justify-end items-center group"
                        >
                            <!-- Connection dot -->
                            <div :class="activeMatch === item.id ? 'bg-gold border-white' : 'bg-ivory border-gold/50'" 
                                 class="absolute -right-12 md:-right-12 top-1/2 -translate-y-1/2 w-4 h-4 rounded-full border-2 hidden md:block transition-colors z-20"></div>
                            
                            <span class="md:hidden text-gold">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </span>
                            <span x-text="item.label"></span>
                        </button>
                    </template>
                </div>

                <!-- Right Side: Matching Causes -->
                <div class="flex flex-col justify-center">
                    <h3 class="text-sm font-bold text-charcoal uppercase tracking-widest mb-6 hidden md:block px-6 md:px-0">Matches</h3>
                    
                    <div class="bg-ivory-dark rounded-3xl p-8 border border-gold/20 shadow-inner relative overflow-hidden">
                        
                        <!-- Connection path visual -->
                        <svg class="absolute top-1/2 left-0 w-16 h-16 -translate-x-full -translate-y-1/2 text-gold hidden md:block z-10" viewBox="0 0 100 100" preserveAspectRatio="none">
                            <path d="M0,50 L100,50" stroke="currentColor" stroke-width="2" stroke-dasharray="4 4" fill="none" />
                        </svg>

                        <!-- Dynamic Content based on activeMatch -->
                        <div x-show="activeMatch === 'clothes'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-forest mb-6 shadow-sm">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            </div>
                            <h4 class="text-3xl font-serif text-forest mb-2">3 causes need clothes</h4>
                            <p class="text-charcoal-light mb-6">Winter is approaching in northern regions. Verified NGOs are collecting usable warm clothing for families.</p>
                            <button @click="contributionType = 'clothes'; window.scrollTo({top: 0, behavior: 'smooth'})" class="text-gold font-bold flex items-center hover:text-forest transition-colors">
                                Filter by Clothes Needs <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>

                        <div x-show="activeMatch === 'books'" style="display:none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-forest mb-6 shadow-sm">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <h4 class="text-3xl font-serif text-forest mb-2">2 causes need books</h4>
                            <p class="text-charcoal-light mb-6">Rural schools and community learning centers are requesting textbooks, storybooks, and stationery sets.</p>
                            <button @click="contributionType = 'books'; window.scrollTo({top: 0, behavior: 'smooth'})" class="text-gold font-bold flex items-center hover:text-forest transition-colors">
                                Filter by Book Needs <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>

                        <div x-show="activeMatch === 'food'" style="display:none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-forest mb-6 shadow-sm">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <h4 class="text-3xl font-serif text-forest mb-2">4 causes need food</h4>
                            <p class="text-charcoal-light mb-6">Community kitchens and disaster relief camps urgently require raw materials (rice, dal) or packed meals.</p>
                            <button @click="contributionType = 'food'; window.scrollTo({top: 0, behavior: 'smooth'})" class="text-gold font-bold flex items-center hover:text-forest transition-colors">
                                Filter by Food Needs <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                        
                        <div x-show="activeMatch === 'items'" style="display:none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-forest mb-6 shadow-sm">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <h4 class="text-3xl font-serif text-forest mb-2">5 causes need items</h4>
                            <p class="text-charcoal-light mb-6">NGOs are looking for blankets, hygiene kits, building materials, and everyday household essentials.</p>
                            <button @click="contributionType = 'items'; window.scrollTo({top: 0, behavior: 'smooth'})" class="text-gold font-bold flex items-center hover:text-forest transition-colors">
                                Filter by Item Needs <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                        
                        <div x-show="activeMatch === 'time'" style="display:none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-forest mb-6 shadow-sm">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h4 class="text-3xl font-serif text-forest mb-2">8 volunteer opportunities</h4>
                            <p class="text-charcoal-light mb-6">From teaching children on weekends to helping distribute food, your time is highly valuable to these causes.</p>
                            <button @click="contributionType = 'time'; window.scrollTo({top: 0, behavior: 'smooth'})" class="text-gold font-bold flex items-center hover:text-forest transition-colors">
                                Filter by Time Needs <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                        
                        <div x-show="activeMatch === 'money'" style="display:none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-forest mb-6 shadow-sm">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h4 class="text-3xl font-serif text-forest mb-2">12 causes need funding</h4>
                            <p class="text-charcoal-light mb-6">Financial contributions help NGOs sustain operations, purchase medical supplies, and fund large-scale relief.</p>
                            <button @click="contributionType = 'money'; window.scrollTo({top: 0, behavior: 'smooth'})" class="text-gold font-bold flex items-center hover:text-forest transition-colors">
                                Filter by Financial Needs <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
