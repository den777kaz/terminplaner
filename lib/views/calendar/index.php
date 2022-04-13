<?php
$today = $this->today;
$today_ym =$this->today_ym;
$next_month = $this->setNextDate();
$prev_month = $this->setPrevDate();


$title_month = $this->titleMonth;
$title_year = $this->titleYear;
?>
<section>
    <div class="container-lg">
        <nav class="calendar-nav">
            <div class="calendar-nav__left">
                <h1><?=$title_month ?> <span><?=$title_year ?></span></h1>
            </div>
            <div class="calendar-nav__middle btn-group">
                <a href="?type=year" class="btn">Year</a>
                <a href="?type=month" class="btn">Month</a>
                <a href="?type=week" class="btn">Week</a>
            </div>
            <div class="calendar-nav__right btn-group">
                <a href="?type=month&ym=<?=$prev_month?>" class="btn"> < </a>
                <a href="?type=month&ym=<?=$today_ym?>" class="btn">today</a>
                <a href="?type=month&ym=<?=$next_month?>" class="btn"> > </a>
            </div>
        </nav>

<!--    render month    -->
        <?php $this->switch_type()?>
    </div>
</section>