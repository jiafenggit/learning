<?php
//餐馆有三个角色:厨师,服务员,顾客
/*
 * 厨师类的接受与执行
 */
/*餐馆示例*/
class cook{
    public function meal(){
        echo '番茄炒鸡蛋',PHP_EOL;
    }
    public function drink(){
        echo '紫菜汤',PHP_EOL;
    }
    public function ok(){
        echo '完毕',PHP_EOL;
    }
}
//然后是命令接口
interface Command{
    //命令接口
    public function execute();
}

/*模拟服务员与厨师的过程*/

class MealCommand implements Command {
    private $cook;
    //绑定命令接受者
    public function __construct(cook $cook)
    {
        $this->cook = $cook;
    }
    public function execute()
    {
        // 把消息传递给厨师,让厨师做饭
        $this->cook->meal();
    }
}
class DrinkCommand implements Command {
    private $cook;
    //绑定命令接受者
    public function __construct(cook $cook)
    {
        $this->cook = $cook;
    }
    public function execute()
    {
        $this->cook->drink();
    }
}

/*模拟顾客与服务员的过程*/
class cookControl {
    private $mealcommand;
    private $drinkcommand;
    //接命令发送者绑定到命令接收器上面
    public function addCommand(Command $mealcommand,Command $drinkcommand){
        $this->mealcommand = $mealcommand;
        $this->drinkcommand = $drinkcommand;
    }

    public function callmeal(){
        $this->mealcommand->execute();
    }
    public function calldrink(){
        $this->drinkcommand->execute();
    }
}

//现在完成一个整的过程,实现命令模式
$control = new cookControl;
$cook = new cook;
$mealcommand = new MealCommand($cook);
$drinkcommand = new DrinkCommand($cook);
$control->addCommand($mealcommand,$drinkcommand);
$control->callmeal();
$control->calldrink();











