@php
    $_index = '__INDEX__';
    $_index_label = '__INDEX__LABEL__';
    $_name = 'وارد نشده';
    $_label = 'وارد نشده';
    $_required = false;
    if (!is_null($index)) $_index = $index;
    if (!is_null($index)) $_index_label = $index + 1;
    if (isset($field->props['name'])) $_name = $field->props['name'];
    if (isset($field->props['label'])) $_label = $field->props['label'];
    if (isset($field->props['required']) && $field->props['required']) $_required = true;
@endphp
<ul class="acf-ul-field">
    <li class="f-order">
        <span class="f-counter">{{ $_index_label }}</span>
    </li>
    <li class="f-title">
        <span>{{ $_label }}</span>
        @if($_required)
            <span class="required">*</span>
        @else
            <span class="required"></span>
        @endif
    </li>
    <li class="f-name">
        <span>{{ $_name }}</span>
    </li>
    <li class="f-type">
        <span>{{ $type }}</span>
    </li>

    <li class="f-action">
        <button class="btn btn-danger btn-sm acf-btn-delete" @if(isset($field)) data-open="{{ route('admin.acf.field.delete',[$field->id]) }}" @else data-open="" @endif type="button">حذف</button>
    </li>
</ul>