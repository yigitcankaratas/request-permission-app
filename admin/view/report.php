<?php require admin_view('static/header')?>


    <div class="box-">
       <h1>Raporlar</h1>
    </div>
    <hr>
    <div class="clear" style="height: 30px;"></div>
    <div class="box-">
        <form action="rapor_bas" method="post" class="form label">
            <h3>
                Çalışan Raporu Al
            </h3>
            <br>
            <p>Çalışan raporu, tüm çalışanların Ad, Soyad, Şirket, Görev ve Kalan İzinlerinin yer aldığı bir rapordur. CSV formatında
            indirilir ve Excel ile açılabilir.</p>
            <br>
            <input type="hidden" name="submit" value="1">
            <button type="submit">İndir</button>
        </form>
    </div>
    <hr>
    <div class="box-">
        <form action="sirket_rapor_bas" method="post" class="form label">
            <h3>
                Şirket Raporu Al
            </h3>
            <br>
            <p>Şirket raporu, seçilen şirketteki çalışanların onaylanmış izinlerinin listelendiği bir rapordur. CSV formatında
                indirilir ve Excel ile açılabilir.</p>
            <br>
            <div class="form-content">
                <select name="sirket" id="sirket">
                    <option value="0">--Lütfen Şirket Seçin--</option>
                    <?php
                    $companies = $db->query("SELECT * FROM companies")->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($companies as $company):
                        ?>
                        <option value= "<?php echo $company['id'] ?>"> <?php echo $company['company'] ?></option>
                    <?php endforeach; ?>
                </select>
                <br>
                <br>
                <input type="hidden" name="submit" value="1">
                <button type="submit">İndir</button>
            </div>
        </form>
    </div>
    <hr>

<?php require admin_view('static/footer')?>