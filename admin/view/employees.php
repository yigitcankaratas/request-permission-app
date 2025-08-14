<?php require admin_view('static/header');

 ?>

    <div class="box-">
        <h1>
            Çalışanlar
            <!--            <a href="#">Add New</a>-->
        </h1>
    </div>

    <div class="clear" style="height: 10px;"></div>

    <div class="table">
        <table>
            <thead>
            <tr>
                <th>Adı Soyadı</th>
                <th class="hide">E-posta</th>
                <th class="hide">Şirket</th>
                <th class="hide">Departman</th>
                <th class="hide">Kalan İzin</th>
                <th>İşlemler</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($query as $row): ?>
                <tr>
                    <td>

                            <?= $row['name'], ' ', $row['surname'] ?>

                    </td>

                    <td class="hide">
                        <?= $row['email'] ?>
                    </td>


                    <td class="hide">
                        <?php
                        $query2 = $db->prepare('SELECT * FROM companies WHERE id = :id');
                        $query2->execute([
                            'id' => $row['company']
                        ]);
                        $row2 = $query2->fetch(PDO::FETCH_ASSOC);
                        echo $row2['company'];
                        ?>
                    </td>
                    <td class="hide">
                        <?php
                        $query3 = $db->prepare('SELECT * FROM departments WHERE id = :id');
                        $query3->execute([
                            'id' => $row['department']
                        ]);
                        $row4 = $query3->fetch(PDO::FETCH_ASSOC);
                        echo $row4['department'];
                        ?>
                    </td>
                    <td class="hide">
                        <?php
                        $eposta = $row['email'];
                        $baslangic = $row['start_date'];
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
                        foreach ($row1 as $arr){
                            $total_leave += $arr['total_day'];
                        }
                        echo $leave_right-$total_leave;
                        ?>

                    </td>
                    <td>
                        <a href="<?php echo admin_url('edit-employees'. "?id=" . $row['id'] )?>"  class="btn">Düzenle</a>
                        <a
                           href="<?= admin_url('delete-employees?id=' . $row['id']) ?>"
                           class="btn">Sil</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php if ($totalRecord > $pageLimit): ?>
    <div class="pagination">
        <ul>
            <?= $db->showPagination(admin_url(route(1) . '?' . $pageParam . '=[page]')) ?>
        </ul>
    </div>
<?php endif; ?>

<?php require admin_view('static/footer') ?>