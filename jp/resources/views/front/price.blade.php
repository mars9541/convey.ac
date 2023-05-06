@extends('layouts.frontend-master')
@section('content')
    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>今すぐ無料でアカウントを作成しましょう</h2>
                        <span class="title-border-middle"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="about-business-2x">
        <div class="container">
            <div class="about-business-content-2x">
                <div class="row">
                    <div class="col-md-8">
                        <div class="about-business-left-2x">
                            <p>今すぐ無料でアカウントを作成しましょう。アカウントは必要な限りずっと無料です。<br><br>CONVEYを使うことにより、従業員個々の'Conveyable Employment Records（CER、 運搬可能な従業員記録）'を作成することが出来ます。従業員に役立つ利益の多いこのシステムが企業に与えてくれる利点はたくさんあります。（従業員、記録は数に制限なく足すことが出来ます。）<br><br>CONVEYアカウントの料金は1年間39,200円から2,499,999円で、企業の規模により値段は異なります。ほとんどの企業はCERへのアップグレードを18ヶ月以内に完了します。アカウントの作成は無料ですので、早めの登録をおすすめします。</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/jp/people.png" alt="sample image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>必要な時に必要な情報を</h2>
                        <span class="title-border-middle"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="business-feature-1x">
        <div class="container">
            <div class="business-features">
                <div class="row">
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0">検索...<br><br>CONVEYデータバンクを使用して求人応募者の従業員記録を安全に検索することが出来ます。ひとりの新しい応募者の検索に対し１クレジットかかります。</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0">検索結果...<br><br>一回の検索で求人応募者の現在、そして過去の雇用者が残した従業員記録が表示されます。</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0">費用...<br><br>検索クレジットは１クレジット400円です。検索結果がゼロの場合はクレジットは引かれません。<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp.... 100%リスクフリーです<br></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>

    <div class="business-cta-2x">
        <div class="business-cta-2-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="business-cta-left-2">
                            <h2>飛躍的な進歩 ...</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="business-cta-right-2">
                            <a href="{{route('register')}}" class=" btn bussiness-btn-larg">今すぐアップグレード</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>

@endsection
