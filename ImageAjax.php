<?php

namespace keygenqt\imageAjax;

use yii\helpers\Url;
use yii\widgets\InputWidget;

class ImageAjax extends InputWidget
{
    public $url = [];
    public $label = true;
    public $maxFiles = 1;
    public $maxFilesize = 100;
    public $defaultImage;
    public $btnSelect = 'Select';
    public $btnDelete = 'Delete';
    public $subtitle = '';
    public $afterUpdate = 'function(response) {}';

    private $_baseUrl;
    private $_ajaxUrl;

    public function getModelName()
    {
        return strtolower(preg_replace('/.+\\\(.+)/ui', '$1', get_class($this->model)));
    }

    public function getBaseUrl()
    {
        if ($this->_baseUrl === null) {
            BowerAssets::register($this->getView());
            $this->_baseUrl = ActiveAssets::register($this->getView())->baseUrl;
        }
        return $this->_baseUrl;
    }

    public function getUrl()
    {
        if ($this->_ajaxUrl === null) {
            $this->_ajaxUrl = Url::toRoute($this->url);
        }
        return $this->_ajaxUrl;
    }

    public function getDefaultLogo()
    {
        return $this->defaultImage ? $this->defaultImage : $this->getBaseUrl() . '/images/default_logo.jpg';
    }

    public function run()
    {
        $this->afterUpdate = "var afterUpdate{$this->getId()} = " . $this->afterUpdate;

        $this->getView()->registerJs("

            var sizeFiles{$this->getId()} = 0;

            {$this->afterUpdate}
            new Dropzone('#{$this->getId()}-select', {
                url: '{$this->getUrl()}',
                clickable: true,
                maxFiles: {$this->maxFiles},
                maxFilesize: {$this->maxFilesize},
                thumbnail: function() {},
                sending: function() {
                    $('#yii2-image-ajax-load').show();
                },
                init: function() {
                    this.on(\"addedfile\", function() {
                        sizeFiles{$this->getId()} = this.files.length;
                        $(\".btn-green-image-ajax.dz-clickable\").addClass(\"active\");
                    });
                },
                error: function(file, message) {
                    $('#yii2-image-ajax-load').hide();
                    $('.yii2-image-ajax .error-block').html('Error server response.').show();
                        setTimeout(function() {
                            $('.yii2-image-ajax .error-block').hide();
                        }, 3000);

                    sizeFiles{$this->getId()}--;
                    if (sizeFiles{$this->getId()} == 0) {
                        this.removeAllFiles();
                    }
                },
                success: function(file, response)
                {
                    response = JSON.parse(response);

                    if (response.error === false) {
                        $('#image-{$this->getId()}').css('background-image', 'url(' + response.url + ')');
                        $('#{$this->getId()}-delete').show();
                    } else {
                        $('.yii2-image-ajax .error-block').html(response.error).show();
                        setTimeout(function() {
                            $('.yii2-image-ajax .error-block').hide();
                        }, 3000);
                    }
                    $('#{$this->getId()}-select').removeClass('img-loading');
                    $('#{$this->getId()}-hidden-filed').val(response.url);

                    $('#yii2-image-ajax-load').hide();
                    
                    afterUpdate{$this->getId()}(response);

                    sizeFiles{$this->getId()}--;
                    if (sizeFiles{$this->getId()} == 0) {
                        this.removeAllFiles();
                    }
                }
            });
        ");

        return $this->getView()->render('@keygenqt/imageAjax/views/view', ['widget' => $this]);
    }
}