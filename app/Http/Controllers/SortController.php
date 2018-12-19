<?php

namespace App\Http\Controllers;

class SortController extends Controller
{
    static $bubble = NULL;

    public function index()
    {
        return view('index');
    }

    // 冒泡排序
    // 思路一
    // 把第一个数跟所有的数比较，如果碰到比第一个数还小的数字，就把他俩位置交换下，然后把交换后的数字继续往后比较...
    // 这样第一轮交换能得出什么呢，就是第一轮交换完，数组的第一个位置，一定是最小的数
    // 循环体内，每次$j = $i + 1, 因为外层每循环一次已经把最小的数压到数字头部了, 没必要从头开始比较了
    public function bubble()
    {
        $num = 20;
        for ($i = 0; $i < $num; $i++) {
            $arr[] = rand(100, 1000);
            $color_arr[] = '#337ab7';
        }
        $i = 0;
        $init['yAxis'] = json_encode($arr);
        $init['color'] = json_encode($color_arr);
        for ($i; $i < $num; $i++) {
            $j = $i + 1;
            for ($j; $j < $num; $j++) {
                $color_arr[$i] = '#f0ad4e';
                $color_arr[$j] = '#ac2925';
                $color[] = $color_arr;
                $yAxis[] = $arr;
                if ($arr[$i] > $arr[$j]) {
                    $arr[$i] = $arr[$i] ^ $arr[$j];
                    $arr[$j] = $arr[$i] ^ $arr[$j];
                    $arr[$i] = $arr[$i] ^ $arr[$j];
                }
                $color_arr[$j] = '#337ab7';
                $color[] = $color_arr;
                $yAxis[] = $arr;
            }
            $color_arr[$i] = '#398439';
            $color[] = $color_arr;
            $yAxis[] = $arr;
        }


        $data = array(
            'init' => $init,
            'sort' => array(
                'yAxis' => json_encode($yAxis),
                'color' => json_encode($color),
            ),
        );
        return view('sort', $data);
    }

    // 冒泡排序
    // 思路2
    // 一组一组数字(相邻的两个数)比较，如果大于后面的数字就发生交换，这样比较完的结果就是会把最大的数移动到最后的位置
    public function bubble2()
    {
        $num = 20;
        for ($i = 0; $i < $num; $i++) {
            $arr[] = rand(100, 1000);
            $color_arr[] = '#337ab7';
        }
        $i = 0;
        $init['yAxis'] = json_encode($arr);
        $init['color'] = json_encode($color_arr);
        for ($i; $i < $num; $i++) {
            $j = 1;
            $flag = 1;  //如果里面没有发生交换，就意味着数组目前就是有序的，可以退出循环了
            for ($j; $j < $num - $i; $j++) {
                $color_arr[$j - 1] = '#f0ad4e';
                $color_arr[$j] = '#ac2925';
                $color[] = $color_arr;
                $yAxis[] = $arr;
                if ($arr[$j - 1] > $arr[$j]) {
                    $flag = 0;
                    $arr[$j - 1] = $arr[$j - 1] ^ $arr[$j];
                    $arr[$j] = $arr[$j - 1] ^ $arr[$j];
                    $arr[$j - 1] = $arr[$j - 1] ^ $arr[$j];
                }
                $color_arr[$j - 1] = '#337ab7';
                $color[] = $color_arr;
                $yAxis[] = $arr;
            }
            if ($flag) {
                for ($k = 0; $k < $num; $k++) {
                    $color_arr[$k] = '#398439';
                }
                $color[] = $color_arr;
                $yAxis[] = $arr;
                break;
            }
            $color_arr[$num - $i - 1] = '#398439';
            $color[] = $color_arr;
            $yAxis[] = $arr;
        }

        $data = array(
            'init' => $init,
            'sort' => array(
                'yAxis' => json_encode($yAxis),
                'color' => json_encode($color),
            ),
        );
        return view('sort', $data);
    }

    // 选择排序
    // 首先在未排序序列中找到最小（大）元素，存放到排序序列的起始位置，
    // 然后，再从剩余未排序元素中继续寻找最小（大）元素，然后放到已排序序列的末尾。
    // 以此类推，直到所有元素均排序完毕。
    public function selection()
    {
        $num = 20;
        for ($i = 0; $i < $num; $i++) {
            $arr[] = rand(100, 1000);
            $color_arr[] = '#337ab7';
        }
        $init['yAxis'] = json_encode($arr);
        $init['color'] = json_encode($color_arr);
        for ($i = 0; $i < $num; $i++) {
            $minIndex = $i;
            $j = $i + 1;
            for ($j; $j < $num; $j++) {
                $color_arr[$minIndex] = '#f0ad4e';
                $color_arr[$j] = '#ac2925';
                $color[] = $color_arr;
                $yAxis[] = $arr;
                if ($arr[$minIndex] > $arr[$j]) {
                    $color_arr[$minIndex] = '#337ab7';
                    $minIndex = $j;
//                    $color_arr[$j] = '#f0ad4e';
                } else {
                    $color_arr[$j] = '#337ab7';
                }
                $color[] = $color_arr;
                $yAxis[] = $arr;
            }
            if ($minIndex > $i) {
                $arr[$i] = $arr[$i] ^ $arr[$minIndex];
                $arr[$minIndex] = $arr[$i] ^ $arr[$minIndex];
                $arr[$i] = $arr[$i] ^ $arr[$minIndex];
            }
            $color_arr[$i] = '#398439';
            if ($i != $minIndex) {
                $color_arr[$minIndex] = '#337ab7';
            }
            $color[] = $color_arr;
            $yAxis[] = $arr;
        }

        $data = array(
            'init' => $init,
            'sort' => array(
                'yAxis' => json_encode($yAxis),
                'color' => json_encode($color),
            ),
        );
        return view('sort', $data);
    }

    // 直接插入排序
    // 从第一个元素开始，该元素可以认为已经被排序；
    // 取出下一个元素，在已经排序的元素序列中从后向前扫描；
    // 如果该元素（已排序）大于新元素，将该元素移到下一位置；
    // 重复步骤3，直到找到已排序的元素小于或者等于新元素的位置；
    // 将新元素插入到该位置后；
    // 重复步骤2~5。
    public function insertion()
    {
        $num = 20;
        for ($i = 0; $i < $num; $i++) {
            $arr[] = rand(100, 1000);
            $color_arr[] = '#337ab7';
        }
        $init['yAxis'] = json_encode($arr);
        $init['color'] = json_encode($color_arr);
        for ($i = 1; $i < $num; $i++) {
            $j = $i - 1;
            $tmp = $arr[$i];
            for ($j; $j >= 0; $j--) {
                $color_arr[$j] = '#f0ad4e';
                $color_arr[$j+1] = '#ac2925';
                $color[] = $color_arr;
                $yAxis[] = $arr;
                if ($tmp < $arr[$j]) {
                    $arr[$j + 1] = $arr[$j];
                    $arr[$j] = $tmp;
                }else{
                    $color_arr[$j] = '#337ab7';
                    $color_arr[$j+1] = '#337ab7';
                    $color[] = $color_arr;
                    $yAxis[] = $arr;
                    break;
                }
                $color_arr[$j] = '#337ab7';
                $color_arr[$j+1] = '#337ab7';
                $color[] = $color_arr;
                $yAxis[] = $arr;
            }
            $color[] = $color_arr;
            $yAxis[] = $arr;
        }

        unset($color_arr);
        for ($k = 0; $k < $num; $k++) {
            $color_arr[] = '#398439';
        }
        $color[] = $color_arr;
        $yAxis[] = $arr;

        $data = array(
            'init' => $init,
            'sort' => array(
                'yAxis' => json_encode($yAxis),
                'color' => json_encode($color),
            ),
        );
        return view('sort', $data);
    }

    // 希尔排序
    // 选择一个增量序列t1，t2，…，tk，其中ti>tj，tk=1；
    // 按增量序列个数k，对序列进行k 趟排序；
    // 每趟排序，根据对应的增量ti，将待排序列分割成若干长度为m 的子序列，分别对各子表进行直接插入排序。
    // 仅增量因子为1 时，整个序列作为一个表来处理，表长度即为整个序列的长度。
    public function shell()
    {
        $num = 20;
        for ($i=0; $i < $num; $i++) {
            $arr[] = rand(100,1000);
            $color_arr[] = '#337ab7';
        }
        $init['yAxis'] = json_encode($arr);
        $init['color'] = json_encode($color_arr);
        //计算增量
        $gap = floor($num/2);
        while ($gap > 0){
            //根据增量进行分组，进行直接插入排序
            for ($i=1; $i*$gap < $num ; $i++) {
                $tmp=$arr[$i*$gap];
                for ($j=$i-1; $j >=0 ; $j--) {
                    $color_arr[$j*$gap] = '#f0ad4e';
                    $color_arr[($j+1)*$gap] = '#ac2925';
                    $color[] = $color_arr;
                    $yAxis[] = $arr;
                    if($tmp < $arr[$j*$gap]){
                        $arr[($j+1)*$gap] = $arr[$j*$gap];
                        $arr[$j*$gap] = $tmp;
                    }else{
                        $color_arr[$j*$gap] = '#337ab7';
                        $color_arr[($j+1)*$gap] = '#337ab7';
                        $color[] = $color_arr;
                        $yAxis[] = $arr;
                        break;
                    }
                    $color_arr[$j*$gap] = '#337ab7';
                    $color_arr[($j+1)*$gap] = '#337ab7';
                    $color[] = $color_arr;
                    $yAxis[] = $arr;
                }
            }
            $gap = floor($gap/2);
        }

        unset($color_arr);
        for ($k = 0; $k < $num; $k++) {
            $color_arr[] = '#398439';
        }
        $color[] = $color_arr;
        $yAxis[] = $arr;

        $data = array(
            'init' => $init,
            'sort' => array(
                'yAxis' => json_encode($yAxis),
                'color' => json_encode($color),
            ),
        );
        return view('sort', $data);
    }

    // 快速排序
    public function quick(){
        $num = 20;
        for ($i=0; $i < $num; $i++) {
            $arr[] = rand(100,1000);
            $color_arr[] = '#337ab7';
        }
        $init['yAxis'] = json_encode($arr);
        $init['color'] = json_encode($color_arr);
        $sort = $this->_mpartition($arr, 0, $num-1, $color_arr);
        $data['init'] = $init;
        $data['sort'] = $sort;
        return view('sort', $data);
    }

    private function _mpartition(&$arr, $start, $end, &$color_arr, &$yAxis = array(), &$color = array()){
        if( $start >= $end ){
            return;
        }
        $i = $start;
        $j = $end;
        // 设置基准数
        $baseval = $arr[$start];
        while ($i < $j){
            while ( $i < $j && $arr[$j] >= $baseval){
                $j--;
            }
//            $color_arr[$i] = '#ac2925';
//            $color_arr[$j] = '#f0ad4e';
//            $color[] = $color_arr;
//            $yAxis[] = $arr;
            if( $i < $j ){
                $arr[$i] = $arr[$i] ^ $arr[$j];
                $arr[$j] = $arr[$i] ^ $arr[$j];
                $arr[$i] = $arr[$i] ^ $arr[$j];
                $i++;
            }
//            $color_arr[$i-1] = '#337ab7';
//            $color_arr[$j] = '#ac2925';
//            $color[] = $color_arr;
            $yAxis[] = $arr;
            while ( $i < $j && $arr[$i] < $baseval ){
                $i++;
            }
//            $color_arr[$j] = '#ac2925';
//            $color_arr[$i] = '#f0ad4e';
//            $color[] = $color_arr;
//            $yAxis[] = $arr;
            if( $i < $j ){
                $arr[$j] = $arr[$j] ^ $arr[$i];
                $arr[$i] = $arr[$j] ^ $arr[$i];
                $arr[$j] = $arr[$j] ^ $arr[$i];
                $j--;
            }
//            $color_arr[$j+1] = '#337ab7';
//            $color_arr[$i] = '#ac2925';
//            $color[] = $color_arr;
            $yAxis[] = $arr;
        }
        // 递归
        $this->_mpartition($arr, $start, $i - 1, $color_arr, $yAxis, $color);
        $this->_mpartition($arr, $i + 1, $end, $color_arr, $yAxis, $color);
        $data = array(
            'yAxis' => json_encode($yAxis),
            'color' => json_encode($color),
        );
        return $data;
    }

    // 归并排序
    public function marge(){

    }

    // 堆排序
    public function heap(){

    }
}
