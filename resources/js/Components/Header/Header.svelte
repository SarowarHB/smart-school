<script>
  import { page, router } from '@inertiajs/svelte';

  let { collapsed, onToggleSidebar } = $props();

  const user = $derived(page.props.auth?.user);

  let dropdownOpen = $state(false);
  let isDark = $state(document.documentElement.classList.contains('dark'));

  function toggleTheme() {
    isDark = !isDark;
    document.documentElement.classList.toggle('dark', isDark);
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
  }

  function logout() {
    router.post('/logout');
  }

  const currentPage = $derived(page.url.split('/').filter(Boolean).pop() ?? 'dashboard');
</script>

<header class="fixed top-0 right-0 z-20 h-16 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800
               flex items-center px-4 gap-4 transition-all duration-300
               {collapsed ? 'left-16' : 'left-[260px]'}
               max-lg:left-0">

  <!-- Mobile sidebar toggle -->
  <button
    onclick={onToggleSidebar}
    aria-label="Toggle sidebar"
    class="lg:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
  >
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
    </svg>
  </button>

  <!-- Page title -->
  <div class="flex-1">
    <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-200 capitalize">
      {currentPage}
    </h2>
  </div>

  <!-- Right actions -->
  <div class="flex items-center gap-2">

    <!-- Search -->
    <button
      aria-label="Search"
      class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
    >
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
      </svg>
    </button>

    <!-- Theme toggle -->
    <button
      onclick={toggleTheme}
      aria-label="Toggle dark mode"
      class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
    >
      {#if isDark}
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <circle cx="12" cy="12" r="5"/>
          <line x1="12" y1="1" x2="12" y2="3"/>
          <line x1="12" y1="21" x2="12" y2="23"/>
          <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/>
          <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
          <line x1="1" y1="12" x2="3" y2="12"/>
          <line x1="21" y1="12" x2="23" y2="12"/>
          <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/>
          <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
        </svg>
      {:else}
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
        </svg>
      {/if}
    </button>

    <!-- Notifications -->
    <button
      aria-label="Notifications"
      class="relative p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
    >
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
        <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
      </svg>
      <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full" aria-hidden="true"></span>
    </button>

    <!-- User dropdown -->
    <div class="relative">
      <button
        onclick={() => dropdownOpen = !dropdownOpen}
        aria-label="User menu"
        aria-expanded={dropdownOpen}
        class="flex items-center gap-2 pl-2 pr-3 py-1.5 rounded-xl hover:bg-gray-100
               dark:hover:bg-gray-800 transition-colors"
      >
        {#if user?.avatar}
          <img src={user.avatar} alt={user.name} class="w-7 h-7 rounded-full object-cover"/>
        {:else}
          <div class="w-7 h-7 rounded-full bg-primary-500 flex items-center justify-center text-white text-xs font-semibold"
               aria-hidden="true">
            {user?.name?.[0] ?? 'U'}
          </div>
        {/if}
        <span class="hidden sm:block text-sm font-medium text-gray-700 dark:text-gray-200">
          {user?.name ?? 'User'}
        </span>
        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <polyline points="6 9 12 15 18 9"/>
        </svg>
      </button>

      {#if dropdownOpen}
        <div
          class="fixed inset-0 z-10"
          onclick={() => dropdownOpen = false}
          onkeydown={(e) => e.key === 'Escape' && (dropdownOpen = false)}
          role="button"
          tabindex="-1"
          aria-label="Close menu"
        ></div>

        <div class="absolute right-0 top-full mt-2 w-56 bg-white dark:bg-gray-900
                    border border-gray-200 dark:border-gray-700 rounded-xl shadow-xl z-20 py-1.5
                    divide-y divide-gray-100 dark:divide-gray-800" role="menu">
          <div class="px-4 py-3">
            <p class="text-sm font-medium text-gray-900 dark:text-white">{user?.name}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{user?.email}</p>
          </div>
          <div class="py-1">
            <a href="/settings" role="menuitem"
               class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 dark:text-gray-300
                      hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <circle cx="12" cy="12" r="3"/>
                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>
              </svg>
              Settings
            </a>
          </div>
          <div class="py-1">
            <button
              onclick={logout}
              role="menuitem"
              class="flex w-full items-center gap-3 px-4 py-2 text-sm text-red-600 dark:text-red-400
                     hover:bg-red-50 dark:hover:bg-red-950/30 transition-colors"
            >
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
              </svg>
              Sign Out
            </button>
          </div>
        </div>
      {/if}
    </div>
  </div>
</header>
