@extends('admin.layouts.layout')
@section('content')
<section class="content-header">
     <h1>
		User 
    		<small>lists</small>
     </h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="#">users</a></li>
        <li class="active">Data tables</li>
    </ol> -->
</section>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
        	<div class="box box-info">
            <div class="box-header">
              	<p style="text-align: right">
	                <a href="javascript:void(0);" id="refresh" onclick="reload()" class="btn btn-info icon-btn p-5">Refresh</a>
	                <a href="javascript:void(0);" id="delete" onclick="" class="btn btn-danger icon-btn p-5 hidden">Delete</a>
	            </p>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="dataTable" class="table table-bordered table-striped">
                <thead>
	                <tr class="btn-primary">
	                  <th><div class="animated-checkbox"><label><input type="checkbox" class="selectall" /><span class="label-text"></span></label></div></th>
	                  <th>First Name</th>
	                  <th>Last Name</th>
					  <th>Email</th>
					  <th>Wishlist</th>
	                  <th>Status</th>
	                  <th>Action</th>
	                </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
	                <tr class="btn-primary">
	                  <th><div class="animated-checkbox"><label><input type="checkbox" class="selectall" /><span class="label-text"></span></label></div></th>
	                  <th>First Name</th>
	                  <th>Last Name</th>
					  <th>Email</th>
					  <th>Wishlist</th>
	                  <th>Status</th>
	                  <th>Action</th>
	                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
            @include('admin.layouts.overlay')
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
</section>
@stop

@section('css')
{{  Html::style('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}
{{  Html::style('backend/plugins/sweetalert/sweetalert.css') }}
@stop

@section('js')
@include('admin.layouts.alert')
{{ Html::script('backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}
{{ Html::script('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}
{{ Html::script('backend/plugins/sweetalert/sweetalert.min.js') }}
{{ Html::script('backend/js/fnStandingRedraw.js') }}
{{ Html::script('backend/js/delete_script.js') }}

	<script type="text/javascript">

	var title = "Are you sure to delete this record?";
	var text = "You will not be able to recover this record";
	var type = "warning";
	var delete_path = "{{ URL::route('admin.users.delete') }}";
	var token = "{{ csrf_token() }}";

	$('#delete').click(function(){
	    var delete_id = $('#dataTable tbody input[type=checkbox]:checked');
	    checkLength(delete_id);
	});

	function filterWithSite(siteId) {
		$('#dataTable').DataTable().ajax.reload( null, false );
	}

	$(function()
	{
	    var dataTable = $('#dataTable').dataTable({
	        "bProcessing": false,
	        "bServerSide": true,
	        "autoWidth": true,
	        "bSearching": true,
	        "aaSorting": [
	            [1, "asc"]
	        ],
	        "sAjaxSource": "{{ URL::route('admin.users.index') }}",
	        "fnServerParams": function ( aoData ) {
	            aoData.push({ "name": "act", "value": "fetch" });
				if($("select[name='site_id']").val()) {
					aoData.push({ "name": "siteId", "value": $("select[name='site_id']").val() });;
				}
	            server_params = aoData;
	        },
	        "aoColumns": [
	        {
	            mData: "id",
	            bSortable: false,
	            bVisible: true,
	            sWidth: "5%",
	            sClass: 'text-center',
	            mRender: function(v, t, o)
	            {
	                return '<div class="animated-checkbox">'
	                            + '<label>'
	                            +' <input type="checkbox" id="chk_'+v+'" name="id[]" value="'+v+'"/>'
	                            +'<span class="label-text"></span></label></div>';
	            }
	        },
	        { "mData": "first_name",sWidth: "10%",bSortable: true,},
	        { "mData": "last_name",sWidth: "10%",bSortable: true,},
	        { "mData": "email",sWidth: "10%",bSortable: true,},
	        { 
	            "mData": "wishlist_products",
	            "sWidth": "10%",
	            "bSortable": false,
	            "mRender": function(v, t, o) {
	                var count = v ? v.length : 0;
	                if (count > 0) {
	                    window.userWishlists = window.userWishlists || {};
	                    window.userWishlists[o.id] = {
	                        username: (o['first_name'] || '') + ' ' + (o['last_name'] || ''),
	                        products: v
	                    };
	                    return '<button type="button" class="btn btn-xs btn-info btn-flat view-wishlist" data-user-id="' + o.id + '"><i class="fa fa-heart text-danger"></i> View (' + count + ')</button>';
	                }
	                return '<span class="text-muted">0 items</span>';
	            }
	        },
	        { "mData": "status",
				sWidth: "10%",
				bSortable: false,
				mRender: function(v, t, o) {
					if(o['status'] == '1') {
						return 'Active';
					} else {
						return 'Inactive';
					}
				}
			},
	        {
	            mData: null,
	            bSortable: false,
	            sWidth: "10%",
	            sClass: "text-center",
	            mRender: function(v, t, o) {

	                var editUrl = '{{ route("admin.users.edit", ":id") }}';
            		editUrl = editUrl.replace(':id',o['id']);

	                var string_obj = JSON.stringify(o);

	                var act_html = "<div class='btn-group'>"
	                                +"<a class='btn btn-primary' href='"+editUrl+"' data-toggle='tooltip' title='Edit' data-placement='top' class='p-5'><i class='fa fa-pencil'></i></a> "
	                                // +"<a href='" +  showUrl+ "' data-toggle='tooltip' title='View' data-placement='top'<i class='glyphicon glyphicon-eye-open'></i></a> "
	                                +" <a class='btn btn-danger' href='javascript:void(0)' onclick=\"deleteRecord('"+delete_path+"','"+title+"','"+text+"','"+token+"','"+type+"',"+o['id']+")\" data-toggle='tooltip' title='Delete' data-placement='top'><i class='fa fa-trash-o'></i></a>"
	                                +"</div>"
	                return act_html;
	            }
	        },
	        ],
	        fnPreDrawCallback : function() {
	            $(".overlay").show();
	        },
	        fnDrawCallback : function (oSettings) {
	           $('.overlay').hide();
	        }
	    });
	    dataTable.fnSetFilteringDelay(1000);
	});

	$(".selectall").on('click', function(){
	    var is_checked = $(this).is(':checked');
	    if(is_checked) {
	    	$('#delete').removeClass('hidden');
	    } else {
	    	$('#delete').addClass('hidden');
	    }
	    $(this).closest('table').find('tbody tr td:first-child input[type=checkbox]').prop('checked',is_checked);
	    $(".selectall").prop('checked',is_checked);
	});

	var currentWishlistProducts = [];
	var currentWishlistPage = 1;
	var itemsPerPage = 5;

	function renderWishlistPage(page) {
	    currentWishlistPage = page;
	    var totalItems = currentWishlistProducts.length;
	    var totalPages = Math.ceil(totalItems / itemsPerPage) || 1;
	    
	    if (currentWishlistPage < 1) currentWishlistPage = 1;
	    if (currentWishlistPage > totalPages) currentWishlistPage = totalPages;

	    $('#prevWishlistPage').prop('disabled', currentWishlistPage === 1);
	    $('#nextWishlistPage').prop('disabled', currentWishlistPage === totalPages);

	    // Generate page numbers dynamically
	    var pageBtnsHtml = '';
	    for (var i = 1; i <= totalPages; i++) {
	        var activeClass = (i === currentWishlistPage) ? 'btn-primary' : 'btn-default';
	        pageBtnsHtml += '<button type="button" class="btn ' + activeClass + ' btn-xs btn-flat wishlist-page-btn" data-page="' + i + '" style="margin: 0 2px; min-width: 22px;">' + i + '</button>';
	    }
	    $('#wishlistPageNumbers').html(pageBtnsHtml);

	    var startIndex = (currentWishlistPage - 1) * itemsPerPage;
	    var endIndex = Math.min(startIndex + itemsPerPage, totalItems);

	    var html = '';
	    if (totalItems > 0) {
	        for (var i = startIndex; i < endIndex; i++) {
	            var product = currentWishlistProducts[i];
	            var imgHtml = '';
	            if (product.main_image) {
	                imgHtml = '<img src="' + product.main_image + '" style="width: 50px; height: auto; display: block; margin: 0 auto;" class="img-thumbnail" />';
	            } else {
	                imgHtml = '<span class="text-muted">No Image</span>';
	            }
	            
	            var priceHtml = product.price ? product.price + ' AED' : 'N/A';

	            html += '<tr>';
	            html += '<td style="vertical-align: middle; text-align: center;">' + imgHtml + '</td>';
	            html += '<td style="vertical-align: middle; font-weight: 600;">' + product.title + '</td>';
	            html += '<td style="vertical-align: middle; text-align: right; font-weight: bold;">' + priceHtml + '</td>';
	            html += '</tr>';
	        }
	    } else {
	        html = '<tr><td colspan="3" class="text-center text-muted">Wishlist is empty.</td></tr>';
	    }

	    $('#wishlistTableBody').html(html);
	}

	$(document).on('click', '.view-wishlist', function() {
	    var userId = $(this).data('user-id');
	    var data = window.userWishlists ? window.userWishlists[userId] : null;
	    if (!data) return;

	    $('#wishlistModalLabel').text(data.username + "'s Wishlist");

	    currentWishlistProducts = data.products || [];
	    
	    var totalItems = currentWishlistProducts.length;
	    if (totalItems <= itemsPerPage) {
	        $('#wishlistPagination').hide();
	    } else {
	        $('#wishlistPagination').show();
	    }

	    renderWishlistPage(1);
	    $('#wishlistModal').modal('show');
	});

	$(document).on('click', '#prevWishlistPage', function() {
	    if (currentWishlistPage > 1) {
	        renderWishlistPage(currentWishlistPage - 1);
	    }
	});

	$(document).on('click', '#nextWishlistPage', function() {
	    var totalPages = Math.ceil(currentWishlistProducts.length / itemsPerPage) || 1;
	    if (currentWishlistPage < totalPages) {
	        renderWishlistPage(currentWishlistPage + 1);
	    }
	});

	$(document).on('click', '.wishlist-page-btn', function() {
	    var page = parseInt($(this).data('page'));
	    if (page && page !== currentWishlistPage) {
	        renderWishlistPage(page);
	    }
	});
	</script>

	<!-- Wishlist Modal -->
	<div class="modal fade" id="wishlistModal" tabindex="-1" role="dialog" aria-labelledby="wishlistModalLabel">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content" style="border-radius: 6px;">
	            <div class="modal-header bg-primary btn-primary" style="border-top-left-radius: 6px; border-top-right-radius: 6px;">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 0.8;"><span aria-hidden="true">&times;</span></button>
	                <h4 class="modal-title" id="wishlistModalLabel" style="color: white; font-weight: 600;">User's Wishlist</h4>
	            </div>
	            <div class="modal-body" style="max-height: 450px; overflow-y: auto; padding: 15px;">
	                <table class="table table-bordered table-striped table-hover" style="margin-bottom: 0;">
	                    <thead>
	                        <tr class="info">
	                            <th style="width: 80px; text-align: center;">Image</th>
	                            <th>Product Title</th>
	                            <th style="width: 120px; text-align: right;">Price</th>
	                        </tr>
	                    </thead>
	                    <tbody id="wishlistTableBody">
	                        <!-- Dynamically filled -->
	                    </tbody>
	                </table>
	            </div>
	            <div class="modal-footer" style="display: flex; justify-content: space-between; align-items: center; padding: 10px 15px;">
	                <div id="wishlistPagination" style="display: flex; align-items: center;">
	                    <button type="button" class="btn btn-default btn-xs btn-flat" id="prevWishlistPage" style="margin-right: 5px;"><i class="fa fa-chevron-left"></i> Previous</button>
	                    <div id="wishlistPageNumbers" style="display: inline-flex; align-items: center;"></div>
	                    <button type="button" class="btn btn-default btn-xs btn-flat" id="nextWishlistPage" style="margin-left: 5px;">Next <i class="fa fa-chevron-right"></i></button>
	                </div>
	                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
	            </div>
	        </div>
	    </div>
	</div>
@stop