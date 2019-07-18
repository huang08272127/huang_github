<?php
    //计算思路，将每一次计算的结果用数组和10进制表示，然后与下一个数相乘，
    //例如arr=[1] 表示1*10的0(对应的下标)次方    所代表的的结果为  1
    //arr=[1,2] 表示1*10的0次方+ 2*10的1次方    所代表的的结果为  21
    //arr=[1,2,4] 表示1*10的0次方+ 2*10的1次方 + 4*10的2次方     421
    //
    //
    //1.先初始化一个数组[1]
    $result = array(1); 
    //2.从1开始，数组每次与一个数相乘
    for($i = 1; $i <=11; $i++){
        $result = bigNumMulty($result, $i);
    }
    echo '<pre>';
    print_r($result);
    echoArr($result);

    //两个大数相乘，$num1和$num2都是string型的
    //3.对于传递过来的数组$arr和数字$num，将数组中的每一个元素与$num相乘
    function bigNumMulty($arr, $num){
        $result = array(0);               //初始化一个数组
        //$result = $arr;               //初始化一个数组
        //[0,0,8]*11
        foreach($arr as $key=>$val){
            $data = $val * $num;
            //addData($result, $data, $key);  //4.处理$data
            //如果出现$data连续多次为零的情况，$index在增加的同时，$result的元素个数没有增加，这样会出现数组的下标缺失
            if($key>=1 && !isset($result[$key-1])){
                $result[$key-1]=0;
            }
            $result=addData($result, $data, $key);  //4.处理$data
            
        }
        return $result;
    }

    function addData($result, $data, $index){
        //$data有可能会是一个多位数，需要对其多次循环处理，每次以10的倍数为单位，一直到小于10为止
        //echo '<pre>';
        //echo $index.'外';
        //print_r($result);
        while($data){
            $single = $data % 10; //得到当前下标对应的值需要增加的量
            $result[$index]=!empty($result[$index])?$result[$index]:0;  //避免$arr[$index]不存在时的报错
            $data_1 = $result[$index] + $single; //将当前下标对应的值与增加值相加，获取最新的值，有可能大于10，需要进一位
            $result[$index] = $data_1 % 10;  //取模处理，获取当前最新的下标
            //print_r($arr);
            //大于10，向前进一位
            if($data_1>=10){
                $result[$index + 1]=!empty($result[$index + 1])?$result[$index + 1]:0;  //避免$arr[$index+1]不存在时的报错
                $result[$index + 1] += intval($data_1 / 10); //向上一位添加对应参数
            }
            
            //print_r($result);
            $data = intval($data/ 10);
            $index++;
        }

        return $result;
    }

    function echoArr($arr){
        $len=count($arr);
        for ($i=$len-1; $i >=0 ; $i--){
            echo $arr[$i];
        }       
    }

    /*function echoArr($arr){
        $index = 0;
        foreach($arr as $key=>$val){
            if($val > 0){
                $index = $key;
            }
        }
        for(; $index > -1; $index--){
            if(empty($arr[$index])){
                echo 0;
            }else{
                echo $arr[$index];
            }
        }
    }*/

