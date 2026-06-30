<div>
    @foreach($workExperiences as $key => $workExperience)
    <div>
        <input type="text" name="workExperiences.{{ $key }}.role" wire:model="workExperiences.{{ $key }}.role" class="form-control px-1 mb-md-5 mb-3" id="workExperiences.{{ $key }}.role" placeholder="Role">
        <input type="text" name="workExperiences.{{ $key }}.project_link" wire:model="workExperiences.{{ $key }}.project_link" class="form-control px-1 mb-md-5 mb-3 d-inline-block" id="workExperiences.{{ $key }}.project_link" placeholder="Project Link">
        <div class="form-floating my-3">
            <textarea class="form-control border rounded-2" rows="5" name="workExperiences.{{ $key }}.responsibilities" wire:model="workExperiences.{{ $key }}.responsibilities" placeholder="Responsibility" id="workExperiences.{{ $key }}.responsibilities"></textarea>
            <label for="floatingTextarea">Responsibility</label>
        </div>
    </div>
    <div>
        @if(sizeof($workExperiences) > 1)
            <a wire:click="remove({{ $key }})" class="btn btn-danger text-white">Remove</a>
        @endif
        @if((sizeof($workExperiences) - 1) == $key)
            <a wire:click="addMore()" class="btn btn-primary text-white">Add More</a>
        @endif
    </div>
    @endforeach
    <input type="hidden" name="work_experience" value="{{ json_encode($workExperiences) }}" />
</div>