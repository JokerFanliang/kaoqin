<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Config;
use think\Session;

class Speech extends Base
{


    public function __construct() {
        parent::__construct();
        $this->APP_ID='11755625';
        $this->API_KEY = '9S8zxGHOM43G24oC4lKoG5Vb';
        $this->SECRET_KEY = '8glylSeQ9VMtooBlGFnfdZQVVbigquTh';
    }

    public function index()
    {
        require_once EXTEND_PATH.'Aip/AipFace.php';

        // 你的 APPID AK SK
        $APP_ID="11755345";
        $API_KEY="6y2W6fqexZrWsGUO2uHTXvNt";
        $SECRET_KEY="T89FsEO3Sel6rbw8zD2VQZeLSAzbxsXB";

        $client = new \AipFace($APP_ID, $API_KEY, $SECRET_KEY);
        
        $image = file_get_contents(STATIC_PATH."/uploads/speech/pear.jpg");

        // 如果有可选参数
        $options = array();
        $options["baike_num"] = 5;

        // 带参数调用通用物体识别
        $res=$client->advancedGeneral($image, $options);
        dump($res);
    }

    //语音识别
    public function index1(){
        require_once EXTEND_PATH.'Aip/AipSpeech.php';
        $client = new \AipSpeech($this->APP_ID, $this->API_KEY, $this->SECRET_KEY);
        $res=$client->asr(file_get_contents(STATIC_PATH."/uploads/speech/16k.pcm"), 'pcm', 16000, array('dev_pid' => 1537,));
        dump($res);
    }

    //图片等证件文字识别
    public function index2()
    {
        require_once EXTEND_PATH.'Aip/AipOcr.php';
        $APP_ID="11756145";
        $API_KEY="HMDKu5zmkMKReyUsUzaZL0MN";
        $SECRET_KEY="Bba4FE6WlwKGSbi7tlarZFRKNbokMiSl";
        $client = new \AipOcr($APP_ID, $API_KEY, $SECRET_KEY);

        $image = file_get_contents(STATIC_PATH."/uploads/speech/demo2.jpg");

        $options = array();
        $options["detect_direction"] = "true";
        $options["probability"] = "true";

        // 带参数调用通用文字识别, 图片参数为本地图片
        $res=$client->basicAccurate($image, $options);
        dump($res);
    }

    //图像识别，识别图片是什么东西
    public function index3()
    {
        require_once EXTEND_PATH.'Aip/AipImageClassify.php';

        // 你的 APPID AK SK
        $APP_ID="11756252";
        $API_KEY="Y7mW4uImP6X0W62GFRUZYYtU";
        $SECRET_KEY="qinBeQjWLmoDlnQOAGxbtVcfHPo5I2hT";

        $client = new \AipImageClassify($APP_ID, $API_KEY, $SECRET_KEY);
        $image = file_get_contents(STATIC_PATH."/uploads/speech/pear.jpg");

        // 如果有可选参数
        $options = array();
        $options["baike_num"] = 5;

        // 带参数调用通用物体识别
        $res=$client->advancedGeneral($image, $options);
        dump($res);
    }




}