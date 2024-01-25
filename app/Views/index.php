<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>

    <!--Пагинация-->
    <div class="container mt-5">
        <?php echo $pager->links() ?>
    </div>

    <!--Форма сортировки-->
    <form action="<?= base_url('/') ?>" method="get" class="container">
        <div class="form-group">
            <label for="sort_by">Сортировать по:</label>
            <select class="form-control" id="sort_by" name="sort_by">
                <option value="id_asc">ID по возрастанию</option>
                <option value="id_desc">ID по убыванию</option>
                <option value="created_at_asc">Дата создания по возрастанию</option>
                <option value="created_at_desc">Дата создания по убыванию</option>
            </select>
        </div>
        <button type="submit" class="btn btn-secondary mt-3">Применить</button>
    </form>

    <!--Вывод списка комментариев-->
    <ul class="list-group">
        <?php foreach ($comments as $item) { ?>
            <li class="list-group-item m-3">
                <p><b><?= $item['name'] ?></b></p>
                <h6>Создано: <span class="badge bg-secondary"><?= $item['created_at'] ?></span></h6>
                <p><?= $item['text'] ?></p>
                <form action="<?= base_url('/delete/' . $item['id']) ?>" method="post">
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </li>
        <?php } ?>
    </ul>

    <!--Форма сохранения комментария-->
    <h4 class="container">Оставить комментарий</h4>
    <form action="<?= base_url('/store') ?>" method="post" class="container">
        <div class="mb-3">
            <label for="email" class="form-label">Name</label>
            <input type="email" class="form-control" id="email" name="name" >
        </div>
        <div class="mb-3">
            <label for="text" class="form-label">Текст комментария</label>
            <textarea class="form-control" id="text" name="text" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>

    <!--Вывод информации о сохранении или не сохранении-->
    <?php if (session()->has('storeError')): ?>
        <div class="alert alert-danger container mt-3">
            <?= session('storeError')->listErrors(); ?>
        </div>
    <?php elseif (session()->has('storeSuccess')): ?>
        <div class="alert alert-success container mt-3">
            <?= session('storeSuccess') ?>
        </div>
    <?php endif; ?>

    <!--Вывод информации о удалении или не удалении-->
    <?php if (session()->has('deleteSuccess')) : ?>
        <div class="alert alert-success container mt-3">
            <?= session('deleteSuccess') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->has('deleteError')) : ?>
        <div class="alert alert-danger container mt-3">
            <?= session('deleteError') ?>
        </div>
    <?php endif; ?>

<?= $this->endSection() ?>