@php
    $_index = '__INDEX__';
    $_index_label = '__INDEX__LABEL__';
    if (!is_null($index)) $_index = $index;
    if (!is_null($index)) $_index_label = $index + 1;
@endphp
<div class="acf-field-item-container">
    @include('admin.acf.template.field.base')
    <input name="fields[{{ $_index }}][type]" value="Select" type="hidden">
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
                        <span>ایتم ها</span>
                        <span class="text-red">*</span>
                    </h4>
                    <p>هر انتخاب را در یک خط جدید وارد کنید.</p>
                    <p>برای کنترل بیشتر، می توانید هم یک مقدار و هم برچسب مانند این را مشخص کنید:</p>
                    <p>Red : قرمز</p>
                </td>
                <td class="acf-td-field">
                    <textarea rows="10" name="fields[{{ $_index }}][select]" type="text">@if(isset($field->props['select']) && is_array($field->props['select'])) {{ collect($field->props['select'])->pluck('old')->implode("\n") }}@endif</textarea>
                </td>
            </tr>

            <tr>
                <td class="acf-td-desc">
                    <h4>چندین مقدار را انتخاب کنید؟</h4>
                </td>
                <td class="acf-td-field">
                    <label for="fields[{{ $_index }}][multiple]">
                        <input id="fields[{{ $_index }}][multiple]" name="fields[{{ $_index }}][multiple]" @if(isset($field->props['multiple']) && $field->props['multiple']) checked @endif type="checkbox">
                        <span>چندین مقدار را انتخاب کنید؟</span>
                    </label>
                </td>
            </tr>

            </tbody>
        </table>
    </div>
</div>