import Alpine from 'alpinejs';
import Swal from 'sweetalert2';

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

        submitForm(actionType) {
            if (!this.transactionsAmount || this.transactionsAmount <= 0) {
                this.amountError = true;
                return;
            }

            this.isSubmitting = true;
            setTimeout(() => {
                this.isSubmitting = false;
                Swal.fire({
                    title: 'Success!',
                    text: actionType === 'create' ? 'Transaksi berhasil ditambahkan.' : 'Transaksi berhasil diubah.',
                    icon: 'success',
                    confirmButtonColor: '#015C4B'
                }).then(() => {
                    window.location.href = '/history';
                });
            }, 5000);
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
                        window.location.href = '/history';
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
});

Alpine.start();
