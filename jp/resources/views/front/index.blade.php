@extends('layouts.frontend-master')
@section('content')
<div class="business-main-slider">
    <div class="owl-carousel main-slider">
        <div class="item">
            <div class="hvrbox">
                <img src="{{asset('landing_front')}}/images/icon/shape.svg" alt="" class="hvrbox-layer_bottom">
                <div class="hvrbox-layer_top">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="overlay-text text-center">
                                    <h3 data-animation-in="slideInDown" data-animation-out="animate-out slideOutUp">CERのブラインドでメンバーの</h3>
                                    <h3 data-animation-in="slideInDown" data-animation-out="animate-out slideOutUp">訪問意欲が</h3>
                                    <a href="{{route('register')}}">
                                        <span class="highlight">今すぐアップグレード</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="shape-sc">
                                    <p data-animation-in="slideInDown" data-animation-out="animate-out fadeOut">
                                    <div class="row">
                                        <div class="col-md-12 no-padding">
                                            <div class="single-features">
                                                <div class="media">
                                                    <img src="{{asset('landing_front')}}/images/icon/checked.png" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <h5 class="mt-0">より高い生産性</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 no-padding">
                                            <div class="single-features">
                                                <div class="media">
                                                    <img src="{{asset('landing_front')}}/images/icon/checked.png" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <h5 class="mt-0">より高い出社率そして遅刻の削減</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 no-padding">
                                            <div class="single-features">
                                                <div class="media">
                                                    <img src="{{asset('landing_front')}}/images/icon/checked.png" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <h5 class="mt-0">採用審査のプロセスをより効率よく</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="business-feature-1x business-feature-onslider">
        <div class="">
            <div class="business-features">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 no-padding">
                            <div class="single-features">
                                <div class="media">
                                    <!-- <img src="images/icon/checked.png" alt="Generic placeholder image"> -->
                                    <div class="media-body">
                                        <h5 class="mt-0 text-center"><i>CER記録を導入してこれまでにはなかった従業員記録の様々な利点を発揮</i></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-4 no-padding">
                            <div class="single-features active">
                                <div class="media">
                                  <img src="images/icon/checked.png" alt="Generic placeholder image">
                                  <div class="media-body">
                                    <h5 class="mt-0">Improve Punctuality and Attendance<br></h5>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 no-padding">
                            <div class="single-features">
                                <div class="media">
                                  <img src="images/icon/checked.png" alt="Generic placeholder image">
                                  <div class="media-body">
                                    <h5 class="mt-0">Screen New Employees More Effectively</h5>
                                  </div>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="padding-top-large"></div>

    <div class="about-business-2x">
        <div class="container">
            <div class="about-business-content-2x">
                <div class="row" style="align-items: flex-end;">
                    <div class="col-md-8">
                        <div class="about-business-left-2x">
                            <h5 style="font-size: 40px;">飛躍的な進歩</h5>
                            <span class="title-border-left"></span>
                            <p>'Conveyable Employment Records（運搬可能な従業員記録、以下CER）'とは、ひとつの雇用者から次の雇用者へ移動可能なデジタルファイルです。被雇用者は転職後でも過去の自分の経験、業績等の記録を保持することが出来ます。<br><br>このシステムを導入することにより、企業のEVP（企業が従業員に提供できる価値）は強くなります。よって、従業員の高いパフォーマンスレベルや時間厳守、そして不必要な病欠の数の低下などにつながります。
                        </div>
                    </div>

                    <div class="col-md-4 pb-lg-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/jp/1.jpg" alt="sample image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="padding-top-large"></div>

    <div class="business-cta-1x">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="cta-content">
                        <h3>CONVEYは「従業員の満足度」を重視するビジネスをサポートしています。</h3>
                        <h2>貢献意欲がアップ</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>
    <div class="business-service-3x">
        <div class="container">
            <div class="business-service-center">
                <div class="row">
                    <div class="col-md-12">
                        <div class="business-title-middle">
                            <h2>高まる生産性</h2>
                            <span class="title-border-middle"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bussiness-highlight-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>企業として、従業員の現在に限らず将来の成功も考慮してサポートする事が出来ます。例えその成功が他企業とであったとしてもです。この従業員を「個人」として尊重したコアバリューを企業が持つことにより、優秀な人材を採用し、定着させることがより可能になります。 <br><br>どのような記録をconveyable（運搬可能）にするかは個々の企業次第です。推薦状の代わりとしてデザインされた退職時の評価のみを使用する企業もありますし、定期的なパフォーマンス評価を足す企業もあります。また、以下のようなさまざまな内容を足して使用する企業もあります：</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 service-center">
        <div class="row">
            <div class="col-md-4">
                <div class="single-service-center text-center">
                    <img src="{{asset('landing_front')}}/images/icon/icon-1.png" alt="Generic placeholder image">
                    <a href="#">パフォーマンス評価</a>
                    <p>上司からの<br> 定期的なコメント・評価、<br> あるいは意見
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-service-center text-center">
                    <img src="{{asset('landing_front')}}/images/icon/icon-2.png" alt="Generic placeholder image">
                    <a href="#">従業員証明書</a>
                    <p>インターナショナルに <br> 認められる <br> 証明書や検定等</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-service-center text-center">
                    <img src="{{asset('landing_front')}}/images/icon/icon-4.png" alt="Generic placeholder image">
                    <a href="#">退職時の評価</a>
                    <p>退職時の<br>従業員の<br> 職務履歴概要</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-service-center text-center">
                    <img src="{{asset('landing_front')}}/images/icon/icon-3.png" alt="Generic placeholder image">
                    <a href="#">従業員表彰</a>
                    <p>企業内での<br>奨励賞<br>や貢献</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-service-center text-center">
                    <img src="{{asset('landing_front')}}/images/icon/icon-5.png" alt="Generic placeholder image">
                    <a href="#">病欠日数等のレポート</a>
                    <p>有給扱いの <br>病欠日数の<br> 定期的な測定・評価</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-service-center text-center">
                    <img src="{{asset('landing_front')}}/images/icon/icon-6.png" alt="Generic placeholder image">
                    <a href="#">出勤率や遅刻等のレポート</a>
                    <p>原因の詳細、<br>個々の理由、 <br> パターンの有無等</p>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="padding-top-large"></div>

<div class="business-cta-1x">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="cta-content">
                    <h3>大企業から小企業まで対応する解決策</h3>
                    <h2>GDPR（EU一般データ保護規則）に100％準拠しています</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="padding-top-large"></div>
<div class="padding-top-large"></div>
<div class="about-business-2x">
    <div class="container">
        <div class="about-business-content-2x">
            <div class="row">
                <div class="col-md-8">
                    <div class="about-business-left-2x">
                        <h5 style="font-size: 40px;">優秀な人材を採用し、定着させることがより可能になります... </h5>
                        <span class="title-border-left"></span>
                        <p>CERにアップグレードすることにより、より企業にあったより優秀な人材を採用し、定着させることが可能になります。<br><br> このような人材の多くは、CERを使用する企業の持つ価値を理解しています。CERが、被雇用者のこれまでの業務経験や仕事に活かせるスキルをひとつの場所に記録してくれるからです。つまり、今日の自社への貢献が、転職後の将来にもしっかりと影響・反映されるという大きな利点を彼らは知っているのです。</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="about-business-right-2x">
                        <img class="img-responsive" src="{{asset('landing_front')}}/images/jp/fas2.png" alt="sample image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="padding-top-large"></div>
<div class="padding-top-large"></div>
<div class="business-app-present-1x">
    <div class="app-present-content">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="app-present-left">
                        <img src="{{asset('landing_front')}}/images/introduct-design2.png" alt="Mountains" class="">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="app-present-right">
                        <h3>採用審査</h3>
                        <h2>情報<br>...今までよりも早い!</h2>
                        <p>新しい人材を採用する際、履歴書と面接だけではどうしても分かりきれない、決断しきれない部分というのは出てくるものです。<br><br>CERにアップグレードした後は、採用審査のプロセスがもっと早くなります。応募者に関する必要な情報に必要な時にすぐにアクセスでき、以前の職場との連絡の取り合いや推薦状を待つ時間等が大幅に短縮されます。</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="padding-top-middle"></div>

<div class="padding-top-large"></div>

<div class="about-business-2x">
    <div class="container">
        <div class="about-business-content-2x">
            <div class="row">
                <div class="col-md-8">
                    <div class="about-business-left-2x">
                        <h5 style="font-size: 40px;">時間 ... そしてコストの節約</h5>
                        <span class="title-border-left"></span>
                        <p>これまでの採用プロセスでは、他企業から以前の従業員に関する推薦状のリクエストがあるなど何かと時間がかかりました。CERを使用することにより、あなたの企業が作った従業員の記録に他企業は必要な時に自らアクセスする事ができるようになります。<br><br>時間とコストの削減はもちろんのこと、CERは企業が過去の従業員と良い関係を保つお手伝いをします。他企業への転職後、以前の企業からの推薦状を待たねばならない煩わしさがなくなるからです。</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="about-business-right-2x">
                        <img class="img-responsive" src="{{asset('landing_front')}}/images/fas1.png" alt="sample image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="padding-top-large"></div>

<div class="business-app-present-1x">
    <div class="app-present-content">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="app-present-left">
                        <img src="{{asset('landing_front')}}/images/introduct-design3.png" alt="Mountains" class="">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="app-present-right">
                        <h3>企業の成功は</h3>
                        <h2>従業員の満足度で決まります</h2>
                        <p> CERにアップグレードすることにより企業のEVP（企業が従業員に提供できる価値）のレベルが一気に高くなり、従業員のより効率のよいパフォーマンスにつながります。<br><br> CONVEY使用の採用プロセスを導入した企業が伸び続けると同時に、従業員も自分の能力、そしてCER履歴を向上させようと前向きな努力をします。CERは被雇用者にとっても将来の成功につながる大切なチャンスだからです。 <br><br> CONVEYを使えば ... みんなが得をします.<br></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



<div class="padding-top-large"></div>







@endsection
