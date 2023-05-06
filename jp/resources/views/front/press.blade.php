@extends('layouts.frontend-master')
@section('content')
    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>プレス・メディア</h2>
                        <span class="title-border-middle"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>

    <div class="bussiness-tab-accordion">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">について</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">背景</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">お問い合わせ先</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="About-tab">
                            <div class="padding-top-middle"></div>
                            <p>コンベアブル・エンプロイメント・レコードは、雇用主が変わっても、従業員が自分の仕事の成果の履歴を保持できるように、雇用主から次の雇用主へ転送するデジタル・ファイルです。
<br><br>
                                すべての伝達可能な記録は、従業員、雇用者、第三者認定プロバイダーが許可制でアクセスできる中立的な位置にある集中リソースであるCONVEYデータバンクに安全に保存されます。この中立性の高さにより、大企業から中小企業まで、従業員の記録を保存しアクセスするためにCONVEYデータバンクへの安全な接続を確立することができます。</p>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="Background-tab">
                            <div class="padding-top-middle"></div>
                            <p>CONVEYは、2019年にClive Lambertによって設立されました。彼は、雇用記録に含まれる大量の情報が、その保存方法によってその可能性を十分に活用されていないことに気付きました。
<br><br>
                                CONVEYはスタンドアローン製品として動作しますが、自社のビジネス用途にもたらしたい伝達性のメリットを認識している多くの人事/採用ソフトウェアプロバイダと統合することも可能です。</p>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="padding-top-middle"></div>
                            <p> 報道関係のお問い合わせは、こちらまでお願いします。: <br><br> press@convey.ac</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="business-faq">

                        <div class="panel-group" id="accordion" role="tablist">

                            <div class="card single-faq">
                                <div class="card-header" role="tab" id="headingOne">
                                    <h5 class="mb-0">
                                        <a class="accordion-toggle" data-toggle="collapse" href="#collapseOne" role="button" aria-expanded="true" aria-controls="collapseOne">
                                            ロゴファイルのダウンロード
                                        </a>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        ロゴはこちらからダウンロードしてください。ウェブサイトのフッターにあるブランドページでは、ブランドガイドラインに沿ったロゴの使用方法について説明しています。
                                        <br><br>
                                        <a href="{{url('frontend_downloadable_file/press_logo')}}" class="color-black-light downloadable-tag">ロゴのダウンロード<i class="fa fa-download m-lg-1"></i></a>
                                    </div>
                                </div>
                            </div>


                            <div class="card single-faq">
                                <div class="card-header" role="tab" id="headingTwo">
                                    <h5 class="mb-0">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapseTwo" role="button" aria-expanded="false" aria-controls="collapseTwo">
                                            スクリーンショットのダウンロード
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">
                                        当社ウェブサイトのスクリーンショットはこちらからダウンロードしてください。
                                        <br><br>
                                        <a href="{{url('frontend_downloadable_file/press_screen_shot')}}" class="color-black-light downloadable-tag">ダウンロード画像<i class="fa fa-download m-lg-1"></i></a>
                                    </div>
                                </div>
                            </div>


                            <div class="card single-faq">
                                <div class="card-header" role="tab" id="headingThree">
                                    <h5 class="mb-0">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapseThree" role="button" aria-expanded="false" aria-controls="collapseThree">
                                            記事ヘッダー画像ダウンロード
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="card-body">
                                        記事のヘッダー画像はこちらからダウンロードしてください。
                                        <br><br>
                                        <a href="{{url('frontend_downloadable_file/press_header_images')}}" class="color-black-light downloadable-tag">ダウンロード画像<i class="fa fa-download m-lg-1"></i></a>
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
