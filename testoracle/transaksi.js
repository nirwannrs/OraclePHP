  $( function() {
    $( "#datepicker" ).datepicker();
    $("#date").text($.datepicker.formatDate('dd M yy', new Date()));
    $('#table_id').DataTable({
    "pageLength": 15,
    "lengthMenu": [ 15, 30, 50, 75, 100 ]
  });
  } );

  function onChangeValue(id){
    $("#qty-"+id).on("change paste keyup", function() {
      var qty = new Number($("#qty-"+id).val());
      var stok = new Number($("#stok-"+id).val());
    
      if( qty <= stok){
        $("#total-"+id).text($("#harga-"+id).val()*$("#qty-"+id).val()); 
      }else{
        if(qty == 0){
          $("#qty-"+id).val(0);
        }else{
          $("#qty-"+id).val(stok);
          $("#qty-"+id).trigger("change");
        }
      }

      calculateTotal();
  });
  }

  function calculateTotal(){
    var empty = 0;
    $(".subTotal").each(function(i){
      empty = empty + new Number($(this).text());
    })
    $("#allTotal").text(empty);
    $("#hargatotal").attr("value", empty);
  } 

  function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
  
  function autoComplete(id){
    $( "#tags-"+id ).autocomplete({
      source: function( request, response ) {
        $.ajax( {
          url: "/Oraclephp/testoracle/search.php",
          dataType: "json",
          data: {
            term: request.term
          },
          success: function( data ) {
            var newData = [];
            var arrayCol = 0;
            $.map( data, function( item ) {
              for (i = 0; i < $('.ui-autocomplete-input').length; i++) {
                  if($($('.ui-autocomplete-input')[i]).val() == item.KODEBARANG){
                    if(arrayCol == 0){
                      arrayCol = arrayCol+1;
                      newData.push(item);
                    }else{
                      newData = jQuery.grep(newData, function(value) {
                        return value != item;
                      });
                    }
                  }
                }
            });
            
            response( $.map( newData, function( item ) {
                return {
                    label: item.KODEBARANG,
                    value: item.KODEBARANG,
                    nama: item.NAMA,
                    harga: item.HARGA,
                    stok: item.STOK
                }
            }));
          }
        } );
      },
      minLength: 1,
      select: function( event, ui ) {
        $("#tags-"+id).attr("readonly", true);
        $("#nama-"+id).text(ui.item.nama);
        $("#harga-"+id).val(ui.item.harga);
        $("#stok-"+id).val(ui.item.stok)
        $("#qty-"+id).focus();
      }
    });

  }

  function bukaTransaksi(kdpel, nama, alamat){
    $("#tablePelanggan").hide();
    $("#idpelanggan").val(kdpel);
    $("#namapelanggan").text(nama);
    $("#alamatpelanggan").text(alamat);
    $("#transaksi").show();
  return false;
}

  function removeElement(id){
    $("#barang-"+id).remove();
    calculateTotal();
  }

function addBarang(id){
  if(id == 0){
    id = $(".barang-details").length + 1;  
  }
  $('#barang-field').before("<tr id='barang-"+id+"' class='barang-details'><td><input type='text' name='barang["+id+"]' id='tags-"+id+"'></td><td id='nama-"+id+"'> </td><td> <input type='text' name='stok["+id+"]' id='stok-"+id+"' readonly> </td><td> <input type='text' name='harga["+id+"]' id='harga-"+id+"' readonly> </td><td><input type='text' name='qty["+id+"]' style='width:150px;' id='qty-"+id+"'  onkeypress='return isNumberKey(event)'></td><td id='total-"+id+"' style='text-align:right' class='subTotal'></td><td width='auto'> <a href='#' onclick='removeElement("+id+")'>Remove</a></td></tr>");
  $("#tags-"+id).focus();
  autoComplete(id);
  onChangeValue(id);
}