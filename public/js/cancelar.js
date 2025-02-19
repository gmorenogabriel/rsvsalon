var fecha=new Date();
var actual=(fecha.getFullYear()+"-"+(fecha.getMonth()+1)+"-"+(fecha.getDate()));

var calendarEl = document.getElementById('CalendarioWeb');
var inf=document.getElementById('titulo');
var FechaInicio=document.getElementById('fechaI');
var FechaFin=document.getElementById('fechaF');
var FechaClick;
let id;

var calendar;

var calendar = new FullCalendar.Calendar(calendarEl, {
       initialView: 'dayGridMonth',
       locale:'es',
 eventClick:function(info){
  FechaClick=moment(info.event.start).format("YYYY-MM-DD");
  
  if(Date.parse(FechaClick)==Date.parse(actual) || Date.parse(actual)>Date.parse(FechaClick)){           
    Swal.fire({
        icon:"error",
        title:"Opps!..",
        text:"No se Puede Cancelar citas anteriores o actuales a la fecha"
    });

}else{
    
    $("#informacion").modal('show');
    inf.innerHTML=info.event.title;
    FechaInicio.innerHTML=info.event.start;
    FechaFin.innerHTML=info.event.end;   

    $("#Eliminar").on('click',function(event){
        event.preventDefault();
        Swal.fire({
            title:'Seguro de Eliminar Cita?',
            icon:'warning',
            showCancelButton:true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Si, eliminar!'
        }).then((result)=>{
            if(result.value){
               id=info.event.id;
               $.ajax({
        url:"../../App/Controladores/cancelarCita.php",
        type:"POST",
        data:{
            id:id,
        },
        success:function(resp){
            $("#resultado").html(resp);
          $('#informacion').modal('hide'); 
          recarga();
        },
        error:function(err,msg){
            alert(msg);
        }
        
      });
            }
        });
      });

    }

 },
 events:'../../App/modelos/citas.php'
     });
 calendar.render();

function recarga(){
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale:'es',
  eventClick:function(info){
   FechaClick=moment(info.event.start).format("YYYY-MM-DD");
   
   if(Date.parse(FechaClick)==Date.parse(actual) || Date.parse(actual)>Date.parse(FechaClick)){           
     Swal.fire({
         icon:"error",
         title:"Opps!..",
         text:"No se Puede Editar citas menores o actuales a la fecha"
     });
 
 }else{
 
 
     $("#informacion").modal('show');
     inf.innerHTML=info.event.title;
     FechaInicio.innerHTML=info.event.start;
     FechaFin.innerHTML=info.event.end;   
 
     $("#Eliminar").on('click',function(event){
   event.preventDefault();
   Swal.fire({
       title:'Seguro de Eliminar Cita?',
       icon:'warning',
       showCancelButton:true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       cancelButtonText: 'Cancelar',
       confirmButtonText: '¡Si, eliminar!'
   }).then((result)=>{
       if(result.value){
          id=info.event.id;
          $.ajax({
   url:"../../App/Controladores/cancelarCita.php",
   type:"POST",
   data:{
       id:id,
   },
   success:function(resp){
       $("#resultado").html(resp);
       $("#informacion").modal('hide');
       recarga();
   },
   error:function(err,msg){
       alert(msg);
   }
   
 });
       }
   });
 });
     }
 
  },
  events:'../../App/modelos/citas.php'
      });
  calendar.render();
    
}


document.addEventListener('DOMContentLoaded', function() {

    Swal.fire({
    icon:"info",
    title:"Cancelar Citas",
    text:"Para cancelar citas has click sobre una de ellas"    
});

});
