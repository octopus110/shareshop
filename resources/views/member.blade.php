@extends('common')
@section('css')
    <link rel="stylesheet" href="/css/member.css">
@endsection
@section('content')
    <section class="member-info">
        <div class="left">
            <img src="/images/tmp/5.png" alt="">
        </div>
        <div class="left">
            <p>小章鱼儿</p>

            <p>下午好</p>
        </div>
        <div class="clear"></div>
    </section>

    <section class="member-item">
        <table>
            <tr>
                <td>
                    <a href="/cart">
                        <h6><i class="iconfont icon-gouwuche"></i></h6>

                        <p>购物车(<span>5</span>)</p>
                    </a>
                </td>
                <td>
                    <a href="/transaction">
                        <h6><i class="iconfont icon-icon08"></i></h6>

                        <p>交易记录</p>
                    </a>
                </td>
                <td>
                    <h6><i class="iconfont icon-daiqianshou"></i></h6>

                    <p>待签收(<span>2</span>)</p>
                </td>
            </tr>
            <tr>
                <td>
                    <h6><i class="iconfont icon-tixian"></i></h6>

                    <p>提现</p>
                </td>
                <td>
                    <h6><i class="iconfont icon-yuecopy"></i></h6>

                    <p>我的余额(<span>￥50000</span>)</p>
                </td>
                <td>
                    <a href="/address">
                        <h6><i class="iconfont icon-shouhuodizhi"></i></h6>

                        <p>收货地址</p>
                    </a>
                </td>
            </tr>
        </table>
    </section>

    <section class="logistics">
        <h2>物流信息</h2>

        <h3>商品名称 <span>圆通快递</span></h3>
        <ul>
            <li>
                2017-2-13 5:30 从仓库发出
            </li>
            <li>
                2017-2-14 15:30 到达上海分中心
            </li>
        </ul>
    </section>
@endsection
@section('js')
@endsection