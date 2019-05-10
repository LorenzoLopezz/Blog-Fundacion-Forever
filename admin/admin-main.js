$('[name=btnUserAction]').tooltip('enable');

$('[name=btnNoteAction]').tooltip('enable');

//---------------------------------------------------------------------------

function consulta(tipo,url,data,done) 
{

  // De esta forma se obtiene la instancia del objeto XMLHttpRequest
  if(window.XMLHttpRequest) 
  {
    connection = new XMLHttpRequest();
  }
  else if(window.ActiveXObject) 
  {
    connection = new ActiveXObject("Microsoft.XMLHTTP");
  }

  // Preparando la función de respuesta
  connection.onreadystatechange = done;

  // Realizando la petición HTTP con método POST
  connection.open(tipo, url);
  connection.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  connection.send(data);
}

//---------------------------------------------------------------------------

$('[id=setNote]').on('click', setState);

function setState()
{

  var id = $(this).data('id');

  consulta('POST','functions/setNotes.php',"id=" + id+"&function=privacity",rec);

  function rec()
  {
    var resp = JSON.parse(connection.responseText);

    $('#body').html('<p class="mar-0">'+resp['ok']+'</p>');
    $('#modalBtns').html('<button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button');

    $('#detailsModal').modal('show');

    var ident = resp.ide;
    var icon = resp.icon;
    $('[id=lockType'+ident+']').html(icon);
  }
}

//---------------------------------------------------------------------------

// DELETE NOTE

$('[id=delNote]').on('click', delNotePer);

function delNotePer()
{
  var id = $(this).data('id');

    $('#modalTitle').html('¿Eliminar ésta nota?');
    $('#body').html('No se podrán revertir los cambios...');
    $('#modalBtns').html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button><button type="button" class="btn btn-primary" data-dismiss="modal" onclick="delNote('+id+')">Aceptar</button>');

    $('#detailsModal').modal('show');
}

function delNote(id)
{

  consulta('POST','functions/setNotes.php',"id=" +id+"&function=delete",del);

  function del()
  {
    if(connection.readyState == 4) 
    {

      $('#modalTitle').html('');
      $('#body').html('');
      $('#modalBtns').html('');

      var resp = JSON.parse(connection.responseText);

      var id = resp.ide;

      $('#content_Target'+id).html('<div class="col-12" style="text-align:center;"><div style="margin:200px 0px;">Deleted</div></div>');
    };
  };
};

//--------------------------------------------------------------

// UPGRADE USER

$('[id=showPanelUpgrade]').on('click', showPanelUpgrade);

function showPanelUpgrade() 
{

  var idU = $(this).data('iduser');
  var idR = $(this).data('idrole');

  consulta('POST','functions/userSettings.php','iduser='+idU+'&idrole='+idR+'&funcion=getRoles',rec);

  function rec()
  {
    if(connection.readyState == 4) 
    {
      var resp = connection.responseText;
      $('#body-panel').html(resp);
    }
  }

  $('#detailsModal').modal('show');
};

function upgradeUser(idu,idr)
{
  consulta('POST','functions/userSettings.php','iduser='+idu+'&idrole='+idr+'&funcion=upgrade',rec);

  function rec()
  {
    if(connection.readyState == 4) 
    {
      var resp = connection.responseText;
      $('#roleAsign'+idu).html(resp);
      $('#body-panel').html('<p class="text-center mar-0">Se ha realizado el cambio</p>');
      $('#modalBtns').html('<button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>');
    }
  };
}

//--------------------------------------------------------------

// LOCK USER

$('[id=lock-button]').on('click', showlockfunction);

function showlockfunction(){
  var idU = $(this).data('iduser');
  var idR = $(this).data('idrole');
  var state = $(this).data('state');

  if (state != "inactive") {

    $('#detailsModal-lock').modal('show');

    $('#comprobar').attr('data-iduser',idU);
    $('#comprobar').attr('data-idrole',idR);
    $('#comprobar').attr('data-state',state);

  } else {
    lockfunction(idU,idR,'1');
  }
}

function comprobar(){
    var idU = $('#comprobar').data('iduser');
    var idR = $('#comprobar').data('idrole');

    var campo = $('#razon').val();

    if (campo === "") {
      alert("Llena el campo");
    } else {
      lockfunction(idU,idR,'0');
    }
}

function lockfunction(idU,idR,tipo){

  if (tipo === "1") {
    consulta('POST','functions/userSettings.php','iduser='+idU+'&idrole='+idR+'&funcion=unlock',style);
  } else {
    var campo = $('#razon').val();
    $('#detailsModal-lock').modal('toggle');
    consulta('POST','functions/userSettings.php','iduser='+idU+'&idrole='+idR+'&funcion=lock&razon='+campo,style);
    $('#razon').val('');
  }

  function style(){

    if(connection.readyState == 4) 
    {
      var resp = JSON.parse(connection.responseText);
      $('#box-user-'+idU).removeClass(resp.a);
      $('#box-user-'+idU).addClass(resp.b);

      $('#body-panel').html('<p class="mar-0 text-center">'+resp.c+'</p>');
      $('#modalBtns').html('<button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>');
      $('#detailsModal').modal('show');

      $('#comprobar').attr('data-iduser',"");
      $('#comprobar').attr('data-idrole',"");
      $('#comprobar').attr('data-state',"");
    }
    
  };
}

//--------------------------------------------------------------
// ELIMINAR USUARIO --------------------------------------------

$('[id=delete_user]').on('click', deleteUser);

function deleteUser(){
  var idU = $(this).data('iduser');

  consulta('POST', 'functions/userSettings.php','iduser='+idU+'&idrole=0&funcion=delete',deleted);

  function deleted(){
    if (connection.readyState == 4) {
      var resp = JSON.parse(connection.responseText);
      $('#box-user-'+idU).html(resp.a);
    }
  }
}