<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DompetKu - Aplikasi Pencatatan Keuangan')</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS CDN (for immediate rendering & compatibility) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            900: '#064e3b',
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
        .stat-card-gradient-1 {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        }
        .stat-card-gradient-2 {
            background: linear-gradient(135deg, #065f46 0%, #047857 100%);
        }
        .stat-card-gradient-3 {
            background: linear-gradient(135deg, #9f1239 0%, #be123c 100%);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col">
    <!-- Navbar -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Brand Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-600 flex items-center justify-center text-white shadow-md shadow-emerald-600/30">
                        <i class="fa-solid fa-wallet text-xl"></i>
                    </div>
                    <div>
                        <a href="{{ route('dashboard') }}" class="font-extrabold text-xl tracking-tight text-slate-900 flex items-center gap-1">
                            Dompet<span class="text-emerald-600">Ku</span>
                        </a>
                        <p class="text-[10px] font-medium text-slate-400 uppercase tracking-widest leading-none">Keuangan Personal</p>
                    </div>
                </div>

               <!-- Navigation -->
<nav class="flex items-center gap-2">

    <a href="{{ route('dashboard') }}"
       class="inline-flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-semibold transition
       {{ request()->routeIs('dashboard')
            ? 'bg-emerald-50 text-emerald-700'
            : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700' }}">

        <i class="fa-solid fa-chart-pie"></i>

        <span class="hidden sm:inline">Dashboard</span>

    </a>

    <a href="{{ route('categories.index') }}"
   class="inline-flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-semibold transition
   {{ request()->routeIs('categories.*')
        ? 'bg-emerald-50 text-emerald-700'
        : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700' }}">

    <i class="fa-solid fa-tags"></i>

    <span class="hidden sm:inline">Kategori</span>

    </a>

    <a href="{{ route('transactions.index') }}"
       class="inline-flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-semibold transition
       {{ request()->routeIs('transactions.*')
            ? 'bg-emerald-50 text-emerald-700'
            : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700' }}">

        <i class="fa-solid fa-receipt"></i>

        <span class="hidden sm:inline">Transaksi</span>

    </a>

    <a href="{{ route('transactions.create') }}"
       class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-emerald-600 text-white text-sm font-bold hover:bg-emerald-700 transition shadow-sm">

        <i class="fa-solid fa-plus"></i>

        <span class="hidden sm:inline">Tambah</span>

    </a>

</nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 py-6 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-500 gap-3">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-wallet text-emerald-600"></i>
                <span class="font-semibold text-slate-700">DompetKu</span> &copy; {{ date('Y') }} — Financial Management System
            </div>
            <div class="flex items-center gap-4">
                <span>SQLite Database Active</span>
                <span class="inline-block w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                <span>Laravel {{ app()->version() }}</span>
            </div>
        </div>
    </footer>
</body>
</html>
