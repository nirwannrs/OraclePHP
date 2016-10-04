$( function() {
  	$("#qty-1").on("change paste keyup", function() {
    $("#total-1").text($("#harga-1").text()*$("#qty-1").val()); 
	});
    autoComplete(1);    
  } );

  $( function() {
    $( "#datepicker" ).datepicker();
    $('#table_id').DataTable({
		"pageLength": 15,
		"lengthMenu": [ 15, 30, 50, 75, 100 ]
	});
  } );

  function onChangeValue(id){
    $("#qty-"+id).on("change paste keyup", function() {
    $("#total-"+id).text($("#harga-"+id).text()*$("#qty-"+id).val()); 
  });
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
            response( $.map( data, function( item ) {
                return {
                    label: item.KODEBARANG,
                    value: item.KODEBARANG,
                    nama: item.NAMA,
                    harga: item.HARGA
                }
            }));
          }
        } );
      },
      minLength: 1,
      select: function( event, ui ) {
        $("#nama-"+id).text(ui.item.nama);
        $("#harga-"+id).text(ui.item.harga);
        // log( "Selected: " + ui.item.value + " aka " + ui.item.id );
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

function addBarang(id){
  $('#barang-1').after("<tr id='barang-"+id+"'><td><input type='text' name='barang-"+id+"' id='tags-"+id+"'></td><td id='nama-"+id+"'> </td><td id='harga-"+id+"'></td><td><input type='text' name='qty-"+id+"' style='width:150px;' id='qty"+id+"'></td><td id='total"+id+"' style='text-align:right'></td><td><a href='#' onclick='addBarang("+id+")' style='text-decoration: none'> + </td></tr>");
  autoComplete(id);
  onChangeValue(id);
}