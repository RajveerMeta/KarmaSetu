@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-200px)] flex items-center justify-center py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white p-8 sm:p-10 rounded-2xl shadow-sm border border-gold/20 relative overflow-hidden">
        
        <!-- Subtle decorative element -->
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-gold/10 rounded-full blur-xl z-0 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-24 h-24 bg-forest/5 rounded-full blur-xl z-0 pointer-events-none"></div>

        <div class="relative z-10">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-serif font-bold text-forest mb-2">Welcome Back</h1>
                <p class="text-charcoal-light">Login to continue your KarmaSetu journey.</p>
            </div>
            
            <form id="LoginForm" class="space-y-6" action="#" method="POST" novalidate>
                @csrf
                
                <div id="loginErrorMsg" class="hidden mb-4 p-4 rounded-lg bg-red-50 border border-red-200">
                    <p class="text-sm font-medium text-red-600">Invalid demo credentials.</p>
                </div>
                
                <div class="space-y-5">
                    <div>
                        <label for="email" class="block text-sm font-medium text-charcoal mb-1">Email Address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required 
                            class="appearance-none block w-full px-4 py-3 border border-charcoal/20 rounded-lg text-charcoal placeholder-charcoal/40 focus:outline-none focus:ring-1 focus:ring-gold focus:border-gold transition-colors sm:text-sm bg-ivory/30 focus:bg-white" 
                            placeholder="Enter your email address">
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-charcoal mb-1">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required 
                            class="appearance-none block w-full px-4 py-3 border border-charcoal/20 rounded-lg text-charcoal placeholder-charcoal/40 focus:outline-none focus:ring-1 focus:ring-gold focus:border-gold transition-colors sm:text-sm bg-ivory/30 focus:bg-white" 
                            placeholder="Enter your password">
                    </div>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" 
                            class="h-4 w-4 text-forest focus:ring-gold border-charcoal/30 rounded cursor-pointer transition-colors accent-forest">
                        <label for="remember" class="ml-2 block text-sm text-charcoal cursor-pointer select-none">
                            Remember Me
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="/forgot-password" class="font-medium text-forest hover:text-gold transition-colors">
                            Forgot Password?
                        </a>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-full text-white bg-forest hover:bg-forest-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-forest transition-all shadow-md hover:shadow-lg">
                        Login
                    </button>
                </div>
            </form>
            
            <div class="text-center mt-8 pt-6 border-t border-charcoal/10">
                <p class="text-sm text-charcoal">
                    Don't have an account? 
                    <a href="/register" class="font-bold text-forest hover:text-gold transition-colors ml-1">
                        Create an account
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    // Phase 1 Frontend Demo Logic
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('demoLoginForm');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const errorMsg = document.getElementById('loginErrorMsg');

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            errorMsg.classList.add('hidden');
            emailInput.classList.remove('border-red-500');
            passwordInput.classList.remove('border-red-500');

            if (emailInput.value === 'demo@karmasetu.test' && passwordInput.value === 'Demo@12345') {
                // Successful demo login
                const demoUser = {
                    name: "Rajveer",
                    email: "demo@karmasetu.test",
                    role: "user",
                    karmaPoints: 1280
                };
                
                localStorage.setItem('karmaSetuDemoUser', JSON.stringify(demoUser));
                window.location.href = '/user/dashboard';
            } else {
                // Failed login
                errorMsg.classList.remove('hidden');
                emailInput.classList.add('border-red-500');
                passwordInput.classList.add('border-red-500');
            }
        });
        
        // Clear errors on input
        [emailInput, passwordInput].forEach(input => {
            input.addEventListener('input', function() {
                errorMsg.classList.add('hidden');
                emailInput.classList.remove('border-red-500');
                passwordInput.classList.remove('border-red-500');
            });
        });
    });
</script>
@endsection
