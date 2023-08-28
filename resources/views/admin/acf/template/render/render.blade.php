<input type="hidden" name="template[{{ $parentIndex }}][template_id]" value="{{ $field->acf_template_id }}">
<input type="hidden" name="template[{{ $parentIndex }}][fields][{{ $index }}][id]" value="{{ $field->id }}">
<input type="hidden" name="template[{{ $parentIndex }}][fields][{{ $index }}][type]" value="{{ $field->type }}">
<input type="hidden" name="template[{{ $parentIndex }}][fields][{{ $index }}][validation]" value="{{ json_encode($field->props['validation']) }}">
@switch($field->type)
    @case('Text')
        <div class="acf-field">
            <label>
                <span class="acf-label-title">{{ $field->label }}</span>
                @if(isset($field->props['required']) && $field->props['required'])
                    <span class="acf-required">*</span>
                @endif
            </label>
            <input type="text"
                   name="template[{{ $parentIndex }}][fields][{{ $index }}][value]"
                   @if(isset($field->props['required']) && $field->props['required']) required @endif
                   value="@if(isset($old)){{ $old->value }}@elseif(isset($field->props['defaultValue'])){{ $field->props['defaultValue'] }}@endif"
                   maxlength="@if(isset($field->props['charLimit'])){{ $field->props['charLimit'] }}@endif"
                   placeholder="@if(isset($field->props['placeHolder'])){{ $field->props['placeHolder'] }}@endif">

            @if(isset($field->props['description']))
                <p class="acf-description">{{ $field->props['description'] }}</p>
            @endif
        </div>
    @break

    @case('Select')
    <div class="acf-field">
        <label>
            <span class="acf-label-title">{{ $field->label }}</span>
            @if(isset($field->props['required']) && $field->props['required'])
                <span class="acf-required">*</span>
            @endif
        </label>
        <select @if(isset($field->props['required']) && $field->props['required']) required @endif>
            <option value="">@if(isset($field->props['placeHolder'])){{ $field->props['placeHolder'] }}@else{{ 'انتخاب کنید' }}@endif</option>
            @if(isset($field->props['select']) && is_array($field->props['select']))
                @foreach($field->props['select'] as $option)
                    <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                @endforeach
            @endif

        </select>
        @if(isset($field->props['description']))
            <p class="acf-description">{{ $field->props['description'] }}</p>
        @endif
    </div>
    @break

    @case('Image')
        <div class="acf-field">
            <label>
                <span class="acf-label-title">{{ $field->label }}</span>
                @if(isset($field->props['required']) && $field->props['required'])
                    <span class="acf-required">*</span>
                @endif
            </label>
            <input type="file" accept="@if(isset($field->props['extensions']) && is_array($field->props['extensions'])){{ collect($field->props['extensions'])->implode(',') }}@endif"
                   @if(isset($field->props['required']) && $field->props['required']) required @endif
                   placeholder="@if(isset($field->props['placeHolder'])){{ $field->props['placeHolder'] }}@endif">
            @if(isset($field->props['description']))
                <p class="acf-description">{{ $field->props['description'] }}</p>
            @endif
        </div>
    @break

    @case('Textarea')
        <div class="acf-field">
            <label>
                <span class="acf-label-title">{{ $field->label }}</span>
                @if(isset($field->props['required']) && $field->props['required'])
                    <span class="acf-required">*</span>
                @endif
            </label>
            <textarea  name="template[{{ $parentIndex }}][fields][{{ $index }}][value]"
                   @if(isset($field->props['required']) && $field->props['required']) required @endif
                   maxlength="@if(isset($field->props['charLimit'])){{ $field->props['charLimit'] }}@endif"
                   rows="@if(isset($field->props['rows'])){{ $field->props['rows'] }}@endif"
                   placeholder="@if(isset($field->props['placeHolder'])){{ $field->props['placeHolder'] }}@endif">@if(isset($old)){{ $old->value }}@elseif(isset($field->props['defaultValue'])){{ $field->props['defaultValue'] }}@endif</textarea>
            @if(isset($field->props['description']))
                <p class="acf-description">{{ $field->props['description'] }}</p>
            @endif
        </div>
    @break

    @case('Range')
        <div class="acf-field">
            <label>
                <span class="acf-label-title">{{ $field->label }}</span>
                @if(isset($field->props['required']) && $field->props['required'])
                    <span class="acf-required">*</span>
                @endif
            </label>

            <div class="acf-range-container">
                <input type="text"
                       name="template[{{ $parentIndex }}][fields][{{ $index }}][minimum]"
                       placeholder="کمترین مقدار"
                       value="@if(isset($old)){{ explode('|',$old->value)[0] }}@elseif(isset($field->props['defaultMinimum'])){{ $field->props['defaultMinimum'] }}@endif">

                <input type="text"
                       name="template[{{ $parentIndex }}][fields][{{ $index }}][maximum]"
                       placeholder="بیشترین مقدار"
                       value="@if(isset($old)){{ explode('|',$old->value)[1] }}@elseif(isset($field->props['defaultMaximum'])){{ $field->props['defaultMaximum'] }}@endif">
            </div>
            @if(isset($field->props['description']))
                <p class="acf-description">{{ $field->props['description'] }}</p>
            @endif
        </div>
    @break

    @case('Email')
        <div class="acf-field">
            <label>
                <span class="acf-label-title">{{ $field->label }}</span>
                @if(isset($field->props['required']) && $field->props['required'])
                    <span class="acf-required">*</span>
                @endif
            </label>
            <input type="email"
                   name="template[{{ $parentIndex }}][fields][{{ $index }}][value]"
                   @if(isset($field->props['required']) && $field->props['required']) required @endif
                   value="@if(isset($old)){{ $old->value }}@elseif(isset($field->props['defaultValue'])){{ $field->props['defaultValue'] }}@endif"
                   placeholder="@if(isset($field->props['placeHolder'])){{ $field->props['placeHolder'] }}@endif">
            @if(isset($field->props['description']))
                <p class="acf-description">{{ $field->props['description'] }}</p>
            @endif
        </div>
    @break

    @case('Url')
        <div class="acf-field">
            <label>
                <span class="acf-label-title">{{ $field->label }}</span>
                @if(isset($field->props['required']) && $field->props['required'])
                    <span class="acf-required">*</span>
                @endif
            </label>
            <input type="text"
                   name="template[{{ $parentIndex }}][fields][{{ $index }}][value]"
                   @if(isset($field->props['required']) && $field->props['required']) required @endif
                   value="@if(isset($old)){{ $old->value }}@elseif(isset($field->props['defaultValue'])){{ $field->props['defaultValue'] }}@endif"
                   placeholder="@if(isset($field->props['placeHolder'])){{ $field->props['placeHolder'] }}@endif">
            @if(isset($field->props['description']))
                <p class="acf-description">{{ $field->props['description'] }}</p>
            @endif
        </div>
    @break
@endswitch