[Image Ajax](http://keygenqt.com/work/yii2-image-ajax)
===================

![GitHub](https://img.shields.io/github/license/keygenqt/yii2-autocomplete-ajax)
![Packagist Downloads](https://img.shields.io/packagist/dt/keygenqt/yii2-image-ajax)

This is the Image Ajax widget Yii 2 enhanced wrapper for the [Dropzone library](http://www.dropzonejs.com). A simple way to do ajax loading image on the site.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either add

```
"require": {
    "keygenqt/yii2-image-ajax": "*"
}
```

of your `composer.json` file.

## Usage

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

## License

**yii2-image-ajax** is released under the BSD 3-Clause License. See the bundled `LICENSE.md` for details.


