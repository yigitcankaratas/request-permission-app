<?php require admin_view('static/header');

?>

    <div class="box-">

    </div>

    <div class="clear" style="height: 10px;"></div>

    <div class="table">
        <table>
            <thead>
            <tr>
                <th><h1>Departmanlar</h1></th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($query as $row): ?>
                <tr>
                    <td>

                            <?= $row['department']?>

                    </td>


                    <td>
                        <a href="<?= admin_url('edit-departments?id=' . $row['id']) ?>" class="btn">Düzenle</a>

                        <a
                           href="<?= admin_url('delete-departments?id=' . $row['id']) ?>"
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