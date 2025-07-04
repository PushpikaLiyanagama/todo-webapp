<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.10.21/build/spline-viewer.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>
    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .input-focus {
            transition: all 0.3s ease;
        }
        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .btn-hover {
            transition: all 0.3s ease;
        }
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
        }
        spline-viewer {
            width: 100%;
            height: 100vh;
            border-radius: 0;
            transform: scale(1.5);
            transform-origin: center;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        .status-message {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.2);
            color: #059669;
        }
        #particles-js {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
    </style>
</head>
<body class="min-h-screen gradient-bg">
    <!-- Particles Background -->
    <div id="particles-js"></div>
    
    <div class="flex min-h-screen relative z-10">
        <!-- Left Column - Login Form -->
        <div class="w-1/2 flex items-center justify-center p-8">
            <div class="form-container rounded-2xl shadow-2xl p-8 w-full max-w-md">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Welcome Back</h1>
                    <p class="text-gray-600">Sign in to your account</p>
                </div>

                <!-- Session Status Message -->
                <div id="status-message" class="status-message rounded-lg p-3 mb-4 text-sm hidden">
                    <!-- Status messages will be displayed here -->
                </div>

                <form method="POST" action="/login" class="space-y-6">
                    <!-- CSRF Token -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrf-token">
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email
                        </label>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            required 
                            autofocus 
                            autocomplete="username"
                            class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="Enter your email address"
                        />
                        <div class="text-red-500 text-sm mt-1" id="email-error"></div>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="current-password"
                            class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="Enter your password"
                        />
                        <div class="text-red-500 text-sm mt-1" id="password-error"></div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input 
                            id="remember_me" 
                            type="checkbox" 
                            name="remember" 
                            class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                        />
                        <label for="remember_me" class="ml-2 text-sm text-gray-600">
                            Remember me
                        </label>
                    </div>

                    <!-- Submit Button and Links -->
                    <div class="flex flex-col space-y-4">
                        <button 
                            type="submit" 
                            class="btn-hover w-full bg-indigo-600 text-white py-3 px-6 rounded-lg font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            Log in
                        </button>
                        
                        <div class="flex justify-between items-center text-sm">
                            <a 
                                href="/password/reset" 
                                class="text-indigo-600 hover:text-indigo-800 transition-colors duration-200"
                            >
                                Forgot your password?
                            </a>
                            <a 
                                href="/register" 
                                class="text-indigo-600 hover:text-indigo-800 transition-colors duration-200"
                            >
                                Need an account?
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Column - Spline 3D Scene -->
        <div class="w-1/2 relative overflow-hidden">
            <div class="absolute inset-0 flex items-center justify-center">
                <spline-viewer url="https://prod.spline.design/aabFvbmIHPkijvZn/scene.splinecode"></spline-viewer>
            </div>
            
            <!-- Overlay content on Spline -->
            
        </div>
    </div>

    <script>
        // Get CSRF token from meta tag or generate via JavaScript
        function getCSRFToken() {
            const metaToken = document.querySelector('meta[name="csrf-token"]');
            if (metaToken) {
                return metaToken.getAttribute('content');
            }
            // If no meta tag, try to get from Laravel (this requires the page to be served by Laravel)
            return document.getElementById('csrf-token').value;
        }

        // Display status message if needed
        function showStatusMessage(message) {
            const statusElement = document.getElementById('status-message');
            statusElement.textContent = message;
            statusElement.classList.remove('hidden');
        }

        // Example: Show status message (you can call this based on URL parameters or server response)
        // showStatusMessage('Password reset link sent to your email!');

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Clear previous errors
            document.querySelectorAll('[id$="-error"]').forEach(el => el.textContent = '');

            let hasError = false;

            // Basic validation
            if (!email.trim()) {
                document.getElementById('email-error').textContent = 'Email is required';
                hasError = true;
            } else if (!/\S+@\S+\.\S+/.test(email)) {
                document.getElementById('email-error').textContent = 'Please enter a valid email';
                hasError = true;
            }

            if (!password) {
                document.getElementById('password-error').textContent = 'Password is required';
                hasError = true;
            }

            if (hasError) {
                e.preventDefault();
            }
        });

        // Add floating label effect
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.classList.remove('focused');
                }
            });
        });

        // Handle remember me checkbox styling
        document.getElementById('remember_me').addEventListener('change', function() {
            if (this.checked) {
                this.parentElement.classList.add('text-indigo-600');
            } else {
                this.parentElement.classList.remove('text-indigo-600');
            }
        });

        // Initialize Particles.js
        particlesJS('particles-js', {
            particles: {
                number: {
                    value: 80,
                    density: {
                        enable: true,
                        value_area: 800
                    }
                },
                color: {
                    value: '#ffffff'
                },
                shape: {
                    type: 'circle',
                    stroke: {
                        width: 0,
                        color: '#000000'
                    },
                    polygon: {
                        nb_sides: 5
                    }
                },
                opacity: {
                    value: 0.5,
                    random: false,
                    anim: {
                        enable: false,
                        speed: 1,
                        opacity_min: 0.1,
                        sync: false
                    }
                },
                size: {
                    value: 3,
                    random: true,
                    anim: {
                        enable: false,
                        speed: 40,
                        size_min: 0.1,
                        sync: false
                    }
                },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#ffffff',
                    opacity: 0.4,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 6,
                    direction: 'none',
                    random: false,
                    straight: false,
                    out_mode: 'out',
                    bounce: false,
                    attract: {
                        enable: false,
                        rotateX: 600,
                        rotateY: 1200
                    }
                }
            },
            interactivity: {
                detect_on: 'canvas',
                events: {
                    onhover: {
                        enable: true,
                        mode: 'repulse'
                    },
                    onclick: {
                        enable: true,
                        mode: 'push'
                    },
                    resize: true
                },
                modes: {
                    grab: {
                        distance: 400,
                        line_linked: {
                            opacity: 1
                        }
                    },
                    bubble: {
                        distance: 400,
                        size: 40,
                        duration: 2,
                        opacity: 8,
                        speed: 3
                    },
                    repulse: {
                        distance: 200,
                        duration: 0.4
                    },
                    push: {
                        particles_nb: 4
                    },
                    remove: {
                        particles_nb: 2
                    }
                }
            },
            retina_detect: true
        });
    </script>
</body>
</html>