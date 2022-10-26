<div data-control="toolbar">
    <a href="<?= Backend::url('abs/todo/notes/create') ?>"
        class="btn btn-primary oc-icon-plus">
        <?= e(trans('backend::lang.list.create_button', ['name'=>'new Note'])) ?>
    </a>

    <button
        class="btn btn-danger oc-icon-trash-o"
        data-request="onDelete"
        data-trigger-type="enable"
        data-trigger = ".list-checkbox input[type='checkbox']"
        data-trigger-condition="checked"
        data-request-success="$el.attr('disabled', 'disabled');"
        data-list-checked-trigger
        data-list-checked-request
        data-stripe-load-indicator>
        <?= e(trans('backend::lang.list.delete_selected')) ?>
    </button>

<!--    <button-->
<!--            id = "remove_notes"-->
<!--            class="btn btn-warning oc-icon-trash-o"-->
<!--            data-request="onDelete"-->
<!--            data-trigger-type="enable"-->
<!--            data-trigger = ".list-checkbox input[type='checkbox']"-->
<!--            data-trigger-condition="checked"-->
<!--            data-request-success="$el.attr('enable', 'enable');"-->
<!--            disabled-->
<!--    >удалить выбранную замтку(и)</button>-->
</div>

<script>
    $("#remove_notes").click(function(){
        $(this).data('request-data', {
            notes: $('.list-checkbox input[type=\'checkbox\']').listWidget('getChecked')
        })
    });
</script>