<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\Pjax;
use yii2fullcalendar\yii2fullcalendar;

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Calendar');

$this->registerJs("
$(document).ready(function() {
    $(document).on('click', '.index-modal-link', function () {
        $('#index-modal').modal({ show: true });
    });
});
");

$eventsJS = <<<EOF
function (start, end, timezone, callback) {
    $.ajax({
        url: '/calendar/get-events',
        dataType: 'json',
        data: {
            start: start.unix(),
            end: end.unix()
        },
        success: function (events) {
            console.log(events);
            callback(events);
        }
    });
}
EOF;

$eventClickJS = <<<EOF
function (calEvent, jsEvent, view) {
    if (!$(this).hasClass('task-complete')) {
        var id = calEvent.id;
        $.pjax({
            container: '#pjax-modal-container',
            url: '/task/calendar-update/?id=' + id,
            push: false,
        });
        $('#index-modal').modal({ show: true });
    }
}
EOF;

$dayClickJS = <<<EOF
function(date, jsEvent, view) {
    function addZero(a) { return parseInt(a) < 10 ? '0' + parseInt(a) : a + ''; }
    function getDate(datetime) {
        var date = new Date(datetime);
        return [
            date.getFullYear(),
            date.getMonth()+1,
            date.getDate()
        ].map(function (a) { return addZero(a); }).join('-') + '_' + [
            date.getHours(),
            date.getMinutes()
        ].map(function (a) { return addZero(a); }).join(':')
    }
    var _i = date._i;
    if (typeof _i === "object") {
        var date = [_i[0], _i[1] + 1, _i[2]].join('-');
        var time = [_i[3], _i[4], _i[5]].join(':');
        _i = new Date(date + ' ' + time).getTime();
    } else {
        _i += 3600 * 1000 * 8;
    }
    var start = Math.round(_i);
    var end = start + 3600 * 1000;
    
    $.pjax({
            container: '#pjax-modal-container',
            url: '/task/calendar-create/?start=' + getDate(start) + '&end=' + getDate(end),
            push: false,
        });
        $('#index-modal').modal({ show: true });
}
EOF;


?>


<?php Modal::begin([
    'id' => 'index-modal',
]) ?>
<?php Pjax::begin([
    'id' => 'pjax-modal-container',
    'linkSelector' => '.index-modal-link',
    'enablePushState' => false,
]) ?>
<?php Pjax::end() ?>
<?php Modal::end() ?>

<?= Html::beginTag('section', ['class' => 'content event-index']) ?>
<?= Html::beginTag('div', ['class' => 'row']) ?>
<?= Html::beginTag('div', ['class' => 'col-md-12']) ?>
<?= Html::beginTag('div', ['class' => 'box box-primary']) ?>
<?= Html::beginTag('div', ['class' => 'box-body']) ?>
<?= yii2fullcalendar::widget([
    'clientOptions' => [
        'selectable' => true,
        'selectHelper' => true,
        'droppable' => false,
        'editable' => false,
        'defaultDate' => date('Y-m-d'),
        'locale' => 'pl',
        'nowIndicator' => true,
        'buttonText' => [
            'today' => 'today',
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
        'events' => new JsExpression($eventsJS),
        'eventClick' => new JsExpression($eventClickJS),
        'dayClick' => new JsExpression($dayClickJS),
    ],
    'themeSystem' => '',
]) ?>
<?= Html::endTag('div') ?>
<?= Html::endTag('div') ?>
<?= Html::endTag('div') ?>
<?= Html::endTag('div') ?>
<?= Html::endTag('section') ?>