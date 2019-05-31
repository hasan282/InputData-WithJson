<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<title>My Workshop</title>
	<!--
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	-->
	<link href="bootstrap3/css/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap3/css/bootstrap-theme.min.css" rel="stylesheet">
	<script src="bootstrap3/js/jquery.min.js"></script>
	<script src="bootstrap3/js/bootstrap.min.js"></script>

	<script src="json/js/jquery-3.4.0.js"></script>
	<script src="json/js/sweetalert2.all.min.js"></script>

	<link rel="shortcut icon" type="image/x-icon" href="imgnicon/mwicon.png">

</head>
<body>

	<div class="container" style="padding-top:10px">
	<div class="jumbotron" style="text-align:center;font-family:century gothic;background-color:#996515">
		<div id="judul" style="color:#c5b358"><h1><b>Workshop Ngobar</b></h1>
		<p>Ngoding Bareng Materi <strong>HTML</strong>, <strong>Javascript</strong>, dan <strong>PHP</strong></p>
		</div>
	</div>
	</div>

	<div class="container">
	<div class="row">
		<div class="col-md-4">
		<div class="form-group">
			<label>Nama</label>
			<input type="text" id="nama" class="form-control">
			<br>
			<label>Jenis</label>
			<select id="jenis" class="form-control" style="width:60%">
				<option value="Makanan">Makanan</option>
				<option value="Minuman">Minuman</option>
				<option value="Perabot">Perabot</option>
				<option value="Perkakas">Perkakas</option>
				<option value="Peralatan">Peralatan</option>
			</select>
			<br>
			<label>Stok</label>
			<input type="text" id="stok" class="form-control" style="width:60%">
			<br><br>
			<button id="simpan" class="btn btn-primary" style="width:40%">Simpan</button>
			<span id="loader"><img src="json/assets/loader.gif"></span>
		</div>
		<div id="boxalert"></div>
		</div>
		<div id="abdullah" class="col-md-8" style="padding-left:50px;padding-top:20px">
		</div>
	</div>
	</div>

<script type="text/javascript">

var HeadTable =
	"<table class='table table-bordered table-striped'><tr><th style='text-align:center'>No.</th>" +
	"<th style='text-align:center'>Nama</th><th style='text-align:center'>" +
	"Jenis</th><th style='text-align:center'>Stok</th><th></th></tr></table>";

var SccAlert =
	"<div class='alert alert-success alert-dismissible'><a href='' class='close' data-dismiss='alert' " +
	"aria-label='close'>&times;</a>Data Produk <strong>Berhasil Ditambahkan!</strong></div>";

function hasan($id){
	return document.getElementById($id);
}

function ShowTable(){
	hasan('abdullah').innerHTML = HeadTable;
}

function AlertSuccess(){
	hasan('boxalert').innerHTML = SccAlert;
}

$(document).ready(function(){
	
	$("#nama").click(function(){
		$("#boxalert").html("");
	});
	$("#jenis").click(function(){
		$("#boxalert").html("");
	});
	$("#stok").click(function(){
		$("#boxalert").html("");
	});
	
	var myUrl;
	var baseUrl = "http://localhost/myws/";
	var id, nama, jenis, stok, input;
	
	$("#loader").hide();
	ShowTable();
	loadGrid();
	
	function loadGrid(){
		myUrl = baseUrl + "operate.php?act=4";
		
		$.ajax({
			url: myUrl,
			dataType: "json",
			beforeSend:function(){
				$("#loader").fadeIn();
			},
			success: function(result){
				var rows;
				var json = result.hasil;
				var nomer = 1;
				var namaz = [];
				var jeniz = [];
				var stokz = [];
				
				$.each(json, function(key, val){
					namaz[val.id] = val.nama;
				//	jeniz[val.id] = val.jenis;
					stokz[val.id] = val.stok;
					rows += "<tr id='" + val.id + "'><td style='text-align:center'>" + nomer + "</td><td>" + val.nama + "</td>";
					rows += "<td>" + val.jenis + "</td><td style='text-align:center'>" + val.stok + "</td>";
					rows += "<td style='width:15%;text-align:center'><button id='" +val.id+ "' class='btn btn-xs btn-warning editz'>Edit</button> ";
					rows += "<button id='" +val.id+ "' class='btn btn-xs btn-danger delz'>Delete</button></td></tr>";
					nomer = nomer+1;
				});
				
				$("table").append(rows);
				$("#loader").fadeOut();
				
				$(".editz").click(function(){
					var id = this.id;
					var nama = namaz[id];
					var jenis = jeniz[id];
					var stok = stokz[id];
				//	alert(nama+" - "+jenis+" - "+stok);
					
					$("#nama").val(nama);
					$("#stok").val(stok);
				});
				/*
				$(".delz").click(function(){
					var AiDi = this.id;
					var nama = namaz[AiDi];
					/*
					swal.fire({
						title: 'Are You Sure to Delete ' + AiDi ' Object ?',
						text: 'it will be delete permanently',
						type: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Yes, delete it !',
						showLoaderOnConfirm: true,
						preConfirm: function(){
							
						},
						allowOutsideClick: false
					});
					
					
					Swal.fire({
						title: "Hapus " + nama + "??",
						text: "Data yang telah dihapus tak dapat dikembalikan",
						type:"warning",
						showCancelButton: true,
						confirmButtonColor: '#d33',
						confirmButtonText: "Hapus data",
						allowOutsideClick: false
					})
					.then((result)=>{
						
						if(result.value){
							$.ajax({
								url = baseUrl + "operate.php?act=3&id=" + AiDi,
								dataType: "json",
								success: function(result){
									var obj = result.hasil;
									var psn;
									$.each(obj, function (key, val){
										console.log("key val " + key + " " + val.pesan);
									});
									Swal.fire("Konfirmasi", psn, "success");
								}
							});
						}else{
							Swal.fire("Penghapusan data dibatalkan");
						}
					});
					
				});*/
				
				
				$(".delz").click(function(){
					var id = this.id;
					var nama = namaz[id];
					
					Swal.fire({
						title: "Hapus " + nama + "??",
						text: "Data yang telah dihapus tak dapat dikembalikan",
						type:"warning",
						showCancelButton: true,
						confirmButtonText: "Hapus data",
						allowOutsideClick: false
					})
					.then((result)=>{
						console.log(baseUrl + "operate.php?act=3&id" + id);
						
						if(result.value){
							$.ajax({
								url: baseUrl + "operate.php?act=3&id="+id,
								dataType: "json",
								success: function(result){
									var obj = result.hasil; //ambil object hasil
									var psn;
									
									$.each(obj, function(key, val){
										console.log("key val "+ key + " " + val.pesan);
									});
									
									Swal.fire("Konfirmasi", psn, "success");
									$("table tr#"+id).fadeOut();

									ShowTable();
									loadGrid();
								}
							});
						}else{
							Swal.fire("Penghapusan data dibatalkan");
						}
					});
				});
			},
			fail: function(xhr, textStatus, errorThrown){
				Swal.fire({
					type: 'error', title: textStatus, text: errorThrown, footer: ''
				});
			}
		});
	};
	
	$("#simpan").click(function(){
		var nama = $("#nama").val();
		var jenis = $("#jenis").val();
		var stok = $("#stok").val();
		
		if(nama.length == 0 || stok.length == 0){
			Swal.fire("Perhatian", "Lengkapi Data yang Akan Diinput", "info");
			return;
		}
		
		myUrl = baseUrl + "operate.php?act=1&nm=" + nama + "&jn=" + jenis + "&st=" + stok;
		console.log(myUrl);
		
		$.ajax({
			url: myUrl,
			dataType: "json",
			beforeSend: function(){},
			success: function(result){
				console.log(result);
				var psn;
				
				$.each(result.hasil, function(key, val){
					console.log("key val " + key + " " + val.pesan);
					psn = val.pesan;
				});
				
				$("#nama").val("");
				$("#jenis").selectedIndex = 0;
				$("#stok").val("");
				
				ShowTable();
				loadGrid();
				AlertSuccess();
				$("#submit").attr("disabled", false);
				$("#loader").fadeOut();
			},
			fail: function(xhr, textStatus, errorThrown){
				Swal.fire(textStatus, errorThrown, "error");
				$("#submit").attr("disabled", false);
			}
		});
	});
	
});
</script>
</body>
</html>