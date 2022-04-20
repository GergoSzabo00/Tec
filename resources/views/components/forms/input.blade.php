<div class="{{ $class ? ' '.$class : ''}}">
    @if ($label)
        <label class="ms-2" for="{{ $name }}">
            {{ $label }}
        </label>
    @endif
    @if ($icon)
        <div class="position-relative">    
            <i class="input-icon fa fa-fw fa-{{ $icon }}"></i>
    @endif
    <input 
        type="{{ $type }}"
        class="form-control form-control-lg rounded-pill{{ $icon ? ' has-icon': ''}}{{ $errors->has($name) ? ' is-invalid' : '' }}"
        id="{{ $id }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        value="{{ old($name, $value) }}"
        {{ $attributes }}>
    @if ($errors->has($name))
        <div class="text-start invalid-feedback">{{ $errors->first($name) }}</div>
    @endif
    @if ($icon)
        </div>
    @endif
</div>