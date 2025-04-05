let shiftPressed = false;

document.addEventListener('alpine:init', () => 
{
    Alpine.store('Row', {
        rowIds: [],
        lastClickedRowId: null,
        // array indexOf() method returns -1 if the value is not found
        // method returns the first index (position) of a specified value
        pushRowId(id) {
            if (index = this.rowIds.indexOf(id) + 1) 
            {
                this.rowIds.splice(index-1, 1);
                this.lastClickedRowId = null;
            } 
            else {
                if (shiftPressed) 
                {
                    this.rowIds.push(id);
                    this.lastClickedRowId = id;
                } else {
                    this.rowIds.length = 0;
                    this.rowIds.push(id);
                    this.lastClickedRowId = id;
                }
            }
        },

        findRowId(id) {
            return this.rowIds.includes(id);
        },

        selectRange(fromId, toId) {
            const tableBody = document.querySelector('#modal-table > tbody');
            if (!tableBody) return;
            const rows = Array.from(tableBody.querySelectorAll('tr'));
            const fromIndex = rows.findIndex(row => parseInt(row.dataset.rowIds) === fromId);
            const toIndex = rows.findIndex(row => parseInt(row.dataset.rowIds) === toId);

            if (fromIndex !== -1 && toIndex !== -1) {
                const start = Math.min(fromIndex, toIndex);
                const end = Math.max(fromIndex, toIndex);

                for (let i = start; i <= end; i++) {
                    const rowIds = parseInt(rows[i].dataset.rowIds);
                    if (!this.rowIds.includes(rowIds)) {
                        this.rowIds.push(rowIds);
                    }
                }
            }
        },
    })
})


// pomocna fce. pro zjisteni, co obsahuje pole rowIds
document.addEventListener('keydown', function(event) 
{
    let string;
    if (event.altKey) 
    {
        Alpine.store('Row').rowIds.forEach(value => {
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