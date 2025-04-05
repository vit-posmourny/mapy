let shiftPressed = false;

document.addEventListener('alpine:init', () => 
{
    Alpine.store('Row', {
        rowId: [],
        lastClickedRowId: null,
        // array indexOf() method returns -1 if the value is not found
        // method returns the first index (position) of a specified value
        pushRowId(id) {
            if (n = this.rowId.indexOf(id) + 1) 
            {
                this.rowId[n-1] = null;
            } 
            else {
                if (shiftPressed) 
                {
                    this.rowId.push(id);
                } else {
                    this.rowId.length = 0;
                    this.rowId.push(id);
                }
            }
        },

        findRowId(id) {
            return this.rowId.includes(id);
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
        },
    })
})


// pomocna fce. pro zjisteni, co obsahuje pole rowId
document.addEventListener('keydown', function(event) 
{
    let string;
    if (event.altKey) 
    {
        Alpine.store('Row').rowId.forEach(value => {
            string += ' ' + value;
        });
         alert(string);
    }   

     if (event.shiftKey)
    {
        shiftPressed = true;
    }
})


document.addEventListener('keyup', function(event)
{
    if (event.key === 'Shift')
    {
        shiftPressed = false;
    }
})


document.addEventListener('deleteOk', () => 
{
    Alpine.store('Row').purgeRowId();
})