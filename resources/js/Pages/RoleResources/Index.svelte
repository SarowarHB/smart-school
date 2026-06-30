<script>
  import { useForm, router } from '@inertiajs/svelte';
  import AppLayout from '../../Layouts/AppLayout.svelte';

  let { roleResources, roles, resources } = $props();

  // ── Delete ─────────────────────────────────────────────────────────────────
  let deleteTarget = $state(null);

  function confirmDelete(entry) { deleteTarget = entry; }
  function cancelDelete()       { deleteTarget = null; }
  function doDelete() {
    if (!deleteTarget) return;
    router.delete(`/role-resources/${deleteTarget.id}`, {
      onSuccess: () => { deleteTarget = null; },
    });
  }

  // ── Create modal ───────────────────────────────────────────────────────────
  let showCreate = $state(false);

  const form = useForm({ role_id: '', resource_id: '' });

  function openCreate() {
    form.reset();
    form.clearErrors();
    showCreate = true;
  }

  function closeCreate() {
    form.reset();
    form.clearErrors();
    showCreate = false;
  }

  function submitForm(e) {
    e.preventDefault();
    form.post('/role-resources', { onSuccess: () => closeCreate() });
  }

  // ── Helpers ────────────────────────────────────────────────────────────────
  function resourceLabel(r) {
    return r.description ? `${r.description} (${r.name})` : r.name;
  }
</script>

<svelte:head>
  <title>Role Resources | Smart School</title>
</svelte:head>

<AppLayout>
  <!-- Page header -->
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Role Resources</h1>
      <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">
        {roleResources.total} assignment{roleResources.total === 1 ? '' : 's'} total
      </p>
    </div>
    <button
      onclick={openCreate}
      class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary-600 hover:bg-primary-700
             text-white text-sm font-medium rounded-xl transition-colors shadow-sm">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
      </svg>
      Assign Resource
    </button>
  </div>

  <!-- Table card -->
  <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead>
          <tr class="border-b border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-800/50">
            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide w-16">#</th>
            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Role</th>
            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Resource</th>
            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Description</th>
            <th class="px-6 py-3.5 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide w-24">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
          {#each roleResources.data as entry, index}
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/40 transition-colors group">
              <td class="px-6 py-4 text-gray-400 dark:text-gray-500 font-mono text-xs">{index + 1}</td>
              <td class="px-6 py-4">
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium
                             bg-purple-50 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300
                             border border-purple-100 dark:border-purple-800">
                  {entry.role_name ?? '—'}
                </span>
              </td>
              <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                {entry.resource_name ?? '—'}
              </td>
              <td class="px-6 py-4 text-gray-500 dark:text-gray-400">
                {entry.resource_description ?? '—'}
              </td>
              <td class="px-6 py-4">
                <div class="flex items-center justify-end">
                  <button
                    onclick={() => confirmDelete(entry)}
                    class="p-1.5 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50
                           dark:hover:bg-red-900/20 dark:hover:text-red-400 transition-colors"
                    title="Remove">
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
              <td colspan="5" class="px-6 py-16 text-center text-gray-400 dark:text-gray-500">
                <div class="flex flex-col items-center gap-2">
                  <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                  </svg>
                  No assignments yet.
                  <button onclick={openCreate} class="text-primary-500 hover:underline">Assign one.</button>
                </div>
              </td>
            </tr>
          {/each}
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    {#if roleResources.last_page > 1}
      <div class="flex items-center justify-between px-6 py-4 border-t border-gray-100 dark:border-gray-800">
        <p class="text-xs text-gray-500 dark:text-gray-400">
          Showing {roleResources.from}–{roleResources.to} of {roleResources.total}
        </p>
        <div class="flex gap-1">
          {#each roleResources.links as link}
            {#if link.url}
              <button
                onclick={() => router.visit(link.url)}
                class="px-3 py-1.5 text-xs rounded-lg transition-colors
                       {link.active
                         ? 'bg-primary-600 text-white font-semibold'
                         : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800'}"
                disabled={link.active}>
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
      aria-label="Close">
    </div>
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
          <h3 class="font-semibold text-gray-900 dark:text-white">Remove Assignment</h3>
          <p class="text-sm text-gray-500 dark:text-gray-400">This action cannot be undone.</p>
        </div>
      </div>
      <p class="text-sm text-gray-700 dark:text-gray-300 mb-6">
        Remove <strong class="text-gray-900 dark:text-white">"{deleteTarget.resource_name}"</strong>
        from role <strong class="text-gray-900 dark:text-white">"{deleteTarget.role_name}"</strong>?
      </p>
      <div class="flex gap-3">
        <button
          onclick={cancelDelete}
          class="flex-1 px-4 py-2.5 text-sm font-medium rounded-xl border border-gray-200
                 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50
                 dark:hover:bg-gray-800 transition-colors">
          Cancel
        </button>
        <button
          onclick={doDelete}
          class="flex-1 px-4 py-2.5 text-sm font-medium rounded-xl bg-red-600 hover:bg-red-700
                 text-white transition-colors">
          Remove
        </button>
      </div>
    </div>
  </div>
{/if}

<!-- Assign Resource modal -->
{#if showCreate}
  <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
    <div
      class="absolute inset-0 bg-black/60 backdrop-blur-sm"
      onclick={closeCreate}
      onkeydown={(e) => e.key === 'Escape' && closeCreate()}
      role="button"
      tabindex="-1"
      aria-label="Close">
    </div>
    <div class="relative w-full max-w-md bg-white dark:bg-gray-900 rounded-2xl shadow-2xl p-6
                border border-gray-200 dark:border-gray-700 z-10">
      <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-5">Assign Resource to Role</h3>

      <form onsubmit={submitForm} novalidate class="space-y-4">

        <!-- Role -->
        <div>
          <label for="modal-role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
            Role <span class="text-red-500" aria-hidden="true">*</span>
          </label>
          <select
            id="modal-role"
            bind:value={form.role_id}
            class="w-full px-4 py-2.5 rounded-xl border text-sm bg-white dark:bg-gray-800
                   text-gray-900 dark:text-white transition-colors focus:outline-none
                   focus:ring-2 focus:ring-primary-500/40
                   {form.errors.role_id
                     ? 'border-red-400 dark:border-red-500'
                     : 'border-gray-200 dark:border-gray-700 focus:border-primary-500 dark:focus:border-primary-500'}">
            <option value="">Select a role…</option>
            {#each roles as role}
              <option value={role.id}>{role.name}</option>
            {/each}
          </select>
          {#if form.errors.role_id}
            <p class="mt-1.5 text-xs text-red-500">{form.errors.role_id}</p>
          {/if}
        </div>

        <!-- Resource -->
        <div>
          <label for="modal-resource" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
            Resource <span class="text-red-500" aria-hidden="true">*</span>
          </label>
          <select
            id="modal-resource"
            bind:value={form.resource_id}
            class="w-full px-4 py-2.5 rounded-xl border text-sm bg-white dark:bg-gray-800
                   text-gray-900 dark:text-white transition-colors focus:outline-none
                   focus:ring-2 focus:ring-primary-500/40
                   {form.errors.resource_id
                     ? 'border-red-400 dark:border-red-500'
                     : 'border-gray-200 dark:border-gray-700 focus:border-primary-500 dark:focus:border-primary-500'}">
            <option value="">Select a resource…</option>
            {#each resources as resource}
              <option value={resource.id}>{resourceLabel(resource)}</option>
            {/each}
          </select>
          {#if form.errors.resource_id}
            <p class="mt-1.5 text-xs text-red-500">{form.errors.resource_id}</p>
          {/if}
        </div>

        <div class="flex gap-3 pt-2">
          <button
            onclick={closeCreate}
            type="button"
            class="flex-1 px-4 py-2.5 text-sm font-medium rounded-xl border border-gray-200
                   dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50
                   dark:hover:bg-gray-800 transition-colors">
            Cancel
          </button>
          <button
            type="submit"
            disabled={form.processing}
            class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-primary-600
                   hover:bg-primary-700 disabled:opacity-60 disabled:cursor-not-allowed
                   text-white text-sm font-medium rounded-xl transition-colors shadow-sm">
            {#if form.processing}
              <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.4 0 0 5.4 0 12h4z"/>
              </svg>
            {/if}
            Assign
          </button>
        </div>
      </form>
    </div>
  </div>
{/if}
