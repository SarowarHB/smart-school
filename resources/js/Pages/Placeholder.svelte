<script>
  import AppLayout from '../Layouts/AppLayout.svelte';

  let { title = 'Page' } = $props();
</script>

<svelte:head>
  <title>{title} | SvelteAdmin</title>
</svelte:head>

<AppLayout>
  <div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{title}</h1>
  </div>

  <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800
              flex flex-col items-center justify-center py-24 text-center">
    <div class="w-16 h-16 rounded-2xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center mb-4"
         aria-hidden="true">
      <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2z"/>
      </svg>
    </div>
    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">{title}</h2>
    <p class="text-sm text-gray-400 mt-2 max-w-sm">
      This section is under construction. Content for <strong>{title}</strong> will appear here.
    </p>
  </div>
</AppLayout>
