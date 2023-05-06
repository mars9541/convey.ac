@extends('layouts.frontend-master')
@section('content')
    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>ブランドについてのガイドライン</h2>
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

    <div class="about-business-2x">
        <div class="container">
            <div class="about-business-content-2x">
                <div class="row">
                    <div class="col-md-8">
                        <div class="about-business-left-2x">
                            <h5><br><br>基本的な要件.</h5>
                            <span class="title-border-left"></span>
                            <p> ここで示すガイドラインにしたがうことにより、私達のロゴを使用することが出来、またその許可が得られます。ガイドラインにしたがっている限り、ロゴを使用するための許可等を得る必要はありません。</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/basiclogo.png" alt="sample image">
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
                            <h5><br><br>ロゴの外観.</h5>
                            <span class="title-border-left"></span>
                            <p>ロゴ使用の際はなるべくフルカラーでお願いしています。一色のみ使用の際は、こちらの例にそってお願いします。ロゴのダウンロードはこちらです：
                                <br><br>&nbsp&nbsp&nbsp&nbsp<a href="{{url('frontend_downloadable_file/convey_colour_logo')}}" class="color-black-light downloadable-tag">カラーロゴ</a>&nbsp&nbsp|&nbsp&nbsp <a href="{{url('frontend_downloadable_file/convey_black_logo')}}" class="color-black-light downloadable-tag">白地に黒のロゴ</a>&nbsp&nbsp|&nbsp&nbsp <a href="{{url('frontend_downloadable_file/convey_white_logo')}}" class="color-black-light downloadable-tag">黒地に白のロゴ</a>
                            </p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/appearance.png" alt="sample image">
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
                            <h5><br>間隔</h5>
                            <span class="title-border-left"></span>
                            <p>ロゴが正確に見えるように、こちらのスペースガイダンスを参考にしてください。ガイダンスにしたがって間隔をとり、ロゴが妨げられたりすることを防ぎ、イメージがより正確に映ります。</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/spacing.png" alt="sample image">
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
                            <h5><br><br>不正確な使用法.</h5>
                            <span class="title-border-left"></span>
                            <p>私達のブランドを尊重するロゴの使い方をお願いしています。こちらの例のような使用法はご遠慮ください。 </p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/unacceptable.png" alt="sample image">
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
                            <h5><br><br>色.</h5>
                            <span class="title-border-left"></span>
                            <p>私達のロゴは白のバックグラウンドの上に２色の色、という構成で出来ています。カラーのバックグラウンドを使用する場合は、こちらに挙げる色のみの使用をお願いします。</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/colours.png" alt="sample image">
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
