@php
    $_index = '__INDEX__';
    $_index_label = '__INDEX__LABEL__';
    if (!is_null($index)) $_index = $index;
    if (!is_null($index)) $_index_label = $index + 1;
@endphp
<div class="acf-field-item-container">
    @include('admin.acf-template.field.base')
    <input name="fields[{{ $_index }}][type]" value="Image" type="hidden">
    <div class="acf-table-container acf-hide">
        <table class="acf-table-field">
            <tbody>
            @include('admin.acf-template.field.base-field')

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
                        <span>متن جایگزین</span>
                    </h4>
                    <p>متن جایگزین یا alt</p>
                </td>
                <td class="acf-td-field">
                    <input name="fields[{{ $_index }}][alt]" type="text"
                           value="@if(isset($field->props['alt'])){{ $field->props['alt'] }}@endif">
                </td>
            </tr>

            <tr>
                <td class="acf-td-desc">
                    <h4>
                        <span>حجم تصویر</span>
                    </h4>
                    <p>حجم تصویر به Byte</p>
                </td>
                <td class="acf-td-field">
                    <input name="fields[{{ $_index }}][size]" type="number"
                           value="@if(isset($field->props['size'])){{ $field->props['size'] }}@endif">
                </td>
            </tr>

            <tr>
                <td class="acf-td-desc">
                    <h4>
                        <span>عرض تصویر</span>
                    </h4>
                    <p>عرض تصویر به Pixel</p>
                </td>
                <td class="acf-td-field">
                    <input name="fields[{{ $_index }}][width]" type="number"
                    value="@if(isset($field->props['width'])){{ $field->props['width'] }}@endif">
                </td>
            </tr>

            <tr>
                <td class="acf-td-desc">
                    <h4>
                        <span>ارتفاع تصویر</span>
                    </h4>
                    <p>ارتفاع تصویر به Pixel</p>
                </td>
                <td class="acf-td-field">
                    <input name="fields[{{ $_index }}][height]" type="number"
                    value="@if(isset($field->props['height'])){{ $field->props['height'] }}@endif">
                </td>
            </tr>

            <tr>
                <td class="acf-td-desc">
                    <h4>
                        <span>فرمت تصویر</span>
                    </h4>
                    <p>فرمت های مورد نظر را با کاما جدا کنید</p>
                    <p>jpg,png,jpeg</p>
                </td>
                <td class="acf-td-field">
                    <input name="fields[{{ $_index }}][extensions]" type="text"
                           value="@if(isset($field->props['extensions']) && is_array($field->props['extensions'])){{ collect($field->props['extensions'])->implode(',') }}@endif">
                </td>
            </tr>

            </tbody>
        </table>
    </div>
</div>