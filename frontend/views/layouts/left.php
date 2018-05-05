<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => array_merge(
                    [
                        ['label' => Yii::t('app', 'Menu'), 'options' => ['class' => 'header']],
                        ['label' => Yii::t('app', 'Dashboard'), 'url' => ['/site/index'], 'icon' => 'dashboard'],
                        ['label' => Yii::t('app', 'Calendar'), 'url' => ['/site/calendar'], 'icon' => 'calendar'],
                        ['label' => Yii::t('app', 'Subscribe info'), 'url' => ['/site/subscribe'], 'icon' => 'share'],
                    ],
                    (Yii::$app->user->identity->role === \common\models\User::ROLE_ADMIN ? [
                        ['label' => Yii::t('app', 'Admin Panel'), 'options' => ['class' => 'header']],
                        ['label' => Yii::t('app', 'cache'), 'url' => ['/cache/index'], 'icon' => 'dashboard'],
                    ] : [])
                ),
            ]
        ) ?>

    </section>

</aside>
