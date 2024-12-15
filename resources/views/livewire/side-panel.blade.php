<div class="w-1/4 shadow-2xl p-8 text-xl font-medium overflow-hidden min-w-96">

    <form wire:submit.prevent="store" x-data="inputValidation()" class="flex flex-col gap-8">
        
        <div class="grid grid-cols-8 items-baseline align-between gap-4 ooverflow-hidden">
            <span class="select-none">Lat:</span><x-text-input id="latitude" x-model="latit" x-on:input="validate" wire:model="latitude" name="latitude" class="col-span-7"/>
            <span x-show="errors.latit" class="error" x-text="errors.latit"></span>

            <span class="select-none">Lon:</span><x-text-input id="longitude" wire:model="longitude" name="longitude" class="col-span-7"/> 
            <span class="select-none col-span-3">Elevation:</span><x-text-input id="elevation" wire:model="elevation" name="elevation" class="col-span-4 text-right"/><span class="select-none col-span-1 text-right">m</span>
        </div>

            <x-primary-button>Store to database</x-primary-button>

    </form>

    <script>
        function inputValidation() {

            return {
                latit: "",
                errors: {},
    
                validate() {

                    this.errors = {}; // Reset errors
          
                    // Rule: Required
                    if (!this.latit) {
                      this.errors.latit = 'latitude is required.';
                    }
          
                    // Rule: Minimum length
                    if (this.latit && this.latit.length < 5) {
                      this.errors.latit = 'latitude must be at least 5 characters.';
                    }
          
                    // Rule: Pattern (e.g., only letters and numbers)
                    const pattern = /^[a-zA-Z0-9]+$/;
                    if (this.latit && !pattern.test(this.latit)) {
                      this.errors.latit = 'latitude can only contain letters and numbers.';
                    }
                },
            };
        }
    </script>

</div>


{{-- <div x-data="inputValidation()">
    <form @submit.prevent="submitForm">
      <!-- Input Field -->
      <label for="username">Username:</label>
      <input
        type="text"
        id="username"
        x-model="username"
        @input="validate"
        placeholder="Enter username"
      />
      <span x-show="errors.username" class="error" x-text="errors.username"></span>

      <!-- Submit Button -->
      <button type="submit" :disabled="Object.keys(errors).length > 0">
        Submit
      </button>
    </form>
  </div>

  <script>
    function inputValidation() {
      return {
        username: '',
        errors: {},

        validate() {
          this.errors = {}; // Reset errors

          // Rule: Required
          if (!this.username) {
            this.errors.username = 'Username is required.';
          }

          // Rule: Minimum length
          if (this.username && this.username.length < 5) {
            this.errors.username = 'Username must be at least 5 characters.';
          }

          // Rule: Pattern (e.g., only letters and numbers)
          const pattern = /^[a-zA-Z0-9]+$/;
          if (this.username && !pattern.test(this.username)) {
            this.errors.username = 'Username can only contain letters and numbers.';
          }
        },

        submitForm() {
          alert('Form submitted successfully!');
        },
      };
    }
  </script> --}}