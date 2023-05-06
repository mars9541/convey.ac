@extends('layouts.frontend-master')
@section('content')
<div class="padding-top-large"></div>

<div class="bussiness-component-title">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="business-title-middle">
                    <h2>すぐに実感できるメリット</h2>
                    <span class="title-border-middle"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="padding-top-large"></div>

<div class="bussiness-dropcaps">
    <div class="container">
        <div class="row">
            <div class="col-md-6 dropcaps">
                <p><strong>古いシステム</strong>これまでの古い形式は従業員記録が持ち得る本来の長所を出しきれていません。 <br><br> 従業員の業績や情報が当時働いていた企業内のみで留められてしまうこれまでのシステムは、ある意味もったいないと言えるでしょう。 <br><br> この古いシステムのもつ不利な点に気づき、Conveyable Employment Records（CER 運搬可能な従業員記録）にアップグレードする企業が増えてきています。</p>
            </div>
            <div class="col-md-6 dropcaps">
                <p><strong>新しいシステム</strong>CERはただの形式のみの従業員記録ではなく、実際に企業、そして従業員本人の成長に役立つことがたくさんあります。<br><br>CERで従業員の記録作成のプロセスを完了させると、その記録はconveyable（運搬・移動可能）になります。従業員は転職する際に、自ら自分の記録を他企業あるいは次の雇用先に送る事ができます。<br><br> CERは従業員の自社での経験や業績も記録します。つまり、どのような職務経歴や業績の記録を将来に残したいかは従業員本人の現在の努力やパフォーマンス次第なのです。</p>
            </div>
        </div>
    </div>
</div>
<div class="padding-top-large"></div>


<div class="business-features-3x">
    <div class="colourful-features-content">
        <div class="row">
            <div class="col-md-3 no-padding">
                <div class="single-colorful-feature feature-color-1">
                    <h3>01.</h3>
                    <h2>編集不可能</h2>
                    <p>CERは編集不可能です。これはより正しいデータを残していくためです。</p>
                </div>
            </div>
            <div class="col-md-3 no-padding">
                <div class="single-colorful-feature feature-color-2">
                    <h3>02.</h3>
                    <h2>明白なコミュニケーション</h2>
                    <p>CERの記録は関係者全員、従業員本人、現在の雇用者、そして許可を得た将来の雇用者が見る事ができます。</p>
                </div>
            </div>
            <div class="col-md-3 no-padding">
                <div class="single-colorful-feature feature-color-3">
                    <h3>03.</h3>
                    <h2>従業員の全体像を把握</h2>
                    <p>CERは従業員の業績や企業への貢献はもちろん、改善指導、あるいは注意等の問題点なども記録されます。</p>
                </div>
            </div>
            <div class="col-md-3 no-padding">
                <div class="single-colorful-feature feature-color-4">
                    <h3>04.</h3>
                    <h2>積み重ねが可能</h2>
                    <p>新しい雇用者は従業員の以前の会社で作られたCERを受け取り、そこから新しい情報を積み重ねていく事ができます。</p>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="padding-top-large"></div>

<div class="business-app-present-2x">
    <div class="app-present-content-2">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>ゼロコストの利点 ... </h2>
                        <span class="title-border-middle"></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="margin-top-middle"></div>
                </div>

                <div class="col-md-7">
                    <div class="app-present-left-2">
                        <img src="{{asset('landing_front')}}/images/jp/ipad.png" alt="Mountains" class="">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="app-present-right-2">
                        <div class="single-app-present">
                            <div class="media">
                                <span class="animatedhover pulse">
{{--                                    <i class="fa fa-phone"></i>--}}
                                    <img src="{{asset('landing_front')}}/images/New folder/4.1.png" width="30px" alt="higher engagement">
                                </span>
                                <div class="media-body">
                                    <h2>より高い貢献意欲</h2>
                                    <p>より前向きな努力と仕事への貢献を従業員から期待する事ができるでしょう。</p>
                                </div>
                            </div>
                        </div>
                        <div class="single-app-present">
                            <div class="media">
                                <span class="animatedhover pulse">
{{--                                    <i class="fa fa-podcast"></i>--}}
                                    <img src="{{asset('landing_front')}}/images/New folder/4.2.png" width="30px" alt="Improved Productivity">
                                </span>
                                <div class="media-body">
                                    <h2>より高い生産性</h2>
                                    <p>より高い生産性を従業員から期待する事ができるでしょう。</p>
                                </div>
                            </div>
                        </div>
                        <div class="single-app-present">
                            <div class="media">
                                <span class="animatedhover pulse">
{{--                                    <i class="fa fa-user"></i>--}}
                                    <img src="{{asset('landing_front')}}/images/New folder/4.3.png" width="30px" alt="Reduced Costs">
                                </span>
                                <div class="media-body">
                                    <h2>コスト削減</h2>
                                    <p>ゼロコスト」のインセンティブで、エンゲージメントの高い従業員の反応が良くなることを期待する。</p>
                                </div>
                            </div>
                        </div>
                        <div class="single-app-present">
                            <div class="media">
                                <span class="animatedhover pulse">
{{--                                    <i class="fa fa-bus"></i>--}}
                                    <img src="{{asset('landing_front')}}/images/New folder/4.4.png" width="30px" alt="Fewer Sick">
                                </span>
                                <div class="media-body">
                                    <h2>病欠日の削減</h2>
                                    <p>従業員の病欠日は減り、より良い出社率が期待できます。</p>
                                </div>
                            </div>
                        </div>
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
                        <img src="{{asset('landing_front')}}/images/jp/design4.png" alt="Mountains" class="">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="app-present-right">
                        <h3>簡単にCERを作成...</h3>
                        <h2>従業員記録</h2>
                        <p>現在従業員記録のシステムがない場合は、「ダイレクトコネクト」のモジュールが使えます。 <br><br>CONVEYアカウントには「ダイレクトコネクト」のモジュールがついてきます。ダイレクトコネクトを使えばすぐにCER記録を作成し始める事が出来ます。作成する記録と付け足す従業員の数に制限はありません。<br><br>
                    </div>
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
                        <h5 style="font-size: 40px;">承認済みプロバイダーネットワーク</h5>
                        <span class="title-border-left"></span>
                        <p>いま他の従業員記録システムを使用している場合は現在のプロバイダーがCER可能（運搬可能）に変えてくれます。<br><br>

                            多くの企業にとって、CER記録の導入は大変大きな変化だと思われます。様々な従業員管理システム（HRIS, ATS, VMS プロバイダー等）が現在CONVEYデータバンクとの接続を実行中です。 <br><br>現在のプロバイダーが承認済みであれば、今までと同じようにシステムを使用し続けて構いません。自動的にCER可能（運搬可能）になります。 </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="about-business-right-2x">
                        <img class="img-responsive" src="{{asset('landing_front')}}/images/jp/supplier.png" alt="sample image">
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
                        <img src="{{asset('landing_front')}}/images/introduct-design3.png" alt="Mountains" class="">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="app-present-right">
                        <h3>各チーム・支店の意見を尊重するために・・・</h3>
                        <h2>「ブランチマネージャー」で各支店ごとのアカウントを作成</h2>
                        <p>CONVEYには大きさに関わらず様々な企業をサポートする便利なフィーチャーが備えられています。「ブランチマネージャー」がそのひとつです。<br><br> 複数の支店がある企業は各支店ごとのアカウント作成が可能です。数に制限はありません。各支店アカウント内での検索、報告機能が可能です。支店アカウントはメインアカウントで中央管理されています。<br><br>
                    </div>
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
                        <h5 style="font-size: 40px;">従業員記録を安全に保護.</h5>
                        <span class="title-border-left"></span>
                        <p>CER記録はCONVEYデータバンクに安全に保管されています。中立的に配置されたリソースを使用します。アクセス権利のある従業員、雇用者そして第三者認証プロバイダーのみのアクセスが可能です。企業の大きさに関わらずCONVEYデータバンクを使用して機密性の高い従業員記録に安全にアクセスそして保存することが可能になります。<br><br>それぞれの国に応じたデータの構成でCONVEYデータバンクは国内、海外のプライバシー保護条件に準拠可能です。</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="about-business-right-2x">
                        <img class="img-responsive" src="{{asset('landing_front')}}/images/map.jpeg" alt="sample image">
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
