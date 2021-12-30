<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2021
 * @package yii2-widgets
 * @subpackage yii2-widget-select2
 * @version 2.2.2
 */

namespace kartik\select2;

/**
 * Asset bundle for the Krajee theme for [[Select2]] widget.
 *
 * @author Mohamad Faeez <mfmdevsystem@gmail.com>
 * @modified Kartik Visweswaran <kartikv2@gmail.com>
 * @since 2.2.2
 */
class ThemeMaterialAsset extends ThemeAsset
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->initTheme();
        $this->setupAssets('css', ['css/select2-material']);
        parent::init();
    }
}
