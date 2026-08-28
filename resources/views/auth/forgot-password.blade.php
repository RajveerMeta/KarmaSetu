@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-200px)] flex items-center justify-center py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white p-8 sm:p-10 rounded-2xl shadow-sm border border-gold/20 relative overflow-hidden">
        
        <!-- Subtle decorative element -->
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-gold/10 rounded-full blur-xl z-0 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-24 h-24 bg-forest/5 rounded-full blur-xl z-0 pointer-events-none"></div>

        <!-- FORM STATE -->
        <div class="relative z-10" id="formState">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-serif font-bold text-forest mb-2">Forgot Your Password?</h1>
                <p class="text-charcoal-light">No worries. Enter your email address and we'll send you a link to reset your password.</p>
            </div>
            
            <form id="forgotPasswordForm" class="space-y-6" action="#" method="POST" novalidate>
                @csrf
                
                <div class="space-y-5">
                    <div class="relative pb-1">
                        <label for="email" class="block text-sm font-medium text-charcoal mb-1">Email Address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required 
                            class="appearance-none block w-full px-4 py-3 border border-charcoal/20 rounded-lg text-charcoal placeholder-charcoal/40 focus:outline-none focus:ring-1 focus:ring-gold focus:border-gold transition-colors sm:text-sm bg-ivory/30 focus:bg-white" 
                            placeholder="Enter your email address">
                        <p class="absolute -bottom-4 left-1 text-[11px] text-red-500 hidden" id="emailError">This field is required.</p>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-full text-white bg-forest hover:bg-forest-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-forest transition-all shadow-md hover:shadow-lg">
                        Send Reset Link
                    </button>
                </div>
            </form>
            
            <div class="text-center mt-8 pt-6 border-t border-charcoal/10">
                <p class="text-sm text-charcoal">
                    Remember your password? 
                    <a href="/login" class="font-bold text-forest hover:text-gold transition-colors ml-1">
                        Login
                    </a>
                </p>
            </div>
        </div>

        <!-- SUCCESS STATE -->
        <div class="relative z-10 hidden" id="successState">
            <div class="text-center mb-8">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-forest/10 mb-6">
                    <svg class="h-8 w-8 text-forest" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-serif font-bold text-forest mb-2">Check Your Email</h1>
                <p class="text-charcoal-light">If an account exists with this email address, we've sent instructions to reset your password.</p>
            </div>
            
            <div class="space-y-4 pt-2">
                <a href="/login" 
                    class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-full text-white bg-forest hover:bg-forest-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-forest transition-all shadow-md hover:shadow-lg">
                    Back to Login
                </a>
                
                <button type="button" id="tryAnotherEmailBtn"
                    class="w-full flex justify-center py-3 px-4 border border-charcoal/20 text-sm font-bold rounded-full text-charcoal bg-white hover:bg-ivory focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-charcoal/20 transition-all shadow-sm hover:shadow-md">
                    Try another email
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('forgotPasswordForm');
        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('emailError');
        const formState = document.getElementById('formState');
        const successState = document.getElementById('successState');
        const tryAnotherBtn = document.getElementById('tryAnotherEmailBtn');
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            let isValid = true;
            
            emailError.classList.add('hidden');
            emailInput.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (!emailInput.value.trim()) {
                emailError.textContent = 'This field is required.';
                emailError.classList.remove('hidden');
                emailInput.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
                isValid = false;
            } else if (!emailPattern.test(emailInput.value)) {
                emailError.textContent = 'Please enter a valid email address.';
                emailError.classList.remove('hidden');
                emailInput.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
                isValid = false;
            }

            if (isValid) {
                // Front-end simulation of successful email processing
                formState.classList.add('hidden');
                successState.classList.remove('hidden');
            }
        });

        emailInput.addEventListener('input', function() {
            this.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
            emailError.classList.add('hidden');
        });
        
        tryAnotherBtn.addEventListener('click', function() {
            emailInput.value = '';
            successState.classList.add('hidden');
            formState.classList.remove('hidden');
            emailInput.focus();
        });
    });
</script>
@endsection
