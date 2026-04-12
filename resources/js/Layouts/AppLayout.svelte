<script>
  import Sidebar      from '../Components/Sidebar/Sidebar.svelte';
  import Header       from '../Components/Header/Header.svelte';
  import FlashMessage from '../Components/UI/FlashMessage.svelte';

  let { children } = $props();

  let sidebarCollapsed = $state(false);
  let mobileOpen       = $state(false);
</script>

<div class="min-h-screen bg-gray-50 dark:bg-gray-950">
  <Sidebar bind:collapsed={sidebarCollapsed} bind:mobileOpen />
  <Header collapsed={sidebarCollapsed} onToggleSidebar={() => mobileOpen = !mobileOpen} />

  <main class="transition-all duration-300 pt-16
               {sidebarCollapsed ? 'lg:ml-16' : 'lg:ml-[260px]'}">
    <div class="p-6">
      {@render children()}
    </div>
  </main>

  <FlashMessage />
</div>
