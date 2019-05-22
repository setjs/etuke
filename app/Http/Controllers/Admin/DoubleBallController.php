<?php


namespace App\Http\Controllers\Admin;


use App\Models\DbModels;
use Illuminate\Http\Request;

class DoubleBallController extends  Controller{

    public function index(){

//        $books = Book::latest()->paginate($request->input('page_size', 10));
        $list = DbModels::selectData('double_ball');
        return view('admin.double.index', compact('list'),[
            'pitch'=>'double'
        ]);
    }


    public function created(){

        return view('admin.double.create',[
            'pitch'=>'double'
        ]);
    }

    public function store(Request $request ){

        if($request->isMethod('post') && $request->ajax()){

            $item = $request->all();
            $ball = explode(' ' , $item['ball']);

            $data['number']=$item['number'];

            $data['date']=$item['date'];
            $data['r1']=$ball[0];
            $data['r2']=$ball[1];
            $data['r3']=$ball[2];
            $data['r4']=$ball[3];
            $data['r5']=$ball[4];
            $data['r6']=$ball[5];
            $data['blue']=$item['blue'];
            $data['week']=self::getWeek($item['date']);
            $data['odd']=self::getOdd($ball);
            $data['sum']=self::getSum($ball);

            $data['equal']=$item['equal'];

            $data['equal_val']=count(explode(' ' , $item['equal']));

            $data['to_be']=$item['to_be'];
            $data['to_be_val']=$item['to_be_val'];

            $data['same_tail']=$item['same_tail'];
            $data['same_tail_val']=$item['same_tail_val'];
            $data['interval']=$item['interval'];

            $data['ac']=$item['ac'];
            $data['skip']=$ball[5] - $ball[0];
            $data['created_at']=time();

            $result = DbModels::insertData('double_ball' , $data);
            if($result){
                return ['code'=>0 , 'msg'=>'success'];
            }else{
                return ['code'=>300 , 'msg'=>'error'];
            }

        }

    }

    public function edit(Request $request , $id){

        $line = DbModels::selectOne('double_ball' , $id);
        return view('admin.double.edit',[
            'pitch'=>'double',
            'line'=>$line
        ]);


    }

    public function update(Request $request , $id){



    }


    static public function getWeek($date){
        return date("w",strtotime($date));
    }

    static public function getOdd($arr){
        $odd = 0;
        foreach ($arr as $key=>$val){
            if($val % 2 == 1){
                $odd++;
            }

        }
        return $odd ;
    }
    static public function getSum($arr){
        $sum = 0;
        foreach ($arr as $key=>$val){
            $sum +=$val;
        }
        return $sum;
    }

    static function connect($arr){



    }
}