
$(document).ready(function(){
    let dropdown=$('#especialidad');
    dropdown.empty();
    dropdown.append('<option selected="true" disabled>Escoge la especialidad</option>');
    dropdown.prop('selectedIndex',0);
    var url="../../App/modelos/especialidad.php";
    $.getJSON(url,function(data){
        $.each(data,function(i,especialidad){
            dropdown.append($('<option></option>').attr('value',especialidad.id_especialidad).text(especialidad.nombre));
        });
    });
    dropdown.change(function(){
        doctores();
    })
});

$(document).ready(function(){
    let doc=$("#doctor");
    doc.change(function(){
        visibleButton();
    })
});

function visibleButton () {
    var buttonToShow = document.getElementById ("fecha_s");
    buttonToShow.style.visibility = "visible";
    } 

    function doctores(){
        $(document).ready(function(){
           $.ajax({
               type:"POST",
               url:"../../App/modelos/doctor.php",
               data:"medico="+$("#especialidad").val(),
               success:function(r){
                   $('#doctor').html(r);
                }
           })
       });
       }

$(document).ready(function(){
    $('#registrar').on("click",function(){
        var hora=$('#hora').val();
        var med=$('#medi').val();
        var esp=$('#espec').val();
        var fecha=$('#inicio').val();

        if(med===null){
            Swal.fire({
                icon:"error",
                title: 'Oops...',
                text: 'Debe seleccionar un medico' 
            });

        }else if( hora<7 || hora>19 ){
            Swal.fire({
                icon:"error",
                title: 'Oops...',
                text: 'Hora debe ser entre 07 y 19 ' 
            });
        }else if(!(/^\d{2}$/.test(hora))){
            Swal.fire({
                icon:"error",
                title: 'Oops...',
                text: 'si es 1 digito agrega el 0 adelante' 
            });
        }else{
            $.ajax({
                url:"../../App/Controladores/nuevaCita.php",
                type:"POST",
                data:{ 
                    esp:esp,
                    med:med,
                    fecha:fecha,
                    hora:hora
                },
                success:function(resp){
                    $("#resultado").html(resp);
                    $("#modalCita").modal('hide');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        locale:'es',
                        dateClick: function(info) {
                          
                            if(Date.parse(info.dateStr)<Date.parse(actual) || Date.parse(info.dateStr)===Date.parse(actual) ){
                                Swal.fire({
                                    icon:"error",
                                    title:"Oopss!",
                                    text:"La fecha no puede ser menor o igual a la actual"
                                });
                              }else{
                          
                          $('#modalCita').modal('show');
                          $('#medi').val($('#med').val());
                          $('#espec').val($('#especialidad').val());
                          $('#inicio').val(info.dateStr);     
                        }

                        },
                        eventClick:function(info){
                            
                            $("#informacion").modal('show');
                            
                            inf.innerHTML=info.event.title;
                            FechaInicio.innerHTML=info.event.start;
                            FechaFin.innerHTML=info.event.end;

                                        },
                        events:'../../App/modelos/citas.php'
                      });
                      calendar.render();
                 },
                 error:function(err,msg){
                     alert(msg);
                 }
            });
        } 
    });
});

