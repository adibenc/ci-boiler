
<!-- Main page content-->
<div class="container my-5">
    <div class="card card-header-actions">
        <div class="card-header text-success" >Artikel
        <div class="float-right">
				<a href="<?php echo site_url('admin/form_content/artikel')?>" class="btn btn-success btn-sm float-rigth">
				Data baru
				</a>
			</div>
        </div>
        <div class="card-body">
            <div class="datatable">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0" id="example">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Dibuat</th>
                            <th>Status</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@script
<script>
	$(document).ready(function() {
		var tabel = $('#example').DataTable({
            ajax: '<?php echo site_url('api/get_content/4');?>',
            processing: true,
            serverSide: true,
            autoWidth: false,
            order : [3, 'desc'],
            "rowCallback": function( row, data, iDisplayIndex ) {
            var index = iDisplayIndex +1;
            $('td:eq(0)',row).html(index);
            return row;
            },
            "columns" : [
                {data: 'id', width: '5%'},                  
                {data: 'deskripsi',
                    render:function(data,type,col,meta){
                        var html = '';
                        html += col.cat_name+'<br/>';
                        html += ' <span class="font-weight-bold" style="font-size: 16px !important;">'+col.judul+'</span>';
                        return html;
                    }
                },
                {data: 'submit_date', width: '10%',
                    render:function(data,type,col,meta){
                        return col.nama+'<br/><small class="text-muted">Date: '+col.submit_date+'</small>';
                    }
                }, 
                {data: 'id_user', width: '15%',
                    render:function(data,type,col,meta){
                        var akses = "<?php echo $this->session->userdata('akses');?>";
                        var html = '';

                        <?php if(in_array($this->session->userdata('akses'),[1,3])){?>
                        if( (col.status != 1) && (akses == 1)){
                            html += '<span class="badge badge-warning" style="font-size: 12px !important; background-color: grey !important;">Draft</span><br/><a href="#!" class="btn-publish" data-value="1" data-id="'+col.id+'">Terbitkan</a>';
                        }else{
                            html += '<span class="badge badge-success" style="font-size: 12px !important;">Ditayangkan</span><br/><a href="#!" class="btn-publish" data-value="0" data-id="'+col.id+'">Batalkan</a>';
                        };
                        <?php }else{?>
                        if( (col.status != 1) && (akses == 1)){
                            html += '<span class="badge badge-warning" style="font-size: 12px !important; background-color: grey !important;">Draft</span>';
                        }else{
                            html += '<span class="badge badge-success" style="font-size: 12px !important;">Ditayangkan</span>';
                        };  
                        <?php }?>

                        return html;
                    }
                },   
                {data: 'id_user', width: '15%',
                    render:function(data,type,col,meta){
                        var linkEdit = "<?php echo site_url('admin/form_content/pers')?>/"+col.id;
                        var akses = "<?php echo $this->session->userdata('akses');?>";
                        var html = '';
                        html += '<a href="'+linkEdit+'" class="btn btn-primary btn-sm">Edit</a> ';
                        html += '<button class="btn btn-danger btn-sm btn-delete" data-id="'+col.id+'">Delete</button>';
                        return html;
                    }
                }                  
            ],
            language: {
            search: '<span>Filter:</span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'Awal', 'last': 'Akhir', 'next': '&rarr;', 'previous': '&larr;' }
            },
            preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
            }
        });

        $('body').on('click','.btn-publish',function(){
            var idRow = $(this).attr('data-id');
            var value = $(this).attr('data-value');
            $.getJSON("<?php echo site_url('admin/publish_content/kms_content');?>/"+idRow+"/"+value, function(json){
                tabel.ajax.reload( null, false );	
            }).error(function() {
                alert("error"); 
            });
        });

        $('body').on('click','.btn-delete',function(e){
            e.preventDefault();
            if (confirm("Apakah Anda yakin akan menghapus data ini?")) {
                var idRow = $(this).attr('data-id');
                $.ajax({
                    type: "GET",
                    url: "<?php echo site_url('api/delete_content')?>/" + idRow,
                    cache: false,
                    success: function(html) {
                        tabel.ajax.reload( null, false );
                    },
                    error: function(xhr){
                        console.log('silahkan coba beberapa saat lagi');
                    }
                });
            }
        });


	} );
</script>
@endscript