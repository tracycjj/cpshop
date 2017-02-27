<?php
// 本类由系统自动生成，仅供测试用途
namespace Wap\Controller;
use Wap\Controller\BaseController;
class IndexController extends BaseController {
    public function _initialize(){
        parent::_initialize();
    }
    public function index(){
        dump($_SESSION);
    }
}