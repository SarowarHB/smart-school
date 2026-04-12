<script>
  import { router } from '@inertiajs/svelte';
  import SidebarIcon from './SidebarIcon.svelte';

  let { item, collapsed, currentPath } = $props();

  let open = $state(false);

  const isActive = $derived(
    currentPath === item.href ||
    (item.children && item.children.some(c => currentPath === c.href))
  );

  const hasChildren = $derived(item.children && item.children.length > 0);

  // Auto-open if a child is active
  $effect(() => {
    if (hasChildren && item.children.some(c => currentPath === c.href)) {
      open = true;
    }
  });

  function navigate(href) {
    router.visit(href);
  }
</script>

<div>
  <!-- Main item row -->
  <button
    onclick={() => {
      if (hasChildren) {
        open = !open;
      } else {
        navigate(item.href);
      }
    }}
    class="w-full flex items-center gap-3 px-3 py-2.5 mx-1 rounded-lg text-sm
           transition-all duration-150 group
           {isActive
             ? 'bg-primary-600 text-white shadow-sm'
             : 'text-gray-400 hover:bg-gray-800 hover:text-gray-100'}"
    style="width: calc(100% - 8px)"
    title={collapsed ? item.label : ''}
  >
    <!-- Icon -->
    <span class="shrink-0 w-5 h-5 flex items-center justify-center">
      <SidebarIcon name={item.icon} />
    </span>

    {#if !collapsed}
      <span class="flex-1 text-left truncate">{item.label}</span>

      {#if hasChildren}
        <svg
          class="w-3.5 h-3.5 shrink-0 transition-transform duration-200 {open ? 'rotate-90' : ''}"
          fill="none" stroke="currentColor" viewBox="0 0 24 24"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
      {/if}
    {/if}
  </button>

  <!-- Submenu -->
  {#if hasChildren && !collapsed && open}
    <div class="ml-5 mt-0.5 border-l border-gray-700 pl-3 space-y-0.5">
      {#each item.children as child}
        <button
          onclick={() => navigate(child.href)}
          class="w-full text-left text-sm px-3 py-2 rounded-lg transition-colors duration-150
                 {currentPath === child.href
                   ? 'text-primary-400 font-medium'
                   : 'text-gray-500 hover:text-gray-200 hover:bg-gray-800'}"
        >
          {child.label}
        </button>
      {/each}
    </div>
  {/if}
</div>
