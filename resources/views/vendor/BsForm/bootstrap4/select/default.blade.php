<?php $invalidClass = $errors->{$errorBag}->has($nameWithoutBrackets) ? ' is-invalid' : ''; ?>
<div class="form-group">
    @if($label)
        {{ Form::label($name, $label, ['class' => 'content-label']) }}
    @endif

    {{ Form::select($name, $options, $value, array_merge(['class' => "form-control$invalidClass"], $attributes)) }}

    @if($inlineValidation)
        @if($errors->{$errorBag}->has($nameWithoutBrackets))
            <div class="invalid-feedback">{{ $errors->{$errorBag}->first($nameWithoutBrackets) }}</div>
        @else
            <strong class="help-block">{{ $note }}</strong>
        @endif
    @else
        <strong class="help-block">{{ $note }}</strong>
    @endif
</div>
