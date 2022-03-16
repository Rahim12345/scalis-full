$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    fotoLoader();
    $( '#image' ).change( function ( event ) {
        $('#imageProgress').css('display','flex');
        var property = document.getElementById('foto-form');
        var form_data = new FormData(property);
        $.ajax({
            type : 'POST',
            data : form_data,
            url  : $('#foto-form').attr('action'),
            cache: false,
            processData: false,
            contentType: false,
            success : function (response) {
                toastr.success(response);
                fotoLoader();
            },
            error : function (myErrors) {
                $.each(myErrors.responseJSON.errors, function (key, error) {
                    toastr.error(error);
                });
            }
        });
        $('#imageProgress').css('display','none');
    } );

    function fotoLoader() {
        $.ajax({
            type    : 'GET',
            url     : '/admin/back-foto',
            success : function (response) {
                let output = '';
                response = chunk(response, 3);
                let cavab = 'Silmək istədiyinizdən əminsiniz?';
                $.each(response, function (key, raw) {
                    output += '<tr>';

                        $.each(raw, function (index, val) {

                    output += '<td style="position: relative"><img src="/files/fotos/'+val.src+'" style="height: 200px;width: 200px" alt="">' +
                        '         <form action="/admin/back-foto/'+val.id+'" method="POST">\n' +
                        '             <input type="hidden" value="'+$('meta[name="csrf-token"]').attr('content')+'" name="_token">\n' +
                        '             <input type="hidden" value="DELETE" name="_method">\n' +
                        '             <button class="btn btn-danger" type="submit" onclick="return confirm(\''+cavab+'\')"><i class="fa fa-times"></i></button>\n' +
                        '         </form>' +
                        '       </td>';
                    });
                    output += '</tr>';
                });
                $('#foto-body').html(output);
            }
        });
    }

    function chunk(array, size) {
        const chunked_arr = [];
        let index = 0;
        while (index < array.length) {
            chunked_arr.push(array.slice(index, size + index));
            index += size;
        }
        return chunked_arr;
    }
});
