<x-app-layout>
    <div x-data='reportsLogic(@json($incomes), 
                            @json($expenses), 
                            @json($summary), 
                            "{{ $periodType }}", 
                            "{{ $startDate }}", 
                            "{{ $endDate }}", 
                            "{{ $selectedMonthYear }}")

                const incomesData = @json($incomes);
                const expensesData = @json($expenses);
                const summaryData = @json($summary);
                const periodType = "{{ $periodType }}";
                const startDate = "{{ $startDate }}";
                const endDate = "{{ $endDate }}";
                const selectedMonthYear = "{{ $selectedMonthYear }}";
                
                console.log(`incomesData`, incomesData);
                console.log(`expensesData`, expensesData);
                console.log(`summaryData`, summaryData);
                console.log(`periodType`, periodType);
                console.log(`startDate`, startDate);
                console.log(`endDate`, endDate);
                console.log(`selectedMonthYear`, selectedMonthYear);

                const currentYear =  new Date();
                console.log(`currentYear`, currentYear.getFullYear());
                '
        class="min-h-screen">
        <div class="px-6 py-5 bg-background sticky top-0 z-20">
            <h2 class="text-2xl font-bold text-gray-deep mb-1">Laporan</h2>
            <p class="text-sm text-gray-medium mb-6">Lihat dan analisa Laporan anda.</p>

            <!-- Period Tabs -->
            <x-reports.period-tabs-reports :selectedMonthYear="$selectedMonthYear" />

            <!-- Type Tabs -->
            <x-reports.type-tabs-reports />
        </div>

        <div class="px-6 pb-24">
            <!-- Donut Chart Area -->
            <x-reports.donut-chart-reports />

            <!-- Rincian Kategori Details -->
            <x-reports.detail-category-reports :incomes="$incomes" :expenses="$expenses" />
        </div>
    </div>
</x-app-layout>
