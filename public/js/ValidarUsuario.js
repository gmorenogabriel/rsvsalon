$(document).ready(function(){
    var modal2=document.getElementById('modelId');
    $('#cedula').on("change",function(){
        var cedula=$(this).val();
       
        if(!(/^\d{10}$/.test(cedula))){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Cedula deben ser 10 digitos'
              });
        }else{
            $.ajax({
                url:"./App/Controladores/comprobarcedula.php",
                type:"POST",
                data:{ cedula:cedula},
                success:function(respuesta){
                   $("#resultado").html(respuesta);
                },
                error:function(err,msg){
                    alert(msg);
                }
            })
        }
})
});
// $(document).ready(function(){
    // let dropdown=$('#sangre');
	// console.log('ValidarUsuarios document.ready #sangre');
    // dropdown.empty();
    // dropdown.append('<option selected="true" disabled>Escoge el tipo</option>');
    // dropdown.prop('selectedIndex',0);
    // var url="./App/modelos/tipoSangre.php";
    // $.getJSON(url,function(data){
        // $.each(data,function(i,sangre){
            // dropdown.append($('<option></option>').attr('value',sangre.id_tipo).text(sangre.tipo_sangre));
        // })
    // })
// })
$(document).ready(function(){
    $('#registrar').on("click",function(){
	console.log('ValidarUsuarios #registrar');
    let ced=$('#ced').val();
    let usuario=$('#usuario').val();
    // var sangre=$('#sangre').val();
    //var telefono=$('#telefono').val();
	//let telefono = parseInt($('#telefono').val(), 18); // convertir el valor a número
	let telefono = $('#telefono').val(); // Obtener el valor como string
    let correo=$('#correo').val();
	console.log('ValidarUsuario #registrar - ced: ', ced, ' - usuario:',usuario, ' - telefono', telefono, ' - correo: ', correo);
	
if( ced==null || usuario==null|| telefono==null || correo==null){
Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'No puede haber campos vacios'
  });
    }else if(!(/^\d{10}$/.test(ced))){
        Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'la cedula es de 10 digitos' 
});
    }else if(!(/^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i.test(correo))){
        Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'El correo tiene que ser: xxxx@xxxx.com' 
});
    }else if(telefono.length < 6 || telefono.length > 18){
        Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'Tu telefono tiene que estar entre 6 y 18' 
        });
    }else{
$.ajax({
    url:"./App/Controladores/registro.php",
    type:"POST",
    data:{ 
        ced:ced,
        usuario:usuario,
        // sangre:sangre,
        telefono:telefono,
        correo:correo
    },
    success:function(resp){
       $("#resultado2").html(resp);
       setTimeout (function(){window.location.reload(); },5000);
    },
    error:function(err,msg){
        alert(msg);
    }
});

}

});
});

function limpiar(){
    $('#ced').val("");

}

