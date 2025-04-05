let shiftPressed = false;

document.addEventListener('alpine:init', () => 
{
    Alpine.store('Row', {
        rowId: [],
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
                    this.purgeRowId();
                    this.rowId.push(id);
                }
            }
            
        },

        findRowId(id) {
            if (this.rowId.includes(id)) 
            {
                return true;
            } 
            else {
                return false;
            }
        },

        purgeRowId() {
            this.rowId.length = 0;
        }
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