<x-filament-panels::page>
    <div class="space-y-8">
        <!-- Welcome Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                    Welcome back, {{ explode(' ', auth()->user()->name ?? 'Alex')[0] }}!
                </h1>
                <p class="mt-1 text-sm font-medium text-gray-500 dark:text-gray-400">
                    Here's what's happening with your playtests today.
                </p>
            </div>
            <button class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-bold text-white transition-colors bg-[#4F46E5] rounded-lg hover:bg-indigo-700 shadow-sm border border-transparent">
                <svg class="w-5 h-5 font-bold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                Create New Test
            </button>
        </div>

        <!-- Metrics Grid -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3 text-center sm:text-left">
            <!-- Active Testing -->
            <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-2xl dark:bg-gray-900 dark:border-gray-800">
                <div class="flex items-center justify-center w-10 h-10 mb-4 mx-auto sm:mx-0 text-blue-600 bg-blue-50 rounded-xl dark:bg-blue-900/30 dark:text-blue-400">
                    <svg class="w-5 h-5 ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                </div>
                <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400">Active Testing</h3>
                <p class="mt-1 text-3xl font-bold text-gray-900 dark:text-white">{{ $activeCount }}</p>
            </div>

            <!-- Completed Tests -->
            <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-2xl dark:bg-gray-900 dark:border-gray-800">
                <div class="flex items-center justify-center w-10 h-10 mb-4 mx-auto sm:mx-0 text-emerald-500 bg-emerald-50 rounded-xl dark:bg-emerald-900/30 dark:text-emerald-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"/></svg>
                </div>
                <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400">Completed Tests</h3>
                <p class="mt-1 text-3xl font-bold text-gray-900 dark:text-white">{{ $completedCount }}</p>
            </div>

            <!-- Total Testers -->
            <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-2xl dark:bg-gray-900 dark:border-gray-800">
                <div class="flex items-center justify-center w-10 h-10 mb-4 mx-auto sm:mx-0 text-purple-600 bg-purple-50 rounded-xl dark:bg-purple-900/30 dark:text-purple-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400">Total Testers Recruited</h3>
                <p class="mt-1 text-3xl font-bold text-gray-900 dark:text-white">{{ $testersCount }}</p>
            </div>
        </div>

        <!-- Recent Applications Section -->
        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl overflow-hidden dark:bg-gray-900 dark:border-gray-800">
            <div class="flex items-center justify-between px-6 py-5 border-b border-gray-50 dark:border-gray-800">
                <h2 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white">Recent Applications</h2>
                <a href="#" class="text-sm font-bold text-[#4F46E5] hover:text-indigo-700 dark:text-indigo-400">View All</a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left whitespace-nowrap">
                    <thead>
                        <tr class="text-[11px] font-bold tracking-widest text-gray-400 uppercase border-b border-gray-50 dark:border-gray-800">
                            <th class="px-6 py-4">App Name</th>
                            <th class="px-6 py-4 border-l border-gray-50 dark:border-gray-800">Platform</th>
                            <th class="px-6 py-4 border-l border-gray-50 dark:border-gray-800">Status & Progress</th>
                            <th class="px-6 py-4 border-l border-gray-50 dark:border-gray-800">Date Started</th>
                            <th class="px-6 py-4 text-right border-l border-gray-50 dark:border-gray-800">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-gray-800 text-[13px]">
                        @forelse($recentMisis as $misi)
                        @php
                            // Extract target testers from package description (e.g., "20 Testers")
                            preg_match('/\d+/', $misi->paket->desc ?? '20', $matches);
                            $target = $matches[0] ?? 20;
                            $count = $misi->misi_anggotas_count ?? 0;
                            $percent = ($target > 0) ? min(100, ($count / $target) * 100) : 0;
                            
                            $statusColor = match($misi->status) {
                                'Completed' => 'emerald',
                                'Pending' => 'amber',
                                default => 'indigo',
                            };
                            
                            $progressColor = match($misi->status) {
                                'Completed' => 'bg-emerald-500',
                                'Pending' => 'bg-amber-400',
                                default => 'bg-[#4F46E5]',
                            };
                        @endphp
                        <tr class="group hover:bg-gray-50 transition-colors dark:hover:bg-gray-800/50">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center justify-center w-11 h-11 text-lg font-bold text-white bg-indigo-500 rounded-lg shadow-sm">
                                        {{ substr($misi->nama_aplikasi, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-extrabold text-[#111827] dark:text-white">{{ $misi->nama_aplikasi }}</div>
                                        <div class="text-[11px] font-bold text-gray-400 mt-0.5">v1.0.0</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-gray-500 dark:text-gray-400">Android</td>
                            <td class="px-6 py-4">
                                <div class="w-64">
                                    <div class="flex items-center justify-between mb-2.5">
                                        <span class="px-2.5 py-0.5 text-[10px] font-extrabold text-{{ $statusColor }}-600 bg-{{ $statusColor }}-50 rounded-full dark:bg-{{ $statusColor }}-900/40 dark:text-{{ $statusColor }}-300 uppercase tracking-widest leading-none flex items-center h-5">
                                            {{ $misi->status }}
                                        </span>
                                        <span class="text-[11px] font-bold text-gray-400">{{ $count }}/{{ $target }} Testers</span>
                                    </div>
                                    <div class="w-full h-2 bg-gray-100 rounded-full dark:bg-gray-800">
                                        <div class="h-2 {{ $progressColor }} rounded-full" style="width: {{ $percent }}%"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-gray-500 dark:text-gray-400">{{ $misi->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-right">
                                <button class="px-4 py-2 text-[13px] font-bold text-gray-700 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 transition-colors dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300">
                                    {{ $misi->status === 'Completed' ? 'Report' : 'Details' }}
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-400 font-medium">
                                No applications found. Start by creating a new test!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-filament-panels::page>
