<?php

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

    <?= Html::activeHiddenInput($widget->model, $widget->attribute, array('id' => $widget->getId() . '-hidden-filed')) ?>

    <div class="table">
        <div class="table-cell">
            <div class="image-data">
                <div id="yii2-image-ajax-load" class="load">
                    <div class="table">
                        <div class="table-cell">
                            <img src="<?= $widget->getBaseUrl() ?>/images/load.gif"/>
                        </div>
                    </div>
                </div>
                <img id="image-<?= $widget->getId() ?>" src=" <?= $widget->model->{$widget->attribute} ? $widget->model->{$widget->attribute} : $widget->getDefaultLogo() ?>"/>
            </div>
        </div>
        <div class="table-cell">
            <div class="error-block"></div>
            <div class="btn-buttons-images">
                <div id="<?= $widget->getId() ?>-select" class="btn-green-image-ajax"><?= $widget->btnSelect ?></div>
                <div <?php if($widget->btnDelete === false): ?>style="display: none;"<?php endif; ?> id="<?= $widget->getId() ?>-delete" class="btn-red-image-ajax"><?= $widget->btnDelete ?></div>
                <div class="subtitle">
                    <?= $widget->subtitle ?>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    <?php if (!$widget->model->{$widget->attribute}): ?>
    $('#<?= $widget->getId() . '-delete' ?>').hide();
    <?php endif; ?>
    $('#<?= $widget->getId() . '-delete' ?>').click(function() {
        $('#<?= $widget->getId() . '-hidden-filed' ?>').val("");
        $('#image-<?= $widget->getId() ?>').attr('src', "<?= $widget->getDefaultLogo() ?>");
        $(this).hide();
    });
</script>