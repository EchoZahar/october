<div class="report-widget">
    <h3><?= $this->property('title') ?></h3>
    <?php if( $this->property('showList') ): ?>

        <ul class="list-nostyle">
            <?php if($notes->count() > 0): ?>
            <?php foreach( $notes as $note ): ?>
                <li class="list-group-item">
                    <form>
                    <div class="row">
                        <div class="col-sm-9">
                            <a class="text-primary" href="<?= Backend::url('abs/todo/notes/update/' . $note->id) ?>"><?= $note->title; ?></a>
                            <?= $note->description ?>
                        </div>
                        <div class="col-sm-3">
                            <input type="hidden" name="noteID" value="<?= $note->id ?>">
                            <button  class="oc-icon-trash-o btn-icon danger pull-right" type="submit"
                                     data-request="<?= $this->getEventHandler('onDelete') ?>"
                            ></button>
                        </div>
                        </form>
                    </div>
                </li>
            <?php endforeach ?>
            <?php else: ?>
                <li class="text-primary">заметок не найдено</li>
            <?php endif; ?>
        </ul>
        <br/>
    <?php endif; ?>

    <form></form>
    <?= Form::open([
        'url'       => Backend::url('abs/todo/notes/store'),
        'method'    => 'POST'
    ]);
    ?>
    <div class="form-group">
        <input class="form-control" type="text" name="title" placeholder="наименование заметки" required />
    </div>

    <div class="form-group ask-form">
        <textarea class="form-control" name="description" id="" rows="3" placeholder="какая то дополнительная информация."></textarea>
    </div>
    <p id="ask-form-symbolCount">500 кол-во символов.</p>

    <div class="form-group text-end">
        <a href="<?= Backend::url('abs/todo/notes') ?>">на странице к заметкам</a>
        <input type="submit" class="btn btn-primary" value="добавить" />
    </div>

    <?= Form::close(); ?>
</div>
<script>
    $(document).ready(function() {
        $(".ask-form textarea").val('');
        $(".ask-form textarea").on("keyup", function() {
            var text = $(".ask-form textarea").val();
            var counter = $("#ask-form-symbolCount");
            counter.text(500 - text.length);
        });
    })
</script>
