<script>
  // No imports needed for this page
</script>

<svelte:head>
  <title>Sign In | SvelteAdmin</title>
</svelte:head>

<div class="min-h-screen flex bg-gradient-to-br from-primary-950 via-gray-900 to-gray-950">
  <!-- Left decorative panel -->
  <div class="hidden lg:flex lg:w-1/2 flex-col justify-between p-12 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-600/20 to-primary-900/40 backdrop-blur-sm"></div>

    <!-- Grid pattern overlay -->
    <div class="absolute inset-0 opacity-10"
         style="background-image: linear-gradient(rgba(255,255,255,.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.1) 1px, transparent 1px);
                background-size: 40px 40px;">
    </div>

    <div class="relative z-10">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-primary-500 flex items-center justify-center shadow-lg">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
        </div>
        <span class="text-white text-xl font-bold tracking-tight">SvelteAdmin</span>
      </div>
    </div>

    <div class="relative z-10 space-y-6">
      {#each [
        { icon: '⚡', title: 'Blazing Fast', desc: 'Built with Svelte 5 & Inertia 3 for instant page transitions.' },
        { icon: '🎨', title: 'Beautiful UI',  desc: 'Polished components with dark mode and responsive design.' },
        { icon: '🔒', title: 'Secure by Default', desc: "Google OAuth with Laravel's battle-tested auth stack." },
      ] as f}
        <div class="flex items-start gap-4">
          <span class="text-2xl">{f.icon}</span>
          <div>
            <p class="text-white font-semibold">{f.title}</p>
            <p class="text-gray-400 text-sm">{f.desc}</p>
          </div>
        </div>
      {/each}
    </div>

    <p class="relative z-10 text-gray-500 text-sm">
      &copy; {new Date().getFullYear()} SvelteAdmin. All rights reserved.
    </p>
  </div>

  <!-- Right login panel -->
  <div class="flex-1 flex items-center justify-center p-6">
    <div class="w-full max-w-md">
      <!-- Mobile logo -->
      <div class="flex lg:hidden items-center justify-center gap-3 mb-10">
        <div class="w-10 h-10 rounded-xl bg-primary-500 flex items-center justify-center">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
        </div>
        <span class="text-white text-xl font-bold">SvelteAdmin</span>
      </div>

      <div class="bg-gray-900 border border-gray-800 rounded-2xl p-8 shadow-2xl">
        <div class="text-center mb-8">
          <h1 class="text-2xl font-bold text-white mb-2">Welcome back</h1>
          <p class="text-gray-400 text-sm">Sign in to your admin dashboard</p>
        </div>

        <a href="/auth/google"
           class="flex items-center justify-center gap-3 w-full px-5 py-3.5 rounded-xl
                  bg-white hover:bg-gray-100 text-gray-900 font-medium text-sm
                  transition-all duration-200 shadow-md hover:shadow-lg active:scale-[.98]">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="w-5 h-5">
            <path fill="#FFC107" d="M43.6 20.1H42V20H24v8h11.3C33.7 32.6 29.3 36 24 36c-6.6 0-12-5.4-12-12s5.4-12 12-12c3 0 5.8 1.1 7.9 3l5.7-5.7C34.1 6.8 29.3 5 24 5 12.9 5 4 13.9 4 25s8.9 20 20 20 20-8.9 20-20c0-1.3-.1-2.6-.4-3.9z"/>
            <path fill="#FF3D00" d="m6.3 14.7 6.6 4.8C14.6 16 19 13 24 13c3 0 5.8 1.1 7.9 3l5.7-5.7C34.1 6.8 29.3 5 24 5c-7.7 0-14.4 4.4-17.7 9.7z"/>
            <path fill="#4CAF50" d="M24 45c5.2 0 9.9-1.9 13.5-5L31.8 34c-2 1.5-4.5 2-7.8 2-5.2 0-9.7-3.4-11.3-8H6.6c3.3 7 10.5 11 17.4 11z"/>
            <path fill="#1976D2" d="M43.6 20.1H42V20H24v8h11.3c-.8 2.3-2.3 4.3-4.3 5.7l.1-.1 5.7 4.8C36.3 37.6 44 31 44 25c0-1.3-.1-2.6-.4-3.9z"/>
          </svg>
          Continue with Google
        </a>

        <div class="mt-8 text-center">
          <p class="text-gray-500 text-xs">
            By signing in you agree to our
            <a href="/terms" class="text-primary-400 hover:text-primary-300">Terms</a>
            and
            <a href="/privacy" class="text-primary-400 hover:text-primary-300">Privacy Policy</a>.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
