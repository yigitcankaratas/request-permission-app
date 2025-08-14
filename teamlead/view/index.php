<?php require teamlead_view('static/header'); ?>

<?php
$this_year = date("Y");
$first_day = $this_year . "-01-01";
$last_day = $this_year . "-12-31";

$query7 = $db->prepare("SELECT * FROM holidays WHERE date >= '$first_day' AND date <= '$last_day' ORDER BY id ASC");
$query7->execute();
$row7 = $query7->fetchAll(PDO::FETCH_ASSOC);
?>


<?php
$eposta = end($_SESSION);
$query2 = $db->prepare("SELECT * FROM users WHERE email = '$eposta'");
$query2->execute();
$row2 = $query2->fetch(PDO::FETCH_ASSOC);
$baslangic = $row2['start_date'];
$xyillik = floor(((strtotime(date('Y-m-d')) - strtotime($baslangic)) / ((365 * 24 * 60 * 60)+ (6 * 60 * 60) )));
$leave_right = 0;
if($xyillik>=1 && $xyillik<6){
    $leave_right = 14;
}
if($xyillik>=6 && $xyillik<15){
    $leave_right = 20;
}
if($xyillik>=15){
    $leave_right = 26;
}
$one_year_ago = date('Y-m-d', strtotime('+' . (string)($xyillik) . ' year', strtotime($baslangic)));
$one_year_ago_year=date('Y', strtotime($one_year_ago));
$one_year_ago_new=date("d-m-Y",strtotime($one_year_ago));
$one_year_after =  date('Y', strtotime($one_year_ago))+1 . date('-m-d', strtotime($one_year_ago))  ;
$total_leave = 0;
$query1 = $db->prepare("SELECT * FROM leaves WHERE email = '$eposta' AND statue = 2 AND leave_start >= ' $one_year_ago' AND leave_start < '$one_year_after'");
$query1->execute();
$row1 = $query1->fetchAll(PDO::FETCH_ASSOC);
foreach ($row1 as $arr) {
    $total_leave += $arr['total_day'];
}
$one_year_ago_year=date('Y', strtotime($one_year_ago));
$one_year_ago_new=date("d-m-Y",strtotime($one_year_ago));
$takvim_aralik = $one_year_ago_new . " / " . date('d-m-', strtotime($baslangic)) . ($one_year_ago_year + 1);
?>
    <div class="box-container container-25">
        <div class="box" id="div-3">
            <h3>
                Yıllık İzinlerim
            </h3>
            <div class="box-content">
                <li>
                    <label>Yıllık İzin Hakkım</label>
                    <div class="form-content">
                        <input type="textarea" name="sirket_sayisi"
                               value="<?= $leave_right ?>" disabled>
                        <br><br>
                    </div>
                </li>
                <li>
                    <label>Onaylanmış İzinlerim</label>
                    <div class="form-content">
                        <input type="textarea" name="sirket_sayisi"
                               value="<?= $total_leave ?>" disabled>
                        <br><br>
                    </div>
                </li>
                <li>
                    <label>Kalan Yıllık İzin Hakkım</label>
                    <div class="form-content">
                        <input type="textarea" name="sirket_sayisi"
                               value="<?= $leave_right - $total_leave ?>" disabled>
                        <br><br>
                    </div>
                </li>
                <li>
                    <label>İzin Takvim Aralığım</label>
                    <div class="form-content">
                        <input type="textarea" name="sirket_sayisi"
                               value="<?= $takvim_aralik ?>" disabled>
                        <br><br>
                    </div>
                </li>
            </div>
        </div>
    </div>


<?php
$query3 = $db->prepare("SELECT * FROM leaves WHERE email = '$eposta' AND leave_start > ' $one_year_ago' ORDER BY id DESC");
$query3->execute();
$row3 = $query3->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
?>

    <div class="box-container container-50">
        <div class="box" id="div-2">
            <h3>
                İzinler
            </h3>
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th>Ad Soyad</th>
                        <th class="hide">İzin Başlangıcı</th>
                        <th class="hide">Yarım Gün</th>
                        <th class="hide">İzin Bitişi</th>
                        <th class="hide">Yarım Gün</th>
                        <th class="hide">Talep Toplamı</th>
                        <th class="hide">İzin Durumu</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!end($row3)){?>
                        <td class="hide">
                            <?php echo "Listelenecek Kayıt Bulunmadı"; ?>
                        </td>
                        <?php goto c;
                    }?>



                    <?php foreach ($row3 as $izin_satir): ?>
                        <tr>


                            <?php
                            if ($i == 9)
                                break;
                            ?>

                            <td class="hide">
                                <?= $row2['name'] . " " . $row2['surname'] ?>
                            </td>
                            <td class="hide">
                                <?= $izin_satir['leave_start'] ?>
                            </td>

                            <td class="hide">
                                <?php
                                if ($izin_satir['start_half_day']) {
                                    echo "Yarım Gün";
                                } else {
                                    echo "";
                                }
                                ?>
                            </td>

                            <td class="hide">
                                <?= $izin_satir['leave_end'] ?>
                            </td>

                            <td class="hide">
                                <?php
                                if ($izin_satir['end_half_day']) {
                                    echo "Yarım Gün";
                                } else {
                                    echo "";
                                }
                                ?>
                            </td>

                            <td class="hide">
                                <?= $izin_satir['total_day'] ?>
                            </td>

                            <td class="hide">
                                <?php
                                if ($izin_satir['statue'] == 1) {
                                    echo "Beklemede";
                                } elseif ($izin_satir['statue'] == 2) {
                                    echo "Onaylandı";
                                } elseif ($izin_satir['statue'] == 3) {
                                    echo "İptal Edildi";
                                }
                                ?>
                            </td>
                            <?php $i++ ?>
                        </tr>
                    <?php endforeach; ?>
                    <?php c: ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

<?php
$today=date("Y-m-d");
$two_days_before = date("Y-m-") . (date("d") - 2) ;
$seven_days_after = date("Y-m-") . (date("d") + 7) ;
$comp = $row2['company'];
$depart = $row2['department'];
$query5 = $db->prepare("SELECT * FROM leaves WHERE company_id = '$comp'AND department_id = '$depart' AND leave_start > '$two_days_before'  
                       AND leave_start < '$seven_days_after' AND email != '$eposta' AND statue = 2 ORDER BY id DESC");
$query5->execute();
$row5 = $query5->fetchAll(PDO::FETCH_ASSOC);



?>


    <div class="box-container container-25">
        <div class="box" id="div-2">
            <h3>
                Takımım
            </h3>
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th>Ad Soyad</th>
                        <th class="hide">İzin Başlangıcı</th>
                        <th class="hide">İzin Bitişi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!end($row5)){?>
                        <td class="hide">
                            <?php echo "Listelenecek Kayıt Bulunmadı"; ?>
                        </td>
                        <?php goto b;
                    }?>


                    <?php foreach ($row5 as $izin_satir): ?>
                        <?php
                        $mail =  $izin_satir['email'];
                        $query6 = $db->prepare("SELECT * FROM users WHERE email = '$mail'");
                        $query6->execute();
                        $row6 = $query6->fetch(PDO::FETCH_ASSOC);
                        ?>

                        <tr>
                            <td class="hide">
                                <?= $row6['name'] . " " . $row6['surname'] ?>
                            </td>
                            <td class="hide">
                                <?= $izin_satir['leave_start'] ?>
                            </td>

                            <td class="hide">
                                <?= $izin_satir['leave_end'] ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                    <?php b: ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=meritdesk', 'root', '');

} catch (PDOException $e) {
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
                    <textarea name="" cols="20" rows="5"
                              readonly><?php echo $duyurular[0]['announcement_text'] ?></textarea>

                    <br><br>
                </div>


                <h4>
                    <label><?php echo $duyurular[1]['announcement_head'] ?></label>
                </h4>
                <div class="form-content">
                    <textarea name="" cols="20" rows="5"
                              readonly><?php echo $duyurular[1]['announcement_text'] ?></textarea>
                    <br><br>
                </div>

            </div>
        </div>
    </div>


    <div class="box-container container-50">
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



<?php require teamlead_view('static/footer')?>