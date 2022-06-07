var questionLlood = function () {
    var $totalCheck;
    var $idUser;
    var $comunidad;
    var $provincia;
    var $centro;
    var $categoria;
    var $area;
    var $atecion;
	var $atecion2;
    var $recordsTotal ;
    this.init = function(){
        $.ajax({
            url: 'backend/comprobar.php',
            type: 'POST',
            data:  {data : $idUser}  ,
            //url: 'assets/js/questions.json',
            async: false,
            success: function (resultadoAjax) {
                var question='';
                var cont = 0;
                $totalCheck = resultadoAjax.totalCheck;
                $recordsTotal = resultadoAjax.recordsTotal;
                var contGrupal = 0;
               $.each(resultadoAjax.data , function(indexData, valueData){
                   if(typeof valueData.questionGroup === 'undefined') {
                       question += '<fieldset data-question="'+cont+'" data-active="false">'+
                           '<h3 class="title"> <span class="num">  '+valueData.id+' </span>'+valueData.question+'</h3>'+
                           '<div class="form-group sectionAnswer answer-'+valueData.id+'" data-id="'+valueData.id+'" data-check="'+valueData.numCheck+'">';
                       $.each(valueData.answer , function(indexAnswer, valueAnswer){
                           question +=  '<p><input type="radio" name="'+indexData+'" value="'+indexAnswer+'"> <span> '+ valueAnswer+'</span></p>';
                       });
                       question += '</div></fieldset>';
                   } else {

                       question +='<fieldset data-question="'+cont+'" data-active="false" class="questionGroup">';
                       question +='<h3> <span class="num"> '+valueData.id+ ' </span>'+valueData.question+ '</h3>';
                       question +='<table class="table tableAnswer  tableAnswerLine" data-check="'+valueData.numCheck+'">';


                       $.each(valueData.questionGroup , function(indexGroup, valueGroup){
                           question +='<tr><td colspan="5" class="tdQ"><hr>'+valueGroup.question+'</td></tr>';
                           question+= '<tr>';
                           var contletter = 1;
                           $.each(valueData.answer , function(indexAnswer, valueAnswer){
                               if(valueData.id == 10 && valueGroup.idG != 8 && indexAnswer != 5) {

                                   question+='<td  class="input">';
                                   question += '<input type="radio" name="G'+contGrupal+'" value="'+indexAnswer+'">';
                                   question +='<span >'+valueData.options[contletter].text +'</span>';

                                   question+='</td>';
                               }
                               else if(valueData.id == 10 && valueGroup.idG != 8 && indexAnswer == 5) {


                               }
                               else {
                                   question+='<td  class="input yy"> ';
                                   question += '<input type="radio" name="G'+contGrupal+'" value="'+indexAnswer+'">';
                                   question +='<span >'+valueData.options[contletter].text +'</span></td>';

                               }
                               contletter++;

                           });
                           question +='</div></tr>';
                           contGrupal++;
                       });
                       question +='</table></div></fieldset>';
                   }
                   cont++;
               });

                $('.sectionQuestions').html(question);

                $('fieldset[data-question=0]').css('display','block');
                $('fieldset[data-question=0]').attr('data-active','true');
                var nunActive =  $("fieldset[data-active='true'] .sectionAnswer ").attr('data-id');
                $('.pag .info .recordsTotal').html(' / '+resultadoAjax.recordsTotal);

            },
            error: function (xhr, status) {
                $.ajax({
                    url: 'backend/comprobar.php',
                    data:  {data : $idUser}  ,
                    type: 'POST',
                    async: false,
                    success: function (resultadoAjax) {
                        var question='';
                        var cont = 0;
                        $totalCheck = resultadoAjax.totalCheck;
                        $recordsTotal = resultadoAjax.recordsTotal;
                        var contGrupal = 0;
                        $.each(resultadoAjax.data , function(indexData, valueData){
                            if(typeof valueData.questionGroup === 'undefined') {
                                question += '<fieldset data-question="'+cont+'" data-active="false">'+
                                    '<h3 class="title"> <span class="num">  '+valueData.id+' </span>'+valueData.question+'</h3>'+
                                    '<div class="form-group sectionAnswer answer-'+valueData.id+'" data-id="'+valueData.id+'" data-check="'+valueData.numCheck+'">';
                                $.each(valueData.answer , function(indexAnswer, valueAnswer){
                                    question +=  '<p><input type="radio" name="'+indexData+'" value="'+indexAnswer+'"> <span> '+ valueAnswer+'</span></p>';
                                });
                                question += '</div></fieldset>';
                            } else {

                                question +='<fieldset data-question="'+cont+'" data-active="false" class="questionGroup">';
                                question +='<h3> <span class="num"> '+valueData.id+ ' </span>'+valueData.question+ '</h3>';
                                question +='<div class="cont"> <table  class="table table-bordered tableinfo"><tr>';

                                $.each(valueData.options , function(indexOptions, valueOptions){
                                    question +='<td class="text-center"> <span>'+valueOptions.letter + "</span>"+ valueOptions.text+'</td>';
                                });

                                question +='</tr></table>';
                                question +='<table class="table tableAnswer" data-check="'+valueData.numCheck+'"><tr><td></td>';

                                $.each(valueData.options , function(indexOptions2, valueOptions2){
                                    question += '<td class="uppercase text-center">'+valueOptions2.letter +'</td>';
                                });

                                question += '</tr>';
                                $.each(valueData.questionGroup , function(indexGroup, valueGroup){
                                    question +='<tr><td>'+valueGroup.question+'</td>';
                                    $.each(valueData.answer , function(indexAnswer, valueAnswer){
                                        if(valueData.id == 10 && valueGroup.idG != 8 && indexAnswer != 5) {
                                            question+='<td class="input"> <input type="radio" name="G'+contGrupal+'" value="'+indexAnswer+'"></td>';
                                        }
                                        else if(valueData.id == 10 && valueGroup.idG != 8 && indexAnswer == 5) {
                                            question+='<td></td>';
                                        }
                                        else {
                                            question+='<td class="input yy"> <input type="radio" name="G'+contGrupal+'" value="'+indexAnswer+'"></td>';
                                        }
                                    });
                                    question +='</tr>';
                                    contGrupal++;
                                });
                                question +='</table></div></fieldset>';
                            }
                            cont++;
                        });

                        $('.sectionQuestions').html(question);

                        $('fieldset[data-question=0]').css('display','block');
                        $('fieldset[data-question=0]').attr('data-active','true');
                        var nunActive =  $("fieldset[data-active='true'] .sectionAnswer ").attr('data-id');
                        $('.pag .info .recordsTotal').html(' / '+resultadoAjax.recordsTotal);
                    },
                    error: function (xhr, status) {
                        $.ajax({
                            url: 'backend/comprobar.php',
                            data:  {data : $idUser}  ,
                            type: 'POST',
                            async: false,
                            success: function (resultadoAjax) {
                                var question='';
                                var cont = 0;
                                $totalCheck = resultadoAjax.totalCheck;
                                $recordsTotal = resultadoAjax.recordsTotal;
                                var contGrupal = 0;
                                $.each(resultadoAjax.data , function(indexData, valueData){
                                    if(typeof valueData.questionGroup === 'undefined') {
                                        question += '<fieldset data-question="'+cont+'" data-active="false">'+
                                            '<h3 class="title"> <span class="num">  '+valueData.id+' </span>'+valueData.question+'</h3>'+
                                            '<div class="form-group sectionAnswer answer-'+valueData.id+'" data-id="'+valueData.id+'" data-check="'+valueData.numCheck+'">';
                                        $.each(valueData.answer , function(indexAnswer, valueAnswer){
                                            question +=  '<p><input type="radio" name="'+indexData+'" value="'+indexAnswer+'"> <span> '+ valueAnswer+'</span></p>';
                                        });
                                        question += '</div></fieldset>';
                                    } else {

                                        question +='<fieldset data-question="'+cont+'" data-active="false" class="questionGroup">';
                                        question +='<h3> <span class="num"> '+valueData.id+ ' </span>'+valueData.question+ '</h3>';
                                        question +='<div class="cont"> <table  class="table table-bordered tableinfo"><tr>';

                                        $.each(valueData.options , function(indexOptions, valueOptions){
                                            question +='<td class="text-center"> <span>'+valueOptions.letter + "</span>"+ valueOptions.text+'</td>';
                                        });

                                        question +='</tr></table>';
                                        question +='<table class="table tableAnswer" data-check="'+valueData.numCheck+'"><tr><td></td>';

                                        $.each(valueData.options , function(indexOptions2, valueOptions2){
                                            question += '<td class="uppercase text-center">'+valueOptions2.letter +'</td>';
                                        });

                                        question += '</tr>';
                                        $.each(valueData.questionGroup , function(indexGroup, valueGroup){
                                            question +='<tr><td>'+valueGroup.question+'</td>';
                                            $.each(valueData.answer , function(indexAnswer, valueAnswer){
                                                if(valueData.id == 10 && valueGroup.idG != 8 && indexAnswer != 5) {
                                                    question+='<td class="input"> <input type="radio" name="G'+contGrupal+'" value="'+indexAnswer+'"></td>';
                                                }
                                                else if(valueData.id == 10 && valueGroup.idG != 8 && indexAnswer == 5) {
                                                    question+='<td></td>';
                                                }
                                                else {
                                                    question+='<td class="input yy"> <input type="radio" name="G'+contGrupal+'" value="'+indexAnswer+'"></td>';
                                                }

                                            });
                                            question +='</tr>';
                                            contGrupal++;
                                        });
                                        question +='</table></div></fieldset>';

                                    }
                                    cont++;
                                });

                                $('.sectionQuestions').html(question);

                                $('fieldset[data-question=0]').css('display','block');
                                $('fieldset[data-question=0]').attr('data-active','true');
                                var nunActive =  $("fieldset[data-active='true'] .sectionAnswer ").attr('data-id');
                                $('.pag .info .recordsTotal').html(' / '+resultadoAjax.recordsTotal);

                            },
                            error: function (xhr, status) {
                                if(xhr.responseJSON.message != null) {
                                    $message = xhr.responseJSON.message;
                                } else {
                                    $message = 'Intente acceder más tarde.';
                                }

                                var msg ='<div class="desp">'+
                                    $message+'<br> '+
                                    '</div>';
                                $('.indice').html('');
                                $('.sectionQuestions').removeClass('none').html(msg);
                            },
                        });
                    },
                });
            },
        });
    };
    this.cargarSelectComunidades = function(){
        $.ajax({
            url: 'assets/js/comunidades.json',
            async: false,
            success: function (resultadoAjax) {
                var options = '<option value="">Seleccione una comunidad</option>';
                $.each(resultadoAjax , function(indexData, valueData){
                    options +="<option value="+ valueData.id+" >"+valueData.nm +"</option>";

                });
                $('#comunidades').html(options);
            },
            error: function (xhr, status) { },
        });
    };
    this.cargarSelectProvincias = function(idComunidad){
        $.ajax({
            url: 'assets/js/provincias.json',
            async: false,
            success: function (resultadoAjax) {
                var options = '<option value="">Seleccione una provincia</option>';
                $.each(resultadoAjax , function(indexData, valueData){
                    if( idComunidad == valueData.id.substr(0, 2)){
                        options +="<option value="+ valueData.id+" data-value="+ valueData.value+">"+valueData.nm +"</option>";
                    }
                });
                $('#provincias').html(options);
            },
            error: function (xhr, status) { },
        });
    };
    this.cargarSelectCentros = function(idProvincia){
        $.ajax({
            url: 'assets/js/centros.json',
            async: false,
            success: function (resultadoAjax) {
                var options = '<option value="">Seleccione un centro</option>';
                $.each(resultadoAjax , function(indexData, valueData){
                    if( idProvincia == valueData.id.substr(0, 3)){
                        options +="<option value="+ valueData.value+" >"+valueData.nm +"</option>";
                    }
                });
                $('#centros').html(options);
            },
            error: function (xhr, status) { },

        });
    };
    this.cargarSelectCategory = function(idProvincia){
        $.ajax({
            url: 'assets/js/categoriasProfesionales.json',
            async: false,
            success: function (resultadoAjax) {
                var options = '<option value="">Seleccione una categoría</option>';
                $.each(resultadoAjax , function(indexData, valueData){
                        options +="<option value="+ valueData.value+" >"+valueData.nm +"</option>";
                });
                $('#categorias').html(options);
            },
            error: function (xhr, status) { },

        });
    };
    this.cargarSelectAreas = function(idProvincia){
        $.ajax({
            url: 'assets/js/areasOperativas.json',
            async: false,
            success: function (resultadoAjax) {
                var options = '<option value="">Seleccione una área</option>';
                $.each(resultadoAjax , function(indexData, valueData){
                    options +="<option value="+ valueData.value+" >"+valueData.nm +"</option>";
                });
                $('#areas').html(options);
            },
            error: function (xhr, status) { },
        });
    };
    this.cargarSelectAtencion = function(idProvincia){
        $.ajax({
            url: 'assets/js/atencionPublico.json',
            async: false,
            success: function (resultadoAjax) {
                var options = '<option value="">Seleccione una opción</option>';
                $.each(resultadoAjax , function(indexData, valueData){
                    options +="<option value="+ valueData.value+" >"+valueData.nm +"</option>";
                });
                $('#atencion').html(options);
            },
            error: function (xhr, status) { },

        });
    };
	this.cargarSelectAtencion2 = function(idProvincia){
        $.ajax({
            url: 'assets/js/atencionPublico2.json',
            async: false,
            success: function (resultadoAjax) {
                var options = '<option value="">Seleccione una opción</option>';
                $.each(resultadoAjax , function(indexData, valueData){
                    options +="<option value="+ valueData.value+" >"+valueData.nm +"</option>";
                });
                $('#atencion').html(options);
            },
            error: function (xhr, status) { },

        });
    };

/*------------------------------------------------------------------*/

$("body").on('click', '.prev', function(){
    $questionId = $("fieldset[data-active='true']").attr('data-question');
    $newId = parseInt($questionId) - 1;
    $("fieldset[data-active='true']").attr('data-active', 'false').css('display', 'none');
    $("fieldset[data-question='"+$newId+"']").attr('data-active', 'true').css('display', 'block');
    var text = $('.questionActual').text();
    $('.questionActual').html(parseInt(text)-1);

    if($newId == 0) {
        $(this).css('display', 'none');
    } else {
        if($newId > 0) {
            $('.next').css('display', 'inline-block');
        }
        $(this).css('display', 'inline-block');
    }
    $(".sectionAnswer p input:checked").parent('p').addClass('active');
    $('.formTest .msg').html(" ");

});

/*------------------------------------------------------------------*/

$("body").on('click', '.next', function(){

    var id =  $("fieldset[data-active='true']").find('.sectionAnswer').attr('data-id');
    var check =  $("fieldset[data-active='true']").find('.sectionAnswer').attr('data-check');
    var checkG =  $("fieldset[data-active='true']").find('.table[data-check]').attr("data-check");
    var n = $( ".answer-"+id+" input:checked" ).length;
    var y = $( "fieldset[data-active='true'] .table input:checked" ).length;

    if( check ==1){
        if(n == 0 ){
            var msg ='<div class="alert alert-danger alert-dismissable fade in">'+
                '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+
                ' Debes marcar una respuesta para continuar'+
                '</div>';
            $('.formTest .msg').html(msg);

        }else{

            $questionId = $("fieldset[data-active='true']").attr('data-question');
            $newId = parseInt($questionId) + 1;
            $("fieldset[data-active='true']").attr('data-active', 'false').css('display', 'none');
            $("fieldset[data-question='"+$newId+"']").attr('data-active', 'true').css('display', 'block');
            var text = $('.questionActual').text();
            $('.questionActual').html(parseInt(text)+1);
            $('.formTest .msg').html("");
            var top = $('.sectionQuestions').offset().top-50;
            window.scrollTo(0, top);

            if($newId == 43) {
                $(this).css('display', 'none');
            } else {
                if($newId > 0) {
                    $('.prev').css('display', 'inline-block');
                }
                $(this).css('display', 'inline-block');
            }

            if($("fieldset[data-active='true']").attr('data-question') == 0){
                $('.pag .prev').addClass('none');
            }else{$('.pag .prev').removeClass('none');}
        }
    }else{

        if(y != checkG ){
            var msg ='<div class="alert alert-danger alert-dismissable fade in">'+
                '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+
                '<strong>*</strong> Debes marcar una respuesta para continuar'+
                '</div>';
            $('.formTest .msg').html(msg);

        }else{

            $questionId = $("fieldset[data-active='true']").attr('data-question');
            $newId = parseInt($questionId) + 1;
            $("fieldset[data-active='true']").attr('data-active', 'false').css('display', 'none');
            $("fieldset[data-question='"+$newId+"']").attr('data-active', 'true').css('display', 'block');
            var text = $('.questionActual').text();
            $('.questionActual').html(parseInt(text)+1);
            $('.formTest .msg').html("");
            var top = $('.sectionQuestions').offset().top-50;
            window.scrollTo(0, top);

            if($newId == 43) {
                $(this).css('display', 'none');
            } else {
                if($newId > 0) {
                    $('.prev').css('display', 'inline-block');
                }
                $(this).css('display', 'inline-block');
            }
        }
    }
    $(" p input:checked").parent('p').addClass('active');

    $questionId = $('input:checked');

    if( ($questionId.length +1) == $totalCheck){
        $('.finish').removeClass('none');
        $('.form-box').removeClass('fondo');
    }
});

/*------------------------------------------------------------------*/

$("body").on('click', '.sectionAnswer p', function(){
    $('.sectionAnswer p').removeClass('active');
    $(this).addClass('active');
    $(this).find('input').prop("checked", true);

});

/*------------------------------------------------------------------*/

$("body").on('click', '.contGroup .sectionAnswer p', function(){
    $(this).addClass('active');
    $(this).find('input').prop("checked", true);

});

/*------------------------------------------------------------------*/

    $("body").on('click', '.tableAnswerLine tr td', function(){
        
        $(this).find('input').prop("checked", true);

    });
/*------------------------------------------------------------------*/

$("body").on('click', '.init .btn', function(){
    $('.welcome .cargando .content').removeClass('none');

    $('.welcome').addClass('none');
    var url = window.location.href;
    var res = url.split("/");
    var $rec = res[res.length-1];
    var num = $rec.split("=");
    var $idUrl = num[num.length-1];

     $idUser =$idUrl;

    $questionLlood.init();
    $questionLlood.cargarSelectComunidades();
    $questionLlood.cargarSelectCategory();
    $questionLlood.cargarSelectAreas();
    $questionLlood.cargarSelectAtencion();
    $questionLlood.cargarSelectAtencion2();
    $('.indice').removeClass('none');
    $('.formHeader').removeClass('none');

});

/*------------------------------------------------------------------*/

  $("body").on('click', '.continueIndice', function(){
        $('.select').removeClass('none');
        $('.indice').addClass('none');

    });
/*------------------------------------------------------------------*/

$("body").on('click', '.continueSelect', function(){
    var select = $(".contSelect select");
    var contSelect = 0;
    $.each(select, function(index, value){
       if($(this).val() != '') {
           contSelect++;
       }
    });


    if ( contSelect < select.length ) {
        $('.continueSelect').addClass('disabled');
    }else{

        $('.pag').removeClass('none');
        $('.sectionQuestions').removeClass('none');
        $('.select').addClass('none');
        $('.form-box').addClass('fondo');


        $comunidad =$('#comunidades').val();
        $provincia =  $("#provincias option:checked").attr('data-value');
        $centro =$('#centros').val();
        $categoria =  $('#categorias').val();
        $area = $('#areas').val();
        $atecion = $('#atencion').val();
    }
});
/*---------------------------------------------------------------*/
    $('.contSelect select').on('change', function(){


        var select = $(".contSelect select");
        var contSelect = 0;
        $.each(select, function(index, value){
            if($(this).val() == '') {
                $('.continueSelect').addClass('disabled');
            } else {
                contSelect++;
            }
        });

        if(contSelect == select.length) {
            $('.continueSelect').removeClass('disabled');
        }

    });
/*------------------------------------------------------------------*/
$("body").on('change', '#comunidades', function(){
    var idComunidad =$(this).val();
    $questionLlood.cargarSelectProvincias(idComunidad);

});

/*-----------------------------------------------------------------*/
$("body").on('change', '#provincias', function(){
    var idProvincia =$(this).val();
    $questionLlood.cargarSelectCentros(idProvincia);
});


/*------------------------------------------------------------------*/
$("body").on('click', '.finish .btn', function(){


    var id =  $("fieldset[data-active='true']").find('.sectionAnswer').attr('data-id');
    var n = $( ".answer-"+id+" input:checked" ).length;
    if(n == 0 ){
        var msg ='<div class="alert alert-danger alert-dismissable fade in">'+
            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+
            ' Debes marcar una respuesta para continuar'+
            '</div>';
        $('.formTest .msg').html(msg);

    }else{

        $('.pag').addClass('none');
        var elemento = this;
        $(elemento).addClass('none');

        var arrayData = [];
        $.each($('input:checked'), function (index, value) {
            arrayData.push(value.value);
        });
        var userdata = [$idUser,$comunidad,$provincia,$centro,$categoria, $area,$atecion];

        $.each(userdata, function (index, value) {
            arrayData.push(value);
        });

        // $idUser + $comunidad + $provincia + $centro + $categoria+ $area + $atecion + arrayData

        var jsonString = JSON.stringify(arrayData);
        $.ajax({
            type: "POST",
            url: 'backend/guardar.php',
            data:  {data : jsonString}  , //arrayData
            success: function (resultado) {
                var msgSucces ='<div class="desp">'+
                    'Gracias por su colaboración, el cuestionario ha finalizado correctamente<br> '+
                    '</div>';
                $('.sectionQuestions').html(msgSucces);

            },error: function (xhr, status) {
                $.ajax({
                    type: "POST",
                    url: 'backend/guardar.php',
                    data:  {data : jsonString}  , //arrayData
                    success: function (resultado) {
                        var msgSucces ='<div class="desp">'+
                            'Gracias por su colaboración, el cuestionario ha finalizado correctamente<br> '+
                            '</div>';
                        $('.sectionQuestions').html(msgSucces);
                    },error: function (xhr, status) {
                        $.ajax({
                            type: "POST",
                            url: 'backend/guardar.php',
                            data:  {data : jsonString}  , //arrayData
                            success: function (resultado) {
                                var msgSucces ='<div class="desp">'+
                                    'Gracias por su colaboración, el cuestionario ha finalizado correctamente<br> '+
                                    '</div>';
                                $('.sectionQuestions').html(msgSucces);
                            },error: function (xhr, status) {
                                var msg ='<div class="alert alert-danger alert-dismissable fade in">'+
                                    '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+
                                    ' Vuelva a intentar pulsar el botón de finalizar más tarde'+
                                    '</div>';
                                $('.formTest .msg').html(msg);
                                $('.pag').removeClass('none');
                                $(elemento).removeClass('none');
                            }
                        });
                    }
                });
            }
        });

    }
});

};
var $questionLlood = new questionLlood();


