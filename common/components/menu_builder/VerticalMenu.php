<?php

namespace common\components\menu_builder;

use common\models\Categories;
use common\components\menu_builder\VerticalMenuAssets;
use yii\bootstrap\Html;
use yii\bootstrap\Widget;

class VerticalMenu extends Widget {

    public $data = null;

    public function init() {
       // $view = $this->getView();
        VerticalMenuAssets::register( $this->getView() );
        parent::init();
    }

    public function run()
    {
        if (empty($this->data)) {
            $this->data = Categories::find()->where(['is_active' => 1])->orderBy('label')->asArray()->all();
        }

        return self::buildHtml($this->data);
    }

    /**
     * Выстраиваем html-разметку меню
     * @param array $items - массив из которого будут построены блоки меню
     * @return string
     */
    protected static function buildHtml(array $items){
        $html = "<div class='btn-group btn-group-vertical btn-group-vertical-full-width'>";
        foreach ($items as $item) {
            //TODO: make url
            $html .= Html::a($item['label'], '#', ['role' => 'button', 'class' => 'btn btn-primary']);
        }
        $html .= "</div>";
        return $html;
    }


}