<div class="col-lg-6">
    <div class="page-header">
        <h2 class="mb-0 text-center">Subscribe <span class="text-primary">Now</span></h2>
    </div>
    <div class="d-flex subscribe-bar py-2 justify-content-center" role="subscribe">
        <input wire:model="email" class="form-control border-end-0 border-primary rounded-0 w-50" type="email"
            placeholder="Email Address" aria-label="Search">
        <button class="btn btn-primary rounded-0" wire:click="subscribe">Subscribe</button>
    </div>
    @error('email') <span class="error d-flex subscribe-bar justify-content-center">{{ $message }}</span> @enderror
</div>