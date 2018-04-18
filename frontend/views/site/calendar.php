<?php

use yii2fullcalendar\yii2fullcalendar;

$this->title = Yii::t('app', 'Calendar');

?>
<section class="content event-index">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <?= yii2fullcalendar::widget([
                        'clientOptions' => [
                            'selectable' => true,
                            'selectHelper' => true,
                            'droppable' => true,
                            'editable' => true,
                            'defaultDate' => date('Y-m-d'),
                            'locale' => 'pl',
                            'nowIndicator' => true,
                            'buttonText' => [
                                'today'=> 'today',
                                'month' => 'month',
                                'week' => 'week',
                                'day' => 'day',
                                'list' => 'list'
                            ],
                            'header' => [
                                'center' => 'title',
                                'left' => 'prev,next today',
                                'right' => 'month,agendaWeek,agendaDay'
                            ],
                            'eventLimit' => true,
                            'views' => [
                                'agenda' => [
                                    'eventLimit' => 3
                                ],
                            ],
                        ],
                        'themeSystem' => '',
                        'events' => [],
                    ]) ?>
                </div>
            </div>

        </div>
    </div>
</section>