<!doctype html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="view/app.js"></script>
</html>




<?php require admin_view('static/header');
try {
    $db = new PDO('mysql:host=localhost;dbname=meritdesk', 'root', '');

} catch (PDOException $e) {
    die($e->getMessage());
}
?>


    <div class="box-">
        <h1>
            Çalışan Ekle
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
                    <label>Ad</label>
                    <div class="form-content">
                        <input type="text" value="<?= post('ad') ?>" name="ad" placeholder="Çalışan Adını Girin">
                    </div>
                </li>
                <li>
                    <label>Soyad</label>
                    <div class="form-content">
                        <input type="text" value="<?= post('soyad') ?>" name="soyad"
                               placeholder="Çalışan Soyadını Girin">
                    </div>
                </li>

                <li>
                    <label>E-posta</label>
                    <div class="form-content">
                        <input type="email" value="<?= post('eposta') ?>" name="eposta"
                               placeholder="Çalışan E-postasını Girin">
                    </div>
                </li>
                <li>
                    <label>Şirket</label>
                    <div class="form-content">
                        <select name="sirket" id="sirket">
                            <option value="0">--Lütfen Şirket Seçin--</option>
                            <?php
                            $companies = $db->query("SELECT * FROM companies")->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($companies as $company):
                                ?>
                                <option value= <?php echo $company['id'] ?>> <?php echo $company['company'] ?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                </li>
                <li>
                    <label>Departman</label>
                    <div class="form-content">
                        <select name="departman">
                            <option value="0">--Lütfen Departman Seçin--</option>
                            <?php
                            $departments = $db->query("SELECT * FROM departments")->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($departments as $department):
                                ?>
                                <option value= <?php echo $department['id'] ?>> <?php echo $department['department'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </li>
                <li>
                    <label>Görev</label>
                    <div class="form-content">
                        <select name="gorev">
                            <option value="0">--Lütfen Görev Seçin--</option>
                            <option value="1">Admin</option>
                            <option value="2">Yönetici</option>
                            <option value="4">Takım Lideri</option>
                            <option value="3">Çalışan</option>
                        </select>
                    </div>
                </li>
                <li>
                    <label>İşe Başlangıç Tarihi</label>
                    <div class="form-content">
                        <input type="date" name="ise-baslangic" value="">

                    </div>
                </li>
                <li>
                    <label>Sorumlu Yönetici 1</label>
                    <div class="form-content">
                        <select name="yonetici1" id="yonetici1" disabled>
                            <option value="">--Lütfen Yönetici Seçin--</option>
                        </select>
                    </div>
                </li>
                <li>
                    <label>Sorumlu Yönetici 2</label>
                    <div class="form-content">
                        <select name="yonetici2" id="yonetici2" disabled>
                            <option value="0">--Lütfen Yönetici Seçin--</option>
                        </select>
                    </div>
                </li>
                <li>
                    <label>Sorumlu Yönetici 3</label>
                    <div class="form-content">
                        <select name="yonetici3" id="yonetici3" disabled>
                            <option value="0">--Lütfen Yönetici Seçin--</option>
                        </select>
                    </div>
                </li>
                <li>
                    <label>Sorumlu Yönetici 4</label>
                    <div class="form-content">
                        <select name="yonetici4" id="yonetici4" disabled>
                            <option value="0">--Lütfen Yönetici Seçin--</option>
                        </select>
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