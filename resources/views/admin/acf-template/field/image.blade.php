<div class="field-item-container">
    @include('admin.acf-template.field.base')
    <input name="fields[__INDEX__][type]" value="Image" type="hidden">
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
                    <input name="fields[__INDEX__][placeHolder]" type="text" value="Placeholder __INDEX__LABEL__">
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
                    <input name="fields[__INDEX__][defaultValue]" type="text" value="Default __INDEX__LABEL__">
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
                    <input name="fields[__INDEX__][alt]" type="text" value="alt">
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
                    <input name="fields[__INDEX__][size]" type="number" value="8000">
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
                    <input name="fields[__INDEX__][width]" type="number" value="500">
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
                    <input name="fields[__INDEX__][height]" type="number" value="500">
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
                    <input name="fields[__INDEX__][extensions]" type="text" value="jpg">
                </td>
            </tr>

            </tbody>
        </table>
    </div>
</div>