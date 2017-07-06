<script type="text/javascript">
$(document).ready(function(){

var table =  $("#products").dataTable({
        aLengthMenu: [
        [10,20, 25,50,-1], [10,20, 25, 50,"All"]
              ]
            });

 table.yadcf([
{column_number : 1},
{column_number : 2},
]);

  $("#modal_table").dataTable({
        aLengthMenu: [
        [5,10, 25,50,-1], [5,10, 25, 50,"All"]
              ]
            });

});
</script>



<div class="page col-lg-12">

<div  class="col-lg-12">
<!-- contenido -->
<h2>Salida de mercancia</h2>
<div class="title col-lg-12"></div>
<div class="separador col-lg-12"></div>

<input type="hidden" id='URL' value="<?php ECHO URL; ?>" />
<div class="col-lg-12">

<!-- select clientes -->
<div class="col-lg-12">

  <fieldset>
    <legend><h4>Informacion General</h4></legend>
        
        <div class="col-lg-6"> 

           <div class="col-lg-12">
              <fieldset>
                    <p><strong>Proyecto</strong></p>
                      
                    <select  id="jobs" name="jobs" class="select col-lg-12" onchange="set_job(this.value);" required>

                    <option selected disabled></option>

                    <?php  
                    $JOBS = $this->model-> get_JobList(); 

                    foreach ($JOBS as $datos) {
                                              
                    $JOBS_INF = json_decode($datos);
                    echo '<option value="'.$JOBS_INF->{'JobID'}.'" >'.$JOBS_INF->{'Description'}."</option>";

                    }
                    ?>
                                
                  </select>   
             </fieldset>
           </div>

           <div class="separador col-lg-12"></div>

             <div class="col-lg-6" >
                  <fieldset>
                    <p><strong>Fase</strong></p>
                      
                    <select  id="jobphase" name="jobphase" class="select col-lg-12" onchange="set_phase(this.value);" required>

                    <option selected disabled></option>

                    <?php  
                    $phase = $this->model->get_phaseList(); 

                    foreach ($phase as $datos) {
                                              
                    $phase_INF = json_decode($datos);
                    echo '<option value="'.$phase_INF->{'PhaseID'}.'" >'.$phase_INF->{'Description'}."</option>";

                    }
                    ?>
                                
                  </select>   
               </fieldset>
             </div>


           <div class="col-lg-6" >
              <fieldset>
                  <p><strong>Centro de Costo</strong></p>
                    
                  <select  id="jobcost" name="jobcost" class="select col-lg-12" onchange="set_cost(this.value);" required>

                  <option selected disabled></option>

                  <?php  
                  $cost = $this->model->get_costList(); 

                  foreach ($cost as $datos) {
                                            
                  $cost_INF = json_decode($datos);
                  echo '<option value="'.$cost_INF->{'CostCodeID'}.'" >'.$cost_INF->{'Description'}."</option>";

                  }
                  ?>
                              
                </select>   
             </fieldset>
           </div>
        </div>


         <div class="col-lg-6" >
           <fieldset>
             <p><strong>Observaciones</strong></p>
               <textarea class="col-lg-12"  rows="2" id="reasonToAdj" name="reasonToAdj"></textarea> 
         </fieldset> 
         </div>

        

        <div class="col-lg-10"></div>
        <div class="col-lg-2">

          <input type="submit" onclick="send_sales_order();" class="btn btn-primary  btn-sm btn-icon icon-right" value="Procesar" />
          
        </div>  


    </fieldset>



</div>

<div class="separador col-lg-12"></div>

<!-- select products -->
<div class="col-lg-12">
<fieldset>
<legend><h4>Productos</h4></legend>

<table id="products" class="table table-striped table-bordered" cellspacing="0"  >
            <thead>
              <tr>
                <th width="5%"></th>
                <th width="30%">Codigo</th>
                <th width="50%">Descripcion</th>
                <th width="5%">Unidad</th>
                <th width="20%">Cantidad</th>

              </tr>
            </thead>

            <tbody> 
            <?php  
                 $Item =  $this->model->get_ProductsList(); 

                 foreach ($Item as $datos) {

                     $Item = json_decode($datos);
                    
                     if($Item->{'QtyOnHand'}>=1){
                      
                      $ID ='"'.$Item->{'ProductID'}.'"';
                      $NAME='"'.$Item->{'Description'}.'"';
                      $PRICE ='"'.number_format($Item->{'Price1'}, 2, '.', ',').'"';
                                      
                      echo  "<tr>
                           <td width='5%' ><a title='Agregar a la orden' data-toggle='modal' data-target='#myModal' href='javascript:void(0)' onclick='javascript: modal(".$ID.",".$NAME.",".$PRICE."); ' ><i style='color:green' class='fa fa-plus'></i></a></td>
                          <td width='30%' id=".$Item->{'ProductID'}."><strong> ".$Item->{'ProductID'}."</strong></td>
                          <td width='50%' id=".$Item->{'ProductID'}.$Item->{'Description'}."><strong>".$Item->{'Description'}.'</strong></td> 
                          <td width="5%" class="numb" id='.$Item->{'ProductID'}.$Item->{'Description'}.'-price'.">".$Item->{'UnitMeasure'}.'</td>
                          <td width="20%" class="numb" id="'.$Item->{'ProductID'}.'qty'.'" >'.number_format($Item->{'QtyOnHand'},0, '.', ',').'</td></tr>';

                      }
                  } 
            ?>            
            </tbody>
          </table>

<script type="text/javascript">

function modal(id,name){

URL = document.getElementById('URL').value;

document.getElementById('item_id_modal').value = id;
document.getElementById('desc_id_modal').value = name;


var datos= "url=bridge_query/get_items_location_by_lote/"+id;
var link= URL+"index.php";

  $.ajax({
      type: "GET",
      url: link,
      data: datos,
      success: function(res){
   
       $('#line').html(res);

     
        }
   });


}
</script>

</fieldset>

</div>
<div class="separador col-lg-12"></div>
</div>


<!-- oredn-->
<div class="col-lg-12" >
  
<fieldset>
<legend>Detalle</legend>

<input type="hidden" id='user' value="<?php echo $active_user_id; ?>" />

  <!-- ESTO PUEDE VARIAR SEGUN SEA EL CASO -->
  <input type="text" id="taxid" name="taxid" value="1" hidden/>
  <!-- valores ocultos -->
  <input type="text" id="cust_id" name="cust_id" hidden/>
  <input type="text" id="cust_comp" name="cust_comp" hidden/>
      
            
  <!-- Invoice Entries -->
  <table class="table table-bordered">
  <thead>
  <tr class="no-borders">
    <th class="text-center hidden-xs">Codigo</th>
    <th width="45%" class="text-center">Descripcion</th>
    <th class="text-center hidden-xs">Cantidad</th>
    
    
  </tr>
  </thead>
              
  <tbody id="invoice">
                
  </tbody>
  </table>
<!-- Invoice Options Buttons -->
          
</fieldset>

</div>
<div  class="separador col-lg-12" ></div> 

</div>



</div>
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 >Ubicacion y Lote</h3>
      </div>

      <div class="col-lg-12 modal-body">
        
      <div id='prod'></div>

        <div class="col-lg-3" > 
             <label class="control-label">ID Producto : </label>
             <input  class="form-control" id="item_id_modal" name="item_id_modal"  readonly/>
        </div>
        <div class="col-lg-1" ></div>
        <div class="form-group col-lg-6" > 
              <label class="control-label" >Descripcion:</label>
              <input class="form-control col-lg-10" id="desc_id_modal" name="desc_id_modal"   readonly/>
        </div> 

<div class="col-lg-12" >  
<div id="line"></div> <!-- /*Aqui se imprime la tabla de productos x lotes*/ -->

</div>    
      </div>
      <div class="modal-footer">
        <button type="button" onclick="set_items();" class="btn btn-primary" >Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>

<script>
var LineArray = []; //array para los items de la cotizacion
var count = 0;
var itemsArray = [];


function agregar_pro_sale_sale(id,item,price,lote,venc,ruta,max,qty){


var caduc = '';

  if(venc!=''){

    caduc = 'VENCE :'+venc;

  }else{

    caduc = '';

  }

  var Lote = "LOTE :"+lote+" "+caduc+" Cant: "+qty;

  var idqty = id+lote+ruta+"qty";


  var element = id+lote+ruta; 
              
    var qty =  parseInt(qty);
              

max = Number(parseFloat(max).toFixed(0));

qty = Number(parseFloat(qty).toFixed(0));


 if(!document.getElementById(element)){


           var arrayItem =LineArray.length;



      var line = '<tr id="'+element+'"><td class="text-center hidden-xs"><a href="#" onclick="javascript: erase_item('+arrayItem+'); del_tr(this);"><i style="color:red;" class="fa fa-minus"></i></a>&nbsp&nbsp'+id+'</td><td>'+item+' '+Lote+'</td><td class="text-center hidden-xs">'+qty+'</td></tr>';
              

              
      $( "#invoice" ).append( line );


          LineArray[LineArray.length] = id+"@"+qty+"@"+lote+'@'+ruta+'@'+caduc;

           }else{
          alert("Ya se han ingresado items del mismo lote.");
              }
        }


function del_tr(remtr)  {   
        while((remtr.nodeName.toLowerCase())!='tr')
              remtr = remtr.parentNode;
        remtr.parentNode.removeChild(remtr);
}
function del_id(id)  {   
          del_tr(document.getElementById(id));

}
function erase_item(line){
        
      LineArray[line]='';

          //alert(LineArray);
}

//FUNCION PARA GUARDAR ITEMS EN ARRAY 
function set_items(){

itemsArray.length ='';

var flag = ''; 
var theTbl = document.getElementById('modal_table'); //objeto de la tabla que contiene los datos de items
var line = '';
var l = '';

for(var i=1; i<theTbl.rows.length ;i++) //BLUCLE PARA LEER LINEA POR LINEA LA TABLA theTbl
{

  var idline = '';
  var cell1 = '';
  var taxfield = '';
  var qty = '';
  var cell ='';
  var iditem ='';
  var descitem = '';


  idline   = theTbl.rows[i].cells[3].innerHTML+theTbl.rows[i].cells[2].innerHTML;
  qty      = theTbl.rows[i].cells[2].innerHTML+theTbl.rows[i].cells[1].innerHTML+'qty';
  iditem   = document.getElementById('item_id_modal').value;
  descitem = document.getElementById('desc_id_modal').value;
  qty_val  = document.getElementById(qty).value;

console.log(qty);
console.log(qty_val);

  if(qty_val > 0){ //LEE SOLO LAS LINEAS CON CHECK. 

  l = 1 + l; //contador de registros
  
    for(var j=0;j<theTbl.rows[i].cells.length; j++) //BLUCLE PARA LEER CELDA POR CELDA DE CADA LINEA
        {       

                 switch (j){

                       case 1:
                            var   ruta=theTbl.rows[i].cells[j].innerHTML;
                              break;
                       case 2:
                            var   lote=theTbl.rows[i].cells[j].innerHTML;
                              break;
                       case 3:
                            var   max=theTbl.rows[i].cells[j].innerHTML;
                              break;
                       case 4:
                            var   qty=document.getElementById(qty).value;

                             if(qty_val==''){

                              alert('Se requiere indicar la cantidad para el lote: '+theTbl.rows[i].cells[3].innerHTML);
                              l='';
                              break;

                             }

                             break;

                             
                       case 5:
                            var  venc=theTbl.rows[i].cells[j].innerHTML;
                              break;
                       case 6:
                            var  taxable='';
                              break;
                 }


                   
           }//FIN BLUCLE PARA LEER CELDA POR CELDA DE CADA LINEA

        }

        
        //INSERTA valor de CELL en el arreglo 
        if (qty_val > 0 && l!=''){


            agregar_pro_sale_sale(iditem,descitem,'',lote,venc,ruta,max,qty_val);
             
            }
 
        

}//FIN BLUCLE PARA LEER LINEA POR LINEA DE LA TABLA 

  if(l!=''){

      $('#myModal').modal('hide');
  }


}
//modificacion rey 23/11

function valida_qty(max,qty,id){  

console.log('MAX:'+max+' Qty:'+qty);



if(qty!=''){

    var compare = (parseInt(max) >= parseInt(qty));

    if(!compare){

      alert('El valor de la cantidad no debe exceder la cantidad disponible en Stock');
     
       document.getElementById(id).value = '';

      return '0';

     }else{

      return '1';
     }

}

}
function send_sales_order(){

  if(LineArray!=''){

    var r = confirm("Desea enviar esta Orden ahora ?");
                

  if (r == true) {

    var arrLen = LineArray.length;
    var count= 1;

    var reasonToAdj = document.getElementById('reasonToAdj').value;
    var job=document.getElementById('jobs').value;
    var phase=document.getElementById('jobphase').value;
    var cost=document.getElementById('jobcost').value;  
    var jobinfo = job+';'+phase+';'+cost;
    
          
          
    URL = document.getElementById('URL').value;

  
  if(reasonToAdj){

         
      var link= URL+"index.php";


      //REGISTROS DE ITEMS 
        $.ajax({
         type: "GET",
         url:  link,
         data:  {url: 'bridge_query/set_sal_merc/', 
                 Data : JSON.stringify(LineArray), 
                 REASON : reasonToAdj.trim(),
                 JOB : jobinfo.trim()
               }, 
         success: function(res){
                             
          console.log(res);

          if(res!=''){//TERMINA EL LLAMADO AL METODO set_req_items SI ESTE DEVUELV UN '1', indica que ya no hay items en el array que procesar.
                  
             msg(link,res);
        
          }

           }
        });  
      //FIN REGISTROS DE ITEMS         
  
             }else{


              alert('Se deben llenar todos los campos');

             }

          } 
                
          
      }else{

        alert('Debe incluir al menos un Item en la orden');


      }

            
  }


function msg(link,SalesOrder){


          alert("La Salida de Mercancia se ha enviado con exito");
   
          var R = confirm('Desea imprimir el reporte ?');

        if(R==true){
     
         count = 1;
         LineArray.length='';
         window.open(link+'?url=ges_ventas/ges_print_SalMerc/'+SalesOrder,'_self');

          }else{

          count = 1;
          LineArray.length='';
          location.reload();

          }

          

        }




function send_data_sales(data){

 

                $.ajax({
                        type: 'POST',
                        url: 'form_query.php',
                        data: data,
                        dataType: 'html',   
                        success: function(res) {
//$("#prueba").append(res);

                

                        }
                    });


             }

</script>