<div class="form-group row">
    <div class="col-md-6 offset-md-4">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="{{ $name }}" id="{{ $name }}" {{ old($name) ? 'checked' : '' }}>

            <label class="form-check-label" for="{{ $name }}">
                {{ $label }}
            </label>
        </div>
    </div>
</div>
