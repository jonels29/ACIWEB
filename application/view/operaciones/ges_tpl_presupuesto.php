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
<table id="table_tpl" class='table table-bordered table-striped responsive" cellspacing="0"'>
<tbody>
<?php
//INI LECTURA DE ARCHIVO EXCEL

$reader= new Spreadsheet_Excel_Reader();



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
	
				 	echo '<tr>';

				 	foreach ($data['cells'][$i] as $KEY => $row) {
				 
				      if($row!=''){

					   echo '<td contenteditable style="'.$reader->style($i,$KEY,$sheet=0,'').' ; " >'.utf8_encode($row).'  </td>';

				      }else{

                       echo '<td ccontenteditable style="'.$reader->style($i,$KEY,$sheet=0,'').' ; "></td>';

				      } 
				 	}
				   echo '</tr>';

				  $i += 1;
				}

			}

}
?>
</tbody>
</table>






	<!--END contenido -->
	</div>
</div>
</div>
</div>
