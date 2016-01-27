<?php

namespace keygenqt\imageAjax;

use \yii\web\AssetBundle;

/**
 * @author KeyGen <keygenqt@gmail.com>
 */
class BowerAssets extends AssetBundle
{
	public $sourcePath = '@bower/dropzone/dist/min';

	public $js = [
		'dropzone.min.js'
	];
}
