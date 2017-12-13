@extends('common')
@section('css')
    <link rel="stylesheet" href="/css/member.css">
@endsection
@section('content')
    <section class="member-info">
        <div class="left">
            <img src="{{ $member['head']?$member['head']:'/images/tmp/5.png' }}" alt="">
        </div>
        <div class="left">
            <p>{{ $member['nickname'] }}</p>

            <p>{{ $member['type']==1?'个体商':'普通会员' }}</p>
        </div>
        <div class="clear"></div>
    </section>

    <section class="member-item">
        <table>
            <tr>
                <td>
                    <a href="/cart">
                        <h6><i class="iconfont icon-icon1"></i></h6>

                        <p>购物车(<span>{{ $carts }}</span>)</p>
                    </a>
                </td>
                <td>
                    <h6><i class="iconfont icon-weibiaoti2fuzhi04"></i></h6>

                    <p>待付款(<span>{{ $pay }}</span>)</p>
                </td>
                <td>
                    <h6><i class="iconfont icon-daifahuo1"></i></h6>

                    <p>代发货(<span>{{ $send }}</span>)</p>
                </td>
                <td>
                    <h6><i class="iconfont icon-daiqianshou"></i></h6>

                    <p>待签收(<span>{{ $submit }}</span>)</p>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="/transaction">
                        <h6><i class="iconfont icon-jiaoyijilu"></i></h6>

                        <p>交易记录</p>
                    </a>
                </td>
                <td>
                    <h6><i class="iconfont icon-yuecopy"></i></h6>

                    <p>我的余额(<span>￥{{ $member['earnings'] }}</span>)</p>
                </td>
                <td>
                    <h6><i class="iconfont icon-tixian"></i></h6>

                    <p>提现(<span>{{ $member['getearnings'] }}</span>)</p>
                </td>
                <td>
                    <a href="/address">
                        <h6><i class="iconfont icon-shouhuodizhi1"></i></h6>

                        <p>收货地址</p>
                    </a>
                </td>
            </tr>
            <tr>

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