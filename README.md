Image Ajax
===================

![Packagist Downloads](https://img.shields.io/packagist/dt/keygenqt/yii2-image-ajax)

This is the Image Ajax widget Yii 2 enhanced wrapper for the [Dropzone library](http://www.dropzonejs.com). A simple way to do ajax loading image on the site.

<p>
    <a href="https://old.keygenqt.com/work/yii2-image-ajax">
        <img src="data/demo_button.gif" width="136px"/>
    </a>
</p>

#### Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

```
"require": {
    "keygenqt/yii2-image-ajax": "*"
}
```

#### Usage

```php
<?= $form->field($model, 'image')->widget(ImageAjax::class, [
    'label' => false,
    'btnSelect' => 'Choose',
    'btnDelete' => 'Delete',
    'url' => ['ajax/upload-image', 'type' => 'test'],
    'subtitle' => 'This video will change its size to 360х360, so keep that in mind.',
    'afterUpdate' => 'function() {
        console.log("call afterUpdate")
    }'
]) ?>
```

#### License

```
Copyright 2016-2024 Vitaliy Zarubin

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
```
