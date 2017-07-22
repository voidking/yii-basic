<?php

namespace app\controllers\util;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class CaptchaController extends Controller
{
    public function actionIndex()
    {
        //echo 'captcha index function';
        return $this->render('captcha.tpl', ['title' => 'CatpchaTest']);
    }

    public function actionGetcode(){
        session_start();
        $response = Yii::$app->getResponse();
        $response->format = $response::FORMAT_RAW;
        $this->createCode(300,80,30);
    }

    public function createCode($width,$height,$fontsize){
        //设置验证码图片大小的函数
        $image = imagecreate($width, $height);    
        //设置验证码颜色 imagecolorallocate(int im, int red, int green, int blue);
        $bgcolor = imagecolorallocate($image,255,255,255); //#fff
        //区域填充 int imagefill(int im, int x, int y, int col) (x,y) 所在的区域着色,col 表示欲涂上的颜色
        imagefill($image, 0, 0, $bgcolor);
        
        //设置变量
        $captcha_code = "";
        //生成随机的字母和数字
        for($i=0;$i<4;$i++){
              
            //设置字体颜色，随机颜色，0-120深颜色
            $fontcolor = imagecolorallocate($image, rand(0,120),rand(0,120), rand(0,120));     
            //$fontcolor = imagecolorallocate($image, 0, 0, 0);
            //设置需要随机取的值，去掉容易出错的值如0和o、1和l、2和z
            $data ='abcdefghigkmnpqrstuvwxy3456789';
            //取出值，字符串截取方法  strlen获取字符串长度
            $fontcontent = substr($data, rand(0,strlen($data)-1),1);
            //连续定义变量
            $captcha_code .= $fontcontent;    
            
            //imagestring设置字体大小，最大值为5
            //$fontsize = 5; 

            //设置坐标
            $x = ($i*$width/4)+rand(5,10);
            $y = rand(($height+$fontsize)/2-5,($height+$fontsize)/2+5);
            //imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);
            imagettftext($image,$fontsize,rand(-10,10),$x,$y,$fontcolor,'font/msyh.ttf',$fontcontent);
        }
        //存到session
        $_SESSION['captcha_code'] = $captcha_code;
        //增加干扰元素，设置雪花点
        for($i=0;$i<200;$i++){
            //设置点的颜色，50-200颜色比数字浅，不干扰阅读
            $pointcolor = imagecolorallocate($image,rand(50,200), rand(50,200), rand(50,200));    
            //imagesetpixel — 画一个单一像素
            imagesetpixel($image, rand(1,$width-1), rand(1,$height-1), $pointcolor);
        }
        //增加干扰元素，设置横线
        for($i=0;$i<2;$i++){
            //设置线的颜色
            $linecolor = imagecolorallocate($image,rand(80,220), rand(80,220),rand(80,220));
            //设置线，两点一线
            imageline($image,rand(1,$width-1), rand(1,$height-1),rand(1,$width-1), rand(1,$height-1),$linecolor);
        }
         
        //设置头部，image/png
        header('Content-Type: image/png');
        //imagepng() 建立png图形函数
        imagepng($image);
        //imagedestroy() 结束图形函数 销毁$image
        imagedestroy($image);
    }

    public function actionCheck($code){
        session_start();
        if(isset($_SESSION['captcha_code'])){
            if($_SESSION['captcha_code'] == $code){
                unset($_SESSION['captcha_code']);
                $result = array(
                    'code'=> '0',
                    'ext'=> '验证成功'
                );
            }else{
                $result = array(
                    'code'=> '1',
                    'ext'=> '验证码错误'
                );
            }
        }else{
            $result = array(
                'code'=> '2',
                'ext'=> '请先刷新验证码'
            );
        }

        echo json_encode($result,JSON_UNESCAPED_UNICODE);
    } 
}

