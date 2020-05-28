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

namespace keygenqt\imageAjax;

use yii\helpers\Url;
use yii\widgets\InputWidget;

/**
 * @property string $id
 * @property string $classname
 */
class ImageAjax extends InputWidget
{
    public $id;
    public $classname;
    public $url = [];
    public $label = true;
    public $maxFiles = 1;
    public $maxFilesize = 100;
    public $defaultImage;
    public $btnSelect = 'Select';
    public $btnDelete = 'Delete';
    public $subtitle = '';
    public $afterUpdate = 'function(response, index) {}';

    private $_baseUrl;
    private $_ajaxUrl;

    public function init()
    {
        $this->classname = strtolower((new \ReflectionClass($this->model))->getShortName());
        $this->id = "{$this->classname}-$this->attribute";
        parent::init();
    }

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

            if (!$('#{$this->getId()}-select').hasClass('dz-clickable')) {

                var sizeFiles{$this->getId()} = 0;

                {$this->afterUpdate}
                new Dropzone('#{$this->getId()}-select', {
                    url: '{$this->getUrl()}',
                    clickable: true,
                    maxFiles: {$this->maxFiles},
                    maxFilesize: {$this->maxFilesize},
                    thumbnail: function() {},
                    sending: function() {
                        $('#{$this->getId()}-yii2-image-ajax-load').show();
                    },
                    init: function() {
                        this.on(\"addedfile\", function() {
                            sizeFiles{$this->getId()} = this.files.length;
                            $(\".btn-green-image-ajax.dz-clickable\").addClass(\"active\");
                        });
                    },
                    error: function(file, message) {
                        $('#{$this->getId()}-yii2-image-ajax-load').hide();
                        $('.{$this->getId()}.yii2-image-ajax .error-block').html('Error server response.').show();
                            setTimeout(function() {
                                $('.{$this->getId()}.yii2-image-ajax .error-block').hide();
                            }, 3000);

                        sizeFiles{$this->getId()}--;
                        if (sizeFiles{$this->getId()} == 0) {
                            $('#{$this->getId()}-yii2-image-ajax-load').hide();
                            this.removeAllFiles();
                        }
                    },
                    success: function(file, response)
                    {
                        response = JSON.parse(response);

                        var value = response.url;
                        if (value === undefined) {
                            value = '{$this->getDefaultLogo()}';
                        }

                        if (response.error === false) {
                            $('#image-{$this->getId()}').css('background-image', 'url(' + value + ')');
                            $('#{$this->getId()}-delete').show();
                        } else {
                            $('.{$this->getId()}.yii2-image-ajax .error-block').html(response.error).show();
                            setTimeout(function() {
                                $('.{$this->getId()}.yii2-image-ajax .error-block').hide();
                            }, 3000);
                        }
                        $('#{$this->getId()}-select').removeClass('img-loading');
                        $('#{$this->id}').val(value);

                        afterUpdate{$this->getId()}(response, sizeFiles{$this->getId()});

                        sizeFiles{$this->getId()}--;
                        if (sizeFiles{$this->getId()} == 0) {
                            $('#{$this->getId()}-yii2-image-ajax-load').hide();
                            this.removeAllFiles();
                        }
                    }
                });
            }

        ");

        return $this->getView()->render('@keygenqt/imageAjax/views/view', ['widget' => $this]);
    }
}
