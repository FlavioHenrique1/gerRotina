<?php \Classes\ClassLayout::setHeadRestrito("user");?>
<?php \Classes\ClassLayout::setHeader('Calendário','Celendário');?>
<?php \Classes\ClassLayout::setNav(); ?>

<script src="<?= DIRPAGE.'lib/js/fullcalendar-6.1.4/dist/index.global.min.js'?>"></script>
    <div class="calendar">
        <div class=" calendarManager"></div>
            <div class="teste"></div>
        </div>
    </div>
<?php \Classes\ClassLayout::setFooter('calendario.js');?>