    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - PSONE RENTAL</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <style>
            .bg-gaming {
                background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
            }

            .text-neon {
                color: #3b82f6;
                text-shadow: 0 0 10px rgba(59, 130, 246, 0.5);
            }

            .input-field {
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
            }

            .input-field:focus {
                background: rgba(255, 255, 255, 0.1);
                border-color: #3b82f6;
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            }

            .btn-primary {
                background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
                box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            }

            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
            }

            .gaming-overlay {
                background: linear-gradient(45deg, rgba(6, 182, 212, 0.3) 0%, rgba(59, 130, 246, 0.3) 50%, rgba(147, 51, 234, 0.3) 100%);
            }
        </style>
    </head>

    <body class="min-h-screen bg-gray-100 flex">

        <!-- Left Side - Gaming Image -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
            <div class="absolute inset-0 bg-gaming"></div>
            <div class="absolute inset-0 gaming-overlay"></div>
            <div class="relative z-10 flex items-center justify-center w-full">
                <div class="text-center text-white">
                    <div class="mb-8">
                        <svg class="mx-auto h-32 w-32 text-cyan-400" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M21.58 16.09l-1.09-7.66A3.996 3.996 0 0 0 16.53 5H7.47C5.48 5 3.79 6.46 3.51 8.43l-1.09 7.66A2 2 0 0 0 4.4 18.5h.6c.66 0 1.26-.33 1.62-.88L8 15.5h8l1.38 2.12c.36.55.96.88 1.62.88h.6a2 2 0 0 0 1.98-2.41zM7 10.5C7 9.67 7.67 9 8.5 9S10 9.67 10 10.5 9.33 12 8.5 12 7 11.33 7 10.5zm5.5 2.5h-1v-1h1v1zm0-2h-1v-1h1v1zm2.5 2.5c-.83 0-1.5-.67-1.5-1.5S14.17 9 15 9s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z" />
                        </svg>
                    </div>
                    <h1 class="text-4xl font-bold mb-4 text-neon">PSONE RENTAL</h1>
                    <p class="text-xl opacity-80">Experience Gaming Like Never Before</p>
                </div>
            </div>

            <!-- Gaming Elements -->
            <div class="absolute top-10 left-10 w-20 h-20 bg-cyan-400 rounded-full opacity-20 animate-pulse"></div>
            <div class="absolute bottom-20 right-20 w-16 h-16 bg-blue-500 rounded-full opacity-30 animate-bounce"></div>
            <div class="absolute top-1/3 right-10 w-12 h-12 bg-purple-500 rounded-full opacity-25 animate-ping"></div>
        </div>



        <!-- Right Side - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
            <div class="max-w-md w-full space-y-8">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->has('login'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                        {{ $errors->first('login') }}
                    </div>
                @endif

                <!-- Header -->
                <div class="text-center">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Login</h2>
                    <h3 class="text-2xl font-bold text-neon tracking-wider">PSONE RENTAL</h3>
                </div>

                <!-- Login Form -->
                <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <!-- Username Field -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                Username :
                            </label>
                            <input id="name" name="name" type="text" autocomplete="username" required
                                class="input-field appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 transition-all duration-200"
                                placeholder="Enter your username">
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                                Password :
                            </label>
                            <input id="password" name="password" type="password" autocomplete="current-password"
                                required
                                class="input-field appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 transition-all duration-200"
                                placeholder="Enter your password">
                        </div>
                    </div>
                     <!-- Forgot Password & Register Links -->
                    <div class="flex items-center justify-between text-sm">
                        <a href="" class="text-blue-600 hover:text-blue-500 transition-colors">
                            Forgot password?
                        </a>
                        <div class="text-gray-600">
                            Don't have a account? 
                            <a href="{{ route('daftar.index') }}" class="text-blue-600 hover:text-blue-500 transition-colors">
                                Register
                            </a>
                        </div>
                    </div>


                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="btn-primary group relative w-full flex justify-center py-3 px-4 border border-transparent text-white font-medium rounded-lg hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            Login
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </body>

    </html>
