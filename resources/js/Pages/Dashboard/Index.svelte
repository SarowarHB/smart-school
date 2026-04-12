<script>
  import { page } from '@inertiajs/svelte';
  import AppLayout from '../../Layouts/AppLayout.svelte';

  let { stats = [] } = $props();

  const iconColors = {
    'users':         { bg: 'bg-violet-100 dark:bg-violet-900/30', text: 'text-violet-600 dark:text-violet-400', bar: 'bg-violet-500' },
    'dollar-sign':   { bg: 'bg-emerald-100 dark:bg-emerald-900/30', text: 'text-emerald-600 dark:text-emerald-400', bar: 'bg-emerald-500' },
    'shopping-cart': { bg: 'bg-orange-100 dark:bg-orange-900/30', text: 'text-orange-600 dark:text-orange-400', bar: 'bg-orange-500' },
    'trending-up':   { bg: 'bg-sky-100 dark:bg-sky-900/30', text: 'text-sky-600 dark:text-sky-400', bar: 'bg-sky-500' },
  };

  const recentOrders = [
    { id: '#INV-001', customer: 'Alice Johnson',  product: 'Pro Plan',   status: 'Paid',    amount: '$99.00'  },
    { id: '#INV-002', customer: 'Bob Smith',      product: 'Starter',    status: 'Pending', amount: '$29.00'  },
    { id: '#INV-003', customer: 'Carol White',    product: 'Enterprise', status: 'Paid',    amount: '$299.00' },
    { id: '#INV-004', customer: 'David Brown',    product: 'Pro Plan',   status: 'Failed',  amount: '$99.00'  },
    { id: '#INV-005', customer: 'Eva Martinez',   product: 'Starter',    status: 'Paid',    amount: '$29.00'  },
  ];

  const statusColors = {
    'Paid':    'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
    'Pending': 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
    'Failed':  'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
  };

  const sparkBars = [40, 65, 45, 70, 55, 80, 60, 90, 75, 85, 70, 95];

  const userName = $derived(page.props.auth?.user?.name ?? 'Admin');
</script>

<svelte:head>
  <title>Dashboard | SvelteAdmin</title>
</svelte:head>

<AppLayout>
  <div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
      Welcome back, {userName}! Here's what's happening today.
    </p>
  </div>

  <!-- Stat cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">
    {#each stats as stat}
      {@const c = iconColors[stat.icon] ?? { bg: 'bg-gray-100 dark:bg-gray-800', text: 'text-gray-600', bar: 'bg-gray-400' }}
      <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800
                  p-5 flex flex-col gap-4 hover:shadow-md transition-shadow">
        <div class="flex items-start justify-between">
          <div>
            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">
              {stat.label}
            </p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{stat.value}</p>
          </div>
          <span class="w-10 h-10 rounded-xl flex items-center justify-center {c.bg}">
            <svg class="w-5 h-5 {c.text}" fill="none" stroke="currentColor" stroke-width="1.8"
                 stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
              {#if stat.icon === 'users'}
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
              {:else if stat.icon === 'dollar-sign'}
                <line x1="12" y1="1" x2="12" y2="23"/>
                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
              {:else if stat.icon === 'shopping-cart'}
                <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
              {:else}
                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
                <polyline points="17 6 23 6 23 12"/>
              {/if}
            </svg>
          </span>
        </div>

        <!-- Sparkline bars -->
        <div class="flex items-end gap-0.5 h-8" aria-hidden="true">
          {#each sparkBars as h, i}
            <div
              class="flex-1 rounded-sm {c.bar}"
              style="height: {h * 0.32}px; opacity: {0.3 + (i / sparkBars.length) * 0.7}"
            ></div>
          {/each}
        </div>

        <div class="flex items-center gap-1.5 text-xs">
          <span class="font-semibold {stat.trend === 'up' ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-500'}">
            {stat.change}
          </span>
          <span class="text-gray-400">vs last month</span>
        </div>
      </div>
    {/each}
  </div>

  <!-- Content grid -->
  <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    <!-- Recent orders -->
    <div class="xl:col-span-2 bg-white dark:bg-gray-900 rounded-2xl border border-gray-200
                dark:border-gray-800 overflow-hidden">
      <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-gray-800">
        <h3 class="font-semibold text-gray-900 dark:text-white">Recent Orders</h3>
        <a href="/invoices" class="text-xs text-primary-600 dark:text-primary-400 hover:underline font-medium">
          View all
        </a>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full text-sm">
          <thead>
            <tr class="text-left border-b border-gray-100 dark:border-gray-800">
              {#each ['Invoice', 'Customer', 'Product', 'Status', 'Amount'] as col}
                <th class="px-6 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                  {col}
                </th>
              {/each}
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
            {#each recentOrders as order}
              <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                <td class="px-6 py-3.5 font-mono text-xs text-gray-600 dark:text-gray-400">{order.id}</td>
                <td class="px-6 py-3.5 font-medium text-gray-900 dark:text-white">{order.customer}</td>
                <td class="px-6 py-3.5 text-gray-600 dark:text-gray-400">{order.product}</td>
                <td class="px-6 py-3.5">
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                               {statusColors[order.status] ?? ''}">
                    {order.status}
                  </span>
                </td>
                <td class="px-6 py-3.5 font-semibold text-gray-900 dark:text-white">{order.amount}</td>
              </tr>
            {/each}
          </tbody>
        </table>
      </div>
    </div>

    <!-- Right column -->
    <div class="space-y-5">

      <!-- Activity feed -->
      <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-5">
        <h3 class="font-semibold text-gray-900 dark:text-white mb-4">Recent Activity</h3>
        <div class="space-y-4">
          {#each [
            { action: 'New user registered',    time: '2 min ago',  color: 'bg-violet-500' },
            { action: 'Order #INV-003 paid',    time: '18 min ago', color: 'bg-emerald-500' },
            { action: 'Product stock updated',  time: '1 hr ago',   color: 'bg-sky-500' },
            { action: 'Failed payment attempt', time: '3 hr ago',   color: 'bg-red-500' },
            { action: 'Report generated',       time: '5 hr ago',   color: 'bg-amber-500' },
          ] as event}
            <div class="flex items-start gap-3">
              <div class="mt-1.5 w-2 h-2 rounded-full {event.color} shrink-0" aria-hidden="true"></div>
              <div>
                <p class="text-sm text-gray-800 dark:text-gray-200">{event.action}</p>
                <p class="text-xs text-gray-400 mt-0.5">{event.time}</p>
              </div>
            </div>
          {/each}
        </div>
      </div>

      <!-- Traffic sources -->
      <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-5">
        <h3 class="font-semibold text-gray-900 dark:text-white mb-4">Traffic Sources</h3>
        <div class="space-y-3">
          {#each [
            { name: 'Organic Search', pct: 42, color: 'bg-primary-500' },
            { name: 'Direct',         pct: 28, color: 'bg-emerald-500' },
            { name: 'Social Media',   pct: 18, color: 'bg-violet-500'  },
            { name: 'Referral',       pct: 12, color: 'bg-amber-500'   },
          ] as src}
            <div>
              <div class="flex items-center justify-between text-xs mb-1">
                <span class="text-gray-700 dark:text-gray-300 font-medium">{src.name}</span>
                <span class="text-gray-500">{src.pct}%</span>
              </div>
              <div class="h-1.5 bg-gray-100 dark:bg-gray-800 rounded-full overflow-hidden" role="progressbar"
                   aria-valuenow={src.pct} aria-valuemin="0" aria-valuemax="100">
                <div class="h-full rounded-full {src.color}" style="width: {src.pct}%"></div>
              </div>
            </div>
          {/each}
        </div>
      </div>
    </div>
  </div>
</AppLayout>
