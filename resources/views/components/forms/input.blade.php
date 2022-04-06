<div class="{{ $icon ? 'position-relative ' : '' }}mb-3">
    @if ($icon)    
        <i class="input-icon fa fa-{{ $icon }}"></i>
    @endif
    <input 
        type="{{ $type }}"
        class="form-control form-control-lg rounded-pill{{ $icon ? ' has-icon': ''}}{{ $errors->has($name) ? ' is-invalid' : '' }}"
        id="{{ $id }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        value="{{ old($name, $value) }}">
    @if ($errors->has($name))
        <div class="text-start invalid-feedback">{{ $errors->first($name) }}</div>
    @endif
</div>