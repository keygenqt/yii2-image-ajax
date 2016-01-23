<?php

namespace keygenqt\imageAjax;

use \yii\web\AssetBundle;

/**
 * @author KeyGen <keygenqt@gmail.com>
 */
class ActiveAssets extends AssetBundle
{
	public $sourcePath = '@keygenqt/imageAjax/assets';

	public $js = [
		'js/dropzone.js',
	];

	public $css = [
		'css/yii2-image-ajax.css'
	];
}
