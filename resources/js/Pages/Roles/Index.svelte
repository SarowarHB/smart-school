<script>
  import { router } from '@inertiajs/svelte';
  import AppLayout from '../../Layouts/AppLayout.svelte';

  let { roles } = $props();

  let deleteTarget = $state(null);   // role being confirmed for deletion
  let flash        = $state('');

  function confirmDelete(role) {
    deleteTarget = role;
  }

  function cancelDelete() {
    deleteTarget = null;
  }

  function doDelete() {
    if (!deleteTarget) return;
    router.delete(`/roles/${deleteTarget.id}`, {
      onSuccess: () => { deleteTarget = null; },
    });
  }
</script>

<svelte:head>
  <title>Roles | SvelteAdmin</title>
</svelte:head>

<AppLayout>
  <!-- Page header -->
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Roles</h1>
      <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">
        {roles.total} role{roles.total === 1 ? '' : 's'} total
      </p>
    </div>
    <a href="/roles/create"
       class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary-600 hover:bg-primary-700
              text-white text-sm font-medium rounded-xl transition-colors shadow-sm">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
      </svg>
      New Role
    </a>
  </div>

  <!-- Table card -->
  <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead>
          <tr class="border-b border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-800/50">
            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide w-16">
              #
            </th>
            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">
              Role Name
            </th>
            <th class="px-6 py-3.5 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide w-32">
              Actions
            </th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
          {#each roles.data as role}
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/40 transition-colors group">
              <td class="px-6 py-4 text-gray-400 dark:text-gray-500 font-mono text-xs">
                {role.id}
              </td>
              <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                {role.name}
              </td>
              <td class="px-6 py-4">
                <div class="flex items-center justify-end gap-2">
                  <a href="/roles/{role.id}/edit"
                     class="p-1.5 rounded-lg text-gray-400 hover:text-primary-600 hover:bg-primary-50
                            dark:hover:bg-primary-900/20 dark:hover:text-primary-400 transition-colors"
                     title="Edit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                      <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                      <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                  </a>
                  <button
                    onclick={() => confirmDelete(role)}
                    class="p-1.5 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50
                           dark:hover:bg-red-900/20 dark:hover:text-red-400 transition-colors"
                    title="Delete"
                  >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                      <polyline points="3 6 5 6 21 6"/>
                      <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                      <path d="M10 11v6M14 11v6"/>
                      <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                    </svg>
                  </button>
                </div>
              </td>
            </tr>
          {:else}
            <tr>
              <td colspan="3" class="px-6 py-16 text-center text-gray-400 dark:text-gray-500">
                <div class="flex flex-col items-center gap-2">
                  <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="12" r="3"/>
                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06A1.65 1.65 0 0 0 15 19.4a1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4"/>
                  </svg>
                  No roles found. <a href="/roles/create" class="text-primary-500 hover:underline">Create one.</a>
                </div>
              </td>
            </tr>
          {/each}
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    {#if roles.last_page > 1}
      <div class="flex items-center justify-between px-6 py-4 border-t border-gray-100 dark:border-gray-800">
        <p class="text-xs text-gray-500 dark:text-gray-400">
          Showing {roles.from}–{roles.to} of {roles.total}
        </p>
        <div class="flex gap-1">
          {#each roles.links as link}
            {#if link.url}
              <button
                onclick={() => router.visit(link.url)}
                class="px-3 py-1.5 text-xs rounded-lg transition-colors
                       {link.active
                         ? 'bg-primary-600 text-white font-semibold'
                         : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800'}"
                disabled={link.active}
              >
                {@html link.label}
              </button>
            {:else}
              <span class="px-3 py-1.5 text-xs text-gray-300 dark:text-gray-600 cursor-not-allowed">
                {@html link.label}
              </span>
            {/if}
          {/each}
        </div>
      </div>
    {/if}
  </div>
</AppLayout>

<!-- Delete confirmation modal -->
{#if deleteTarget}
  <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
    <div
      class="absolute inset-0 bg-black/60 backdrop-blur-sm"
      onclick={cancelDelete}
      onkeydown={(e) => e.key === 'Escape' && cancelDelete()}
      role="button"
      tabindex="-1"
      aria-label="Close"
    ></div>
    <div class="relative w-full max-w-sm bg-white dark:bg-gray-900 rounded-2xl shadow-2xl p-6
                border border-gray-200 dark:border-gray-700 z-10">
      <div class="flex items-center gap-3 mb-4">
        <div class="w-10 h-10 rounded-xl bg-red-100 dark:bg-red-900/30 flex items-center justify-center shrink-0">
          <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
          </svg>
        </div>
        <div>
          <h3 class="font-semibold text-gray-900 dark:text-white">Delete Role</h3>
          <p class="text-sm text-gray-500 dark:text-gray-400">This action cannot be undone.</p>
        </div>
      </div>
      <p class="text-sm text-gray-700 dark:text-gray-300 mb-6">
        Are you sure you want to delete the role
        <strong class="text-gray-900 dark:text-white">"{deleteTarget.name}"</strong>?
      </p>
      <div class="flex gap-3">
        <button
          onclick={cancelDelete}
          class="flex-1 px-4 py-2.5 text-sm font-medium rounded-xl border border-gray-200
                 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50
                 dark:hover:bg-gray-800 transition-colors"
        >
          Cancel
        </button>
        <button
          onclick={doDelete}
          class="flex-1 px-4 py-2.5 text-sm font-medium rounded-xl bg-red-600 hover:bg-red-700
                 text-white transition-colors"
        >
          Delete
        </button>
      </div>
    </div>
  </div>
{/if}
