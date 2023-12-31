@php
    $_index = '__INDEX__';
    $_index_label = '__INDEX__LABEL__';
    if (!is_null($index)) $_index = $index;
    if (!is_null($index)) $_index_label = $index + 1;
@endphp
<div class="acf-field-item-container">
    <input name="fields[{{ $_index }}][type]" value="Textarea" type="hidden">
    @include('admin.acf.template.field.base')
    <div class="acf-table-container acf-hide">
        <table class="acf-table-field">
            <tbody>
            @include('admin.acf.template.field.base-field')
            <tr>
                <td class="acf-td-desc">
                    <h4>
                        <span>متن نگه دارنده</span>
                    </h4>
                    <p>نمایش placeholder فیلد</p>
                </td>
                <td class="acf-td-field">
                    <input name="fields[{{ $_index }}][placeHolder]" type="text"
                           value="@if(isset($field->props['placeHolder'])) {{ $field->props['placeHolder'] }}@endif">
                </td>
            </tr>

            <tr>
                <td class="acf-td-desc">
                    <h4>
                        <span>پیش فرض</span>
                    </h4>
                    <p>مقدار پیش فرض فیلد</p>
                </td>
                <td class="acf-td-field">
                    <input name="fields[{{ $_index }}][defaultValue]" type="text"
                           value="@if(isset($field->props['defaultValue'])) {{ $field->props['defaultValue'] }}@endif">
                </td>
            </tr>

            <tr>
                <td class="acf-td-desc">
                    <h4>
                        <span>تعداد کاراکتر ها</span>
                    </h4>
                    <p>تعداد کاراکتر های قابل ثبت</p>
                </td>
                <td class="acf-td-field">
                    <input name="fields[{{ $_index }}][charLimit]" type="number"
                           value="@if(isset($field->props['charLimit'])){{ $field->props['charLimit'] }}@endif">
                </td>
            </tr>

            <tr>
                <td class="acf-td-desc">
                    <h4>
                        <span>تعداد سطرها</span>
                    </h4>
                    <p>تعداد سطرهای متنی textarea</p>
                </td>
                <td class="acf-td-field">
                    <input name="fields[{{ $_index }}][rows]" type="number"
                           value="@if(isset($field->props['rows'])){{ $field->props['rows'] }}@endif">
                </td>
            </tr>

            </tbody>
        </table>
    </div>
</div>