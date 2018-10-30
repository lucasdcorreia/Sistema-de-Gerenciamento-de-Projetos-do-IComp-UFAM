<?php

namespace dbfernandes\icomp;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

/**
 * Class ICompToggleWidget
 * @package dbfernandes\icomp
 */
class ICompToggleWidget extends InputWidget
{
    /**
     * @var string
     */
    public $labelEnabled;

    /**
     * @var string
     */
    public $labelDisabled;

    /**
     * @var string
     */
    public $container = 'div';

    /**
     * @var array
     */
    public $containerOptions = [];

    /**
     * @var array
     */
    public $pluginOptions = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (!$this->labelEnabled) {
            $this->labelEnabled = Yii::t('yii', 'Yes');
        }
        if (!$this->labelDisabled) {
            $this->labelDisabled = Yii::t('yii', 'No');
        }
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        ICompToggleAsset::register($this->getView());

        $pluginOptions = ArrayHelper::merge([
            'on' => $this->labelEnabled,
            'off' => $this->labelDisabled,
            'onstyle' => 'success',
            'offstyle' => 'danger',
        ], $this->pluginOptions);

        $this->view->registerJs('
            $("#' . $this->getId() . '").bootstrapToggle(' . Json::encode($pluginOptions) . ');
        ');

        if ($this->container) {
            return Html::tag($this->container, $this->renderInput(), $this->containerOptions);
        }
        return $this->renderInput();
    }

    /**
     * @return string
     */
    protected function renderInput()
    {
        if ($this->model) {
            return Html::activeCheckbox($this->model, $this->attribute, ['label' => false, 'id' => $this->getId()]);
        }
        return Html::checkbox($this->name, $this->value, ['label' => false, 'id' => $this->getId()]);
    }
}
