<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => Yii::t('app', 'Menu'), 'options' => ['class' => 'header']],
                    ['label' => Yii::t('app', 'Dashboard'), 'url' => ['/site/index'], 'icon' => 'dashboard'],
                    ['label' => Yii::t('app', 'Calendar'), 'url' => ['/site/calendar'], 'icon' => 'calendar'],
                    ['label' => Yii::t('app', 'Subscribe info'), 'url' => ['/site/subscribe'], 'icon' => 'share'],
//                    ['label' => Yii::t('app', 'Add Project'), 'url' => ['/project/create']],
                ],
            ]
        ) ?>

    </section>

</aside>
