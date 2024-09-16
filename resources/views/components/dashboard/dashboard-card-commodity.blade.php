<div class="flex flex-col col-span-full sm:col-span-6 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
    <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
        <h2 class="font-semibold text-slate-800 dark:text-slate-100">Komoditas (Year {{date('Y')}})</h2>
    </header>
    <div id="dashboard-card-commodity-legend" class="px-5 py-3">
        <ul class="flex flex-wrap"></ul>
    </div>
    <div class="grow">
        <canvas id="dashboard-card-commodity" width="595" height="248"></canvas>
    </div>
</div>