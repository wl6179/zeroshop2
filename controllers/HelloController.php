<?php
/**
 * 如何操作 请求&响应
 * @author 44533
 *
 */
namespace app\controllers;      #所有控制器都按约定，放在此命名空间下；

use yii\web\Controller;             #继承Controller时所需命名空间前缀；
use yii\web\Cookie;                 #使用cookies时，所需命名空间前缀；

class HelloController extends Controller
{
    /**
     * view II
     */
    public $layout = 'comment';     //forview layout
    
    /**
     * view
     */
    public function actionIndex(){
        //向视图传递参数
        $data = array();
        $data['test_str'] = 'ak47';     //在视图中直接使用变量 $test_str
        $data['test_arr'] = [1, 2];     //在视图中直接使用变量 $test_arr[]
        
        return $this->renderPartial('index', $data);    //向视图中只需要传入一个 $data 即可！可见Yii中已经有统一的约定，遵守即可
    }
    
    /**
     * view II
     */
    public function actionIndex_forview(){
        //向视图传递参数
        $data = array();
        $data['test_str'] = 'ak47';     //在视图中直接使用变量 $test_str
        $data['test_arr'] = [1, 2];     //在视图中直接使用变量 $test_arr[]
    
        return $this->render('index_forview', $data);    //向视图中只需要传入一个 $data 即可！可见Yii中已经有统一的约定，遵守即可
    }
    
    /**
     * model
     * 操作model之操作数据表
     * 注意
     *  记录集对象，占内存量是很大的；
     *  而Yii会把记录集转换成数组，目的就是优化了内存存储量，不会让记录集过大而内存溢出；
     *  So，应该使用->asArray()函数！；
     */
    public function actionModel(){
        //查询 - 可以不用SQL，而用OO方式查询数据
        //1.使用SQL
        $sql = 'select * from test where id=:id';
        $results = Test::findBySql($sql, array(':id'=>1))->all();        //返回一个大数组（已经内置好了 SQL注入防范功能！）
        //1.2.使用SQL II之Yii改进版（通过数组传查询条件参数）
        //这就用了OO的Yii方式查询数据
        $results = Test::find()->where(['>', 'id', 0])->all();
        //Test::find()->where(['between', 1, 2])->all();
        //Test::find()->where(['like', 'title', 'abc'])->all();
        
        //如何优化查询的数据记录集：
        //使用asArray()
        $results = Test::find()->where(['>', 'id', 0])->asArray()->all();
        
        //批量查询
        foreach (Test::find()->batch(3) as $tests){     //->batch(3)循环每次出3条记录，即遍历无数条记录时，内存永远只存储着3条记录的量！（是一个优化思路）
            print_r(count($tests));     //把内存降下来了，永远都是3条的量
        }
        
        //删除数据
        $results = Test::find()->where(['>', 'id', 0])->all();  //找到数据
        $results[0]->delete();           //找到那一条要删除的数据，删除之！
        //另一个删除方式
        Test::deleteAll('id>:id', array(':id'=>0));     //也能删除指定条件的记录
        
        //修改数据
        $test = Test::find()->where(['id'=>4])->one();  //找到一条数据
        $test->title = 'title4';
        $test->save();
    }
    
    
    
	public function actionRequestResponse(){
		echo 'hello world.'. PHP_EOL;
		//请求组件
		$request = \YII::$app->request;            #request 请求组件
		//var_dump($request);
		
		var_dump($request->get('id', 33));
		var_dump($request->post('name', '默认'));
		
		//获取请求本身信息
		if ($request->isGet) {
			echo 'this is a GET method.'. PHP_EOL;
		}else {
		    echo 'this is not a GET method.'. PHP_EOL;
		}
		
		if ($request->isPost) {
		    echo 'this is a POST method.'. PHP_EOL;
		}else {
		    echo 'this is not a POST method.'. PHP_EOL;
		}
		
		//获取用户信息
		echo $request->userIp. PHP_EOL;
		
		
		
		//响应组件
		$response = \YII::$app->response;
		//$response->statusCode = '404';        //将输出设置成404 NOT FOUND页面
		
		//操作响应
		//向响应头中添加消息
		$response->headers->add('pragma', 'no-cache');                //与浏览器打交道，控制浏览器如果有响应时，浏览器请不要缓存这些内容！！
		$response->headers->set('pragma', 'max-age=5');               //缓存5秒钟
		$response->headers->remove('pragma');       //删除某一项
		//跳转
		//$response->headers->add('location', 'http://www.baidu.com');       //跳转（YII已经集成到了 Controller 中：）
		//$this->redirect('http://www.baidu.com', 302);                                   //跳转（YII已经集成到了 Controller 中：）[302状态码]
		//文件下载
		//$response->headers->add('content-disposition', 'attachment; filename="ak47.jpeg"');                //以附件的形式，下载文件（YII已经集成到了 response 组件中：）
		//$response->sendFile('../images/abc.jpg');                                                                                         //以附件的形式，下载文件（YII已经集成到了 response 组件中：）[YII会自动判断文件源的类型，来自动设置下载的文件类型！]注意：目录是基于入口文件index.php处的！
	}
	
	public function actionSession(){
	    echo 'hello session.'. PHP_EOL;
	    //session组件
	    $session = \YII::$app->session;
	    
	    //判断session有没有开启
	    if($session->isActive){
	        echo 'the session is active.';
	    }else {
	        //开启session
	        $session->open();
	    }
	    
	    //操作session
	    $session->set('user', '张三');
	    $session->remove('user');
	    
	    //YII的session组件设计的时候，就是继承自PHP的特性ArrayAccess，所以它的对象实例也可以当数组使用！！
	    //如，用数组方式使用session组件
	    $session['user'] = '张三';
	    unset($session['user']);
	}
	
	/**
	 * 在 response 组件之下！
	 */
	public function actionCookies(){
	    echo 'hello cookies.'. PHP_EOL;
	    //响应组件之下的cookies集合！
	    $cookies = \YII::$app->response->cookies;
	    //请求组件之下的cookies集合！
	    $cookies2 = \YII::$app->request->cookies;
	    
	    //操作cookies
	    $cookie_data = array('name'=>'user', 'value'=>'张三');
	    $cookies->add(new \yii\web\Cookie\Cookie($cookie_data));       //YII的cookies机制，已经自动对其进行加密了！（会用到开头设置config的cookieValiKey密钥来加密的！！！安全机制不错！自定义安全~）
	    $cookies->remove('user');
	    
	    //取出浏览器中的cookies
	    echo $cookies2->getValue('user', '默认User') . PHP_EOL;
	}
}
