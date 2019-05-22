<?php


namespace App\Http\Controllers\Pc;


use App\Models\DbModels;

class DoubleBallController extends PcController{

    public function index(){

        $list = DbModels::getTake('double_ball' , 50);

        return view('web.double.index',[
            'list'=>$list
        ]);
    }

    public function list(){
        $list = DbModels::getTake('double_ball' , 50);
        $red = range(1,33 );
        $blue = range(1, 16);

        $red_count = self::redBall($list);
        $blue_count = self::blueBall($list);

        return view('web.double.list',[
            'list'=>$list,
            'red'=>$red,
            'blue'=>$blue,
            'red_count'=>$red_count,
            'blue_count'=>$blue_count
        ]);
    }
    public function week($week){

        $red = range(1,33 );
        $blue = range(1, 16);
        if($week == 'odd'){
            $list = \DB::select('select * from `double_ball` where number%2 = 1 order by `id` desc limit 50');
            array_multisort(array_column($list,'number'),SORT_ASC,$list);
            $red_count = self::redBallSpace($list);
            $blue_count = self::blueBallSpace($list);
            return view('web.double.odd',[
                'list'=>$list,
                'red'=>$red,
                'blue'=>$blue,
                'red_count'=>$red_count,
                'blue_count'=>$blue_count
            ]);
        }else if($week == 'even'){
            $list = \DB::select('select * from `double_ball` where number%2 = 0 order by `id` desc limit 50');
            array_multisort(array_column($list,'number'),SORT_ASC,$list);
            $red_count = self::redBallSpace($list);
            $blue_count = self::blueBallSpace($list);

//            dd($list);


            return view('web.double.odd',[
                'list'=>$list,
                'red'=>$red,
                'blue'=>$blue,
                'red_count'=>$red_count,
                'blue_count'=>$blue_count
            ]);
        }else{
            $list = DbModels::getTakeWhere('double_ball' , ['week'=>$week],50);
        }

        $red_count = self::redBall($list);
        $blue_count = self::blueBall($list);
        return view('web.double.list',[
            'list'=>$list,
            'red'=>$red,
            'blue'=>$blue,
            'red_count'=>$red_count,
            'blue_count'=>$blue_count
        ]);
    }
    public function doubleMap(){

        $list = DbModels::getTake('double_ball' , 50);
        $red = range(1,33 );
        $blue = range(1, 16);


        return view('web.double.map' , [
            'list'=>$list,
            'red'=>$red,
            'blue'=>$blue,
        ]);
    }



    static public function redBall($data){

        $red = range(1,33 );
        $count['r1'] = 0;$count['r2'] = 0;$count['r3'] = 0;
        $count['r4'] = 0;$count['r5'] = 0;$count['r6']  = 0;
        $count['r7'] = 0;$count['r8'] = 0;$count['r9'] = 0;
        $count['r10'] = 0;$count['r11'] = 0;$count['r12'] = 0;
        $count['r13'] = 0;$count['r14'] = 0;$count['r15'] = 0;
        $count['r16'] = 0;$count['r17'] = 0;$count['r18'] = 0;
        $count['r19'] = 0;$count['r20'] = 0;$count['r21'] = 0;
        $count['r22'] = 0;$count['r23'] = 0;$count['r24'] = 0;
        $count['r25'] = 0;$count['r26'] = 0;$count['r27'] = 0;
        $count['r28'] = 0;$count['r29'] = 0;$count['r30'] = 0;
        $count['r31'] = 0;$count['r32'] = 0;$count['r33'] = 0;

        foreach($data as $key=>$val){
            $i=1;
            foreach($red as $k=>$v){

                if($v==$val['r'.$i]){
                    $count['r'.$v]++ ;
                    $i++ ;
                }
            }
       }
        return $count;
    }

    static public function blueBall($data){

        $blue = range(1,16 );
        $count['b1'] = 0;$count['b2'] = 0;$count['b3'] = 0;$count['b4'] = 0;
        $count['b5'] = 0;$count['b6']  = 0;$count['b7'] = 0;$count['b8'] = 0;
        $count['b9'] = 0;$count['b10'] = 0;$count['b11'] = 0;$count['b12'] = 0;
        $count['b13'] = 0;$count['b14'] = 0;$count['b15'] = 0;$count['b16'] = 0;

        foreach($data as $key=>$val){

            foreach($blue as $k=>$v){

                if($v == $val['blue']){
                    $count['b'.$v]++ ;
                }
            }
        }
        return $count;
    }

    static public function redBallSpace($data){



        $red = range(1,33 );
        $count['r1'] = 0;$count['r2'] = 0;$count['r3'] = 0;
        $count['r4'] = 0;$count['r5'] = 0;$count['r6']  = 0;
        $count['r7'] = 0;$count['r8'] = 0;$count['r9'] = 0;
        $count['r10'] = 0;$count['r11'] = 0;$count['r12'] = 0;
        $count['r13'] = 0;$count['r14'] = 0;$count['r15'] = 0;
        $count['r16'] = 0;$count['r17'] = 0;$count['r18'] = 0;
        $count['r19'] = 0;$count['r20'] = 0;$count['r21'] = 0;
        $count['r22'] = 0;$count['r23'] = 0;$count['r24'] = 0;
        $count['r25'] = 0;$count['r26'] = 0;$count['r27'] = 0;
        $count['r28'] = 0;$count['r29'] = 0;$count['r30'] = 0;
        $count['r31'] = 0;$count['r32'] = 0;$count['r33'] = 0;

        foreach($data as $key=>$val){

            foreach($red as $k=>$v){

                if($v == $val->r1){
                    $count['r'.$v]++;
                }else if($v == $val->r2){
                    $count['r'.$v]++;
                }else if($v == $val->r3){
                    $count['r'.$v]++;
                }else if($v == $val->r4){
                    $count['r'.$v]++;
                }else if($v == $val->r5){
                    $count['r'.$v]++;
                }else if($v == $val->r6){
                    $count['r'.$v]++;
                }
            }
        }
        return $count;
    }

    static public function blueBallSpace($data){

        $blue = range(1,16 );
        $count['b1'] = 0;$count['b2'] = 0;$count['b3'] = 0;$count['b4'] = 0;
        $count['b5'] = 0;$count['b6']  = 0;$count['b7'] = 0;$count['b8'] = 0;
        $count['b9'] = 0;$count['b10'] = 0;$count['b11'] = 0;$count['b12'] = 0;
        $count['b13'] = 0;$count['b14'] = 0;$count['b15'] = 0;$count['b16'] = 0;

        foreach($data as $key=>$val){

            foreach($blue as $k=>$v){

                if($v == $val->blue){
                    $count['b'.$v]++ ;
                }
            }
        }
        return $count;
    }


}