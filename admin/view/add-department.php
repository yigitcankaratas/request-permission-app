<?php require admin_view('static/header') ?>


    <div class="box-">
        <h1>
            Departman Ekle
        </h1>
    </div>

    <div class="clear" style="height: 10px;"></div>
    <div class="box-">
        <form action="" method="post" class="form label">
            <?php if ($err=error()): ?>
                <div class = "alert alert-danger" role="alert">
                    <?=$err?>
                </div>
            <?php endif; ?>
            <?php if ($succ=success()): ?>
                <div class = "alert alert-success" role="alert">
                    <?=$succ?>
                </div>
            <?php endif; ?>
            <ul>
                <li>
                    <label>Departman Adı</label>
                    <div class="form-content">
                        <input type="text" value="<?=post('department')?>" name="department" placeholder="Departman Adını Girin" >
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