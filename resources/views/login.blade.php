<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- MATIKAN CACHE BROWSER -->
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">

  <title>Login - Inventaris TIK Diskominfo</title>
  
  <!-- CDN GOOGLE MATERIAL SYMBOLS & FONTS -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- TAILWIND CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <style>
    body { 
      font-family: 'Plus Jakarta Sans', sans-serif; 
    }

    .toggle-btn {
      position: absolute;
      right: 14px;
      top: 50%;
      transform: translateY(-50%);
      background: transparent;
      border: none;
      display: flex;
      align-items: center;
      justify-content: center;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-slate-950 via-purple-950 to-slate-900 text-slate-100 min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

  <!-- Subtle Purple Glow Effects -->
  <div class="absolute -top-32 -left-32 w-96 h-96 bg-purple-600/20 rounded-full blur-3xl pointer-events-none"></div>
  <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-indigo-600/15 rounded-full blur-3xl pointer-events-none"></div>

  <!-- Container Utama -->
  <div class="w-full max-w-sm space-y-6 z-10">
    
    <!-- HEADER BRANDING: Logo & Judul Diskominfo -->
    <div class="text-center space-y-2">
      <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-tr from-purple-600 to-indigo-500 text-white rounded-2xl shadow-lg shadow-purple-950/80 border border-purple-400/20 text-xl font-bold">
        🏛️
      </div>
      <div>
        <h1 class="font-bold text-xl tracking-wider text-white">
          DISKOMINFO
        </h1>
        <p class="text-[11px] text-purple-300/80 font-medium tracking-widest uppercase">
          Inventaris TIK
        </p>
      </div>
    </div>

    <!-- Card Login Violet Dark -->
    <div class="bg-slate-900/80 backdrop-blur-xl rounded-2xl p-7 border border-purple-500/20 shadow-2xl shadow-purple-950/50">
      
      <!-- Sub-header dalam Form -->
      <div class="mb-6">
        <h2 class="text-lg font-semibold text-white">Selamat Datang</h2>
        <p class="text-xs text-purple-200/60 mt-1">Masuk untuk mengelola portal inventaris TIK</p>
      </div>

      <!-- Form Login -->
      <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Username Input -->
        <div class="space-y-1.5">
          <label for="username" class="text-xs font-medium text-purple-200/90 flex items-center gap-1.5">
            <span class="material-symbols-outlined text-base text-purple-400">person</span>
            Username
          </label>
          <div class="relative">
            <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus
              class="w-full px-3.5 py-2.5 bg-slate-950/60 border border-purple-500/30 rounded-xl text-sm text-slate-100 placeholder:text-purple-300/30 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
              placeholder="Username Anda">
          </div>
          @error('username')
            <p class="text-rose-400 text-xs mt-1 font-medium flex items-center gap-1">
              <span class="material-symbols-outlined text-sm">error</span> {{ $message }}
            </p>
          @enderror
        </div>

        <!-- Password Input -->
        <div class="space-y-1.5">
          <label for="password" class="text-xs font-medium text-purple-200/90 flex items-center gap-1.5">
            <span class="material-symbols-outlined text-base text-purple-400">lock</span>
            Kata Sandi
          </label>
          <div class="relative">
            <input type="password" id="password" name="password" required
              class="w-full pl-3.5 pr-11 py-2.5 bg-slate-950/60 border border-purple-500/30 rounded-xl text-sm text-slate-100 placeholder:text-purple-300/30 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
              placeholder="••••••••">
            
            <!-- Tombol Toggle Password -->
            <button type="button" onclick="togglePassword()" class="toggle-btn text-purple-400/60 hover:text-purple-300 focus:outline-none">
              <span id="eye-open" class="material-symbols-outlined text-lg">visibility</span>
              <span id="eye-closed" class="material-symbols-outlined text-lg hidden">visibility_off</span>
            </button>
          </div>
          @error('password')
            <p class="text-rose-400 text-xs mt-1 font-medium flex items-center gap-1">
              <span class="material-symbols-outlined text-sm">error</span> {{ $message }}
            </p>
          @enderror
        </div>

        <!-- Tombol Login -->
        <button type="submit" class="w-full bg-purple-600 hover:bg-purple-500 text-white font-semibold py-3 px-4 rounded-xl text-xs uppercase tracking-wider transition-all duration-200 shadow-lg shadow-purple-600/30 flex items-center justify-center gap-2 mt-2 cursor-pointer active:scale-[0.99]">
          <span>Masuk</span>
          <span class="material-symbols-outlined text-base">arrow_forward</span>
        </button>

      </form>

      <!-- Footer di Dalam Card -->
      <div class="mt-6 pt-4 border-t border-purple-500/10 text-center">
        <p class="text-[11px] text-purple-300/40 font-medium">
          © 2026 Diskominfo • Inventaris TIK
        </p>
      </div>

    </div>
  </div>

  <!-- Script Toggle Password -->
  <script>
    function togglePassword() {
      const pass = document.getElementById('password');
      const eyeOpen = document.getElementById('eye-open');
      const eyeClosed = document.getElementById('eye-closed');

      if (pass.type === 'password') {
        pass.type = 'text';
        eyeOpen.classList.add('hidden');
        eyeClosed.classList.remove('hidden');
      } else {
        pass.type = 'password';
        eyeOpen.classList.remove('hidden');
        eyeClosed.classList.add('hidden');
      }
    }
  </script>

</body>
</html>