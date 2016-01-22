<?php

/** @var String $id */
/** @var String $imageDefault */
/** @var String $attribute */
/** @var String $subtitle */
/** @var String $btnSelect */
/** @var String $btnDelete */
/** @var \yii\base\Model $model */

use \yii\helpers\Html;

?>

<style>
    .field-<?= strtolower(preg_replace('/.+\\\(.+)/ui', '$1', $model::className())) . '-' . $attribute ?> label.control-label {
        display: none;
    }
    #<?= $id ?>-select.img-loading .fa-hourglass {
        color: black;
        font-size: 12px;
        display: inline-block;
        margin-left: 7px;
    }
</style>

<div class="yii2-image-ajax <?= $id ?>">

    <?= Html::activeHiddenInput($model, $attribute, array('id' => $id . '-hidden-filed')) ?>

    <div class="table">
        <div class="table-cell">
            <div class="image-data">
                <img id="image-<?= $id ?>" src=" <?= $model->$attribute ? $model->$attribute : $imageDefault ?>"/>
            </div>
        </div>
        <div class="table-cell">
            <div class="error-block"></div>
            <div class="btn-buttons-images">
                <div id="<?= $id ?>-select" class="btn btn-success"><?= $btnSelect ?></div>
                <div id="<?= $id ?>-delete" class="btn btn-danger"><?= $btnDelete ?></div>
                <div class="subtitle">
                    <?= $subtitle ?>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    <?php if (!$model->$attribute): ?>
    $('#<?= $id . '-delete' ?>').hide();
    <?php endif; ?>
    $('#<?= $id . '-delete' ?>').click(function() {
        $('#<?= $id . '-hidden-filed' ?>').val("");
        $('#image-<?= $id ?>').attr('src', "<?= $imageDefault ?>");
        $(this).hide();
    });
</script>