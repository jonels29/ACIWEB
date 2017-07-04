<?PHP

class ges_presupuesto extends Controller
{

//******************************************************************************
//CREAR PROPUESTAS
public function crear_presupuesto(){


 $res = $this->model->verify_session();

        if($res=='0'){
        

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/_templates/panel.php';
            require APP . 'view/operaciones/ges_crea_presupuesto.php';
            require APP . 'view/_templates/footer.php';


        }
          
	
}

//******************************************************************************
//CREAR TEMPLATES
public function crear_template(){

require('Excel/reader.php');
require('Excel/simple_html_dom.php');

 $res = $this->model->verify_session();

        if($res=='0'){
        

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/_templates/panel.php';
            require APP . 'view/operaciones/ges_tpl_presupuesto.php';
            require APP . 'view/_templates/footer.php';


        }
          
  
}

}

?>