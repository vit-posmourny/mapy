let shiftPressed = false;

document.addEventListener('alpine:init', () => {
    Alpine.store('Row', {
        selectedRowIds: [],
        lastClickedRowId: null,

        pushRowId(id) {
            const index = this.selectedRowIds.indexOf(id);
            if (index !== -1) {
                if (!shiftPressed) {
                    this.selectedRowIds.splice(index, 1);
                }
            } else {
                this.selectedRowIds.push(id);
            }
            this.lastClickedRowId = id;
        },

        findRowId(id) {
            return this.selectedRowIds.includes(id);
        },

        purgeRowId() {
            this.selectedRowIds = [];
            this.lastClickedRowId = null;
        },

        selectRange(fromId, toId) {
            const tableBody = document.querySelector('#modal_table tbody');
            if (!tableBody) return;
            const rows = Array.from(tableBody.querySelectorAll('tr'));
            const fromIndex = rows.findIndex(row => parseInt(row.dataset.rowId) === fromId);
            const toIndex = rows.findIndex(row => parseInt(row.dataset.rowId) === toId);

            if (fromIndex !== -1 && toIndex !== -1) {
                const start = Math.min(fromIndex, toIndex);
                const end = Math.max(fromIndex, toIndex);

                for (let i = start; i <= end; i++) {
                    const rowId = parseInt(rows[i].dataset.rowId);
                    if (!this.selectedRowIds.includes(rowId)) {
                        this.selectedRowIds.push(rowId);
                    }
                }
            }
        }
    })
})

document.addEventListener('keydown', function(event) {
    if (event.shiftKey) {
        shiftPressed = true;
    }
})

document.addEventListener('keyup', function(event) {
    if (event.key === 'Shift') {
        shiftPressed = false;
    }
})

document.addEventListener('deleteOk', () => {
    this.selectedRowIds = [];
})