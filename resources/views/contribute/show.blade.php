@extends('layouts.app')

@section('content')


    <!-- 02. INTRODUCTION / HERO -->
    <section class="bg-ivory pt-10 pb-8 border-b border-gold/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center max-w-3xl">
            <span class="text-gold font-bold tracking-widest uppercase text-xs">Make a Difference</span>
            <h1 class="mt-3 text-4xl md:text-5xl font-serif text-forest mb-4 leading-tight">Make a Contribution That Creates Change</h1>
            <p class="text-lg text-charcoal-light font-light leading-relaxed">
                Your contribution helps trusted NGOs and communities provide essential support where it is needed most.
            </p>
        </div>
    </section>

    <!-- Alpine App for Form -->
    <div x-data="contributionApp()" x-cloak>
        <!-- 03. MAIN CONTRIBUTION LAYOUT -->
        <section class="bg-ivory-dark py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- Review State Overlay -->
                <div x-show="showReview" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" style="display: none;">
                    <div class="bg-white rounded-3xl p-8 max-w-md w-full shadow-2xl relative border border-forest" @click.away="showReview = false">
                        <h2 class="text-2xl font-serif text-forest mb-6">Review Your Contribution</h2>
                        
                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between border-b border-gold/20 pb-4">
                                <span class="text-charcoal-light font-medium">Type</span>
                                <span class="text-forest font-bold capitalize" x-text="type === 'items' ? 'Useful Items' : type"></span>
                            </div>
                            
                            <template x-if="type === 'money'">
                                <div class="flex justify-between border-b border-gold/20 pb-4">
                                    <span class="text-charcoal-light font-medium">Amount</span>
                                    <span class="text-forest font-bold font-serif text-xl" x-text="'₹' + amount.toLocaleString('en-IN')"></span>
                                </div>
                            </template>
                            
                            <template x-if="type === 'food'">
                                <div class="flex justify-between border-b border-gold/20 pb-4">
                                    <span class="text-charcoal-light font-medium">Quantity</span>
                                    <span class="text-forest font-bold" x-text="foodQuantity + ' ' + foodUnit"></span>
                                </div>
                            </template>
                            
                            <template x-if="type === 'clothes'">
                                <div class="flex justify-between border-b border-gold/20 pb-4">
                                    <span class="text-charcoal-light font-medium">Quantity</span>
                                    <span class="text-forest font-bold" x-text="clothesQuantity + ' items'"></span>
                                </div>
                            </template>
                            
                            <template x-if="type === 'items'">
                                <div class="flex justify-between border-b border-gold/20 pb-4">
                                    <span class="text-charcoal-light font-medium">Item</span>
                                    <span class="text-forest font-bold" x-text="itemName + ' (' + itemQuantity + ')'"></span>
                                </div>
                            </template>
                            
                            <div class="flex justify-between border-b border-gold/20 pb-4">
                                <span class="text-charcoal-light font-medium">Supporting</span>
                                <span class="text-charcoal font-bold text-right">{{ $ngo['category'] }}</span>
                            </div>
                            
                            <div class="flex justify-between pb-2">
                                <span class="text-charcoal-light font-medium">NGO</span>
                                <span class="text-charcoal font-bold text-right">{{ $ngo['name'] }}</span>
                            </div>
                        </div>
                        
                        <div class="flex gap-4">
                            <button type="button" @click="showReview = false" class="flex-1 px-4 py-3 bg-ivory text-charcoal hover:bg-gold/20 rounded-xl font-bold transition-colors">Edit</button>
                            <button type="button" @click="confirmContribution" class="flex-1 px-4 py-3 bg-forest text-ivory hover:bg-forest/90 rounded-xl font-bold transition-colors shadow-md">Confirm</button>
                        </div>
                    </div>
                </div>

                <!-- Main Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-[1.3fr_1fr] gap-12 lg:gap-16 items-start">
                    
                    <!-- LEFT COLUMN -->
                    <div class="w-full space-y-12">
                        
                        <!-- 04. CAUSE INFORMATION -->
                        <div class="bg-white rounded-3xl border border-gold/20 shadow-sm overflow-hidden">
                            <div class="p-8">
                                <span class="text-xs font-bold text-gold uppercase tracking-wider mb-2 block">Supporting</span>
                                <h2 class="text-3xl md:text-4xl font-serif text-forest mb-6">{{ $ngo['category'] }}</h2>
                                
                                <div class="w-full aspect-[16/9] md:aspect-[21/9] lg:aspect-[16/9] rounded-2xl overflow-hidden bg-forest/5 relative mb-8">
                                    <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Supporting {{ $ngo['category'] }}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent pointer-events-none"></div>
                                </div>
                                
                                <div class="prose prose-lg text-charcoal-light font-light leading-relaxed max-w-none">
                                    <p class="text-xl text-charcoal font-medium border-l-4 border-gold pl-4 py-1 mb-6">
                                        Help provide essential resources and support to those who need it most in our communities.
                                    </p>
                                    <p>
                                        Your contribution to {{ $ngo['category'] }} directly fuels grassroots efforts. {{ $ngo['description'] }} We believe that collective action forms the backbone of sustainable community development.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- 05. NGO SECTION -->
                        <div class="bg-white p-8 rounded-3xl border border-gold/20 shadow-sm">
                            <h3 class="text-sm font-bold text-gold uppercase tracking-wider mb-6">Organized By</h3>
                            
                            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 mb-6">
                                <div class="w-16 h-16 bg-ivory border border-gold/30 rounded-2xl flex items-center justify-center shrink-0 shadow-sm text-3xl font-serif text-forest">
                                    {{ substr($ngo['name'], 0, 1) }}
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <h4 class="font-serif text-forest text-xl">{{ $ngo['name'] }}</h4>
                                        @if($ngo['verified'])
                                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-2 text-sm text-charcoal-light mb-2">
                                        <svg class="w-4 h-4 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                        <span>{{ $ngo['location'] }}</span>
                                    </div>
                                    <p class="text-sm text-charcoal-light leading-relaxed">A dedicated non-profit organization working to create positive community impact through meaningful initiatives.</p>
                                </div>
                            </div>
                            
                            <a href="/ngos/{{ $ngo['id'] }}" class="inline-flex items-center justify-center gap-2 w-full sm:w-auto bg-white border border-forest text-forest hover:bg-forest hover:text-ivory px-6 py-3 rounded-xl text-sm font-bold transition-all group">
                                View NGO Profile 
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                        
                        <!-- 06. FUNDRAISING PROGRESS -->
                        <div class="bg-white p-8 rounded-3xl border border-gold/20 shadow-sm">
                            <h3 class="text-2xl font-serif text-forest mb-8">Fundraising Progress</h3>
                            
                            <div class="flex flex-wrap justify-between items-end mb-4 gap-4">
                                <div>
                                    <span class="text-3xl md:text-4xl font-serif text-forest block mb-1">₹3,75,000</span>
                                    <span class="text-xs font-bold text-gold uppercase tracking-wider">Raised</span>
                                </div>
                                <div class="text-center hidden sm:block">
                                    <span class="text-2xl md:text-3xl font-serif text-forest block mb-1">75%</span>
                                    <span class="text-xs font-bold text-gold uppercase tracking-wider">Funded</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-xl md:text-2xl font-serif text-charcoal-light block mb-1">₹5,00,000</span>
                                    <span class="text-xs font-bold text-charcoal-light uppercase tracking-wider">Goal</span>
                                </div>
                            </div>
                            
                            <div class="w-full bg-ivory rounded-full h-4 mb-4 border border-gold/20 overflow-hidden shadow-inner">
                                <div class="bg-forest h-full rounded-full relative" style="width: 75%">
                                    <div class="absolute inset-0 bg-white/20 w-full h-full" style="background-image: linear-gradient(45deg, rgba(255,255,255,0.15) 25%, transparent 25%, transparent 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, transparent 75%, transparent); background-size: 1rem 1rem;"></div>
                                </div>
                            </div>
                            
                            <div class="flex justify-between items-center text-sm font-medium text-charcoal-light">
                                <span class="sm:hidden">75% Funded</span>
                                <span class="ml-auto">₹1,25,000 remaining</span>
                            </div>
                        </div>
                        
                    </div>
                    
                    <!-- RIGHT COLUMN: FORM -->
                    <div class="w-full">
                        <div class="bg-white p-6 md:p-8 rounded-3xl border border-gold/20 shadow-lg lg:sticky lg:top-24 z-10">
                            <div class="mb-8">
                                <h2 class="text-3xl font-serif text-forest mb-2">Make a Contribution</h2>
                                <p class="text-sm text-charcoal-light">Choose how you'd like to support this cause.</p>
                            </div>
                            
                            <!-- 07. CONTRIBUTION TYPE -->
                            <div class="mb-8">
                                <label class="block text-sm font-bold text-charcoal uppercase tracking-wider mb-4">What would you like to contribute?</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <template x-for="option in ['money', 'food', 'clothes', 'items']">
                                        <button 
                                            @click="type = option"
                                            type="button"
                                            :class="type === option ? 'bg-forest/5 border-forest text-forest ring-1 ring-forest' : 'bg-white border-gold/30 text-charcoal hover:border-forest hover:text-forest'"
                                            class="py-3 px-4 border rounded-xl font-bold transition-all text-sm capitalize flex items-center justify-center gap-2 relative overflow-hidden"
                                        >
                                            <span x-text="option === 'items' ? 'Useful Items' : option"></span>
                                            <div x-show="type === option" class="absolute top-1 right-1 w-2 h-2 rounded-full bg-forest"></div>
                                        </button>
                                    </template>
                                </div>
                            </div>
                            
                            <form @submit.prevent="handleContinue">
                                
                                <!-- 08. MONEY FIELDS -->
                                <div x-show="type === 'money'" x-collapse>
                                    <div class="mb-8">
                                        <label class="block text-sm font-bold text-charcoal uppercase tracking-wider mb-4">Contribution Amount</label>
                                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-4">
                                            <template x-for="preset in [500, 1000, 2000, 5000]">
                                                <button 
                                                    type="button"
                                                    @click="amount = preset; isCustomAmount = false"
                                                    :class="amount === preset && !isCustomAmount ? 'bg-forest text-white border-forest shadow-md' : 'bg-white text-forest border-gold/30 hover:border-forest hover:bg-forest/5'"
                                                    class="py-3 border rounded-xl font-bold transition-all text-sm"
                                                    x-text="'₹' + preset.toLocaleString('en-IN')"
                                                ></button>
                                            </template>
                                        </div>
                                        <div>
                                            <button 
                                                type="button"
                                                @click="isCustomAmount = true; $nextTick(() => $refs.customAmount.focus())"
                                                :class="isCustomAmount ? 'bg-forest/5 border-forest ring-1 ring-forest text-forest' : 'bg-white border-gold/30 hover:border-forest text-forest'"
                                                class="w-full py-3 px-4 border rounded-xl transition-all text-left flex items-center mb-3"
                                            >
                                                <div class="flex-1 text-sm font-bold">Other Amount</div>
                                                <div x-show="isCustomAmount" class="w-3 h-3 rounded-full bg-forest"></div>
                                            </button>
                                            <div x-show="isCustomAmount" x-collapse>
                                                <div class="relative">
                                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-charcoal-light font-medium">₹</span>
                                                    <input 
                                                        x-ref="customAmount"
                                                        type="number" 
                                                        x-model.number="amount"
                                                        min="1" 
                                                        placeholder="Enter amount" 
                                                        class="w-full pl-8 pr-4 py-3.5 bg-ivory border border-gold/30 rounded-xl focus:ring-2 focus:ring-forest focus:border-transparent outline-none text-forest font-medium transition-all"
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- 09. FOOD FIELDS -->
                                <div x-show="type === 'food'" x-collapse>
                                    <div class="space-y-5 mb-8">
                                        <div>
                                            <label class="block text-xs font-bold text-charcoal uppercase tracking-wider mb-2">Food Type</label>
                                            <select class="w-full px-4 py-3.5 bg-ivory border border-gold/30 rounded-xl focus:ring-2 focus:ring-forest focus:border-transparent outline-none text-charcoal transition-all appearance-none cursor-pointer">
                                                <option>Rice / Grains</option>
                                                <option>Packaged Food</option>
                                                <option>Cooked Meals</option>
                                                <option>Groceries</option>
                                            </select>
                                        </div>
                                        <div class="grid grid-cols-2 gap-3">
                                            <div>
                                                <label class="block text-xs font-bold text-charcoal uppercase tracking-wider mb-2">Quantity</label>
                                                <input x-model="foodQuantity" type="number" min="1" class="w-full px-4 py-3.5 bg-ivory border border-gold/30 rounded-xl focus:ring-2 focus:ring-forest focus:border-transparent outline-none text-charcoal transition-all" placeholder="10">
                                              </div>
                                            <div>
                                                <label class="block text-xs font-bold text-charcoal uppercase tracking-wider mb-2">Unit</label>
                                                <select x-model="foodUnit" class="w-full px-4 py-3.5 bg-ivory border border-gold/30 rounded-xl focus:ring-2 focus:ring-forest focus:border-transparent outline-none text-charcoal transition-all appearance-none cursor-pointer">
                                                    <option>kg</option>
                                                    <option>packets</option>
                                                    <option>meals</option>
                                                    <option>boxes</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-charcoal uppercase tracking-wider mb-2">Delivery</label>
                                            <select class="w-full px-4 py-3.5 bg-ivory border border-gold/30 rounded-xl focus:ring-2 focus:ring-forest focus:border-transparent outline-none text-charcoal transition-all appearance-none cursor-pointer">
                                                <option>I will drop off at NGO center</option>
                                                <option>Request pickup</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- 10. CLOTHES FIELDS -->
                                <div x-show="type === 'clothes'" x-collapse>
                                    <div class="space-y-5 mb-8">
                                        <div>
                                            <label class="block text-xs font-bold text-charcoal uppercase tracking-wider mb-2">Clothing Type</label>
                                            <select class="w-full px-4 py-3.5 bg-ivory border border-gold/30 rounded-xl focus:ring-2 focus:ring-forest focus:border-transparent outline-none text-charcoal transition-all appearance-none cursor-pointer">
                                                <option>Children's Clothes</option>
                                                <option>Women's Clothes</option>
                                                <option>Men's Clothes</option>
                                                <option>Blankets</option>
                                                <option>Winter Wear</option>
                                            </select>
                                        </div>
                                        <div class="grid grid-cols-2 gap-3">
                                            <div>
                                                <label class="block text-xs font-bold text-charcoal uppercase tracking-wider mb-2">Quantity</label>
                                                <input x-model="clothesQuantity" type="number" min="1" class="w-full px-4 py-3.5 bg-ivory border border-gold/30 rounded-xl focus:ring-2 focus:ring-forest focus:border-transparent outline-none text-charcoal transition-all" placeholder="5">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-bold text-charcoal uppercase tracking-wider mb-2">Condition</label>
                                                <select class="w-full px-4 py-3.5 bg-ivory border border-gold/30 rounded-xl focus:ring-2 focus:ring-forest focus:border-transparent outline-none text-charcoal transition-all appearance-none cursor-pointer">
                                                    <option>New</option>
                                                    <option>Good Condition</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-charcoal uppercase tracking-wider mb-2">For</label>
                                            <select class="w-full px-4 py-3.5 bg-ivory border border-gold/30 rounded-xl focus:ring-2 focus:ring-forest focus:border-transparent outline-none text-charcoal transition-all appearance-none cursor-pointer">
                                                <option>Children</option>
                                                <option>Adults</option>
                                                <option>Elderly</option>
                                                <option>Any</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- 11. USEFUL ITEMS FIELDS -->
                                <div x-show="type === 'items'" x-collapse>
                                    <div class="space-y-5 mb-8">
                                        <div>
                                            <label class="block text-xs font-bold text-charcoal uppercase tracking-wider mb-2">Item Name</label>
                                            <input x-model="itemName" type="text" class="w-full px-4 py-3.5 bg-ivory border border-gold/30 rounded-xl focus:ring-2 focus:ring-forest focus:border-transparent outline-none text-charcoal transition-all" placeholder="e.g. School Books, Furniture">
                                        </div>
                                        <div class="grid grid-cols-2 gap-3">
                                            <div>
                                                <label class="block text-xs font-bold text-charcoal uppercase tracking-wider mb-2">Quantity</label>
                                                <input x-model="itemQuantity" type="number" min="1" class="w-full px-4 py-3.5 bg-ivory border border-gold/30 rounded-xl focus:ring-2 focus:ring-forest focus:border-transparent outline-none text-charcoal transition-all" placeholder="1">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-bold text-charcoal uppercase tracking-wider mb-2">Condition</label>
                                                <select class="w-full px-4 py-3.5 bg-ivory border border-gold/30 rounded-xl focus:ring-2 focus:ring-forest focus:border-transparent outline-none text-charcoal transition-all appearance-none cursor-pointer">
                                                    <option>New</option>
                                                    <option>Good Condition</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-charcoal uppercase tracking-wider mb-2">Description</label>
                                            <textarea rows="2" class="w-full px-4 py-3 bg-ivory border border-gold/30 rounded-xl focus:ring-2 focus:ring-forest focus:border-transparent outline-none text-charcoal transition-all resize-none" placeholder="Describe the item..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- 12. CONTRIBUTOR INFORMATION -->
                                <div class="pt-8 border-t border-gold/20 mb-8">
                                    <h3 class="text-xl font-serif text-forest mb-6">Your Information</h3>
                                    
                                    <div class="space-y-5">
                                        <div>
                                            <label class="block text-xs font-bold text-charcoal uppercase tracking-wider mb-2">Full Name</label>
                                            <input type="text" required class="w-full px-4 py-3.5 bg-ivory border border-gold/30 rounded-xl focus:ring-2 focus:ring-forest focus:border-transparent outline-none text-charcoal transition-all" placeholder="Enter your name">
                                        </div>
                                        
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                            <div>
                                                <label class="block text-xs font-bold text-charcoal uppercase tracking-wider mb-2">Email Address</label>
                                                <input type="email" required class="w-full px-4 py-3.5 bg-ivory border border-gold/30 rounded-xl focus:ring-2 focus:ring-forest focus:border-transparent outline-none text-charcoal transition-all" placeholder="Enter your email">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-bold text-charcoal uppercase tracking-wider mb-2">Phone Number</label>
                                                <input type="tel" class="w-full px-4 py-3.5 bg-ivory border border-gold/30 rounded-xl focus:ring-2 focus:ring-forest focus:border-transparent outline-none text-charcoal transition-all" placeholder="Enter your phone number">
                                            </div>
                                        </div>
                                        
                                        <label class="flex items-center gap-3 cursor-pointer group pt-2">
                                            <div class="relative flex items-center justify-center">
                                                <input type="checkbox" class="peer sr-only">
                                                <div class="w-5 h-5 border-2 border-gold/50 rounded bg-white peer-checked:bg-forest peer-checked:border-forest transition-colors"></div>
                                                <svg class="absolute w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-opacity pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                            </div>
                                            <span class="text-sm font-medium text-charcoal group-hover:text-forest transition-colors">Make my contribution anonymous</span>
                                        </label>
                                        
                                        <div class="pt-2">
                                            <label class="block text-xs font-bold text-charcoal uppercase tracking-wider mb-2">Message to the NGO (Optional)</label>
                                            <textarea rows="3" class="w-full px-4 py-3 bg-ivory border border-gold/30 rounded-xl focus:ring-2 focus:ring-forest focus:border-transparent outline-none text-charcoal transition-all resize-none" placeholder="Write a short message..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- 13. SUMMARY & CTA -->
                                <div class="bg-forest/5 rounded-2xl p-6 mb-6 border border-forest/10">
                                    <h4 class="text-sm font-bold text-forest uppercase tracking-wider mb-4 border-b border-forest/10 pb-2">Contribution Summary</h4>
                                    
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-sm text-charcoal-light font-medium">Type</span>
                                        <span class="text-sm font-bold text-charcoal capitalize" x-text="type === 'items' ? 'Useful Items' : type"></span>
                                    </div>
                                    
                                    <!-- Dynamic Summary Values -->
                                    <template x-if="type === 'money'">
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-charcoal-light font-medium">Amount</span>
                                            <span class="text-lg font-serif font-bold text-forest" x-text="'₹' + amount.toLocaleString('en-IN')"></span>
                                        </div>
                                    </template>
                                    
                                    <template x-if="type === 'food'">
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-charcoal-light font-medium">Quantity</span>
                                            <span class="text-sm font-bold text-charcoal" x-text="foodQuantity + ' ' + foodUnit"></span>
                                        </div>
                                    </template>
                                    
                                    <template x-if="type === 'clothes'">
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-charcoal-light font-medium">Quantity</span>
                                            <span class="text-sm font-bold text-charcoal" x-text="clothesQuantity + ' items'"></span>
                                        </div>
                                    </template>
                                    
                                    <template x-if="type === 'items'">
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-charcoal-light font-medium">Item</span>
                                            <span class="text-sm font-bold text-charcoal" x-text="itemName || 'Not specified'"></span>
                                        </div>
                                    </template>
                                    
                                    <div class="flex justify-between items-center mt-3 pt-3 border-t border-forest/10">
                                        <span class="text-sm text-charcoal-light font-medium">Supporting</span>
                                        <span class="text-sm font-bold text-charcoal text-right">{{ $ngo['name'] }}</span>
                                    </div>
                                </div>
                                
                                <button type="submit" class="w-full bg-forest text-ivory hover:bg-forest/90 px-6 py-4 rounded-xl font-bold transition-all shadow-md text-lg flex items-center justify-center gap-2 group">
                                    Continue 
                                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </button>
                                
                                <div class="mt-6 flex flex-wrap justify-center gap-x-6 gap-y-2 text-xs text-charcoal-light font-medium">
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                        Verified NGO
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                        Transparent fundraising
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                        Multiple ways to contribute
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- 14. HOW YOUR CONTRIBUTION HELPS -->
    <section class="py-16 md:py-24 bg-white border-t border-gold/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 max-w-2xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-serif text-forest mb-4">How Your Contribution Helps</h2>
                <p class="text-charcoal-light text-lg">Every contribution can create meaningful change in the lives of those who need it.</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-ivory border border-gold/20 p-8 rounded-3xl text-center hover:-translate-y-1 hover:shadow-md transition-all">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm mx-auto mb-4 text-forest font-bold font-serif text-xl">₹</div>
                    <h3 class="text-xl font-serif text-forest mb-2">₹500</h3>
                    <p class="text-sm text-charcoal-light leading-relaxed">Can help provide essential educational materials and basic necessities.</p>
                </div>
                
                <div class="bg-ivory border border-gold/20 p-8 rounded-3xl text-center hover:-translate-y-1 hover:shadow-md transition-all">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm mx-auto mb-4 text-forest">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-serif text-forest mb-2">FOOD</h3>
                    <p class="text-sm text-charcoal-light leading-relaxed">Can help provide nutritious meals to families facing hardship.</p>
                </div>
                
                <div class="bg-ivory border border-gold/20 p-8 rounded-3xl text-center hover:-translate-y-1 hover:shadow-md transition-all">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm mx-auto mb-4 text-forest">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                    </div>
                    <h3 class="text-xl font-serif text-forest mb-2">CLOTHES</h3>
                    <p class="text-sm text-charcoal-light leading-relaxed">Can help provide warm clothing and basic weather protection.</p>
                </div>
                
                <div class="bg-ivory border border-gold/20 p-8 rounded-3xl text-center hover:-translate-y-1 hover:shadow-md transition-all">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm mx-auto mb-4 text-forest">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <h3 class="text-xl font-serif text-forest mb-2">USEFUL ITEMS</h3>
                    <p class="text-sm text-charcoal-light leading-relaxed">Can help communities access practical resources and educational tools.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 15. WHY KARMASETU -->
    <section class="py-16 md:py-24 bg-forest text-ivory border-t border-gold/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-serif mb-4 text-white">Why Contribute Through KarmaSetu?</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center max-w-5xl mx-auto">
                <div>
                    <div class="w-16 h-16 rounded-full bg-white/10 flex items-center justify-center mx-auto mb-6 text-gold">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-white">Verified NGOs</h3>
                    <p class="text-ivory/80 font-light leading-relaxed">All listed NGOs undergo a vetting process before being publicly listed to ensure your contribution reaches the right hands.</p>
                </div>
                
                <div>
                    <div class="w-16 h-16 rounded-full bg-white/10 flex items-center justify-center mx-auto mb-6 text-gold">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-white">Clear Fundraising</h3>
                    <p class="text-ivory/80 font-light leading-relaxed">See precise fundraising goals and real-time progress for campaigns to understand exactly what is needed.</p>
                </div>
                
                <div>
                    <div class="w-16 h-16 rounded-full bg-white/10 flex items-center justify-center mx-auto mb-6 text-gold">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-white">Multiple Ways to Help</h3>
                    <p class="text-ivory/80 font-light leading-relaxed">Money is not the only way to contribute. Help directly with food, clothes, or other useful items.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Alpine.js Component Logic -->
    <script>
        function contributionApp() {
            return {
                type: 'money',
                amount: 1000,
                isCustomAmount: false,
                
                foodQuantity: 10,
                foodUnit: 'kg',
                
                clothesQuantity: 5,
                
                itemName: '',
                itemQuantity: 1,
                
                showReview: false,
                
                handleContinue() {
                    // Basic frontend validation for useful items
                    if (this.type === 'items' && !this.itemName.trim()) {
                        alert('Please enter an item name to contribute.');
                        return;
                    }
                    this.showReview = true;
                },
                
                confirmContribution() {
                    alert('This is Phase 1 (Frontend Only). Your ' + this.type + ' contribution would be submitted here.');
                    this.showReview = false;
                }
            }
        }
    </script>
@endsection
