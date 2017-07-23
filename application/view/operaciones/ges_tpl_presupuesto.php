<script type="text/javascript">

 // ********************************************************
// * Aciones cuando la pagina ya esta cargada
// ********************************************************
$(window).load(function(){

$('#ERROR').hide();

});

var table = $("#table_tpl").DataTable({

      bSor: false,
      responsive: true,
      searching: false,
      paging:    false,
      info:      false,
      collapsed: false

  });



</script>

<div class="page col-lg-12">

<!--INI DIV ERRO-->
<div id="ERROR" class="alert alert-danger"></div>
<!--INI DIV ERROR-->

<div  class="col-lg-12">
<!-- contenido -->
<h2>Modelos de Propuestas</h2>
	<div class="title col-lg-12"></div>

	<div class="col-lg-12">
	<!--INI  contenido -->

	<form action="" role="form" class="form-horizontal" enctype="multipart/form-data" method="POST">
		<!--INPUT FILE-->
	    <div class="col-lg-4">
	      <fieldset>
	        <legend>Seleccionar el archivo de carga</legend>
	    	<input type="file" class="form-control" id="price_file" name="price_file" required="Debe seleccionar el archivo de lista de precios a cargar" />	
	    	<p class="help-block">El archivo debe ser en formato (.xls)</p>
	      </fieldset>
	    </div>
	   <!--INPUT FILE-->
       
        <!--SUBMIT BOTTON-->
		<div class="form-group col-lg-2">
			<input type="submit"  value="Cargar" class="btn btn-primary  btn-block text-lef" name="submit" />
		</div>
        <!--SUBMIT BOTTON-->
     </form>

<div class="separador col-lg-12"></div>

<?php
//INI LECTURA DE ARCHIVO EXCEL

$reader= new Spreadsheet_Excel_Reader();

$table = '';
$table_to_save = '';
$table .= "<table id='table_tpl' class='table table-bordered table-striped responsive' cellspacing='0'><tbody>";
$table_to_save  .= "<table id='table_tpl' class='table table-bordered table-striped responsive' cellspacing='0'><tbody>";

if($_FILES["price_file"]["size"] > 0)
{


$filename=$_FILES["price_file"]["tmp_name"];
	
			//$reader->setUTFEncoder('iconv');
			//$reader->setOutputEncoding('UTF-8');
			$reader->read($filename);

			 foreach($reader->sheets as $k=>$data)
			 {
	        
				$i=1;
				 while ($i<=$data['numRows']){

					 	if($i==1){

					 		$table_to_save .= '<thead>';


					 	}elseif ($i==2) {

					 		$table_to_save .= '</thead>';

					 	}
	
	     		 	  $table_to_save .=  '<tr>'."\xA";  


				 	foreach ($data['cells'][$i] as $KEY => $CellVal) {
						 
                      if($CellVal){


						      	if($i==1){

						 		$table_to_save .= '<th >'.utf8_encode($CellVal).'  </th>'."\xA"; //HEADER


						 	    }else{


									switch ($KEY) {

										case 1:
										$table_to_save .= '<td width="10%"  contenteditable >'.utf8_encode($CellVal).'  </td>'."\xA";
											break;
									    case 2:
										$table_to_save .= '<td width="15%"  contenteditable >'.utf8_encode($CellVal).'  </td>'."\xA";
											break;
										case 3:
										$table_to_save .= '<td width="15%"  contenteditable >'.utf8_encode($CellVal).'  </td>'."\xA";
											break;
										case 4:
										$table_to_save .= '<td width="3%"  contenteditable >'.utf8_encode($CellVal).'  </td>'."\xA";
											break;
									    case 5:
										$table_to_save .= '<td width="3%"  class="numb" contenteditable >'.utf8_encode($CellVal).'  </td>'."\xA";
											break;
										case 6:
										$table_to_save .= '<td width="5%"  class="numb" contenteditable onfocusout="recalcular('.$i.');" id="qty'.$i.'" >'.utf8_encode($CellVal).'  </td>'."\xA";
										    break;
										case 7:
										$table_to_save .= '<td width="5%"  class="numb" contenteditable onfocusout="calculate('.$i.');" id="unitprice'.$i.'">'.utf8_encode($CellVal).'  </td>'."\xA";
											break;
									    case 8:
											$table_to_save .= '<td width="5%"  class="numb" contenteditable id="total'.$i.'" >'.utf8_encode($CellVal).'  </td>'."\xA";
											break;

									}


						 	    }

		                }     

				 	}

				   $table_to_save .=  '</tr>'."\xA";

				  $i += 1;
				}

			}

}

$table_to_save .=  "</tbody></table>"."\xA";

echo $table_to_save;

file_put_contents('/home/daoutqw3/public_html/DEMO/ACIWEB/public/tpl_puma.html', $table_to_save);


?>
	<!--END contenido -->
	</div>
</div>
</div>
</div>

