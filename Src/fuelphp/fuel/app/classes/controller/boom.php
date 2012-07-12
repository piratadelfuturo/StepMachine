<?php

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 * 
 * @package  app
 * @extends  Controller
 */
class Controller_Boom extends Controller {
    
    
    public function before(){
        
    }
    
    public function action_index() {
        
        
        //assign views as variables, lazy rendering
        $data['view']['header'] = View::forge('block/header');
        $data['view']['content'] = View::forge('block/index');
        $data['view']['user'] = View::forge('block/user');
        $data['view']['footer'] = View::forge('block/footer');
        
        return Response::forge(View::forge('layout/layout',$data));
    }
    

}