<div class="field-item-container">
    @include('admin.acf-template.field.base')
    <input name="fields[__INDEX__][type]" value="Email" type="hidden">
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
                    <input name="fields[__INDEX__][default]" type="text" value="Default __INDEX__LABEL__">
                </td>
            </tr>

            </tbody>
        </table>
    </div>
</div>