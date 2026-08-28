@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-200px)] flex items-center justify-center py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white p-8 sm:p-10 rounded-2xl shadow-sm border border-gold/20 relative overflow-hidden">
        
        <!-- Subtle decorative element -->
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-gold/10 rounded-full blur-xl z-0 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-24 h-24 bg-forest/5 rounded-full blur-xl z-0 pointer-events-none"></div>

        <div class="relative z-10">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-serif font-bold text-forest mb-2">Create Your Account</h1>
                <p class="text-charcoal-light">Join KarmaSetu and start making a difference.</p>
            </div>
            
            <form id="registerForm" class="space-y-6" action="#" method="POST" novalidate>
                @csrf
                
                <div class="space-y-5">
                    <div class="relative pb-1">
                        <label for="name" class="block text-sm font-medium text-charcoal mb-1">Full Name</label>
                        <input id="name" name="name" type="text" autocomplete="name" required 
                            class="appearance-none block w-full px-4 py-3 border border-charcoal/20 rounded-lg text-charcoal placeholder-charcoal/40 focus:outline-none focus:ring-1 focus:ring-gold focus:border-gold transition-colors sm:text-sm bg-ivory/30 focus:bg-white" 
                            placeholder="Enter your full name">
                        <p class="absolute -bottom-4 left-1 text-[11px] text-red-500 hidden" id="nameError">Full name is required.</p>
                    </div>

                    <div class="relative pb-1">
                        <label for="email" class="block text-sm font-medium text-charcoal mb-1">Email Address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required 
                            class="appearance-none block w-full px-4 py-3 border border-charcoal/20 rounded-lg text-charcoal placeholder-charcoal/40 focus:outline-none focus:ring-1 focus:ring-gold focus:border-gold transition-colors sm:text-sm bg-ivory/30 focus:bg-white" 
                            placeholder="Enter your email address">
                        <p class="absolute -bottom-4 left-1 text-[11px] text-red-500 hidden" id="emailError">Please enter a valid email address.</p>
                    </div>

                    <div class="relative pb-1">
                        <label for="phone" class="block text-sm font-medium text-charcoal mb-1">Phone Number</label>
                        <input id="phone" name="phone" type="tel" autocomplete="tel" required 
                            class="appearance-none block w-full px-4 py-3 border border-charcoal/20 rounded-lg text-charcoal placeholder-charcoal/40 focus:outline-none focus:ring-1 focus:ring-gold focus:border-gold transition-colors sm:text-sm bg-ivory/30 focus:bg-white" 
                            placeholder="Enter your phone number">
                        <p class="absolute -bottom-4 left-1 text-[11px] text-red-500 hidden" id="phoneError">Please enter a valid phone number.</p>
                    </div>
                    
                    <div class="relative pb-1">
                        <label for="password" class="block text-sm font-medium text-charcoal mb-1">Password</label>
                        <input id="password" name="password" type="password" autocomplete="new-password" required minlength="8"
                            class="appearance-none block w-full px-4 py-3 border border-charcoal/20 rounded-lg text-charcoal placeholder-charcoal/40 focus:outline-none focus:ring-1 focus:ring-gold focus:border-gold transition-colors sm:text-sm bg-ivory/30 focus:bg-white" 
                            placeholder="Create a password">
                        <p class="absolute -bottom-4 left-1 text-[11px] text-red-500 hidden" id="passwordError">Password must be at least 8 characters.</p>
                    </div>

                    <div class="relative pb-1">
                        <label for="password_confirmation" class="block text-sm font-medium text-charcoal mb-1">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required minlength="8"
                            class="appearance-none block w-full px-4 py-3 border border-charcoal/20 rounded-lg text-charcoal placeholder-charcoal/40 focus:outline-none focus:ring-1 focus:ring-gold focus:border-gold transition-colors sm:text-sm bg-ivory/30 focus:bg-white" 
                            placeholder="Confirm your password">
                        <p class="absolute -bottom-4 left-1 text-[11px] text-red-500 hidden" id="confirmPasswordError">Passwords do not match.</p>
                    </div>
                </div>

              

                <div class="pt-2">
                    <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-full text-white bg-forest hover:bg-forest-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-forest transition-all shadow-md hover:shadow-lg">
                        Create Account
                    </button>
                </div>
            </form>
            
            <div class="text-center mt-8 pt-6 border-t border-charcoal/10">
                <p class="text-sm text-charcoal">
                    Already have an account? 
                    <a href="/login" class="font-bold text-forest hover:text-gold transition-colors ml-1">
                        Login
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('registerForm');
        
        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Hide all errors and remove error borders
            document.querySelectorAll('p[id$="Error"]').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('input').forEach(el => el.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500'));

            // Show error helper function
            const showError = (inputId, errorId) => {
                document.getElementById(errorId).classList.remove('hidden');
                const inputEl = document.getElementById(inputId);
                inputEl.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
                isValid = false;
            };

            // Validate Name
            const name = document.getElementById('name');
            if (!name.value.trim()) {
                showError('name', 'nameError');
            }

            // Validate Email
            const email = document.getElementById('email');
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email.value.trim() || !emailPattern.test(email.value)) {
                showError('email', 'emailError');
            }

            // Validate Phone
            const phone = document.getElementById('phone');
            const phonePattern = /^[0-9\-\+\s]{7,15}$/; 
            if (!phone.value.trim() || !phonePattern.test(phone.value)) {
                showError('phone', 'phoneError');
            }

            // Validate Password
            const password = document.getElementById('password');
            if (!password.value || password.value.length < 8) {
                showError('password', 'passwordError');
            }

            // Validate Confirm Password
            const confirmPassword = document.getElementById('password_confirmation');
            if (!confirmPassword.value || password.value !== confirmPassword.value) {
                showError('password_confirmation', 'confirmPasswordError');
            }

            // Validate Terms
            const terms = document.getElementById('terms');
            if (!terms.checked) {
                document.getElementById('termsError').classList.remove('hidden');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
            }
        });

        // Real-time clear errors on input
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
                const errorId = this.id === 'password_confirmation' ? 'confirmPasswordError' : this.id + 'Error';
                const errorEl = document.getElementById(errorId);
                if (errorEl) errorEl.classList.add('hidden');
            });
        });
        
        document.getElementById('terms').addEventListener('change', function() {
            document.getElementById('termsError').classList.add('hidden');
        });
    });
</script>
@endsection
