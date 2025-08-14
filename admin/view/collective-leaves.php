<?php require admin_view('static/header')?>

    <div class="box-">
        <h1>
            Toplu İzin Tanımla
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
                    <label>Toplam İzin Günü</label>
                    <div class="form-content">
                        <input type="text" value="0.5" name="toplu_izin" disabled >
                    </div>
                </li>


                <li class="submit">
                    <input type="hidden" name="submit" value="1">
                    <button type="submit">İzni Tanımla</button>
                </li>
            </ul>
        </form>
    </div>


<?php require admin_view('static/footer')?>