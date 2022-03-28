<div class="streamline message-nicescroll-bar">
    <div class="sl-item">
        <a href="javascript:void(0)">
            <div class="icon bg-red">
                <i class="fa fa-times"></i>
            </div>
            <div class="sl-content">
                <span class="inline-block capitalize-font pull-left truncate head-notifications" style="font-size: 1rem;">به تعداد {{$hight}} عوارض تخنیکی عاجل</span>
                <div class="clearfix"></div>
                <p class="truncate" style="visibility: hidden;">مشتری شما برای طرح پایه مشترک شده است. مشتری 25 دلار در ماه پرداخت
                    خواهد کرد.</p>
            </div>
        </a>
    </div>
    <hr class="light-grey-hr ma-0" />
    <div class="sl-item">
        <a href="javascript:void(0)">
            <div class="icon bg-yellow">
                <i class="fa fa-exclamation-triangle"></i>
            </div>
            <div class="sl-content">
                <span class="inline-block capitalize-font pull-left truncate head-notifications" style="font-size: 1rem;">به تعداد {{$middle}} عوارض تخنیکی متوسط</span>
                <div class="clearfix"></div>
                <p class="truncate" style="visibility: hidden;">برخی از خطاهای فنی رخ داده باید حل شوند</p>
            </div>
        </a>
    </div>
    <hr class="light-grey-hr ma-0" />
    <div class="sl-item">
        <a href="javascript:void(0)">
            <div class="icon bg-blue">
                <i class="zmdi zmdi-time"></i>
            </div>
            <div class="sl-content">
                <span class="inline-block capitalize-font pull-left truncate head-notifications" style="font-size: 1rem;">به تعداد {{$low}} عوارض تخنیکی عادی</span>
                <div class="clearfix"></div>
                <p class="truncate" style="visibility: hidden;"> آخرین پرداختی برای اشتراک G Suite Basic شما انجام نشد</p>
            </div>
        </a>
    </div>
    <hr class="light-grey-hr ma-0" />
</div>

<script>
    var notificationCount = "{{ $notiCount }}";
</script>