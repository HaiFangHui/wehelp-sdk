<?php

require '../src/Bangtuike/bangtuike.php';

$bangtuike = new Bangtuike(array(
    'channel' => 'channel6880', //测试
    'app-id'  => '1517051',     //测试
    'uid'     => '123111111',    
    'env'     => 'test',        //test 测试环境  product  生成环境
));



try {

    echo "\n任务列表------------------------------------\n";
    //任务列表
    $tasks = $bangtuike->getTaskList(array(
        'offset' => 1,
        'limit'  => 5,
    ));

    foreach ($tasks as $task) {
        echo "id: " .           $task->id .           "\n";
        echo "title: " .        $task->title .        "\n";
        echo "img: " .          $task->img .          "\n";
        echo "desc: " .         $task->desc .         "\n";
        echo "total_amount: " . $task->total_amount  ."\n";
        echo "unit_price: " .   $task->unit_price .   "\n";
        echo "is_share: " .     $task->is_share .     "\n";
    }


    echo "\n单个任务--------------------------------------\n";
    //单个任务
    $task = $bangtuike->getTask(1115, array(
        'uid'   => '123111111',
        'phone' => '18618328615',
        'sex'   => 1,
        'city'  => '北京',
        'ip'    => '192.168.1.1',
    ));

    echo "id: " .               $task->id .              "\n";
    echo "title: " .            $task->title .           "\n";
    echo "img: " .              $task->img .             "\n";
    echo "desc: " .             $task->desc .            "\n";
    echo "hosting_url: " .      $task->hosting_url  .    "\n";
    echo "source_url: " .       $task->source_url .      "\n";
    echo "is_share: " .         $task->is_share .        "\n";
    echo "total_amount: " .     $task->total_amount .    "\n";
    echo "unit_price: " .       $task->unit_price .      "\n";
    echo "read_count: " .       $task->read_count .      "\n";
    echo "user_read_count: " .  $task->user_read_count . "\n";



    echo "\n分享数据---------------------------------------\n";
    //分享数据
    $share = $bangtuike->getTaskShare(1115, array(
        'uid' => '123111111',
    ));

    echo "id: " .               $share->id .              "\n";
    echo "title: " .            $share->title .           "\n";
    echo "img: " .              $share->img .             "\n";
    echo "desc: " .             $share->desc .            "\n";
    echo "share_url: " .        $share->share_url  .      "\n";



    echo "\n分享数据回调---------------------------------------\n";
    //分享数据回调
    $share = $bangtuike->getTaskShareCallback(1115, array(
        'uid'    => '123111111',
        'result' => 1,
    ));

    echo "msg: " . $share->msg;
    



    echo "\n用户分享结算---------------------------------------\n";
    //用户分享结算
    $data = $bangtuike->getTaskStat(1115, array(
        'uid' => '123111111',
    ));

    echo "id: " .               $data->id .              "\n";
    echo "title: " .            $data->title .           "\n";
    echo "unit_price: " .       $data->unit_price .      "\n";
    echo "read_count: " .       $data->read_count .      "\n";
    echo "is_closed: " .        $data->is_closed  .      "\n";
    echo "close_read_count: " . $data->close_read_count ."\n";

} catch (\Exception $e) {
    echo $e->getMessage();
}
