<script>
  import { page } from '@inertiajs/svelte';
  import SidebarItem from './SidebarItem.svelte';

  let { collapsed = $bindable(false), mobileOpen = $bindable(false) } = $props();

  const menu = $derived(page.props.sidebarMenu ?? []);
  const currentPath = $derived(page.url);
</script>

<!-- Mobile backdrop -->
{#if mobileOpen}
  <div
    class="fixed inset-0 z-20 bg-black/60 backdrop-blur-sm lg:hidden"
    onclick={() => mobileOpen = false}
    onkeydown={(e) => e.key === 'Escape' && (mobileOpen = false)}
    role="button"
    tabindex="-1"
    aria-label="Close sidebar"
  ></div>
{/if}

<aside
  class="fixed top-0 left-0 h-full z-30 flex flex-col bg-gray-900 border-r border-gray-800
         transition-all duration-300 ease-in-out
         {collapsed ? 'w-16' : 'w-[260px]'}
         {mobileOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'}"
>
  <!-- Logo / Brand -->
  <div class="flex items-center gap-3 px-4 h-16 border-b border-gray-800 shrink-0">
    <div class="w-8 h-8 rounded-lg bg-primary-500 flex items-center justify-center shrink-0">
      <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
      </svg>
    </div>
    {#if !collapsed}
      <span class="text-white font-bold text-lg tracking-tight">SvelteAdmin</span>
    {/if}
  </div>

  <!-- Navigation -->
  <nav class="flex-1 overflow-y-auto overflow-x-hidden py-4 space-y-1" aria-label="Sidebar navigation">
    {#each menu as group}
      {#if !collapsed}
        <p class="px-4 pt-3 pb-1 text-[10px] font-semibold uppercase tracking-widest text-gray-500">
          {group.label}
        </p>
      {:else}
        <div class="my-2 border-t border-gray-800"></div>
      {/if}

      {#each group.items as item}
        <SidebarItem {item} {collapsed} {currentPath} />
      {/each}
    {/each}
  </nav>

  <!-- Collapse toggle (desktop only) -->
  <button
    onclick={() => collapsed = !collapsed}
    aria-label="{collapsed ? 'Expand' : 'Collapse'} sidebar"
    class="hidden lg:flex items-center justify-center h-10 border-t border-gray-800
           text-gray-400 hover:text-white hover:bg-gray-800 transition-colors"
  >
    <svg class="w-4 h-4 transition-transform duration-300 {collapsed ? 'rotate-180' : ''}"
         fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
    </svg>
  </button>
</aside>
