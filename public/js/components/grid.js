$.extend( $.fn.dataTableExt.oStdClasses, {
    "sWrapper": "dataTables_wrapper form-inline"
} );

/* API method to get paging information */
$.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
{
    return {
        "iStart":         oSettings._iDisplayStart,
        "iEnd":           oSettings.fnDisplayEnd(),
        "iLength":        oSettings._iDisplayLength,
        "iTotal":         oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage":          Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
        "iTotalPages":    Math.ceil( oSettings.fnRecordsTotal() / oSettings._iDisplayLength )
    };
}

/* Bootstrap style pagination control */
$.extend( $.fn.dataTableExt.oPagination, {
    "bootstrap": {
        "fnInit": function( oSettings, nPaging, fnDraw ) {
            var oLang = oSettings.oLanguage.oPaginate;
            var fnClickHandler = function ( e ) {
                e.preventDefault();
                if ( oSettings.oApi._fnPageChange(oSettings, e.data.action) ) {
                    fnDraw( oSettings );
                }
            };

            $(nPaging).addClass('pagination').append(
                '<ul>'+
                    '<li class="prev disabled"><a href="#">&larr; '+oLang.sPrevious+'</a></li>'+
                    '<li class="next disabled"><a href="#">'+oLang.sNext+' &rarr; </a></li>'+
                '</ul>'
            );
            var els = $('a', nPaging);
            $(els[0]).bind( 'click.DT', { action: "previous" }, fnClickHandler );
            $(els[1]).bind( 'click.DT', { action: "next" }, fnClickHandler );
        },

        "fnUpdate": function ( oSettings, fnDraw ) {
            var oPaging = oSettings.oInstance.fnPagingInfo();
            var iListLength = oPaging.iLength;
            var an = oSettings.aanFeatures.p;
            var i, j, sClass, iStart, iEnd, iHalf=Math.floor(iListLength/2);

            if ( oPaging.iTotalPages < iListLength) {
                iStart = 1;
                iEnd = oPaging.iTotalPages;
            }
            else if ( oPaging.iPage <= iHalf ) {
                iStart = 1;
                iEnd = iListLength;
            } else if ( oPaging.iPage >= (oPaging.iTotalPages-iHalf) ) {
                iStart = oPaging.iTotalPages - iListLength + 1;
                iEnd = oPaging.iTotalPages;
            } else {
                iStart = oPaging.iPage - iHalf + 1;
                iEnd = iStart + iListLength - 1;
            }

            for ( i=0, iLen=an.length ; i<iLen ; i++ ) {
                // Remove the middle elements
                $('li:gt(0)', an[i]).filter(':not(:last)').remove();

                // Add the new list items and their event handlers
                for ( j=iStart ; j<=iEnd ; j++ ) {
                    sClass = (j==oPaging.iPage+1) ? 'class="active"' : '';
                    $('<li '+sClass+'><a href="#">'+j+'</a></li>')
                    .insertBefore( $('li:last', an[i])[0] )
                    .bind('click', function (e) {
                        e.preventDefault();
                        oSettings._iDisplayStart = (parseInt($('a', this).text(),10)-1) * oPaging.iLength;
                        fnDraw( oSettings );
                    } );
                }

                // Add / remove disabled classes from the static elements
                if ( oPaging.iPage === 0 ) {
                    $('li:first', an[i]).addClass('disabled');
                } else {
                    $('li:first', an[i]).removeClass('disabled');
                }

                if ( oPaging.iPage === oPaging.iTotalPages-1 || oPaging.iTotalPages === 0 ) {
                    $('li:last', an[i]).addClass('disabled');
                } else {
                    $('li:last', an[i]).removeClass('disabled');
                }
            }
        }
    }
} );

$.extend($.fn.dataTableExt.oStdClasses,
    {
        "sSortAsc": "header headerSortDown",
        "sSortDesc": "header headerSortUp",
        "sSortable": "header"
    }
);

var grid = {
    opcoes:function(form){
        var url = form.attr('action')+'?'+ form.serialize();
        return {
        "bProcessing": true,
        "bServerSide": true,
        'bRetrieve':true,
        "sPaginationType": "bootstrap",
        'iDisplayLength': 10,
        "sAjaxSource": url ,  
        "sDom": "<'row-fluid'<'span6'><'span6'l>r>t<'row-fluid'<'span6'i><'span6'p>>",
        "oLanguage": {
                "sProcessing":   "Processando...",
                "sLengthMenu":   "Registros por página _MENU_",
                "sZeroRecords":  "Nenhum registro encontrado.",
                "sInfo":         "Mostrando de _START_ até _PAGINADO_ registros.",
                "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
                "sInfoFiltered": "Filtrado de _MAX_ registros no total.",
                "sInfoPostFix":  "",
                "sSearch":       "Buscar:",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "Primeiro",
                    "sPrevious": "Anterior",
                    "sNext":     "Seguinte",
                    "sLast":     "Último"
                }
            }
        }
    },
    carrega:function (table,form){
        table.addClass('table')
        .addClass('table-striped')
        .addClass('table-bordered')
        .dataTable(grid.opcoes(form));
        if (typeof form === 'object') {
            form.unbind('submit').bind('submit', function(){
                table.parents('.hidden').removeClass('hidden');
                $('.alert').css('display', 'none');
                table.fnDraw(false);

                return false;
            });
        } else {
            table.unbind('submit').bind('submit', function() {
                table.fnDraw(false);
                return false;
            });
        }
    }
}