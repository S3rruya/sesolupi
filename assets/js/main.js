var urlatual = "https://pnd-2190.oiweb4.com/";
//var urlatual = "http://localhost/pnd-2190/";


function slideToggle(t,e,o){0===t.clientHeight?j(t,e,o,!0):j(t,e,o)}function slideUp(t,e,o){j(t,e,o)}function slideDown(t,e,o){j(t,e,o,!0)}function j(t,e,o,i){void 0===e&&(e=400),void 0===i&&(i=!1),t.style.overflow="hidden",i&&(t.style.display="block");var p,l=window.getComputedStyle(t),n=parseFloat(l.getPropertyValue("height")),a=parseFloat(l.getPropertyValue("padding-top")),s=parseFloat(l.getPropertyValue("padding-bottom")),r=parseFloat(l.getPropertyValue("margin-top")),d=parseFloat(l.getPropertyValue("margin-bottom")),g=n/e,y=a/e,m=s/e,u=r/e,h=d/e;window.requestAnimationFrame(function l(x){void 0===p&&(p=x);var f=x-p;i?(t.style.height=g*f+"px",t.style.paddingTop=y*f+"px",t.style.paddingBottom=m*f+"px",t.style.marginTop=u*f+"px",t.style.marginBottom=h*f+"px"):(t.style.height=n-g*f+"px",t.style.paddingTop=a-y*f+"px",t.style.paddingBottom=s-m*f+"px",t.style.marginTop=r-u*f+"px",t.style.marginBottom=d-h*f+"px"),f>=e?(t.style.height="",t.style.paddingTop="",t.style.paddingBottom="",t.style.marginTop="",t.style.marginBottom="",t.style.overflow="",i||(t.style.display="none"),"function"==typeof o&&o()):window.requestAnimationFrame(l)})}

let sidebarItems = document.querySelectorAll('.sidebar-item.has-sub');
for(var i = 0; i < sidebarItems.length; i++) {
    let sidebarItem = sidebarItems[i];
	sidebarItems[i].querySelector('.sidebar-link').addEventListener('click', function(e) {
        e.preventDefault();
        
        let submenu = sidebarItem.querySelector('.submenu');
        if( submenu.classList.contains('active') ) submenu.style.display = "block"

        if( submenu.style.display == "none" ) submenu.classList.add('active')
        else submenu.classList.remove('active')
        slideToggle(submenu, 300)
    })
}

window.addEventListener('DOMContentLoaded', (event) => {
    var w = window.innerWidth;
    if(w < 1200) {
        document.getElementById('sidebar').classList.remove('active');
    }
});
window.addEventListener('resize', (event) => {
    var w = window.innerWidth;
    if(w < 1200) {
        document.getElementById('sidebar').classList.remove('active');
    }else{
        document.getElementById('sidebar').classList.add('active');
    }
});

document.querySelector('.burger-btn').addEventListener('click', () => {
    document.getElementById('sidebar').classList.toggle('active');
})
document.querySelector('.sidebar-hide').addEventListener('click', () => {
    document.getElementById('sidebar').classList.toggle('active');

})


// Perfect Scrollbar Init
if(typeof PerfectScrollbar == 'function') {
    const container = document.querySelector(".sidebar-wrapper");
    const ps = new PerfectScrollbar(container, {
        wheelPropagation: false
    });
}

// Scroll into active sidebar
document.querySelector('.sidebar-item.active').scrollIntoView(false)

atualizalista_clientes();
function atualizalista_clientes() {
    $('#tabelaclientes').DataTable({
        "destroy": true,
        "processing":true,
        "responsive": true,
        "pageLength": 50,
        "order": [[0, "desc"]],
        "columnDefs": [ {
            'targets': [6], /* column index [0,1,2,3]*/
            'orderable': false, /* true or false */
        }],
        "ajax": {
           url: 'z-ajax.php?action=getclients',
           method: "GET",
           dataType: 'json',
           dataSrc: function (json) {
                if (!json.data) {
                    return [];
                } else {
                    return json.data;
                }
            },
           xhrFields: {
               withCredentials: true
           }
        },
      

        "columns": [
            { data: "codigo_cliente" },
            { data: "tipo" },
            { data: "nome" },
            { data: "tel_res" },
            { data: "tel_cel" },
            { data: "status"},
            { data: "action"},
            /*and so on, keep adding data elements here for all your columns.*/
        ],
        "dom": 'Bfrtip',
        "buttons": [{
            extend: 'print',
            "text": '<i class="fas fa-print"></i> Imprimir',
            exportOptions: {
                columns: [ 0,1,2,3,4,5 ]
            },
            customize: function ( win ) {
            $(win.document.body)
                .prepend('<img src="'+urlatual+'assets/images/logo/logo.png" style="width:80px; height:80px; float:left; top:0; left:0;" />');
            },
        }],
        "oLanguage": {
          "sProcessing":   "Processando...",
          "sLengthMenu":   "Mostrar  _MENU_ registros",
          "sZeroRecords":  "Não foram encontrados resultados",
          "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          "sInfoEmpty":    "",
          "sInfoFiltered": "",
          "sInfoPostFix":  "",
          "sSearch":       "Buscar: ",
          "sUrl":          "",
          "oPaginate": {
              "sFirst":    "Primeiro",
              "sPrevious": "Anterior",
              "sNext":     "Seguinte",
              "sLast":     "Último"
          }
      }
    }); 
}











$('#tabelamedicos').DataTable({
    "responsive": true,
    "pageLength": 50,
    "order": [[0, "desc"]],
    "columnDefs": [ {
        'targets': [6], /* column index [0,1,2,3]*/
        'orderable': false, /* true or false */
    }],
    "dom": 'Bfrtip',
    "buttons": [{
        extend: 'print',
        "text": '<i class="fas fa-print"></i> Imprimir',
        exportOptions: {
            columns: [ 0,1,2,3,4,5 ]
        },
        customize: function ( win ) {
        $(win.document.body)
            .prepend('<img src="'+urlatual+'assets/images/logo/logo.png" style="width:80px; height:80px; float:left; top:0; left:0;" />');
        },
    }],
    "oLanguage": {
      "sProcessing":   "Processando...",
      "sLengthMenu":   "Mostrar  _MENU_ registros",
      "sZeroRecords":  "Não foram encontrados resultados",
      "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
      "sInfoEmpty":    "",
      "sInfoFiltered": "",
      "sInfoPostFix":  "",
      "sSearch":       "Buscar: ",
      "sUrl":          "",
      "oPaginate": {
          "sFirst":    "Primeiro",
          "sPrevious": "Anterior",
          "sNext":     "Seguinte",
          "sLast":     "Último"
      }
  }
});    

$('#tabelausuarios').DataTable({
    "responsive": true,
    "pageLength": 50,
    "order": [[0, "desc"]],
    "columnDefs": [ {
        'targets': [5], /* column index [0,1,2,3]*/
        'orderable': false, /* true or false */
    }],
    "dom": 'Bfrtip',
    "buttons": [{
        extend: 'print',
        "text": '<i class="fas fa-print"></i> Imprimir',
        exportOptions: {
            columns: [ 0,1,2,3,4 ]
        },
        customize: function ( win ) {
        $(win.document.body)
            .prepend('<img src="'+urlatual+'assets/images/logo/logo.png" style="width:80px; height:80px; float:left; top:0; left:0;" />');
        },
    }],
    "oLanguage": {
      "sProcessing":   "Processando...",
      "sLengthMenu":   "Mostrar  _MENU_ registros",
      "sZeroRecords":  "Não foram encontrados resultados",
      "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
      "sInfoEmpty":    "",
      "sInfoFiltered": "",
      "sInfoPostFix":  "",
      "sSearch":       "Buscar: ",
      "sUrl":          "",
      "oPaginate": {
          "sFirst":    "Primeiro",
          "sPrevious": "Anterior",
          "sNext":     "Seguinte",
          "sLast":     "Último"
      }
  }
});  










jQuery( document ).ready(function() {



    

    $('#cep_cliente').live('focusout', function() {
            getEndereco();
    });
    $('#cep_declarante').live('focusout', function() {
            getEndereco2();
    });


    jQuery('.cartao').mask('0000 0000 0000 0000');
    jQuery('.cvv').mask('0000');
    jQuery('.mescartao').mask('00');
    jQuery('.anocartao').mask('0000');
    jQuery('.money2').mask("#.##0,00", {reverse: true});
    jQuery('.telefone').mask('(00)0000-00009');
    jQuery('.celular').mask('(00)0 0000-0000');
    jQuery('.cep').mask('00000-000');
    jQuery('.cpf').mask('000.000.000-00', {reverse: true});
    jQuery('.rg').mask('00.000.000-Z', {
    translation: {
      'Z': {
        pattern: /[A-Za-z0-9]/, 
        optional: true
      }
    }
  });



    //reload conteudo inferior
    jQuery(document).on('hide.bs.modal','.modal_back', function () {
        location.reload();
    });
    jQuery(document).on('click', '.modal_bt_back', function(){
        location.reload();
    });

    //encaminhando o usario para pagina
    jQuery(document).on('hide.bs.modal','.modal_redir', function () {
        //location.reload();
        var link = jQuery("#modalcode").attr("link");
        var link = jQuery("div.modal-header button").attr("link");
        window.location = link;
    });
    jQuery(document).on('click', '.modal_bt_redir', function(){
        //location.reload();
        var link = jQuery("#modalcode").attr("link");
        var link = jQuery("div.modal-header button").attr("link");
        window.location = link;
    });

    jQuery.validator.addMethod(
      "notEqualTo",
      function(elementValue,element,param) {
        return elementValue != param;
      },
      "Value cannot be {0}"
    );
}); //fecha geral - line133    



/* #27. MODAL*/
$(document).on('click', '.open_modal', function(){

    var mtype=$(this).attr("mtype");
    var print=$(this).attr("print");
    var id=$(this).attr("id");

    $.ajax({
        data: {
            action:'modalcontent',
            mtype:mtype,
            id:id
        },
        type: 'POST',
        url: 'z-ajax.php',
        beforeSend: function(){
            $('.modal-body').html('');
            var htmlText =  '<div class="retorno">' +
                            '<img src="assets/images/ajax-loader.gif" /> Processando...' +
                            '</div>';
            $('.modal-body').append(htmlText);
        },    
        success: function(data){                
            $.each(data, function(index) {
                var listo = data[index].return;
                $('.modal-title').html(data[index].titulo);

                $('#modalcode').modal('show');
                if(listo === 1){
                    $.get("includes/modal_template/"+mtype+".php?id="+id, function (data) {
                        $('.modal-body').html(data);
                    });
                }
                if(print == '1'){
                    jQuery("#btnPrint").removeClassStartingWith('printare');
                    jQuery("#btnPrint").attr("printarea",'printarea'+id);
                    jQuery("#btnPrint").addClass('printarea'+id);
                    $('.modal-footer').slideDown();
                }else{
                    $('.modal-footer').slideUp();
                }


            });
        },
        error: function (e){
            alert("deu erro");
        }
    }); 
    return false;
});   


$.fn.removeClassStartingWith = function (filter) {
    $(this).removeClass(function (index, className) {
        return (className.match(new RegExp("\\S*" + filter + "\\S*", 'g')) || []).join(' ')
    });
    return this;
};


// validação de formulario de CADASTRO DE USUARIOS
$(document).on("click", '.salvacadastro_cliente', function () {
    $('#form_cadastro_cliente').validate({
        rules: {
            tipo_cliente: {
                required: true
            },
            codigo_cliente: {
                required: true
            },
            nome_cliente: {
                required: true
            },
            data_nascimento_cliente: {
                required: true
            },
            estado_civil_cliente: {
                required: true
            },
            cpf_cliente: {
                required: true
            },
            rg_cliente: {
                required: true
            },
            cep_cliente: {
                required: true
            },
            endereco_cliente: {
                required: true
            },
            numero_cliente: {
                required: true
            },

            bairro_cliente: {
                required: true
            },
            cidade_cliente: {
                required: true
            },
            estado_cliente: {
                required: true
            },
            tel_res_cliente: {
                required: true,
                minlength: 5
            },
            tel_cel_cliente: {
                required: true,
                minlength: 5
            },
            email_cliente: {
                required: true
            },
            religiao_cliente: {
                required: true
            },
            adesao_cliente: {
                required: true
            },
            vencimento_cliente: {
                required: true
            },
        },
        onfocusout: function(element) {
            this.element(element);
        },
        highlight: function(input) {
            jQuery(input).addClass('error');
        },
        errorPlacement: function(error, element){},
        submitHandler: function(form) {
            var dadosformulario = jQuery( "#form_cadastro_cliente" ).serialize();
                jQuery.ajax({
                    url: 'z-ajax.php?action=cliente_novo',
                    type: 'POST',
                    dataType: 'json',
                    cache:  'false',
                    data: dadosformulario,
                beforeSend: function(){
                    jQuery('.formarea').slideUp();
                    var htmlText = '<div class="retorno">' +
                            '<img src="assets/images/ajax-loader.gif" /> ' +
                          '<span id="newConfirmation"> Aguarde processando...</span></div>';
                    $('.loadingform').append(htmlText);
                },
                success: function (obj){
                    jQuery('.retorno').slideUp();
                    //$('#modalcode').addClass('modal_back');
                    //$('div.modal-header button').addClass('modal_bt_back');
                    atualizalista_clientes();

                    var htmlconfirm = ' <div class="alert alert-success" role="alert"><strong>Tudo certo! </strong>Cadastro realizado.</div>';
                    $('.loadingform').html(htmlconfirm);
                },
                error: function (e){
                    jQuery('.retorno').slideUp();
                    var htmlconfirm = ' <div class="alert alert-danger" role="alert"><strong>Algo está errado! </strong>Ocorreu um erro no envio das informações. Revise se os campos necessários foram preencidos corretamente.</div>';                    
                    $('.loadingform').html(htmlconfirm);                    
                }
              });
            return false;
          }
        });
}); 

// validação de formulario de CADASTRO DE USUARIOS
$(document).on("click", '.salvaedicao_cliente', function () {
    $('#form_cliente_editar').validate({
        rules: {
            tipo_cliente: {
                required: true
            },
            codigo_cliente: {
                required: true
            },
            nome_cliente: {
                required: true
            },
            data_nascimento_cliente: {
                required: true
            },
            estado_civil_cliente: {
                required: true
            },
            cpf_cliente: {
                required: true
            },
            rg_cliente: {
                required: true
            },
            cep_cliente: {
                required: true
            },
            endereco_cliente: {
                required: true
            },
            numero_cliente: {
                required: true
            },
            bairro_cliente: {
                required: true
            },
            cidade_cliente: {
                required: true
            },
            estado_cliente: {
                required: true
            },
            tel_cel_cliente: {
                required: true
            },
            email_cliente: {
                required: true
            },
            religiao_cliente: {
                required: true
            },
            adesao_cliente: {
                required: true
            },
            vencimento_cliente: {
                required: true
            },
        },
        onfocusout: function(element) {
            this.element(element);
        },
        highlight: function(input) {
            jQuery(input).addClass('error');
        },
        errorPlacement: function(error, element){},
        submitHandler: function(form) {
            var dadosformulario = jQuery( "#form_cliente_editar" ).serialize();
                jQuery.ajax({
                    url: 'z-ajax.php?action=cliente_editar',
                    type: 'POST',
                    dataType: 'json',
                    cache:  'false',
                    data: dadosformulario,
                beforeSend: function(){
                    jQuery('.formarea').slideUp();
                    var htmlText = '<div class="retorno">' +
                            '<img src="assets/images/ajax-loader.gif" /> ' +
                          '<span id="newConfirmation"> Aguarde processando...</span></div>';
                    $('.loadingform').append(htmlText);
                },
                success: function (obj){
                    jQuery('.retorno').slideUp();
                    //adiciona class para que se fechado o modal atualiza a pagina
                    //$('#modalcode').addClass('modal_back');
                    //$('div.modal-header button').addClass('modal_bt_back');
                    atualizalista_clientes();

                    var htmlconfirm = ' <div class="alert alert-success" role="alert"><strong>Tudo certo! </strong>Dados foram atualizados.</div>';
                    $('.loadingform').html(htmlconfirm);
                },
                error: function (e){
                    jQuery('.retorno').slideUp();
                    var htmlconfirm = ' <div class="alert alert-danger" role="alert"><strong>Algo está errado! </strong>Verifique se tudo foi preenchido corretamente.</div>';                  
                    $('.loadingform').html(htmlconfirm);                    
                }
              });
            return false;
          }
        });
}); 









/***comeca aqui*/




// validação de formulario de CADASTRO DE USUARIOS
$(document).on("click", '.edit_financeiro', function () {

    var id=$(this).attr("id");
    //alert('oi'+id);

        $.ajax({
            data: {action:'formfinanceiro',id:id},
            type: 'POST',
            dataType: "html",
            url: 'z-ajax.php',

            beforeSend: function(){
                var htmlText =  '<div class="retorno">' +
                                '<img src="assets/images/ajax-loader.gif" /> Processando...' +
                                '</div>';
                //$('#areaload').append(htmlText);
                //$( '.mostrartreinamento' ).removeClass( "active" );
                //$( '#'+id ).addClass( " active " ); 
            },    
            success: function(data){                
                //$( ".areatoshow" ).slideDown( "slow", function() {
                  //  $('#areaload').hide();
                    $('#contenthere').html(data);
                //});

            }
        });
    return false;

});

// validação de formulario de CADASTRO DE USUARIOS
$(document).on("click", '.salva_financeiro', function () {
    $('#form_salva_financeiro').validate({
        rules: {
            nome_financeiro: {
                required: true
            },
            dt_nascimento_financeiro: {
                required: true
            },
            parentesco_financeiro: {
                required: true
            },
            dt_adesao_financeiro: {
                required: true
            }
        },
        onfocusout: function(element) {
            this.element(element);
        },
        highlight: function(input) {
            jQuery(input).addClass('error');
        },
        errorPlacement: function(error, element){},
        submitHandler: function(form) {
             $('#tabelafinanceiro').DataTable().ajax.reload();

            var dadosformulario = jQuery( "#form_salva_financeiro" ).serialize();
                jQuery.ajax({
                    url: 'z-ajax.php?action=salva_financeiro',
                    type: 'POST',
                    dataType: 'json',
                    cache:  'false',
                    data: dadosformulario,
                beforeSend: function(){
                   $('.loadingform_inmodal').html('');
                   // jQuery('.formarea_inmodal').slideUp();
                   jQuery( "#form_salva_financeiro" )[0].reset();
                    var htmlText = '<div class="retorno_inmodal">' +
                            '<img src="assets/images/ajax-loader.gif" /> ' +
                          '<span id="newConfirmation"> Aguarde processando...</span></div>';
                    $('.loadingform_inmodal').append(htmlText);
                },
                success: function (obj){
                    jQuery('.retorno_inmodal').slideUp();
                    //adiciona class para que se fechado o modal atualiza a pagina
                    $('#modalcode').addClass('modal_back');
                    $('div.modal-header button').addClass('modal_bt_back');
                    
                    var htmlconfirm = ' <div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Tudo certo! </strong>Dados foram atualizados.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    $('.loadingform_inmodal').html(htmlconfirm);


                    atualiza_financeiro();

                },
                error: function (e){
                    jQuery('.retorno').slideUp();
                    var htmlconfirm = ' <div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Algo está errado! </strong>Verifique se tudo foi preenchido corretamente. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';                  
                    $('.loadingform_inmodal').html(htmlconfirm);                    
                }
              });
            return false;
          }
    
        });
}); 






// validação de formulario de CADASTRO DE USUARIOS
$(document).on("click", '.salvaedicao_financeiro', function () {
    $('#form_salvaedicao_financeiro').validate({
        rules: {
            dt_pagamento: {
                required: true
            },
            valor_pagamento: {
                required: true
            },
            status_financeiro: {
                required: true
            },
        },
        onfocusout: function(element) {
            this.element(element);
        },
        highlight: function(input) {
            jQuery(input).addClass('error');
        },
        errorPlacement: function(error, element){},
        submitHandler: function(form) {
            var dadosformulario = jQuery( "#form_salvaedicao_financeiro" ).serialize();
                jQuery.ajax({
                    url: 'z-ajax.php?action=salvaedicao_financeiro',
                    type: 'POST',
                    dataType: 'json',
                    cache:  'false',
                    data: dadosformulario,
                beforeSend: function(){
                   $('.loadingform_inmodal').html('');
                   // jQuery('.formarea_inmodal').slideUp();
                   jQuery( "#form_salvaedicao_financeiro" )[0].reset();
                    var htmlText = '<div class="retorno_inmodal">' +
                            '<img src="assets/images/ajax-loader.gif" /> ' +
                          '<span id="newConfirmation"> Aguarde processando...</span></div>';
                    $('.loadingform_inmodal').append(htmlText);
                },
                success: function (obj){
                    jQuery('.retorno_inmodal').slideUp();
                    //adiciona class para que se fechado o modal atualiza a pagina
                    $('#modalcode').addClass('modal_back');
                    $('div.modal-header button').addClass('modal_bt_back');
                    
                    var htmlconfirm = ' <div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Tudo certo! </strong>Dados foram atualizados.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    $('.loadingform_inmodal').html(htmlconfirm);
                    
                    atualiza_financeiro();
                },
                error: function (e){
                    jQuery('.retorno').slideUp();
                    var htmlconfirm = ' <div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Algo está errado! </strong>Verifique se tudo foi preenchido corretamente. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';                  
                    $('.loadingform_inmodal').html(htmlconfirm);                    
                }
              });
            return false;
          }
    
        });
}); 

/****ate aqui**/


// validação de formulario de CADASTRO DE USUARIOS
$(document).on("click", '.edit_dependente', function () {
    var id=$(this).attr("id");
  //  alert('oi'+id);

        $.ajax({
            data: {action:'formdependente',id:id},
            type: 'POST',
            dataType: "html",
            url: 'z-ajax.php',

            beforeSend: function(){
                var htmlText =  '<div class="retorno">' +
                                '<img src="assets/images/ajax-loader.gif" /> Processando...' +
                                '</div>';
                //$('#areaload').append(htmlText);
                //$( '.mostrartreinamento' ).removeClass( "active" );
                //$( '#'+id ).addClass( " active " ); 
            },    
            success: function(data){                
                //$( ".areatoshow" ).slideDown( "slow", function() {
                  //  $('#areaload').hide();
                    $('#contenthere').html(data);
                //});

            }
        });
    return false;

});

// validação de formulario de CADASTRO DE USUARIOS
$(document).on("click", '.salva_dependente', function () {
    $('#form_salva_dependente').validate({
        rules: {
            nome_dependente: {
                required: true
            },
            cpf_dependente: {
                required: true
            },
            dt_nascimento_dependente: {
                required: true
            },
            parentesco_dependente: {
                required: true
            },
            dt_adesao_dependente: {
                required: true
            }
        },
        onfocusout: function(element) {
            this.element(element);
        },
        highlight: function(input) {
            jQuery(input).addClass('error');
        },
        errorPlacement: function(error, element){},
        submitHandler: function(form) {
             $('#tabeladependentes').DataTable().ajax.reload();

            var dadosformulario = jQuery( "#form_salva_dependente" ).serialize();
                jQuery.ajax({
                    url: 'z-ajax.php?action=salva_dependente',
                    type: 'POST',
                    dataType: 'json',
                    cache:  'false',
                    data: dadosformulario,
                beforeSend: function(){
                   $('.loadingform_inmodal').html('');
                   // jQuery('.formarea_inmodal').slideUp();
                   jQuery( "#form_salva_dependente" )[0].reset();
                    var htmlText = '<div class="retorno_inmodal">' +
                            '<img src="assets/images/ajax-loader.gif" /> ' +
                          '<span id="newConfirmation"> Aguarde processando...</span></div>';
                    $('.loadingform_inmodal').append(htmlText);
                },
                success: function (obj){
                    jQuery('.retorno_inmodal').slideUp();
                    //adiciona class para que se fechado o modal atualiza a pagina
                    $('#modalcode').addClass('modal_back');
                    $('div.modal-header button').addClass('modal_bt_back');
                    
                    var htmlconfirm = ' <div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Tudo certo! </strong>Dados foram atualizados.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    $('.loadingform_inmodal').html(htmlconfirm);


                    atualizalista();

                },
                error: function (e){
                    jQuery('.retorno').slideUp();
                    var htmlconfirm = ' <div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Algo está errado! </strong>Verifique se tudo foi preenchido corretamente. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';                  
                    $('.loadingform_inmodal').html(htmlconfirm);                    
                }
              });
            return false;
          }
    
        });
}); 






// validação de formulario de CADASTRO DE USUARIOS
$(document).on("click", '.salvaedicao_dependente', function () {
    $('#form_salvaedicao_dependente').validate({
        rules: {
            nome_dependente: {
                required: true
            },
            cpf_dependente: {
                required: true
            },
            dt_nascimento_dependente: {
                required: true
            },
            parentesco_dependente: {
                required: true
            },
            dt_adesao_dependente: {
                required: true
            }
        },
        onfocusout: function(element) {
            this.element(element);
        },
        highlight: function(input) {
            jQuery(input).addClass('error');
        },
        errorPlacement: function(error, element){},
        submitHandler: function(form) {
            var dadosformulario = jQuery( "#form_salvaedicao_dependente" ).serialize();
                jQuery.ajax({
                    url: 'z-ajax.php?action=salvaedicao_dependente',
                    type: 'POST',
                    dataType: 'json',
                    cache:  'false',
                    data: dadosformulario,
                beforeSend: function(){
                   $('.loadingform_inmodal').html('');
                   // jQuery('.formarea_inmodal').slideUp();
                   jQuery( "#form_salvaedicao_dependente" )[0].reset();
                    var htmlText = '<div class="retorno_inmodal">' +
                            '<img src="assets/images/ajax-loader.gif" /> ' +
                          '<span id="newConfirmation"> Aguarde processando...</span></div>';
                    $('.loadingform_inmodal').append(htmlText);
                },
                success: function (obj){
                    jQuery('.retorno_inmodal').slideUp();
                    //adiciona class para que se fechado o modal atualiza a pagina
                    $('#modalcode').addClass('modal_back');
                    $('div.modal-header button').addClass('modal_bt_back');
                    
                    var htmlconfirm = ' <div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Tudo certo! </strong>Dados foram atualizados.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    $('.loadingform_inmodal').html(htmlconfirm);
                    
                    atualizalista();
                },
                error: function (e){
                    jQuery('.retorno').slideUp();
                    var htmlconfirm = ' <div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Algo está errado! </strong>Verifique se tudo foi preenchido corretamente. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';                  
                    $('.loadingform_inmodal').html(htmlconfirm);                    
                }
              });
            return false;
          }
    
        });
}); 





// validação de formulario de CADASTRO DE MEDICO
$(document).on("click", '.salvacadastro_medico', function () {
    $('#form_cadastro_medico').validate({
        rules: {
            nome_medico: {
                required: true
            },
            telefone_medico: {
                required: true,
                minlength: 3
            },
            celular_medico: {
                required: true
            },
            especialidade_medico: {
                required: true
            },
        },
        onfocusout: function(element) {
            this.element(element);
        },
        highlight: function(input) {
            jQuery(input).addClass('error');
        },
        errorPlacement: function(error, element){},
        submitHandler: function(form) {
            var dadosformulario = jQuery( "#form_cadastro_medico" ).serialize();
                jQuery.ajax({
                    url: 'z-ajax.php?action=medico_novo',
                    type: 'POST',
                    dataType: 'json',
                    cache:  'false',
                    data: dadosformulario,
                beforeSend: function(){
                    jQuery('.formarea').slideUp();
                    var htmlText = '<div class="retorno">' +
                            '<img src="assets/images/ajax-loader.gif" /> ' +
                          '<span id="newConfirmation"> Aguarde processando...</span></div>';
                    $('.loadingform').append(htmlText);
                },
                success: function (obj){
                    jQuery('.retorno').slideUp();
                    $('#modalcode').addClass('modal_back');
                    $('div.modal-header button').addClass('modal_bt_back');

                    var htmlconfirm = ' <div class="alert alert-success" role="alert"><strong>Tudo certo! </strong>Cadastro realizado.</div>';
                    $('.loadingform').html(htmlconfirm);
                },
                error: function (e){
                    jQuery('.retorno').slideUp();
                    var htmlconfirm = ' <div class="alert alert-danger" role="alert"><strong>Algo está errado! </strong>Ocorreu um erro no envio das informações. Revise se os campos necessários foram preencidos corretamente.</div>';                    
                    $('.loadingform').html(htmlconfirm);                    
                }
              });
            return false;
          }
        });
}); 

// validação de formulario de CADASTRO DE MEDICO
$(document).on("click", '.salvaedicao_medico', function () {
    $('#form_medico_editar').validate({
        rules: {
            nome_medico: {
                required: true
            },
            telefone_medico: {
                required: true,
                minlength: 3
            },
            celular_medico: {
                required: true
            },
            especialidade_medico: {
                required: true
            },
        },
        onfocusout: function(element) {
            this.element(element);
        },
        highlight: function(input) {
            jQuery(input).addClass('error');
        },
        errorPlacement: function(error, element){},
        submitHandler: function(form) {
            var dadosformulario = jQuery( "#form_medico_editar" ).serialize();
                jQuery.ajax({
                    url: 'z-ajax.php?action=medico_editar',
                    type: 'POST',
                    dataType: 'json',
                    cache:  'false',
                    data: dadosformulario,
                beforeSend: function(){
                    jQuery('.formarea').slideUp();
                    var htmlText = '<div class="retorno">' +
                            '<img src="assets/images/ajax-loader.gif" /> ' +
                          '<span id="newConfirmation"> Aguarde processando...</span></div>';
                    $('.loadingform').append(htmlText);
                },
                success: function (obj){
                    jQuery('.retorno').slideUp();
                    //adiciona class para que se fechado o modal atualiza a pagina
                    $('#modalcode').addClass('modal_back');
                    $('div.modal-header button').addClass('modal_bt_back');
                    var htmlconfirm = ' <div class="alert alert-success" role="alert"><strong>Tudo certo! </strong>Dados foram atualizados.</div>';
                    $('.loadingform').html(htmlconfirm);
                },
                error: function (e){
                    jQuery('.retorno').slideUp();
                    var htmlconfirm = ' <div class="alert alert-danger" role="alert"><strong>Algo está errado! </strong>Verifique se tudo foi preenchido corretamente.</div>';                  
                    $('.loadingform').html(htmlconfirm);                    
                }
              });
            return false;
          }
    
        });
}); 







// validação de formulario de CADASTRO DE USUARIOS
$(document).on("click", '.salvacadastro_usuario', function () {
    $('#form_cadastro_usuario').validate({
        rules: {
            nome_usuario: {
                required: true
            },
            login_usuario: {
                required: true
            },
            senha_usuario: {
                required: true
            },
            email_usuario: {
                required: true
            },
            telefone_usuario: {
                required: true,
                minlength: 3
            },
            celular_usuario: {
                required: true
            },
        },
        onfocusout: function(element) {
            this.element(element);
        },
        highlight: function(input) {
            jQuery(input).addClass('error');
        },
        errorPlacement: function(error, element){},
        submitHandler: function(form) {
            var dadosformulario = jQuery( "#form_cadastro_usuario" ).serialize();
                jQuery.ajax({
                    url: 'z-ajax.php?action=usuario_novo',
                    type: 'POST',
                    dataType: 'json',
                    cache:  'false',
                    data: dadosformulario,
                beforeSend: function(){
                    jQuery('.formarea').slideUp();
                    var htmlText = '<div class="retorno">' +
                            '<img src="assets/images/ajax-loader.gif" /> ' +
                          '<span id="newConfirmation"> Aguarde processando...</span></div>';
                    $('.loadingform').append(htmlText);
                },
                success: function (obj){
                    jQuery('.retorno').slideUp();
                    $('#modalcode').addClass('modal_back');
                    $('div.modal-header button').addClass('modal_bt_back');

                    var htmlconfirm = ' <div class="alert alert-success" role="alert"><strong>Tudo certo! </strong>Cadastro realizado.</div>';
                    $('.loadingform').html(htmlconfirm);
                },
                error: function (e){
                    jQuery('.retorno').slideUp();
                    var htmlconfirm = ' <div class="alert alert-danger" role="alert"><strong>Algo está errado! </strong>Ocorreu um erro no envio das informações. Revise se os campos necessários foram preencidos corretamente.</div>';                    
                    $('.loadingform').html(htmlconfirm);                    
                }
              });
            return false;
          }
        });
}); 


$(document).on("click", '.medico_excluir', function () {
    var id=$(this).attr("idmedico");
    $.ajax({
        data: {action:'medico_excluir',id:id},
        type: 'POST',
        dataType: "html",
        url: 'z-ajax.php',

        beforeSend: function(){
            var htmlText =  '<div class="retorno">' +
                            '<img src="assets/images/ajax-loader.gif" /> Processando...' +
                            '</div>';
            //$('#areaload').append(htmlText);
            //$( '.mostrartreinamento' ).removeClass( "active" );
            //$( '#'+id ).addClass( " active " ); 
        },    
        success: function(data){          
            $('#modalcode').addClass('modal_back');
            $('div.modal-header button').addClass('modal_bt_back');              

            $('#contenthere').html(data);
        }
    });
    return false;

});

// validação de formulario de CADASTRO DE USUARIOS
$(document).on("click", '.salvaedicao_usuario', function () {
    $('#form_usuario_editar').validate({
        rules: {
            nome_usuario: {
                required: true
            },
            login_usuario: {
                required: true
            },
            senha_usuario: {
                required: true
            },
            email_usuario: {
                required: true
            },
            telefone_usuario: {
                required: true,
                minlength: 3
            },
            celular_usuario: {
                required: true
            },
        },
        onfocusout: function(element) {
            this.element(element);
        },
        highlight: function(input) {
            jQuery(input).addClass('error');
        },
        errorPlacement: function(error, element){},
        submitHandler: function(form) {
            var dadosformulario = jQuery( "#form_usuario_editar" ).serialize();
                jQuery.ajax({
                    url: 'z-ajax.php?action=usuario_editar',
                    type: 'POST',
                    dataType: 'json',
                    cache:  'false',
                    data: dadosformulario,
                beforeSend: function(){
                    jQuery('.formarea').slideUp();
                    var htmlText = '<div class="retorno">' +
                            '<img src="assets/images/ajax-loader.gif" /> ' +
                          '<span id="newConfirmation"> Aguarde processando...</span></div>';
                    $('.loadingform').append(htmlText);
                },
                success: function (obj){
                    jQuery('.retorno').slideUp();
                    //adiciona class para que se fechado o modal atualiza a pagina
                    $('#modalcode').addClass('modal_back');
                    $('div.modal-header button').addClass('modal_bt_back');
                    var htmlconfirm = ' <div class="alert alert-success" role="alert"><strong>Tudo certo! </strong>Dados foram atualizados.</div>';
                    $('.loadingform').html(htmlconfirm);
                },
                error: function (e){
                    jQuery('.retorno').slideUp();
                    var htmlconfirm = ' <div class="alert alert-danger" role="alert"><strong>Algo está errado! </strong>Verifique se tudo foi preenchido corretamente.</div>';                  
                    $('.loadingform').html(htmlconfirm);                    
                }
              });
            return false;
          }
    
        });
}); 


 
function getEndereco() {
    
    var cep_code = jQuery("#cep_cliente").val();
      if( cep_code.length <= 0 ) return;
      jQuery.get("https://apps.widenet.com.br/busca-cep/api/cep.json", { code: cep_code },
         function(result){
            //console.log(result.status);
            // if( result.status!=1 ){
            //    alert(result.message || "Houve um erro desconhecido");
            //    return;
            // }
            //jQuery("input#cep").val( result.code );
            jQuery("#estado_cliente").val( result.state );
            jQuery("#cidade_cliente").val( result.city );
            jQuery("#bairro_cliente").val( result.district );
            jQuery("#endereco_cliente").val( result.address );
            jQuery("#numero_cliente").focus();
         });
}

function getEndereco2() {
    
    var cep_code = jQuery("#cep_declarante").val();
      if( cep_code.length <= 0 ) return;
      jQuery.get("https://apps.widenet.com.br/busca-cep/api/cep.json", { code: cep_code },
         function(result){
            //console.log(result.status);
            // if( result.status!=1 ){
            //    alert(result.message || "Houve um erro desconhecido");
            //    return;
            // }
            //jQuery("input#cep").val( result.code );
            jQuery("#estado_declarante").val( result.state );
            jQuery("#cidade_declarante").val( result.city );
            jQuery("#bairro_declarante").val( result.district );
            jQuery("#endereco_declarante").val( result.address );
            jQuery("#numero_declarante").focus();
         });
}



    jQuery('#btnPrint').on("click", function () {
        var area=$(this).attr("printarea");
        //alert('print'+area);
      jQuery('#'+area).printThis({
       loadCSS: urlatual+"assets/css/print.css",
      });
    });


