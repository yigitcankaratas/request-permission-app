
<?php require user_view('static/header') ?>
    <div class="box-">
        <h1>
            İzinlerim
            <!--            <a href="#">Add New</a>-->
        </h1>
    </div>

    <div class="clear" style="height: 10px;"></div>
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

    <div class="table">
        <table>
            <thead>
            <tr>
                <th>Ad Soyad</th>
                <th class="hide">Şirket</th>
                <th class="hide">İzin Başlangıcı</th>
                <th class="hide">Yarım Gün</th>
                <th class="hide">İzin Bitişi</th>
                <th class="hide">Yarım Gün</th>
                <th class="hide">Talep Toplamı</th>
                <th class="hide">Kalan İzin</th>
                <th class="hide">İzin Durumu</th>
                <th>İşlemler</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($query as $row): ?>
                <tr>

                    <td class="hide">
                        <?php
                        $query3 = $db->prepare('SELECT * FROM users WHERE email = :email');
                        $query3->execute([
                            'email' => $row['email']
                        ]);
                        $row4 = $query3->fetch(PDO::FETCH_ASSOC);
                        echo $row4['name'] . " " . $row4['surname'];
                        ?>
                    </td>

                    <td class="hide">
                        <?php
                        $query2 = $db->prepare('SELECT * FROM companies WHERE id = :id');
                        $query2->execute([
                            'id' => $row['company_id']
                        ]);
                        $row2 = $query2->fetch(PDO::FETCH_ASSOC);
                        echo $row2['company'];
                        ?>
                    </td>

                    <td>
                        <?= $row['leave_start'] ?>
                    </td>

                    <td>
                        <?php
                        if ($row['start_half_day']) {
                            echo "Evet";
                        } else {
                            echo "Hayır";
                        }
                        ?>

                    </td>

                    <td>
                        <?= $row['leave_end'] ?>
                    </td>

                    <td>
                        <?php
                        if ($row['end_half_day']) {
                            echo "Evet";
                        } else {
                            echo "Hayır";
                        }
                        ?>

                    </td>

                    <td>
                        <?= $row['total_day'] ?>
                    </td>

                    <td class="hide">
                        <?php
                        $eposta = $row['email'];
                        $baslangic = $row4['start_date'];
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
                        echo $leave_right - $total_leave;
                        ?>

                    </td>

                    <td>
                        <?php
                        if ($row['statue'] == 1) {
                            echo "Beklemede";
                        } elseif ($row['statue'] == 2) {
                            echo "Onaylandı";
                        } elseif ($row['statue'] == 3) {
                            echo "İptal Edildi";
                        }
                        ?>
                    </td>

                    <td>
                        <a href="<?= user_url('cancel_leave?id=' . $row['id']) ?>" class="btn">İptal Et</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php if ($totalRecord > $pageLimit): ?>
    <div class="pagination">
        <ul>
            <?= $db->showPagination(user_url(route(1) . '?' . $pageParam . '=[page]')) ?>
        </ul>
    </div>
<?php endif; ?>


<?php require user_view('static/footer') ?>