function reviewNote(){

	var text = $('#contenido').html();
	$('#boxContent').html(text);

}

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


// CONTAR PALABRAS DE UN STRING -------

// textoArea = document.getElementById("area").value;

// primerBlanco = /^ /
// ultimoBlanco = / $/
// variosBlancos = /[ ]+/g

// texto = texto.replace (variosBlancos," ");
// texto = texto.replace (primerBlanco,"");
// texto = texto.replace (ultimoBlanco,"");
// textoTroceado = texto.split (texto, " ");
// numeroPalabras = textoTroceado.length;

$('[id=share-btn]').on('click', share);

function share(){

	var btnFB = document.getElementById('btn-FB');
	var btnTW = document.getElementById('btn-TW');
	var btnG = document.getElementById('btn-G');
	var btnWh = document.getElementById('btn-Wh');

	var id = $(this).data('id');

	btnFB.setAttribute('href','https://www.facebook.com/sharer/sharer.php?u=https://periodicoforever.000webhostapp.com/note.php?idP='+id);
	btnTW.setAttribute('href','https://twitter.com/?status= ¡Colabora! https://periodicoforever.000webhostapp.com/note.php?idP='+id);
	btnG.setAttribute('href','https://plus.google.com/share?url=https://periodicoforever.000webhostapp.com/note.php?idP='+id);
	btnWh.setAttribute('href','https://wa.me/?text=https://periodicoforever.000webhostapp.com/note.php?idP='+id);

	$('#share-modal').modal('show');

};


$('#comentar').on('click', comentar);

function comentar(){

	var content = document.getElementById('commentContent').value;
	var id = $(this).data('id');

	if (content != "") {
		$.ajax({
			type: 	'POST',
			url: 	'functions/comentar.php',
			data: 	{'content':content,'id':id}
			}).done(function(resp){

				var commentBox = $('#comments-body');

				commentBox.removeClass('comments');
				commentBox.addClass('comments_H');
				setTimeout(function(){
					commentBox.html(resp);
					commentBox.removeClass('comments_H');
					commentBox.addClass('comments');
					$('#commentContent').attr('style','');
					$('#commentContent').val("");
				},200);

			});
	} else {
		$('#commentContent').attr('style','border: 2px solid red;');
	}

};

$('[id=btn-reaction]').on('click', reaction);

function reaction(){

	var id = $(this).data('id');
	var type = $(this).data('type');

	$.ajax({
		type: 	'POST',
		url: 	'functions/reaction.php',
		data: 	{'id':id,'type':type},
		dataType: 'json',
		encode: true
	}).done(function(resp){
		$('[id=dislike'+id+']').html(resp.disl);
		$('[id=like'+id+']').html(resp.like);
	})

}

$('[id=del_comment]').on('click', deletec);

function deletec(){

	var idcomment = $(this).data('idc');
	var idbox = $(this).data('idbox');

	consulta('POST','functions/actions.php','idComment='+idcomment+'&typeAction=delComment',end);

	function end(){
		if (connection.readyState == 4){
			$('#box-'+idbox).html("<h4>Eliminado</h4>");
		}
	}

};

$('[id=delete_c]').on('click', deletec);

function deletec(){

	var idcomment = $(this).data('id');
	var idbox = $(this).data('idbox');

	consulta('POST','functions/actions.php','idComment='+idcomment+'&typeAction=delComment',end);

	function end(){
		if (connection.readyState == 4){
			$('#commentBox-'+idbox).html("<h4>Eliminado</h4>");
		}
	}

};

$('[id=report]').on('click',reportar);

function reportar(){
	var tipo = $(this).data('type');
	var id = $(this).data('id');
	var content = $('#content-report').val();

	if (content != "") {
		consulta('POST','functions/report.php','type='+tipo+'&id='+id+'&content='+content,end);

		function end(){
			if (connection.readyStte = 4) {
				$('#box-report').html('<h4 class="center-text">Tu reporte ha sido enviado con éxito, si es necesario nos pondremos en contacto contigo.</h4>');
				$('#content-report').val("");
				$('#report').addClass('hidden');
			}
		}
	} else {
		alert('No has llenado el campo de justificación');
	}
}


// ------------------------------------------------------- 

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

  consulta('POST','admin/functions/setNotes.php',"id=" + id+"&function=privacity",rec);

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