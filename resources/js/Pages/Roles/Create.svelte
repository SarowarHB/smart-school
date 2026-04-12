<script>
  import { useForm } from '@inertiajs/svelte';
  import AppLayout from '../../Layouts/AppLayout.svelte';

  const form = useForm({ name: '' });

  function submit(e) {
    e.preventDefault();
    $form.post('/roles');
  }
</script>

<svelte:head>
  <title>New Role | SvelteAdmin</title>
</svelte:head>

<AppLayout>
  <!-- Breadcrumb -->
  <nav class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-6" aria-label="Breadcrumb">
    <a href="/roles" class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Roles</a>
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
      <polyline points="9 18 15 12 9 6"/>
    </svg>
    <span class="text-gray-900 dark:text-white font-medium">New Role</span>
  </nav>

  <div class="max-w-lg">
    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6">
      <h1 class="text-lg font-semibold text-gray-900 dark:text-white mb-5">Create Role</h1>

      <form onsubmit={submit} novalidate>
        <div class="mb-5">
          <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
            Role Name <span class="text-red-500" aria-hidden="true">*</span>
          </label>
          <input
            id="name"
            type="text"
            bind:value={$form.name}
            placeholder="e.g. Editor, Moderator"
            class="w-full px-4 py-2.5 rounded-xl border text-sm
                   bg-white dark:bg-gray-800
                   text-gray-900 dark:text-white
                   placeholder-gray-400 dark:placeholder-gray-500
                   transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500/40
                   {$form.errors.name
                     ? 'border-red-400 dark:border-red-500'
                     : 'border-gray-200 dark:border-gray-700 focus:border-primary-500 dark:focus:border-primary-500'}"
            aria-describedby={$form.errors.name ? 'name-error' : undefined}
          />
          {#if $form.errors.name}
            <p id="name-error" class="mt-1.5 text-xs text-red-500">{$form.errors.name}</p>
          {/if}
        </div>

        <div class="flex items-center gap-3 pt-2">
          <button
            type="submit"
            disabled={$form.processing}
            class="flex items-center gap-2 px-5 py-2.5 bg-primary-600 hover:bg-primary-700
                   disabled:opacity-60 disabled:cursor-not-allowed text-white text-sm font-medium
                   rounded-xl transition-colors shadow-sm"
          >
            {#if $form.processing}
              <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.4 0 0 5.4 0 12h4z"/>
              </svg>
            {/if}
            Create Role
          </button>
          <a href="/roles"
             class="px-5 py-2.5 text-sm font-medium rounded-xl border border-gray-200 dark:border-gray-700
                    text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
            Cancel
          </a>
        </div>
      </form>
    </div>
  </div>
</AppLayout>
