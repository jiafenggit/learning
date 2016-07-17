<?php
$a = [1,2,4,56,53,23,35];

//冒泡排序
function bubble($arr){
    echo "这是冒泡排序";
    $len = count($arr);
    //该层循环是控制冒泡的次数2
    for($i = 1; $i < $len; $i++){
        //控制该次冒泡，冒出一个数，需要比较的次数
        for($j = 0; $j < $len-$i; $j++){
            if($arr[$j] > $arr[$j+1]){
                $tmp = $arr[$j+1];
                $arr[$j+1] = $arr[$j];
                $arr[$j] = $tmp;
            }
        }
    }
    return $arr;
}
// $a = bubble($a);

//选择排序
function select_sort($arr){
    echo "这是选择排序";
    $len = count($arr);
    //$i 当前最小值的位置，需要参与比较的元素
    for($i = 0; $i < $len-1; $i++){
        //先假设最小的值的位置
        $p = $i;
        //$j 当前都需要和哪些元素比较，$i后面
        for($j = $i+1; $j < $len;$j++){
            if($arr[$p] > $arr[$j])
                $p = $j;
        }
        if($p != $i){
            $tmp = $arr[$p];
            $arr[$p] = $arr[$i];
            $arr[$i] = $tmp;
        }
    }
    return $arr;
}
//$a = select_sort($a);

//插入排序
function insert_sort($arr){
    echo "这是插入排序";
    //区分哪些部分是已经排序好的
    //哪部分是没有排序的
    //找到其中一个需要排序的元素
    //这个元素从第二个元素开始，到最后一个元素都是需要排序的元素
    $len = count($arr);
    for($i = 1;$i < $len; $i++){
        //获得当前需要比较的元素值。
        $tmp = $arr[$i];
        for($j = $i-1; $j >= 0; $j--) {
            if($tmp < $arr[$j]){
                $arr[$j+1] = $arr[$j];
                $arr[$j] = $tmp;
            } else {
                //如果碰到不需要移动的元素，不需要再比较，就跳出当前循环
                break;
            }
        }
    }
    return $arr;
}
//$a = insert_sort($a);

function quick_sort($arr) {
    $len = count($arr);
    if($len <= 1)
        return $arr;
    //选择一个标尺，就选用第一个元素
    $base = $arr[0];
    //遍历除了标尺外的所有元素，按照大小关系放入两个元素
    $small_arr = array();
    $big_arr = array();
    for($i = 1; $i < $len; $i++){
        if($base > $arr[$i]){
            $small_arr[] = $arr[$i];
        } else {
            $big_arr[] = $arr[$i];
        }
    }
    //再分别对两个数组进行相同的排序处理方式
    $small_arr = quick_sort($small_arr);
    $big_arr = quick_sort($big_arr);
    echo "这是快速排序";
    return array_merge($small_arr,array($base),$big_arr);
}
//$a = quick_sort($a);

//归并排序
function merge_sort($arr) {
    $len = count($arr);
    if ($len <= 1)
        return $arr;
    $half = ($len>>1) + ($len & 1);
echo "($len & 1)"."   ";
    $arr2d = array_chunk($arr, $half);
    $left = merge_sort($arr2d[0]);
    $right = merge_sort($arr2d[1]);
    while (count($left) && count($right))
        if ($left[0] < $right[0])
            $reg[] = array_shift($left);
        else
            $reg[] = array_shift($right);
    return array_merge($reg, $left, $right);
}
$a = merge_sort($a);
echo "<pre>";
print_r($a);