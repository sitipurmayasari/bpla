<div class="col-span-full xl:col-span-6 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
    <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
        <h2 class="font-semibold text-slate-800 dark:text-slate-100">Top Negara Tujuan</h2>
    </header>
    <div class="p-3">

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="table-auto w-full dark:text-slate-300">
                <!-- Table header -->
                <thead class="text-xs uppercase text-slate-400 dark:text-slate-500 bg-slate-50 dark:bg-slate-700 dark:bg-opacity-50 rounded-sm">
                    <tr>
                        <th class="p-2">
                            <div class="font-semibold text-left">Negara</div>
                        </th>
                        <th class="p-2">
                            <div class="font-semibold text-center">Submission</div>
                        </th>
                        <th class="p-2">
                            <div class="font-semibold text-center">Approve</div>
                        </th>
                        <th class="p-2">
                            <div class="font-semibold text-center">Reject</div>
                        </th>
                        <th class="p-2">
                            <div class="font-semibold text-center">Conversion</div>
                        </th>
                    </tr>
                </thead>
                <!-- Table body -->
                <tbody class="text-sm font-medium divide-y divide-slate-100 dark:divide-slate-700">
                    <!-- Row -->
                    @foreach ($topdestination as $item)
                        <tr>
                            <td class="p-2">
                                <div class="text-slate-800 dark:text-slate-100">{{$item->destination->name}}</div>
                            </td>
                            <td class="p-2">
                                <div class="text-center">2.4K</div>
                            </td>
                            <td class="p-2">
                                <div class="text-center text-emerald-500">$3,877</div>
                            </td>
                            <td class="p-2">
                                <div class="text-center">267</div>
                            </td>
                            <td class="p-2">
                                <div class="text-center text-sky-500">4.7%</div>
                            </td>
                        </tr>                        
                    @endforeach
                   
                   
                </tbody>
            </table>

        </div>
    </div>
</div>