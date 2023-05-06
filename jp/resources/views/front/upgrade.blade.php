@extends('layouts.frontend-master')
@section('content')
    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>３つのアップグレード方法<h2>
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
                            <h5>1. 「ダイレクトコネクト」を使用</h5>
                            <span class="title-border-left"></span>
                            <p> CER記録にアップグレードするための一番簡単な方法がこれです。アカウントにログインして、「ダイレクトコネクト」モジュールを使用して新規の記録を作成します。たくさんの小企業、そして今まで従業員管理のシステムがなかった企業もこの方法を使用しています。<br><br> ダイレクトコネクトモジュールは無料で利用出来ます。足す従業員、記録の数に制限はありませんので、大きさに関わらず様々な企業が利用出来ます。</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/jp/CONTROLPANEL.png" alt="sample image">
                        </div>
                    </div>
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
                            <h5>2. 承認されたプロバイダーを利用</h5>
                            <span class="title-border-left"></span>
                            <p>ダイレクトコネクトよりもよりたくさんのフィーチャーが必要な場合は、承認されたパートナープロバイダーとアカウントを作成することもできます。もしも現在すでにこのパートナープロバイダーで従業員記録を作成している場合は、CONVEYとの接続がすでに行われ、記録が自動的にCONVEYデータバンクに同期されているはずです。<br><br>様々なワークフォースマネージメント、従業員管理、人事管理システム(HRIS)、採用管理システム(ATS)、ベンダー管理システム(VMS)などを提供するプロバイダーが現在CONVEYとの接続を行っています。もしも現在すでにこの承認されたパートナープロバイダーのアカウントをお持ちであれば、CONVEYデータバンクに簡単にアクセスが可能です。</p>
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

    <div class="about-business-2x">
        <div class="container">
            <div class="about-business-content-2x">
                <div class="row">
                    <div class="col-md-8">
                        <div class="about-business-left-2x">
                            <h5>3. カスタムAPIの使用</h5>
                            <span class="title-border-left"></span>
                            <p>カスタムソフトウェアを使用する大企業の場合はCONVEY APIを使用しカスタム接続が可能です。APIは標準化されたプログラムインターフェイスを通してCONVEYデータベースに接続します。CONVEY APIはHTTPsリクエストとJSONレスポンスを使用した RESTful APIです。 <br><br>現在企業が使用しているシステムの知識のあるIT開発者なら２−５日間でこのプロセスを完了できるはずです。<br><br>
                                このプロセスに関する詳しい情報は、アカウントにログインしてください。</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/jp/api2.png" alt="sample image">
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
