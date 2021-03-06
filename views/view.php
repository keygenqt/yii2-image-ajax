<?php
/*
 * Copyright 2020 Vitaliy Zarubin
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/** @var keygenqt\imageAjax\ImageAjax $widget */

use \yii\helpers\Html;

?>

<style>
    <?php if ($widget->label === false): ?>
        .field-<?= $widget->getModelName() . '-' . $widget->attribute ?> label.control-label {
            display: none;
        }
    <?php endif; ?>

    #<?= $widget->getId() ?>-select.img-loading .fa-hourglass {
        color: black;
        font-size: 12px;
        display: inline-block;
        margin-left: 7px;
    }
</style>

<div class="yii2-image-ajax <?= $widget->getId() ?>">

    <?= Html::activeHiddenInput($widget->model, $widget->attribute) ?>

    <div class="table">
        <div class="table-cell">
            <div id="image-<?= $widget->getId() ?>" class="image-data" style="background-image: url('<?= $widget->model->{$widget->attribute} ? $widget->model->{$widget->attribute} : $widget->getDefaultLogo() ?>')">
                <div id="<?= $widget->getId() ?>-yii2-image-ajax-load" class="load">
                    <div class="table">
                        <div class="table-cell">
                            <img src="<?= $widget->getBaseUrl() ?>/images/load.gif"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-cell">
            <div class="error-block"></div>
            <div class="btn-buttons-images">
                <div id="<?= $widget->getId() ?>-select" class="btn-green-image-ajax"><?= $widget->btnSelect ?></div>
                <?php if($widget->btnDelete !== false): ?>
                    <div id="<?= $widget->getId() ?>-delete" class="btn-red-image-ajax"><?= $widget->btnDelete ?></div>
                <?php endif; ?>
                <div class="subtitle">
                    <?= $widget->subtitle ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if($widget->btnDelete !== false): ?>
    <script type="text/javascript">
        <?php if (!$widget->model->{$widget->attribute}): ?>
        $('#<?= $widget->getId() . '-delete' ?>').hide();
        <?php endif; ?>
        $('#<?= $widget->getId() . '-delete' ?>').click(function() {
            $('#<?= $widget->id ?>').val("");
            $('#image-<?= $widget->getId() ?>').css('background-image', "url('<?= $widget->getDefaultLogo() ?>')");
            $(this).hide();
        });
    </script>
<?php endif; ?>