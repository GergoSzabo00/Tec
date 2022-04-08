<div class="form-check">
    <input class="form-check-input{{ $errors->has($name) ? ' is-invalid' : '' }}" type="checkbox" value="{{$value}}" id="{{$id}}" name="{{$name}}" >
    <label class="form-check-label" for="{{$name}}">{{ $label }}</label>
    @if ($errors->has($name))
    <div class="text-start invalid-feedback">{{ $errorMessage }}</div>
    @endif
</div>