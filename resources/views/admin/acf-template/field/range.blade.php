<div class="field-item-container">
    @include('admin.acf-template.field.base')
    <input name="fields[__INDEX__][type]" value="Range" type="hidden">
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
                        <span>کمترین</span>
                    </h4>
                    <p>کمترین مقدار عددی</p>
                </td>
                <td class="acf-td-field">
                    <input name="fields[__INDEX__][minimum]" type="text" value="minimum __INDEX__LABEL__">
                </td>
            </tr>

            <tr>
                <td class="acf-td-desc">
                    <h4>
                        <span>حد اکثر</span>
                    </h4>
                    <p>بیشترین مقدار عددی</p>
                </td>
                <td class="acf-td-field">
                    <input name="fields[__INDEX__][maximum]" type="text" value="maximum __INDEX__LABEL__">
                </td>
            </tr>

            <tr>
                <td class="acf-td-desc">
                    <h4>
                        <span>پیش فرض حداقل</span>
                    </h4>
                </td>
                <td class="acf-td-field">
                    <input name="fields[__INDEX__][defaultMinimum]" type="text" value="defaultMinimum __INDEX__LABEL__">
                </td>
            </tr>

            <tr>
                <td class="acf-td-desc">
                    <h4>
                        <span>حداکثر حداقل</span>
                    </h4>
                </td>
                <td class="acf-td-field">
                    <input name="fields[__INDEX__][defaultMaximum]" type="text" value="Default __INDEX__LABEL__">
                </td>
            </tr>

            </tbody>
        </table>
    </div>
</div>