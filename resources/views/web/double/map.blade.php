@extends('layouts.app')
@section('style')
    <link href="/assets/css/ball.css" rel="stylesheet"  />
@stop
@section('content')
    <div class="double ">
        <table>
            <tr>
                <td>期号</td>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
                <td>8</td>
                <td>9</td>
                <td>10</td>
                <td>11</td>
                <td>12</td>
                <td>13</td>
                <td>14</td>
                <td>15</td>
                <td>16</td>
                <td>17</td>
                <td>18</td>
                <td>19</td>
                <td>20</td>
                <td>21</td>
                <td>22</td>
                <td>23</td>
                <td>24</td>
                <td>25</td>
                <td>26</td>
                <td>27</td>
                <td>28</td>
                <td>29</td>
                <td>30</td>
                <td>31</td>
                <td>32</td>
                <td>33</td>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
                <td>8</td>
                <td>9</td>
                <td>10</td>
                <td>11</td>
                <td>12</td>
                <td>13</td>
                <td>14</td>
                <td>15</td>
                <td>16</td>
                <td >奇偶</td>
                <td >和值</td>
                <td >同号</td>
                <td >同号值</td>
                <td >连号</td>
                <td >连号值</td>
                <td >同尾</td>
                <td >同尾值</td>
                <td >三区比</td>
                <td >AC值</td>
                <td >跨距</td>
            </tr>
            <tbody>
            @foreach($list->sort() as $key=>$val)
                @php
                    $i=1;
                @endphp
                <tr>
                    <td class="number">{{$val->number}}</td>
                    @foreach($red as $k=>$v)
                        @if($v==$val['r'.$i])
                            <td class="red">{{$val['r'.$i]}}</td>
                            @php
                                $i++
                            @endphp
                        @else
                            <td></td>
                        @endif
                    @endforeach

                    @foreach($blue as $b=>$bs)
                        @if($bs==$val['blue'])
                            <td class="blue">{{$val['blue']}}</td>
                        @else
                            <td></td>
                        @endif
                    @endforeach
                    <td>{{$val->odd}}:{{6-$val->odd}}</td>
                    <td >{{$val->sum}}</td>
                    <td >{{$val->equal_val}}</td>
                    <td >{{$val->equal}}</td>
                    <td >{{$val->to_be}}</td>
                    <td >{{$val->to_be_val}}</td>
                    <td >{{$val->same_tail}}</td>
                    <td >{{$val->same_tail_val}}</td>
                    <td>{{$val->interval}}</td>
                    <td >{{$val->ac}}</td>
                    <td >{{$val->skip}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@endsection