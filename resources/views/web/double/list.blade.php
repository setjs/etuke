@extends('layouts.app')
@section('style')
    <link href="/assets/css/ball.css" rel="stylesheet"  />
@stop
@section('content')
    <div class="ball">
        <table  cellspacing="1" cellpadding="0" bgcolor="#FFFFFF">
            <thead>
            <tr class="tdw">
                <td rowspan="2">期号</td>
                <td colspan="33">红 色 球</td>
                <td colspan="16">蓝 色 球</td>
            </tr>
            <tr class="tdw">
                <td >1</td>
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
                <td >23</td>
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
                <td>01</td>
                <td>02</td>
                <td>03</td>
                <td>04</td>
                <td>05</td>
                <td>06</td>
                <td>07</td>
                <td>08</td>
                <td>09</td>
                <td>10</td>
                <td>11</td>
                <td>12</td>
                <td>13</td>
                <td>14</td>
                <td>15</td>
                <td>16</td>
            </tr>
            </thead>
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
            </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr id="select-1">
                <td>期号</td>
                <td >01</td>
                <td>02</td>
                <td>03</td>
                <td>04</td>
                <td>05</td>
                <td>06</td>
                <td>07</td>
                <td>08</td>
                <td>09</td>
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
                <td>01</td>
                <td>02</td>
                <td>03</td>
                <td>04</td>
                <td>05</td>
                <td>06</td>
                <td>07</td>
                <td>08</td>
                <td>09</td>
                <td>10</td>
                <td>11</td>
                <td>12</td>
                <td>13</td>
                <td>14</td>
                <td>15</td>
                <td>16</td>
                </tr>
                <tr id="select-2">
                    <td >期号</td>
                    <td >01</td>
                    <td>02</td>
                    <td>03</td>
                    <td>04</td>
                    <td>05</td>
                    <td>06</td>
                    <td>07</td>
                    <td>08</td>
                    <td>09</td>
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
                    <td>01</td>
                    <td>02</td>
                    <td>03</td>
                    <td>04</td>
                    <td>05</td>
                    <td>06</td>
                    <td>07</td>
                    <td>08</td>
                    <td>09</td>
                    <td>10</td>
                    <td>11</td>
                    <td>12</td>
                    <td>13</td>
                    <td>14</td>
                    <td>15</td>
                    <td>16</td>
                </tr>
                <tr class="tdd">
                    <td>共50期</td>
                    @foreach(range(1,33) as $key=>$red)
                        <td  >{{$red_count['r'.$red]}}<img  src="/assets/images/ball/bar.gif"  height="{{$red_count['r'.$red]*10}}"></td>
                    @endforeach

                    @foreach(range(1,16) as $key=>$blue)
                        <td  >{{$blue_count['b'.$blue]}}<img  src="/assets/images/ball/bar.gif"  height="{{$blue_count['b'.$blue]*10}}"></td>
                    @endforeach
                </tr>
                <tr class="tdw">
                    <td>期号</td>
                    <td >1</td>
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
                    <td >12</td>
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
                    <td >23</td>
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
                    <td >1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>5</td>
                    <td>6</td>
                    <td>7</td>
                    <td>8</td>
                    <td >9</td>
                    <td>10</td>
                    <td>11</td>
                    <td>12</td>
                    <td>13</td>
                    <td>14</td>
                    <td>15</td>
                    <td >16</td>
                </tr>
                <tr class="tdw">
                    <td colspan="33">红 色 球</td>
                    <td colspan="16">蓝 色 球</td>
                </tr>
            </tfoot>


        </table>
    </div>
@endsection

@section('js')
    <script>
        $('#select-1>td , #select-2 >td').click(function(){
          var index = $(this).index();

          if(index < 34){
            if($(this).hasClass('red')){
              $(this).removeClass('red')
            }else {
              $(this).addClass('red')
            }
          }else{
            if($(this).hasClass('blue')){
              $(this).removeClass('blue')
            }else {
              $(this).addClass('blue')
            }
          }
        })
    </script>
@stop