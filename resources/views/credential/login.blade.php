<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dashlane</title>
    <link rel="icon" href="https://cdn.dashlane.com/logo/dashlane-icon.png" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex">
    <div class="w-3/4 bg-gray-100 flex flex-col justify-center px-16 relative">
        <img src="https://cdn.dashlane.com/logo/dashlane-icon.png" alt="Dashlane Logo" class="absolute top-6 left-6 w-20 rounded-full shadow-lg">
        <h1 class="text-4xl font-bold text-gray-800 mt-20">Welcome Back!</h1>
        <p class="text-lg text-gray-600 mt-4">Access your account securely and easily.</p>
    </div>

    <div class="w-1/4 flex flex-col justify-center px-10 py-6 relative">
        <div class="flex justify-end items-center space-x-2 absolute top-6 right-6">
            <p class="text-sm text-gray-600">Don't have an account?</p>
            <a href="/register" class="bg-teal-600 text-white px-4 py-2 rounded-lg hover:bg-teal-700 transition">Sign up</a>
        </div>

        <div id="login-section" class="w-full max-w-sm mx-auto space-y-4 mt-10">
            <h2 class="text-3xl font-semibold mb-2 text-gray-800">Sign in to Dashlane</h2>
            <p class="text-gray-600 text-sm mb-4">Enter your email to continue.</p>

            <form id="emailForm" class="space-y-4" onsubmit="showPasswordForm(event)">
                <label for="email" class="text-sm font-medium">Email</label>
                <input id="email" name="email" type="email" placeholder="Enter your email..." required 
                    class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="w-full bg-teal-600 text-white py-2 rounded-lg hover:bg-teal-700 transition">Next</button>
            </form>

            <form id="passwordForm" class="space-y-4 hidden" onsubmit="loginUser(event)">
                <label for="password" class="text-sm font-medium">Password</label>
                <input id="password" name="password" type="password" placeholder="Enter your password..." required 
                    class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="w-full bg-teal-600 text-white py-2 rounded-lg hover:bg-teal-700 transition">Sign in</button>
                <div class="flex justify-between items-center text-sm text-gray-600 mt-2">
                    <span>Forgot your password?</span>
                    <a href="/forgot-password" class="text-teal-600 hover:underline">Reset it here</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showPasswordForm(event) {
            event.preventDefault();
            const emailForm = document.getElementById('emailForm');
            const passwordForm = document.getElementById('passwordForm');

            emailForm.classList.add('opacity-0', 'transition-opacity', 'duration-300');
            setTimeout(() => {
                emailForm.classList.add('hidden');
                passwordForm.classList.remove('hidden');
                passwordForm.classList.add('opacity-0');
                setTimeout(() => passwordForm.classList.remove('opacity-0'), 100);
            }, 300);
        }

        function loginUser(event) {
            event.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            fetch('/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email, password })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '/dashboard';
                } else {
                    alert('Invalid credentials. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred during login.');
            });
        }
    </script>
</body>
</html>