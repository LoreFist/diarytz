<?php

namespace app\themes\copytemplate\components;

use yii\base\Component;

class Helper extends Component {

    public static function getTemplateMenu($icon) {
        return '<a href="{url}" role="button" class="dropdown-toggle"><span class="i-' . $icon . '">{label}</span></a>';
    }
}
