import Alpine from 'alpinejs';
import Swal from 'sweetalert2';
import Chart from 'chart.js/auto';

window.Alpine = Alpine;
window.Swal = Swal;

document.addEventListener('alpine:init', () => {
    // 1. Month Selector Component Logic
    Alpine.data('monthSelector', () => ({
        SelectedMonthAndYear: '',
        datePickerOpen: false,
        datePickerMonth: '',
        datePickerYear: '',
        datePickerMonthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],

        init() {
            let currentDate = new Date();
            this.datePickerMonth = currentDate.getMonth();
            this.datePickerYear = currentDate.getFullYear();
            this.updateSelectedValue();
        },

        get formattedMonthYear() {
            return `${this.datePickerMonthNames[this.datePickerMonth]} ${this.datePickerYear}`;
        },

        prevMonth() {
            if (this.datePickerMonth === 0) {
                this.datePickerYear--;
                this.datePickerMonth = 11;
            } else {
                this.datePickerMonth--;
            }
            this.updateSelectedValue();
        },

        nextMonth() {
            if (this.datePickerMonth === 11) {
                this.datePickerMonth = 0;
                this.datePickerYear++;
            } else {
                this.datePickerMonth++;
            }
            this.updateSelectedValue();
        },

        selectMonth(monthIndex) {
            this.datePickerMonth = monthIndex;
            this.updateSelectedValue();
            this.datePickerOpen = false;
        },

        updateSelectedValue() {
            let monthStr = ('0' + (this.datePickerMonth + 1)).slice(-2);
            this.SelectedMonthAndYear = `${monthStr}/${this.datePickerYear}`;
        }
    }));

    // 2. Transaction Form Component Logic (Create/Edit)
    Alpine.data('transactionForm', () => ({
        SelectedTransactionType: 'pengeluaran',
        SelectedCategory: '',
        transactionsAmount: '',
        formattedAmount: '',
        amountError: false,
        isSubmitting: false,

        // Datepicker state
        datePickerOpen: false,
        datePickerValue: '',
        datePickerMonth: '',
        datePickerYear: '',
        datePickerDay: '',
        datePickerDaysInMonth: [],
        datePickerBlankDaysInMonth: [],
        datePickerMonthNames: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        datePickerDays: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],

        init() {
            let currentDate = new Date();
            this.datePickerMonth = currentDate.getMonth();
            this.datePickerYear = currentDate.getFullYear();
            this.datePickerDay = currentDate.getDay();
            this.datePickerValue = this.datePickerFormatDate(currentDate);
            this.datePickerCalculateDays();
        },

        formatAmount(e) {
            // Hapus semua karakter selain angka
            let value = e.target.value.replace(/[^0-9]/g, '');

            if (value === '') {
                this.transactionsAmount = '';
                this.formattedAmount = '';
                this.amountError = true;
                e.target.value = ''; // Paksa input di DOM kosong
                return;
            }

            this.amountError = false;
            this.transactionsAmount = parseInt(value, 10);
            this.formattedAmount = this.transactionsAmount.toLocaleString('id-ID');
            e.target.value = this.formattedAmount; // Paksa input di DOM sesuai format
        },

        submitForm(e) {
            if (!this.transactionsAmount || this.transactionsAmount <= 0) {
                e.preventDefault();
                this.amountError = true;
                Swal.fire({
                    title: 'Kesalahan!',
                    text: 'Jumlah transaksi harus diisi dan tidak boleh kosong atau minus.',
                    icon: 'error',
                    confirmButtonColor: '#015C4B'
                });
                return false;
            }
            if (!this.SelectedCategory) {
                e.preventDefault();
                Swal.fire({
                    title: 'Kesalahan!',
                    text: 'Silakan pilih kategori terlebih dahulu.',
                    icon: 'error',
                    confirmButtonColor: '#015C4B'
                });
                return false;
            }
            return true;
        },

        deleteTransaction() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DC2626',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Transaksi berhasil dihapus.',
                        icon: 'success',
                        confirmButtonColor: '#015C4B'
                    }).then(() => {
                        window.location.href = '/transactions';
                    });
                }
            });
        },

        // Datepicker specific methods
        datePickerCalculateDays() {
            let daysInMonth = new Date(this.datePickerYear, this.datePickerMonth + 1, 0).getDate();
            let dayOfWeek = new Date(this.datePickerYear, this.datePickerMonth).getDay();
            let blankdaysArray = [];
            for (var i = 1; i <= dayOfWeek; i++) {
                blankdaysArray.push(i);
            }
            let daysArray = [];
            for (var i = 1; i <= daysInMonth; i++) {
                daysArray.push(i);
            }
            this.datePickerBlankDaysInMonth = blankdaysArray;
            this.datePickerDaysInMonth = daysArray;
        },
        datePickerPreviousMonth() {
            if (this.datePickerMonth == 0) {
                this.datePickerYear--;
                this.datePickerMonth = 11;
            } else {
                this.datePickerMonth--;
            }
            this.datePickerCalculateDays();
        },
        datePickerNextMonth() {
            if (this.datePickerMonth == 11) {
                this.datePickerMonth = 0;
                this.datePickerYear++;
            } else {
                this.datePickerMonth++;
            }
            this.datePickerCalculateDays();
        },
        datePickerDayClicked(day) {
            let selectedDate = new Date(this.datePickerYear, this.datePickerMonth, day);
            this.datePickerDay = day;
            this.datePickerValue = this.datePickerFormatDate(selectedDate);
            this.datePickerOpen = false;
        },
        datePickerIsSelectedDate(day) {
            const d = new Date(this.datePickerYear, this.datePickerMonth, day);
            return this.datePickerValue === this.datePickerFormatDate(d);
        },
        datePickerIsToday(day) {
            const today = new Date();
            const d = new Date(this.datePickerYear, this.datePickerMonth, day);
            return today.toDateString() === d.toDateString();
        },
        datePickerFormatDate(date) {
            let formattedDate = ('0' + date.getDate()).slice(-2);
            let formattedMonth = this.datePickerMonthNames[date.getMonth()];
            let formattedYear = date.getFullYear();
            return `${formattedDate} ${formattedMonth} ${formattedYear}`;
        }
    }));

    // 3. Header Notification Component Logic
    Alpine.data('headerNav', () => ({
        bellNotify: 'bell',
        isBellClicked: false,

        toggleNotification() {
            this.isBellClicked = !this.isBellClicked;
            if (this.isBellClicked) {
                this.bellNotify = 'silent-bell';
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Notifikasi Dinyalakan",
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                this.bellNotify = 'bell';
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Notifikasi Dimatikan",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }
    }));

    // 4. Reports Logic Component
    Alpine.data('reportsLogic', (initialIncomes = [], initialExpenses = [], initialSummary = {}, initialPeriodType = 'bulanan', initialStartDate = '', initialEndDate = '', initialMonthYear = '') => {
        let chartInstance = null;

        return {
            SelectedPeriodType: initialPeriodType,
            SelectedTransactionType: 'pengeluaran',
            incomes: initialIncomes,
            expenses: initialExpenses,
            summary: initialSummary,
            monthYear: initialMonthYear,

            // Date Range Selector State
            startDate: initialStartDate,
            endDate: initialEndDate,
            startPickerOpen: false,
            endPickerOpen: false,
            startPickerMonth: 0,
            startPickerYear: 2026,
            startPickerDaysInMonth: [],
            startPickerBlankDaysInMonth: [],
            endPickerMonth: 0,
            endPickerYear: 2026,
            endPickerDaysInMonth: [],
            endPickerBlankDaysInMonth: [],

            datePickerMonthNames: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datePickerDays: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],

            init() {
                if (!this.startDate || !this.endDate) {
                    let currentDate = new Date();
                    let year = currentDate.getFullYear();
                    let month = currentDate.getMonth();

                    let firstDay = new Date(year, month, 1);
                    let lastDay = new Date(year, month + 1, 0);

                    this.startDate = this.formatYYYYMMDD(firstDay);
                    this.endDate = this.formatYYYYMMDD(lastDay);
                }

                let sParts = this.startDate.split('-');
                if (sParts.length === 3) {
                    this.startPickerYear = parseInt(sParts[0], 10);
                    this.startPickerMonth = parseInt(sParts[1], 10) - 1;
                }
                let eParts = this.endDate.split('-');
                if (eParts.length === 3) {
                    this.endPickerYear = parseInt(eParts[0], 10);
                    this.endPickerMonth = parseInt(eParts[1], 10) - 1;
                }

                this.startPickerCalculateDays();
                this.endPickerCalculateDays();

                this.$nextTick(() => {
                    this.initChart();
                });

                this.$watch('SelectedPeriodType', (val) => {
                    this.triggerReload();
                });
                this.$watch('startDate', (val) => {
                    this.triggerReload();
                });
                this.$watch('endDate', (val) => {
                    this.triggerReload();
                });
                this.$watch('SelectedTransactionType', (val) => {
                    this.updateChart();
                });
            },

            triggerReload() {
                const url = new URL(window.location.href);
                let changed = false;

                if (url.searchParams.get('period_type') !== this.SelectedPeriodType) {
                    url.searchParams.set('period_type', this.SelectedPeriodType);
                    changed = true;
                }

                if (this.SelectedPeriodType === 'rentang_tanggal') {
                    if (url.searchParams.get('start_date') !== this.startDate) {
                        url.searchParams.set('start_date', this.startDate);
                        changed = true;
                    }
                    if (url.searchParams.get('end_date') !== this.endDate) {
                        url.searchParams.set('end_date', this.endDate);
                        changed = true;
                    }
                }

                if (changed) {
                    window.location.href = url.pathname + url.search;
                }
            },

            formatRupiah(amount) {
                if (amount === undefined || amount === null) return '0';
                return new Intl.NumberFormat('id-ID').format(amount);
            },

            formatYYYYMMDD(date) {
                let year = date.getFullYear();
                let month = ('0' + (date.getMonth() + 1)).slice(-2);
                let day = ('0' + date.getDate()).slice(-2);
                return `${year}-${month}-${day}`;
            },

            formatDisplayDate(dateStr) {
                if (!dateStr) return '';
                let parts = dateStr.split('-');
                if (parts.length !== 3) return '';
                let year = parts[0];
                let monthIndex = parseInt(parts[1], 10) - 1;
                let day = parts[2];
                return `${day} ${this.datePickerMonthNames[monthIndex]} ${year}`;
            },

            // Start Datepicker Methods
            startPickerCalculateDays() {
                let daysInMonth = new Date(this.startPickerYear, this.startPickerMonth + 1, 0).getDate();
                let dayOfWeek = new Date(this.startPickerYear, this.startPickerMonth).getDay();
                let blankdaysArray = [];
                for (var i = 1; i <= dayOfWeek; i++) {
                    blankdaysArray.push(i);
                }
                let daysArray = [];
                for (var i = 1; i <= daysInMonth; i++) {
                    daysArray.push(i);
                }
                this.startPickerBlankDaysInMonth = blankdaysArray;
                this.startPickerDaysInMonth = daysArray;
            },

            startPickerPreviousMonth() {
                if (this.startPickerMonth === 0) {
                    this.startPickerYear--;
                    this.startPickerMonth = 11;
                } else {
                    this.startPickerMonth--;
                }
                this.startPickerCalculateDays();
            },

            startPickerNextMonth() {
                if (this.startPickerMonth === 11) {
                    this.startPickerMonth = 0;
                    this.startPickerYear++;
                } else {
                    this.startPickerMonth++;
                }
                this.startPickerCalculateDays();
            },

            startPickerDayClicked(day) {
                let selectedDate = new Date(this.startPickerYear, this.startPickerMonth, day);
                let formatted = this.formatYYYYMMDD(selectedDate);
                if (this.endDate && formatted > this.endDate) {
                    this.endDate = formatted;
                }
                this.startDate = formatted;
                this.startPickerOpen = false;
            },

            startPickerIsSelectedDate(day) {
                const d = new Date(this.startPickerYear, this.startPickerMonth, day);
                return this.startDate === this.formatYYYYMMDD(d);
            },

            // End Datepicker Methods
            endPickerCalculateDays() {
                let daysInMonth = new Date(this.endPickerYear, this.endPickerMonth + 1, 0).getDate();
                let dayOfWeek = new Date(this.endPickerYear, this.endPickerMonth).getDay();
                let blankdaysArray = [];
                for (var i = 1; i <= dayOfWeek; i++) {
                    blankdaysArray.push(i);
                }
                let daysArray = [];
                for (var i = 1; i <= daysInMonth; i++) {
                    daysArray.push(i);
                }
                this.endPickerBlankDaysInMonth = blankdaysArray;
                this.endPickerDaysInMonth = daysArray;
            },

            endPickerPreviousMonth() {
                if (this.endPickerMonth === 0) {
                    this.endPickerYear--;
                    this.endPickerMonth = 11;
                } else {
                    this.endPickerMonth--;
                }
                this.endPickerCalculateDays();
            },

            endPickerNextMonth() {
                if (this.endPickerMonth === 11) {
                    this.endPickerMonth = 0;
                    this.endPickerYear++;
                } else {
                    this.endPickerMonth++;
                }
                this.endPickerCalculateDays();
            },

            endPickerDayClicked(day) {
                let selectedDate = new Date(this.endPickerYear, this.endPickerMonth, day);
                let formatted = this.formatYYYYMMDD(selectedDate);
                if (this.startDate && formatted < this.startDate) {
                    this.startDate = formatted;
                }
                this.endDate = formatted;
                this.endPickerOpen = false;
            },

            endPickerIsSelectedDate(day) {
                const d = new Date(this.endPickerYear, this.endPickerMonth, day);
                return this.endDate === this.formatYYYYMMDD(d);
            },
            getCategoryColor(name) {
                const colors = {
                    'tempat tinggal': '#015C4B',
                    'makan': '#3B82F6',
                    'makanan & minuman': '#3B82F6',
                    'transportasi': '#F97316',
                    'belanja': '#92400E',
                    'gaji': '#10B981',
                    'gaji & bonus': '#10B981',
                    'investasi': '#3B82F6',
                    'sampingan': '#A855F7',
                };
                return colors[name.toLowerCase()] || '#9CA3AF';
            },

            getChartData() {
                const items = this.SelectedTransactionType === 'pemasukan' ? this.incomes : this.expenses;
                if (!items || items.length === 0) {
                    return {
                        labels: ['Tidak ada data'],
                        data: [100],
                        colors: ['#E5E7EB']
                    };
                }

                const labels = items.map(item => item.nama);
                const data = items.map(item => item.percent_num);
                const colors = items.map(item => this.getCategoryColor(item.nama));

                return { labels, data, colors };
            },

            initChart() {
                const ctx = document.getElementById('pieChart');
                if (!ctx) return;

                const chartData = this.getChartData();

                chartInstance = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: chartData.labels,
                        datasets: [{
                            data: chartData.data,
                            backgroundColor: chartData.colors,
                            borderWidth: 4,
                            borderColor: '#ffffff',
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        cutout: '75%',
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        if (context.label === 'Tidak ada data') return ' Tidak ada data';
                                        return ` ${context.label}: ${context.raw}%`;
                                    }
                                }
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            },

            updateChart() {
                if (!chartInstance) return;

                const chartData = this.getChartData();

                chartInstance.data.labels = chartData.labels;
                chartInstance.data.datasets[0].data = chartData.data;
                chartInstance.data.datasets[0].backgroundColor = chartData.colors;
                chartInstance.update();
            }
        };
    });
});

Alpine.start();
