<div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-4">

    {{-- BCA --}}
    <div
        class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 p-4 flex items-start gap-3 shadow-sm">
        <div
            class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center flex-shrink-0">
            <span class="text-xs font-black text-blue-700 dark:text-blue-300">BCA</span>
        </div>
        <div>
            <p class="text-xs text-gray-500 underline decoration-blue-500/30 uppercase tracking-wide font-bold">Bank BCA</p>
            <p class="text-base font-bold text-gray-900 dark:text-gray-100 tracking-widest mt-0.5">
                1234 5678 90
            </p>
            <p class="text-xs font-medium text-gray-700 dark:text-gray-400 mt-0.5">a/n PlayTest Indonesia</p>
        </div>
    </div>

    {{-- Mandiri --}}
    <div
        class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 p-4 flex items-start gap-3 shadow-sm">
        <div
            class="w-10 h-10 rounded-lg bg-yellow-100 dark:bg-yellow-900/40 flex items-center justify-center flex-shrink-0">
            <span class="text-xs font-black text-yellow-700 dark:text-yellow-300">MDR</span>
        </div>
        <div>
            <p class="text-xs text-gray-500 underline decoration-yellow-500/30 uppercase tracking-wide font-bold">Bank Mandiri</p>
            <p class="text-base font-bold text-gray-900 dark:text-gray-100 tracking-widest mt-0.5">
                1090 0987 6543 21
            </p>
            <p class="text-xs font-medium text-gray-700 dark:text-gray-400 mt-0.5">a/n PlayTest Indonesia</p>
        </div>
    </div>

</div>

{{-- Petunjuk transfer --}}
<div class="rounded-lg bg-red-100 dark:bg-red-950/50 border-2 border-red-200 dark:border-red-800 p-3 mb-2">
    <div class="flex gap-2">
        <x-heroicon-o-information-circle class="w-5 h-5 text-red-800 dark:text-red-400 flex-shrink-0 mt-0.5" />
        <div class="text-xs space-y-2">
            <p class="font-black text-slate-950 dark:text-white uppercase tracking-wide">Cara pembayaran:</p>
            <ol class="list-decimal list-inside space-y-1 text-slate-900 dark:text-slate-100 font-black">
                <li>Transfer sesuai total di ringkasan kanan</li>
                <li>Screenshot bukti transfer</li>
                <li>Upload di form di bawah ini</li>
            </ol>
        </div>
    </div>
</div>