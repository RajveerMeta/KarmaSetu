<nav class="sticky top-0 z-50 bg-ivory/90 backdrop-blur-md border-b border-gold/20" x-data="{ mobileMenuOpen: false }">
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
                <a href="#" class="text-charcoal hover:text-forest text-sm font-medium transition-colors">Login</a>
                <a href="#" class="bg-forest text-ivory hover:bg-forest-dark px-5 py-2 rounded-full text-sm font-medium transition-all shadow-sm">Join KarmaSetu</a>
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
            <a href="#" class="block px-3 py-2 text-base font-medium text-charcoal hover:bg-ivory-dark hover:text-forest rounded-md">Volunteer</a>
            <a href="/ngos" class="block px-3 py-2 text-base font-medium text-charcoal hover:bg-ivory-dark hover:text-forest rounded-md">NGOs</a>
            <a href="/about" class="block px-3 py-2 text-base font-medium text-charcoal hover:bg-ivory-dark hover:text-forest rounded-md">About</a>
        </div>
        <div class="pt-4 pb-4 border-t border-gold/20 px-4 flex flex-col space-y-3">
            <a href="#" class="text-center text-charcoal font-medium border border-charcoal/20 rounded-full py-2">Login</a>
            <a href="#" class="text-center bg-forest text-ivory font-medium rounded-full py-2">Join KarmaSetu</a>
        </div>
    </div>
</nav>
