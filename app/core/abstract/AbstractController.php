<?php
namespace App\Core\abstract;

use App\Core\App;
use App\Core\Session;

abstract class AbstractController extends Session{
    protected $Layout='base';
    protected $session;

    public function __construct(
        
    )
    {
        #$this->session=Session::getIstance();
        $this->session=App::getDependence('session');
    }
    private static AbstractController|null $instance=null;
      public static function getInstance(){
        if (self::$instance===null){
            self::$instance=new static();
        }
        return self::$instance;
    }
    abstract public function index();
    abstract public function show();
    abstract public function store();
    abstract public function edit();
    abstract public function create();
    public function render($view, array $data=[]){
            extract($data);
            ob_start();
            require_once '../templates/' .$view;
            $contentForlayout = ob_get_clean();  
            require_once '../templates/layout/'.$this->Layout . '.layout.php';
    }

}