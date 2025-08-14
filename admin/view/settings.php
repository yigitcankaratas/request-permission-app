<?php require admin_view('static/header') ?>


    <div class="box-">
        <h1>
            Ayarlar
        </h1>
    </div>

    <div class="clear" style="height: 10px;"></div>

    <div class="box-">
        <form action="" method="post" class="form label">
            <ul>
                <li>
                    <label>Site Başlığı</label>
                    <div class="form-content">
                        <input type="text" name="settings[title]" value="<?= setting('title') ?>">
                    </div>
                </li>
                <li>
                    <label>Site Açıklaması</label>
                    <div class="form-content">
                        <input type="text" name="settings[description]" value="<?= setting('description') ?>">
                    </div>
                </li>
            </ul>
            <hr>
            <h1>Bakım Modu Ayarları</h1>
            <ul>
                <li>
                    <label>Bakım Modu</label>
                    <div class="form-content">
                        <select name="settings[maintenance-mode]">
                            <option <?= setting('maintenance-mode') == 1 ? 'selected' : null ?> value="1">Açık</option>
                            <option <?= setting('maintenance-mode') == 2 ? 'selected' : null ?> value="2">Kapalı
                            </option>
                        </select>
                    </div>
                </li>
                <li>
                    <label>Bakım Modu Başlığı</label>
                    <div class="form-content">
                        <input type="text" name="settings[maintenance-mode-title]"
                               value="<?= setting('maintenance-mode-title') ?>">
                    </div>
                </li>
                <li>
                    <label>Bakım Modu Açıklaması</label>
                    <div class="form-content">
                        <textarea name="settings[maintenance-mode-description]" cols="30"
                                  rows="5"><?= setting('maintenance-mode-description') ?></textarea>
                    </div>
                </li>

                <?php /*
                <h1>Resmi Tatil Ayarları</h1>
                <li>
                    <label>Yılbaşı</label>
                    <div class="form-content">
                        <input type="date" name="settings[public-holiday-yilbasi]"
                               value="<?= setting('public-holiday-yilbasi') ?>">

                    </div>
                </li>
                <li>
                    <label>23 Nisan</label>
                    <div class="form-content">
                        <input type="date" name="settings[public-holiday-cocuk]"
                               value="<?= setting('public-holiday-cocuk') ?>">

                    </div>
                </li>
                <li>
                    <label>1 Mayıs</label>
                    <div class="form-content">
                        <input type="date" name="settings[public-holiday-isci]"
                               value="<?= setting('public-holiday-isci') ?>">

                    </div>
                </li>
                <li>
                    <label>19 Mayıs</label>
                    <div class="form-content">
                        <input type="date" name="settings[public-holiday-genclik]"
                               value="<?= setting('public-holiday-genclik') ?>">

                    </div>
                </li>
                <li>
                    <label>15 Temmuz</label>
                    <div class="form-content">
                        <input type="date" name="settings[public-holiday-demokrasi]"
                               value="<?= setting('public-holiday-demokrasi') ?>">

                    </div>
                </li>
                <li>
                    <label>30 Ağustos</label>
                    <div class="form-content">
                        <input type="date" name="settings[public-holiday-zafer]"
                               value="<?= setting('public-holiday-zafer') ?>">

                    </div>
                </li>
                <li>
                    <label>29 Ekim</label>
                    <div class="form-content">
                        <input type="date" name="settings[public-holiday-cumhuriyet]"
                               value="<?= setting('public-holiday-cumhuriyet') ?>">

                    </div>
                </li>
                <li>
                    <label>Ramazan Bayramı</label>
                    <div class="form-content">
                        <input type="date" name="settings[public-holiday-ramazan-baslangic]"
                               value="<?= setting('public-holiday-ramazan-baslangic') ?>">
                        <input type="date" name="settings[public-holiday-ramazan-bitis]"
                               value="<?= setting('public-holiday-ramazan-bitis') ?>">
                    </div>

                </li>
                <li>
                    <label>Kurban Bayramı</label>
                    <div class="form-content">
                        <input type="date" name="settings[public-holiday-kurban-baslangic]"
                               value="<?= setting('public-holiday-kurban-baslangic') ?>">
                        <input type="date" name="settings[public-holiday-kurban-bitis]"
                               value="<?= setting('public-holiday-kurban-bitis') ?>">
                    </div>
                </li>
                */?>

                <li class="submit">
                    <input type="hidden" name="submit" value="1">
                    <button type="submit">Ayarları Kaydet</button>
                </li>
            </ul>
        </form>
    </div>


<?php require admin_view('static/footer') ?>