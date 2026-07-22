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
    Alpine.data('reportsLogic', () => {
        let chartInstance = null;

        return {
            SelectedPeriodType: 'bulanan', // 'bulanan', 'rentang_tanggal'
            SelectedTransactionType: 'pengeluaran', // 'pemasukan', 'pengeluaran'

            // Date Range Selector State
            startDate: '',
            endDate: '',
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
                // Default dates logic: current month start and end
                let currentDate = new Date();
                let year = currentDate.getFullYear();
                let month = currentDate.getMonth();

                let firstDay = new Date(year, month, 1);
                let lastDay = new Date(year, month + 1, 0);

                this.startDate = this.formatYYYYMMDD(firstDay);
                this.endDate = this.formatYYYYMMDD(lastDay);

                this.startPickerMonth = month;
                this.startPickerYear = year;
                this.endPickerMonth = month;
                this.endPickerYear = year;

                this.startPickerCalculateDays();
                this.endPickerCalculateDays();

                this.$nextTick(() => {
                    this.initChart();
                });

                this.$watch('SelectedPeriodType', () => this.updateChart());
                this.$watch('SelectedTransactionType', () => this.updateChart());
                this.$watch('startDate', () => this.updateChart());
                this.$watch('endDate', () => this.updateChart());
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
                console.log(this.endDate);
                this.endPickerOpen = false;
            },

            endPickerIsSelectedDate(day) {
                const d = new Date(this.endPickerYear, this.endPickerMonth, day);
                return this.endDate === this.formatYYYYMMDD(d);
            },

            initChart() {
                const ctx = document.getElementById('pieChart');
                if (!ctx) return;

                const primaryColor = '#015C4B';
                const blueColor = '#3B82F6';
                const orangeColor = '#F97316';
                const amberColor = '#92400E';
                const grayColor = '#9CA3AF';

                chartInstance = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Tempat Tinggal', 'Makanan', 'Transportasi', 'Belanja', 'Lainnya'],
                        datasets: [{
                            data: [40, 20, 15, 15, 10],
                            backgroundColor: [
                                primaryColor,
                                blueColor,
                                orangeColor,
                                amberColor,
                                grayColor
                            ],
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

                let data = [40, 20, 15, 15, 10];
                if (this.SelectedTransactionType === 'pemasukan') {
                    data = [60, 25, 15, 0, 0];
                }

                // Dummy modification based on period
                if (this.SelectedPeriodType === 'rentang_tanggal') {
                    data = data.map(val => Math.max(1, Math.round(val * 0.7)));
                }

                chartInstance.data.datasets[0].data = data;
                chartInstance.update();
            }
        };
    });
});

Alpine.start();
