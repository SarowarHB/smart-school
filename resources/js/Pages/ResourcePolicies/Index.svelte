<script>
  import { useForm, router } from '@inertiajs/svelte';
  import AppLayout from '../../Layouts/AppLayout.svelte';

  let { resourcePolicies, resources, policies } = $props();

  // ── Delete ─────────────────────────────────────────────────────────────────
  let deleteTarget = $state(null);

  function confirmDelete(rp) { deleteTarget = rp; }
  function cancelDelete()    { deleteTarget = null; }
  function doDelete() {
    if (!deleteTarget) return;
    router.delete(`/resource-policies/${deleteTarget.id}`, {
      onSuccess: () => { deleteTarget = null; },
    });
  }

  // ── Create / Edit modal ────────────────────────────────────────────────────
  let modalMode = $state(null);   // 'create' | 'edit' | null
  let editingRp = $state(null);

  const form = useForm({ resource_id: '', policy_id: '', is_active: false });

  function openCreate() {
    form.reset();
    form.clearErrors();
    modalMode = 'create';
    editingRp = null;
  }

  function openEdit(rp) {
    form.resource_id = rp.resource_id ?? '';
    form.policy_id   = rp.policy_id ?? '';
    form.is_active   = rp.is_active ?? false;
    form.clearErrors();
    modalMode = 'edit';
    editingRp = rp;
  }

  function closeModal() {
    form.reset();
    form.clearErrors();
    modalMode = null;
    editingRp = null;
  }

  function submitForm(e) {
    e.preventDefault();
    if (modalMode === 'create') {
      form.post('/resource-policies', { onSuccess: () => closeModal() });
    } else if (modalMode === 'edit' && editingRp) {
      form.put(`/resource-policies/${editingRp.id}`, { onSuccess: () => closeModal() });
    }
  }
</script>

<svelte:head>
  <title>Resource Policies | SvelteAdmin</title>
</svelte:head>

<AppLayout>
  <!-- Page header -->
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Resource Policies</h1>
      <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">
        {resourcePolicies.total} record{resourcePolicies.total === 1 ? '' : 's'} total
      </p>
    </div>
    <button
      onclick={openCreate}
      class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary-600 hover:bg-primary-700
             text-white text-sm font-medium rounded-xl transition-colors shadow-sm">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
      </svg>
      New Record
    </button>
  </div>

  <!-- Table card -->
  <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead>
          <tr class="border-b border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-800/50">
            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide w-16">#</th>
            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Resource</th>
            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Policy</th>
            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Active</th>
            <th class="px-6 py-3.5 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide w-32">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
          {#each resourcePolicies.data as rp, index}
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/40 transition-colors group">
              <td class="px-6 py-4 text-gray-400 dark:text-gray-500 font-mono text-xs">{index + 1}</td>
              <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{rp.resource_name ?? '—'}</td>
              <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{rp.policy_name ?? '—'}</td>
              <td class="px-6 py-4">
                {#if rp.is_active}
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                               bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400">
                    Active
                  </span>
                {:else}
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                               bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400">
                    Inactive
                  </span>
                {/if}
              </td>
              <td class="px-6 py-4">
                <div class="flex items-center justify-end gap-2">
                  <button
                    onclick={() => openEdit(rp)}
                    class="p-1.5 rounded-lg text-gray-400 hover:text-primary-600 hover:bg-primary-50
                           dark:hover:bg-primary-900/20 dark:hover:text-primary-400 transition-colors"
                    title="Edit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                      <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                      <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                  </button>
                  <button
                    onclick={() => confirmDelete(rp)}
                    class="p-1.5 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50
                           dark:hover:bg-red-900/20 dark:hover:text-red-400 transition-colors"
                    title="Delete">
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
                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2z"/>
                  </svg>
                  No records found. <button onclick={openCreate} class="text-primary-500 hover:underline">Create one.</button>
                </div>
              </td>
            </tr>
          {/each}
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    {#if resourcePolicies.last_page > 1}
      <div class="flex items-center justify-between px-6 py-4 border-t border-gray-100 dark:border-gray-800">
        <p class="text-xs text-gray-500 dark:text-gray-400">
          Showing {resourcePolicies.from}–{resourcePolicies.to} of {resourcePolicies.total}
        </p>
        <div class="flex gap-1">
          {#each resourcePolicies.links as link}
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
          <h3 class="font-semibold text-gray-900 dark:text-white">Delete Record</h3>
          <p class="text-sm text-gray-500 dark:text-gray-400">This action cannot be undone.</p>
        </div>
      </div>
      <p class="text-sm text-gray-700 dark:text-gray-300 mb-6">
        Are you sure you want to delete this resource policy record?
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

<!-- Create / Edit modal -->
{#if modalMode}
  <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
    <div
      class="absolute inset-0 bg-black/60 backdrop-blur-sm"
      onclick={closeModal}
      onkeydown={(e) => e.key === 'Escape' && closeModal()}
      role="button"
      tabindex="-1"
      aria-label="Close"
    ></div>
    <div class="relative w-full max-w-xl bg-white dark:bg-gray-900 rounded-2xl shadow-2xl p-8
                border border-gray-200 dark:border-gray-700 z-10">
      <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-5">
        {modalMode === 'create' ? 'Create Resource Policy' : 'Edit Resource Policy'}
      </h3>

      <form onsubmit={submitForm} novalidate class="space-y-4">

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
                     : 'border-gray-200 dark:border-gray-700 focus:border-primary-500 dark:focus:border-primary-500'}"
          >
            <option value="">— Select Resource —</option>
            {#each resources as resource}
              <option value={resource.id}>{resource.name}</option>
            {/each}
          </select>
          {#if form.errors.resource_id}
            <p class="mt-1.5 text-xs text-red-500">{form.errors.resource_id}</p>
          {/if}
        </div>

        <!-- Policy -->
        <div>
          <label for="modal-policy" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
            Policy <span class="text-red-500" aria-hidden="true">*</span>
          </label>
          <select
            id="modal-policy"
            bind:value={form.policy_id}
            class="w-full px-4 py-2.5 rounded-xl border text-sm bg-white dark:bg-gray-800
                   text-gray-900 dark:text-white transition-colors focus:outline-none
                   focus:ring-2 focus:ring-primary-500/40
                   {form.errors.policy_id
                     ? 'border-red-400 dark:border-red-500'
                     : 'border-gray-200 dark:border-gray-700 focus:border-primary-500 dark:focus:border-primary-500'}"
          >
            <option value="">— Select Policy —</option>
            {#each policies as policy}
              <option value={policy.id}>{policy.name}</option>
            {/each}
          </select>
          {#if form.errors.policy_id}
            <p class="mt-1.5 text-xs text-red-500">{form.errors.policy_id}</p>
          {/if}
        </div>

        <!-- Is Active -->
        <div class="flex items-center gap-3">
          <input
            id="modal-is-active"
            type="checkbox"
            bind:checked={form.is_active}
            class="w-4 h-4 rounded border-gray-300 dark:border-gray-600 text-primary-600
                   focus:ring-primary-500 dark:bg-gray-800"
          />
          <label for="modal-is-active" class="text-sm font-medium text-gray-700 dark:text-gray-300">
            Active
          </label>
        </div>

        <div class="flex gap-3 pt-2">
          <button
            onclick={closeModal}
            type="button"
            class="flex-1 px-4 py-2.5 text-sm font-medium rounded-xl border border-gray-200
                   dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50
                   dark:hover:bg-gray-800 transition-colors"
          >
            Cancel
          </button>
          <button
            type="submit"
            disabled={form.processing}
            class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-primary-600
                   hover:bg-primary-700 disabled:opacity-60 disabled:cursor-not-allowed
                   text-white text-sm font-medium rounded-xl transition-colors shadow-sm"
          >
            {#if form.processing}
              <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.4 0 0 5.4 0 12h4z"/>
              </svg>
            {/if}
            {modalMode === 'create' ? 'Create Record' : 'Save Changes'}
          </button>
        </div>
      </form>
    </div>
  </div>
{/if}
