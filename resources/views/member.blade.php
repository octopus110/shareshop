@extends('common')
@section('css')
    <link rel="stylesheet" href="/css/member.css">
    <style>
        .right i{
            display: block;
            width: 100%;
            text-align: center;
            color: orangered;
        }
    </style>
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
        <div class="right">
            <a href="/improve">
                <i>个人信息</i>
                <i class="iconfont icon-gerenxinxi"></i>
            </a>
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
                    <a href="/obligation/0">
                        <h6><i class="iconfont icon-weibiaoti2fuzhi04"></i></h6>

                        <p>待付款(<span>{{ $pay }}</span>)</p>
                    </a>
                </td>
                <td>
                    <a href="/obligation/1">
                        <h6><i class="iconfont icon-daifahuo1"></i></h6>

                        <p>待发货(<span>{{ $send }}</span>)</p>
                    </a>
                </td>
                <td>
                    <a href="/obligation/2">
                        <h6><i class="iconfont icon-daiqianshou"></i></h6>

                        <p>待签收(<span>{{ $submit }}</span>)</p>
                    </a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="/transaction">
                        <h6><i class="iconfont icon-fenxiang"></i></h6>

                        <p>获得红包</p>
                    </a>
                </td>
                <td>
                    <h6><i class="iconfont icon-hongbao"></i></h6>

                    <p>我的红包(<span>￥{{ $member['earnings'] }}</span>)</p>
                </td>
                <td>
                    <a href="/packet">
                        <h6><i class="iconfont icon-fafanghongbao-"></i></h6>

                        <p>红包提现(<span>{{ $member['getearnings'] }}</span>)</p>
                    </a>
                </td>
                <td>
                    <a href="/address/0">
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
        @if(count($express))
            @foreach($express as $k => $item)
                <h3>{{ $express_sub[$k]['commodity_name'] }} : <br>
                    <span>{{ $express_sub[$k]['express_name'] }}({{ $item['nu'] }})</span></h3>
                <ul>
                    @foreach($item['data'] as $item_sub)
                        <li>
                            {{ $item_sub['time'] }} : <br/>
                            &nbsp;&nbsp;&nbsp;{{ $item_sub['context'] }}
                        </li>
                    @endforeach
                </ul>
            @endforeach
        @else
            <h3>暂无物流</h3>
        @endif
    </section>
@endsection
@section('js')
@endsection