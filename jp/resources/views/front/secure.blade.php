@extends('layouts.frontend-master')
@section('content')
    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>データの保護</h2>
                        <span class="title-border-middle"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="bussiness-highlight-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>CER記録はCONVEYデータバンクに安全に保管されています。CONVEYプラットフォーム内に中立的に配置されたリソースを使用します。CONVEYプラットフォームは「データ保護byデザインbyデフォルト」の概念を元に作られました。データ主体の権利の保護を確保するためにデータ処理のシステムを設定します。これはGDPR（EUデータ保護規則）第25条に明記され、EUデータ保護規則の遵守を確保するため行うべき技術的・組織的措置が定められています。プラットフォームは暗号化されたデータをTransport Layer Security (TLS)で送信し、送信中のデータの漏洩を防ぎます。また、データ管理者に課される義務には、初期設定によって必要な個人データのみが処理される適切な技術的・組織的措置を講じなければならない、個人の介入がなければ不特定多数の人間が個人データにアクセスできないことを確保、個人からのリクエストがあればその個人のデータを削除しなければならない等があります。</p>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>

    <div class="about-business-2x">
        <div class="container">
            <div class="about-business-content-2x">
                <div class="row">
                    <div class="col-md-8">
                        <div class="about-business-left-2x">
                            <h5>安全なデータの保管</h5>
                            <span class="title-border-left"></span>
                            <p>CONVEYは ISO27001:2013認証を取得しています。このデータセンターは24時間のセキュリティー、CCTVカメラ、訪問者のIDカード使用等で保護されています。CONVEYプラットフォームのハードウェアは冗長電源を使用しシステムの信頼性を高めます。<br>
                                <br>CONVEYのインフラストラクチャーは1TbpsのDDoS攻撃防御システムを使用しています。DDoS攻撃はサービスの遅延、停止を狙いますが、この防御システムでたとえ攻撃にあったとしてもCONVEYのプラットフォームは通常通りにデータ処理を続けることが出来ます。</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/jp/sec.png" alt="sample image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>
    <div class="business-feature-1x">
        <div class="container">
            <div class="business-features">
                <div class="row">
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <img class="mr-3" src="{{asset('landing_front')}}/images/icon/leader.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">Eメールのセキュリティ<br><br> CONVEYのプラットフォームを通して送受信されるすべてのEメールは三つのレイヤーのアンチウイルス、アンチスパムでスキャンされます。<br><br></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <img class="mr-3" src="{{asset('landing_front')}}/images/icon/world-map.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">サイバー攻撃.<br><br> CONVEYの Web Application FirewallはすべてのHTTPリクエストを検査し、SQLインジェクション、トロイの木馬、クロスサイトスクリプティング、path traversalなどを検知します。</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <img class="mr-3" src="{{asset('landing_front')}}/images/icon/money.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">データのバックアップ.<br><br> CONVEYのプラットフォームは定期的に自動バックアップします。スナップショットも作成されシステムは復元可能です。<br></h5>
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
