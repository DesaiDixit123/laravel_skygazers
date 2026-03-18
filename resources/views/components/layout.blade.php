@slot('title')
    Sky Gazers Studio - Global Creative Studio
@endslot

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Sky Gazers Studio' }}</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo_skygazers.png') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome (for icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --bg-dark: #000000;
            --text-gold: #c5a059;
            --text-light: #ffffff;
            --sidebar-width: 280px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-light);
            margin: 0;
            overflow-x: hidden;
            width: 100%;
        }

        h1, h2, h3, .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .main-container {
            display: flex;
            min-height: 100vh;
        }

        .content-area {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s ease;
        }

        @media (max-width: 1024px) {
            .content-area {
                margin-left: 0;
            }
        }

        .container {
            width: 100%;
            max-width: 1400px; /* Slightly wider for luxury feel */
            margin: 0 auto;
            padding: 0 100px; /* Generous side padding as requested */
        }

        @media (max-width: 1200px) {
            .container {
                padding: 0 50px;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 30px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 15px;
            }
        }
    </style>
</head>
<body class="antialiased">
    <div class="main-container">
        <x-sidebar />
        
        <main class="content-area">
            {{ $slot }}
        </main>
        
        <x-floating-buttons />
    </div>
</body>
</html>
