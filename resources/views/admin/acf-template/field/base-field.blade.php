@php
    $_index = '__INDEX__';
    $_index_label = '__INDEX__LABEL__';
    if (!is_null($index)) $_index = $index;
    if (!is_null($index)) $_index_label = $index + 1;
@endphp
<tr>
    <td class="acf-td-desc">
        <h4>
            <span>لیبل</span>
            <span class="text-red">*</span>
        </h4>
        <p>لیبل فیلد در زمان ویرایش</p>
    </td>
    <td class="acf-td-field">
        <input class="acf-inp-label" name="fields[{{ $_index }}][label]" type="text" value="@if(isset($field->props['label'])) {{ $field->props['label'] }}@endif">
    </td>
</tr>
<tr>
    <td class="acf-td-desc">
        <h4>
            <span>نام (EN)</span>
            <span class="text-red">*</span>
        </h4>
        <p>نام متغییر قابل دسترسی در قالب</p>
    </td>
    <td class="acf-td-field">
        <input class="acf-sort-position" type="hidden" name="fields[{{ $_index }}][sort_position]" value="">
        <input class="acf-inp-name" name="fields[{{ $_index }}][name]" type="text" value="@if(isset($field->props['label'])) {{ $field->props['name'] }}@endif">
        @if(isset($field))
            <input type="hidden" name="fields[{{ $_index }}][id]" value="{{ $field->id }}">
        @endif
    </td>
</tr>
<tr>
    <td class="acf-td-desc">
        <h4>الزامی</h4>
        <p>فیلد در زمان ویرایش اجباری باشد</p>
    </td>
    <td class="acf-td-field">
        <label for="fields[{{ $_index }}][required]" class="acf-label-checkbox">
            <input class="acf-inp-required" id="fields[{{ $_index }}][required]" name="fields[{{ $_index }}][required]" @if(isset($field->props['required']) && $field->props['required']) checked @endif type="checkbox">
            <span>الزامی باشد</span>
        </label>
    </td>
</tr>

<tr>
    <td class="acf-td-desc">
        <h4>توضیحات</h4>
        <p>توضیحاتی که در زمان ویرایش نشان داده میشود</p>
    </td>
    <td class="acf-td-field">
        <textarea rows="5" class="acf-inp-description" name="fields[{{ $_index }}][description]">@if(isset($field->props['description'])){{ $field->props['description'] }}@endif</textarea>
    </td>
</tr>