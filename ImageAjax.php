<?php

namespace keygenqt\imageAjax;

use yii\helpers\Url;
use yii\widgets\InputWidget;

class ImageAjax extends InputWidget
{
    public $url = [];
    public $defaultLogo;
    public $btnSelect = 'Select';
    public $btnDelete = 'Delete';
    public $subtitle = 'Max size 100 MIB';

    public function init()
    {
        $this->url = Url::toRoute($this->url);

        $id = $this->getId() . rand(0, 999999);

        $baseUrl = ActiveAssets::register($this->getView())->baseUrl;

        echo $this->getView()->render('@keygenqt/imageAjax/views/view', [
            'id' => $id,
            'imageDefault' => $this->defaultLogo,
            'attribute' => $this->attribute,
            'baseUrl' => $baseUrl,
            'model' => $this->model,
            'subtitle' => $this->subtitle,
            'btnSelect' => $this->btnSelect,
            'btnDelete' => $this->btnDelete,
        ]);

        $this->getView()->registerJs("
//          <script>
            new Dropzone('#$id-select', {
                url: '{$this->url}',
                clickable: true,
                maxFiles: 1,
                maxFilesize: 100,
                thumbnail: function() {},
                sending: function() {
                    $('#yii2-image-ajax-load').show();
                },
                error: function(file, message) {
                    $('#yii2-image-ajax-load').hide();
                    $('.yii2-image-ajax .error-block').html('Error server response.').show();
                        setTimeout(function() {
                            $('.yii2-image-ajax .error-block').hide();
                        }, 3000);
                },
                success: function(file, response)
                {
                    response = JSON.parse(response);

                    if (response.error === false) {
                        $('#image-{$id}').attr('src', response.url);
                        $('#$id-delete').show();
                    } else {
                        $('.yii2-image-ajax .error-block').html(response.error).show();
                        setTimeout(function() {
                            $('.yii2-image-ajax .error-block').hide();
                        }, 3000);
                    }
                    $('#$id-select').removeClass('img-loading');
                    $('#$id-hidden-filed').val(response.url);
                    this.removeAllFiles();
                    $('#yii2-image-ajax-load').hide();
                }
            });
        ");

        parent::init();
    }
}