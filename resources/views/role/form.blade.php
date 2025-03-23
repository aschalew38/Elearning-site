<div class="form-group col-md-12">
    <label for="name_field">Role Name</label>
    <input type="text" id="name_field" name="name" value="{{ old('name') ?? ($role?->name ?? '') }}" required
        class="form-control @error('name') is-invalid @enderror">
    @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
