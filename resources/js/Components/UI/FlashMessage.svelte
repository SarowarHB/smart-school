<script>
  import { page } from '@inertiajs/svelte';

  let visible = $state(false);
  let message = $state('');
  let type    = $state('success');  // 'success' | 'error'
  let timer;

  $effect(() => {
    const flash = page.props.flash;
    if (flash?.success) {
      message = flash.success;
      type    = 'success';
      visible = true;
      clearTimeout(timer);
      timer = setTimeout(() => visible = false, 4000);
    } else if (flash?.error) {
      message = flash.error;
      type    = 'error';
      visible = true;
      clearTimeout(timer);
      timer = setTimeout(() => visible = false, 5000);
    }
  });
</script>

{#if visible}
  <div
    role="alert"
    class="fixed bottom-5 right-5 z-50 flex items-start gap-3 max-w-sm w-full px-4 py-3.5
           rounded-xl shadow-lg border backdrop-blur-sm
           {type === 'success'
             ? 'bg-emerald-50 dark:bg-emerald-900/80 border-emerald-200 dark:border-emerald-700 text-emerald-800 dark:text-emerald-200'
             : 'bg-red-50 dark:bg-red-900/80 border-red-200 dark:border-red-700 text-red-800 dark:text-red-200'}
           animate-[slideUp_0.2s_ease-out]"
  >
    <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
      {#if type === 'success'}
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/>
      {:else}
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/>
      {/if}
    </svg>
    <p class="text-sm font-medium flex-1">{message}</p>
    <button
      onclick={() => visible = false}
      aria-label="Dismiss notification"
      class="shrink-0 opacity-60 hover:opacity-100 transition-opacity"
    >
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <line x1="18" y1="6" x2="6" y2="18"/>
        <line x1="6" y1="6" x2="18" y2="18"/>
      </svg>
    </button>
  </div>
{/if}

<style>
  @keyframes slideUp {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
  }
</style>
