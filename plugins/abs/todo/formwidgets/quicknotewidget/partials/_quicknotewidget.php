<div class="report-widget">
    <h3><?= $this->property('title') ?></h3>
    <?php if( $this->property('showList') ): ?>

        <ul class="list-nostyle">
            <?php if($notes->count() > 0): ?>
            <?php foreach( $notes as $note ): ?>
                <li class="list-group-item">
                    <?= $note->title . ' ' . substr($note->description, 0, 15) ?>
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

    <div class="form-group">
        <textarea class="form-control" name="description" id="" cols="30" rows="10" placeholder="какая то дополнительная информация."></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Submit" />
        <a href="<?= Backend::url('admin/abs/todo/notes') ?>">к заметкам</a>
    </div>

    <?= Form::close(); ?>
</div>
