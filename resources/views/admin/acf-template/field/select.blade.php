<div class="field-item-container">
    @include('admin.acf-template.field.base')
    <input name="fields[__INDEX__][type]" value="Select" type="hidden">
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

            <tr>
                <td class="acf-td-desc">
                    <h4>
                        <span>ایتم ها</span>
                    </h4>
                    <p>هر انتخاب را در یک خط جدید وارد کنید.</p>
                    <p>برای کنترل بیشتر، می توانید هم یک مقدار و هم برچسب مانند این را مشخص کنید:</p>
                    <p>Red : قرمز</p>
                </td>
                <td class="acf-td-field">
                    <input name="fields[__INDEX__][select]" type="text" value="Placeholder __INDEX__LABEL__">
                </td>
            </tr>

            <tr>
                <td class="acf-td-desc">
                    <h4>چندین مقدار را انتخاب کنید؟</h4>
                </td>
                <td class="acf-td-field">
                    <label for="fields[__INDEX__][required]">
                        <input id="fields[__INDEX__][multiple]" name="fields[__INDEX__][multiple]" type="checkbox">
                        <span>چندین مقدار را انتخاب کنید؟</span>
                    </label>
                </td>
            </tr>

            </tbody>
        </table>
    </div>
</div>