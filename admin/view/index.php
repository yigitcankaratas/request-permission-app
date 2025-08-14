<?php require admin_view('static/header'); ?>

<?php
$this_year = date("Y");
$first_day = $this_year . "-01-01";
$last_day = $this_year . "-12-31";

$query7 = $db->prepare("SELECT * FROM holidays WHERE date >= '$first_day' AND date <= '$last_day' ORDER BY id ASC");
$query7->execute();
$row7 = $query7->fetchAll(PDO::FETCH_ASSOC);



?>
    <div class="box-container container-25">
        <div class="box" id="div-1">
            <h3>
                Resmi Tatiller
            </h3>
            <div class="box-content">
                <li>
                    <label>Yılbaşı</label>
                    <div class="form-content">
                        <input type="date" name="settings[public-holiday-yilbasi]"
                               value="<?= $row7[0]['date'] ?>" disabled>
                        <br><br>
                    </div>
                </li>
                <li>
                    <label>23 Nisan</label>
                    <div class="form-content">
                        <input type="date" name="settings[public-holiday-cocuk]"
                               value="<?= $row7[1]['date'] ?>" disabled>
                        <br><br>
                    </div>
                </li>
                <li>
                    <label>1 Mayıs</label>
                    <div class="form-content">
                        <input type="date" name="settings[public-holiday-isci]"
                               value="<?= $row7[2]['date'] ?>" disabled>
                        <br><br>
                    </div>
                </li>
                <li>
                    <label>19 Mayıs</label>
                    <div class="form-content">
                        <input type="date" name="settings[public-holiday-genclik]"
                               value="<?= $row7[3]['date'] ?>" disabled>
                        <br><br>
                    </div>
                </li>
                <li>
                    <label>15 Temmuz</label>
                    <div class="form-content">
                        <input type="date" name="settings[public-holiday-demokrasi]"
                               value="<?= $row7[4]['date'] ?>" disabled>
                        <br><br>
                    </div>
                </li>
                <li>
                    <label>30 Ağustos</label>
                    <div class="form-content">
                        <input type="date" name="settings[public-holiday-zafer]"
                               value="<?= $row7[5]['date'] ?>" disabled>
                        <br><br>
                    </div>
                </li>
                <li>
                    <label>29 Ekim</label>
                    <div class="form-content">
                        <input type="date" name="settings[public-holiday-cumhuriyet]"
                               value="<?= $row7[6]['date'] ?>" disabled>
                        <br><br>
                    </div>
                </li>
                <li>
                    <label>Ramazan Bayramı (Başlangıç - Bitiş)</label>
                    <div class="form-content">
                        <input type="date" name="settings[public-holiday-ramazan-baslangic]"
                               value="<?= $row7[7]['date'] ?>" disabled>
                        <input type="date" name="settings[public-holiday-ramazan-bitis]"
                               value="<?= $row7[9]['date'] ?>" disabled>
                        <br><br>
                    </div>

                </li>
                <li>
                    <label>Kurban Bayramı (Başlangıç - Bitiş)</label>
                    <div class="form-content">
                        <input type="date" name="settings[public-holiday-kurban-baslangic]"
                               value="<?= $row7[10]['date'] ?>" disabled>
                        <input type="date" name="settings[public-holiday-kurban-bitis]"
                               value="<?= $row7[13]['date'] ?>" disabled>
                        <br><br>
                    </div>
                </li>
            </div>
        </div>
    </div>

    <?php

    try {
    $db= new PDO('mysql:host=localhost;dbname=meritdesk','root', '');

    }catch(PDOException $e){
    die($e->getMessage());
    }

    $duyurular = $db->query("SELECT * FROM announcements ORDER BY  id DESC")->fetchAll(PDO::FETCH_ASSOC);


    ?>

    <div class="box-container container-50">
        <div class="box" id="div-2">
            <h3>
                Duyurular
            </h3>
            <div class="box-content">

                <h4>
                    <label><?php echo $duyurular[0]['announcement_head'] ?></label>
                </h4>
                    <div class="form-content">
                        <textarea name="" cols="20" rows="5" readonly><?php echo $duyurular[0]['announcement_text'] ?></textarea>

                        <br><br>
                    </div>


                <h4>
                    <label><?php echo $duyurular[1]['announcement_head'] ?></label>
                </h4>
                    <div class="form-content">
                        <textarea name="" cols="20" rows="5" readonly><?php echo $duyurular[1]['announcement_text'] ?></textarea>
                        <br><br>
                    </div>


                <h4>
                    <label><?php echo $duyurular[2]['announcement_head'] ?></label>
                </h4>
                    <div class="form-content">
                        <textarea name="" cols="20" rows="5" readonly><?php echo $duyurular[2]['announcement_text'] ?></textarea>
                        <br><br>
                    </div>



                <div class="box-content">
                    <h3>
                        Duyuru Ekle
                    </h3>
                    <form action="add_announcement" method="post" class="form">
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
                                <input type="text" name="duyuru_baslik" id="duyuru_baslik" placeholder="Duyuru Başlığı">
                            </li>
                            <li>
                                <textarea name="duyuru_aciklama" id="duyuru_aciklama" cols="30" rows="5" placeholder="Duyuru Açıklaması"></textarea>
                            </li>
                            <li>
                                <button type="submit" name="submit" value="1">Duyuru Yayınla</button>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
    try {
    $db= new PDO('mysql:host=localhost;dbname=meritdesk','root', '');

    }catch(PDOException $e){
    die($e->getMessage());
    }

    $query = $db->prepare('SELECT * FROM companies ');
    $query->execute();
    $company_count = $query->rowCount();

    $query2 = $db->prepare('SELECT * FROM departments ');
    $query2->execute();
    $department_count = $query2->rowCount();

    $query3 = $db->prepare('SELECT * FROM users ');
    $query3->execute();
    $users_count = $query3->rowCount();

    $query4 = $db->prepare('SELECT * FROM users WHERE user_role = 1');
    $query4->execute();
    $admin_count = $query4->rowCount();

    $query5 = $db->prepare('SELECT * FROM users WHERE user_role = 2');
    $query5->execute();
    $manager_count = $query5->rowCount();


    $query7 = $db->prepare('SELECT * FROM users WHERE user_role = 4');
    $query7->execute();
    $teamlead_count = $query7->rowCount();


    $query6 = $db->prepare('SELECT * FROM users WHERE user_role = 3');
    $query6->execute();
    $employee_count = $query6->rowCount();

?>
    <div class="box-container container-25">
        <div class="box" id="div-3">
            <h3>
                MeritDesk
            </h3>
            <div class="box-content">
                <li>
                    <label>Şirket Sayısı</label>
                    <div class="form-content">
                        <input type="textarea" name="sirket_sayisi"
                               value="<?= $company_count ?>" disabled>
                        <br><br>
                    </div>
                </li>
                <li>
                    <label>Şirket İçi Departman Sayısı</label>
                    <div class="form-content">
                        <input type="textarea" name="department_sayisi"
                               value="<?= $department_count ?>" disabled>
                        <br><br>
                    </div>
                </li>
                <li>
                    <label>Toplam Kullanıcı Sayısı</label>
                    <div class="form-content">
                        <input type="textarea" name="kullanici_sayisi"
                               value="<?= $users_count ?>" disabled>
                        <br><br>
                    </div>
                </li>
                <li>
                    <label>Admin Sayısı</label>
                    <div class="form-content">
                        <input type="textarea" name="admin_sayisi"
                               value="<?= $admin_count ?>" disabled>
                        <br><br>
                    </div>
                </li>
                <li>
                    <label>Yönetici Sayısı</label>
                    <div class="form-content">
                        <input type="textarea" name="manager_sayisi"
                               value="<?= $manager_count ?>" disabled>
                        <br><br>
                    </div>
                </li>
                <li>
                    <label>Takım Lideri Sayısı</label>
                    <div class="form-content">
                        <input type="textarea" name="takim_lideri_sayisi"
                               value="<?= $teamlead_count ?>" disabled>
                        <br><br>
                    </div>
                </li>
                <li>
                    <label>Çalışan Sayısı</label>
                    <div class="form-content">
                        <input type="textarea" name="calisan_sayisi"
                               value="<?= $employee_count ?>" disabled>
                        <br><br>
                    </div>
                </li>
            </div>
        </div>
    </div>

<?php require admin_view('static/footer')?>