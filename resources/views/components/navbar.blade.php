<nav class="sticky top-0 z-50 bg-ivory/90 backdrop-blur-md border-b border-gold/20" 
     x-data="{ 
        mobileMenuOpen: false,
        userDropdownOpen: false,
        demoUser: null,
        init() {
            const stored = localStorage.getItem('karmaSetuDemoUser');
            if(stored) {
                try {
                    this.demoUser = JSON.parse(stored);
                } catch(e) {}
            }
        },
        logout() {
            localStorage.removeItem('karmaSetuDemoUser');
            this.demoUser = null;
            window.location.href = '/login';
        }
     }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="/" class="text-2xl font-serif font-bold text-forest flex items-center gap-2">
                    <svg class="w-8 h-8 text-gold" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 21a9 9 0 0 0 9-9H3a9 9 0 0 0 9 9Z"></path>
                        <path d="M12 3a9 9 0 0 0 9 9H3a9 9 0 0 0 9-9Z"></path>
                        <path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                    </svg>
                    KarmaSetu
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex md:items-center md:space-x-8">
                <a href="/" class="text-charcoal hover:text-forest transition-colors text-sm font-medium tracking-wide">Home</a>
                <a href="/causes" class="text-charcoal hover:text-forest transition-colors text-sm font-medium tracking-wide">Causes</a>
                <a href="/events" class="text-charcoal hover:text-forest transition-colors text-sm font-medium tracking-wide">Events</a>
                <a href="/ngos" class="text-charcoal hover:text-forest transition-colors text-sm font-medium tracking-wide">NGOs</a>
                <a href="/about" class="text-charcoal hover:text-forest transition-colors text-sm font-medium tracking-wide">About</a>
            </div>

            <!-- Right Actions -->
            <div class="hidden md:flex items-center space-x-4">
                <template x-if="!demoUser">
                    <div class="flex items-center space-x-4">
                        <a href="/login" class="text-charcoal hover:text-forest text-sm font-medium transition-colors">Login</a>
                        <a href="/register" class="bg-forest text-ivory hover:bg-forest-dark px-5 py-2 rounded-full text-sm font-medium transition-all shadow-sm">Join KarmaSetu</a>
                    </div>
                </template>

                <template x-if="demoUser">
                    <div class="relative">
                        <button @click="userDropdownOpen = !userDropdownOpen" @click.away="userDropdownOpen = false" class="flex items-center space-x-2 text-charcoal hover:text-forest text-sm font-medium transition-colors focus:outline-none">
                            <span class="flex items-center justify-center h-8 w-8 rounded-full bg-forest text-white text-xs font-serif font-bold shadow-sm" x-text="demoUser.name.charAt(0)"></span>
                            <span x-text="demoUser.name"></span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': userDropdownOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <!-- Dropdown menu -->
                        <div x-show="userDropdownOpen" style="display:none;" x-transition
                             class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-charcoal/10 overflow-hidden z-50 py-2">
                            <a href="/user/dashboard" class="block px-4 py-2 text-sm text-charcoal hover:bg-ivory-dark hover:text-forest transition-colors">My Dashboard</a>
                            <a href="/user/contributions" class="block px-4 py-2 text-sm text-charcoal hover:bg-ivory-dark hover:text-forest transition-colors">My Contributions</a>
                            <a href="/user/events" class="block px-4 py-2 text-sm text-charcoal hover:bg-ivory-dark hover:text-forest transition-colors">My Events-Tickets</a>
                            <a href="/user/volunteer-activities" class="block px-4 py-2 text-sm text-charcoal hover:bg-ivory-dark hover:text-forest transition-colors">Volunteer Activities</a>
                            <a href="/leaderboard" class="block px-4 py-2 text-sm text-charcoal hover:bg-ivory-dark hover:text-forest transition-colors">Rewards and Karma Points</a>
                            <a href="/user/profile" class="block px-4 py-2 text-sm text-charcoal hover:bg-ivory-dark hover:text-forest transition-colors">Profile & Settings</a>
                            <div class="border-t border-charcoal/5 my-1"></div>
                            <button @click="logout()" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors font-medium">Logout</button>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="text-charcoal hover:text-forest focus:outline-none">
                    <svg class="h-6 w-6" x-show="!mobileMenuOpen" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6" x-show="mobileMenuOpen" style="display:none;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" style="display:none;" x-transition class="md:hidden bg-ivory border-t border-gold/20 absolute w-full shadow-lg">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="/" class="block px-3 py-2 text-base font-medium text-charcoal hover:bg-ivory-dark hover:text-forest rounded-md">Home</a>
            <a href="/causes" class="block px-3 py-2 text-base font-medium text-charcoal hover:bg-ivory-dark hover:text-forest rounded-md">Causes</a>
            <a href="/causes" class="block px-3 py-2 text-base font-medium text-charcoal hover:bg-ivory-dark hover:text-forest rounded-md">Donate</a>
            <a href="/events" class="block px-3 py-2 text-base font-medium text-charcoal hover:bg-ivory-dark hover:text-forest rounded-md">Events</a>
            <a href="/ngos" class="block px-3 py-2 text-base font-medium text-charcoal hover:bg-ivory-dark hover:text-forest rounded-md">NGOs</a>
            <a href="/about" class="block px-3 py-2 text-base font-medium text-charcoal hover:bg-ivory-dark hover:text-forest rounded-md">About</a>
        </div>
        
        <div class="pt-4 pb-4 border-t border-gold/20 px-4 flex flex-col space-y-3">
            <template x-if="!demoUser">
                <div class="flex flex-col space-y-3">
                    <a href="/login" class="text-center text-charcoal font-medium border border-charcoal/20 rounded-full py-2">Login</a>
                    <a href="/register" class="text-center bg-forest text-ivory font-medium rounded-full py-2">Join KarmaSetu</a>
                </div>
            </template>
            
            <template x-if="demoUser">
                <div class="flex flex-col">
                    <div class="flex items-center space-x-3 mb-4 px-2">
                        <div class="flex items-center justify-center h-10 w-10 rounded-full bg-forest text-white text-lg font-serif font-bold shadow-sm" x-text="demoUser.name.charAt(0)"></div>
                        <div>
                            <p class="text-base font-bold text-forest" x-text="demoUser.name"></p>
                            <p class="text-xs text-charcoal-light font-medium" x-text="demoUser.email"></p>
                        </div>
                    </div>
                    <div class="flex flex-col space-y-1 bg-white rounded-xl p-2 border border-charcoal/5 shadow-sm">
                        <a href="/user/dashboard" class="block px-3 py-2.5 text-sm font-medium text-charcoal hover:bg-ivory-dark hover:text-forest rounded-lg">My Dashboard</a>
                        <a href="/user/contributions" class="block px-3 py-2.5 text-sm font-medium text-charcoal hover:bg-ivory-dark hover:text-forest rounded-lg">My Contributions</a>
                        <a href="/user/events" class="block px-3 py-2.5 text-sm font-medium text-charcoal hover:bg-ivory-dark hover:text-forest rounded-lg">My Events / Tickets</a>
                        <a href="/user/volunteer-activities" class="block px-3 py-2.5 text-sm font-medium text-charcoal hover:bg-ivory-dark hover:text-forest rounded-lg">Volunteer Activities</a>
                        <a href="/user/leaderboard" class="block px-3 py-2.5 text-sm font-medium text-charcoal hover:bg-ivory-dark hover:text-forest rounded-lg">Rewards / Karma Points</a>
                        <a href="/user/profile" class="block px-3 py-2.5 text-sm font-medium text-charcoal hover:bg-ivory-dark hover:text-forest rounded-lg">Profile & Settings</a>
                        <div class="border-t border-charcoal/5 my-1 mx-2"></div>
                        <button @click="logout()" class="block w-full text-left px-3 py-2.5 text-sm font-medium text-red-600 hover:bg-red-50 rounded-lg">Logout</button>
                    </div>
                </div>
            </template>
        </div>
    </div>
</nav>
