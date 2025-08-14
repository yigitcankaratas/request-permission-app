<?php require manager_view('static/header')?>

    <!doctype html>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="view/app.js"></script>
    </html>




<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=meritdesk', 'root', '');

} catch (PDOException $e) {
    die($e->getMessage());
}
?>


    <div class="box-">
        <h1>
            İzin Talebi Oluştur
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
                    <label>İzin Başlangıç Tarihi</label>
                    <div class="form-content">



                        <input type="date" name="izin-baslangic" value="" min="<?= date("Y-m-d") ?>" max="<?= date('Y-m-d', strtotime('+1 year', strtotime(date("Y-m-d")))) ?>">
                        <select name="baslangic_gun" id="baslangic_gun">
                            <option value="0">Tam Gün</option>
                            <option value="1">Öğleden Önce Yarım Gün</option>
                            <option value="2">Öğleden Sonra Yarım Gün</option>
                        </select>
                    </div>
                </li>
                <li>
                    <label>İzin Bitiş Tarihi</label>
                    <div class="form-content">
                        <input type="date" name="izin-bitis" value="" min="<?= date("Y-m-d") ?>" max="<?= date('Y-m-d', strtotime('+1 year', strtotime(date("Y-m-d")))) ?>">
                        <select name="bitis_gun" id="bitis_gun">
                            <option value="0">Tam Gün</option>
                            <option value="1">Öğleden Önce Yarım Gün</option>
                            <option value="2">Öğleden Sonra Yarım Gün</option>
                        </select>
                    </div>
                </li>
                <li>
                    <label>İzin Açıklaması</label>
                    <div class="form-content">
                        <textarea name="izin_aciklama" id="izin_aciklama" cols="30" rows="5" placeholder="İzin Açıklaması"></textarea>
                    </div>
                </li>

                <?php
                $key_email=key($_SESSION);
                $key_email=(string)$key_email;

                $calisan = $db->query("SELECT * FROM users WHERE email = '$key_email'")->fetchAll(PDO::FETCH_ASSOC);

                $company = $calisan[0]['company'];
                $department = $calisan[0]['department'];
                $info = $calisan[0]['name'] . " " . $calisan[0]['surname'];
                $info_start_date = $calisan[0]['start_date'];
                $y1 = $calisan[0]['manager1'];

                if(!$y1){
                    $y1_name="";
                    $y1_email=NULL;
                }
                else{
                    $row1 = $db->query("SELECT * FROM users WHERE id = '$y1'")->fetchAll(PDO::FETCH_ASSOC);
                    $y1_name = $row1 [0]['name'] . " " . $row1 [0]['surname'] . "; ";
                    $y1_email= $row1 [0]['email'];
                }

                $y2 = $calisan[0]['manager2'];
                if(!$y2){
                    $y2_name="";
                    $y2_email=NULL;
                }
                else{
                    $row2 = $db->query("SELECT * FROM users WHERE id = '$y2'")->fetchAll(PDO::FETCH_ASSOC);
                    $y2_name = $row2 [0]['name'] . " " . $row2 [0]['surname'] . "; ";
                    $y2_email= $row2 [0]['email'];
                }

                $y3 = $calisan[0]['manager3'];
                if(!$y3){
                    $y3_name="";
                    $y3_email=NULL;
                }
                else{
                    $row3 = $db->query("SELECT * FROM users WHERE id = '$y3'")->fetchAll(PDO::FETCH_ASSOC);
                    $y3_name = $row3 [0]['name'] . " " . $row3 [0]['surname'] . "; ";
                    $y3_email= $row3 [0]['email'];
                }

                $y4 = $calisan[0]['manager4'];
                if(!$y4){
                    $y4_name="";
                    $y4_email=NULL;
                }
                else{
                    $row4 = $db->query("SELECT * FROM users WHERE id = '$y4'")->fetchAll(PDO::FETCH_ASSOC);
                    $y4_name = $row4 [0]['name'] . " " . $row4 [0]['surname'] . ";";
                    $y4_email= $row4 [0]['email'];
                }
                ?>

                <li>
                    <label>Talebin İletileceği Kişiler</label>
                    <div class="form-content">
                        <input type="textarea" name="yoneticiler" value="<?= $y1_name . $y2_name . $y3_name . $y4_name ?>" disabled>
                        <input type="hidden" name="y1_email" value="<?=$y1_email?>">
                        <input type="hidden" name="y2_email" value="<?=$y2_email?>">
                        <input type="hidden" name="y3_email" value="<?=$y3_email?>">
                        <input type="hidden" name="y4_email" value="<?=$y4_email?>">
                        <input type="hidden" name="user_email" value="<?=$key_email?>">
                        <input type="hidden" name="user_company" value="<?=$company?>">
                        <input type="hidden" name="user_department" value="<?=$department?>">
                        <input type="hidden" name="user_info" value="<?=$info?>">
                        <input type="hidden" name="info_start_date" value="<?=$info_start_date?>">

                    </div>
                </li>

                <li class="submit">
                    <input type="hidden" name="submit" value="1">
                    <button type="submit">İzin Talebi Oluştur</button>
                </li>
            </ul>
        </form>
    </div>






<?php require manager_view('static/footer')?>