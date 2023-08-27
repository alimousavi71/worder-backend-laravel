@php
    $_index = '__INDEX__';
    $_index_label = '__INDEX__LABEL__';
    if (!is_null($index)) $_index = $index;
    if (!is_null($index)) $_index_label = $index + 1;
@endphp
<div class="acf-field-item-container">
    @include('admin.acf-template.field.base')
    <input name="fields[{{ $_index }}][type]" value="Range" type="hidden">
    <div class="acf-table-container acf-hide">
        <table class="acf-table-field">
            <tbody>
            @include('admin.acf-template.field.base-field')

            <tr>
                <td class="acf-td-desc">
                    <h4>
                        <span>کمترین</span>
                        <span class="text-red">*</span>
                    </h4>
                    <p>کمترین مقدار عددی</p>
                </td>
                <td class="acf-td-field">
                    <input name="fields[{{ $_index }}][minimum]" type="text"
                           value="@if(isset($field->props['minimum'])) {{ $field->props['minimum'] }}@endif">
                </td>
            </tr>

            <tr>
                <td class="acf-td-desc">
                    <h4>
                        <span>حد اکثر</span>
                        <span class="text-red">*</span>
                    </h4>
                    <p>بیشترین مقدار عددی</p>
                </td>
                <td class="acf-td-field">
                    <input name="fields[{{ $_index }}][maximum]" type="text"
                           value="@if(isset($field->props['maximum'])) {{ $field->props['maximum'] }}@endif">
                </td>
            </tr>

            <tr>
                <td class="acf-td-desc">
                    <h4>
                        <span>پیش فرض حداقل</span>
                    </h4>
                </td>
                <td class="acf-td-field">
                    <input name="fields[{{ $_index }}][defaultMinimum]" type="text"
                           value="@if(isset($field->props['defaultMinimum'])) {{ $field->props['defaultMinimum'] }}@endif">
                </td>
            </tr>

            <tr>
                <td class="acf-td-desc">
                    <h4>
                        <span>حداکثر حداقل</span>
                    </h4>
                </td>
                <td class="acf-td-field">
                    <input name="fields[{{ $_index }}][defaultMaximum]" type="text"
                           value="@if(isset($field->props['defaultMaximum'])) {{ $field->props['defaultMaximum'] }}@endif">
                </td>
            </tr>

            </tbody>
        </table>
    </div>
</div>