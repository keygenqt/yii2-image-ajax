yii2-image-ajax
===================

This is the ImageAjax widget and a Yii 2 enhanced wrapper for the [Dropzone jQuery plugin](http://www.dropzonejs.com). A simple way to do ajax loading image on the site.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either add

```
"require": {
    "keygenqt/yii2-image-ajax": "*"
},
"repositories":[
    {
        "type": "git",
        "url": "https://github.com/keygenqt/yii2-image-ajax.git"
    }
]
```

of your `composer.json` file.

## Latest Release

The latest version of the module is v0.5.0 `BETA`.

## Usage

View:

```php
use keygenqt\imageAjax\ImageAjax;

// Normal select with ActiveForm & model
<?= $form->field($model, 'icon')->widget(ImageAjax::classname(), [
    'label' => false,
    'defaultImage' => '/images/user-icon-default.png',
    'btnSelect' => 'Choose',
    'btnDelete' => 'Delete',
    'url' => ['ajax/upload-image'],
    'subtitle' => 'This video will change its size to 360х360, so keep that in mind.'
]) ?>

```

Controller:

```php
// AjaxController
class AjaxController extends Controller
{
    public function actionUploadImage()
    {
        if (Yii::$app->request->isAjax) {
            $url = Helper::uploadImage('file');
            if ($url) {
                echo Json::encode([
                    'url' => $url,
                    'error' => false,
                ]);
            } else {
                echo Json::encode([
                    'error' => 'Error upload file.',
                ]);
            }
            exit;
        }
    }
}
```

## ScreenShot

![Alt text](https://raw.githubusercontent.com/keygenqt/yii2-image-ajax/master/screenshot/empty.png?raw=true "Empty")
![Alt text](https://raw.githubusercontent.com/keygenqt/yii2-image-ajax/master/screenshot/load.png?raw=true "Load")
![Alt text](https://raw.githubusercontent.com/keygenqt/yii2-image-ajax/master/screenshot/select.png?raw=true "Select")

## License

**yii2-image-ajax** is released under the BSD 3-Clause License. See the bundled `LICENSE.md` for details.


