<?php require admin_view('static/header');
try {
    $db = new BasicDB('localhost', 'meritdesk', 'root', '');

} catch (PDOException $e) {
    die($e->getMessage());
}
?>


    <div class="box-">
        <h1>
            Şirket Düzenle
        </h1>
    </div>

    <div class="clear" style="height: 10px;"></div>
    <div class="box-">
        <form action="" method="post" class="form label">
            <?php if ($err = error()): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $err ?>
                </div>
            <?php endif; ?>
            <?php if ($succ = success()): ?>
                <div class="alert alert-success" role="alert">
                    <?= $succ ?>
                </div>
            <?php endif; ?>
            <ul>
                <li>
                    <label>Şirket Adı</label>
                    <div class="form-content">
                        <?php
                        $row = $db->from('companies')
                            ->where('id', $id)
                            ->first();
                        ?>
                        <input type="text" value="<?= post('company') ?>" name="company" placeholder="<?= $row['company'] ?>">
                    </div>
                </li>


                <li class="submit">
                    <input type="hidden" name="submit" value="1">
                    <button type="submit">Ayarları Kaydet</button>
                </li>
            </ul>
        </form>
    </div>

<?php require admin_view('static/footer') ?>