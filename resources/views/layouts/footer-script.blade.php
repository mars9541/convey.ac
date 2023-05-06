<!-- jQuery  -->
<script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/modernizr.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ URL::asset('assets/js/waves.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.nicescroll.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ URL::asset('plugins/sweet-alert2/sweetalert2.min.js')}}"></script>
<script src="{{ URL::asset('plugins/select2/js/select2.min.js')}}"></script>
<script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('plugins/alertify/js/alertify.js') }}"></script>

<script>
	$.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });
	$(document).ajaxError(function(event, jqxhr, settings, exception) {

	    if (exception == 'unknown status') {
            window.location = '{{route("login")}}';
	    }
	});

	// disable datatables error prompt
	$.fn.dataTable.ext.errMode = 'none';

	function date_format(data)
	{
		var y = data.substr(0,4);
        var m = data.substr(5,2);
        var d = data.substr(8,2);
        return m+'/'+d+'/'+y;
	}
// if (!!window.EventSource && $('#message_event').length) {

//  	let evtSource = new EventSource("{{route('team.getEventStream')}}");

// evtSource.addEventListener('message', function(e) {
//   var data = JSON.parse(e.data);
//   console.log(data);
// }, false);

// evtSource.addEventListener('userlogon', function(e) {
//   var data = JSON.parse(e.data);
//   console.log('User login:' + data.username);
// }, false);

// evtSource.addEventListener('update', function(e) {
//   var data = JSON.parse(e.data);
//   console.log(data);
// }, false);

	// evtSource.onmessage = function (e) {
	//  let data = JSON.parse(e.data);
	//  if($('#message_cnt').html()=='You have '+data+' unread messages'){

	//  }else{
	//  	if(data!=0){
	//  		$('#message_cnt').html('You have '+data+' unread messages');
	//  		if(!$('.badge').hasClass('badge-danger'))
	//  		{
	//  			$('.badge').addClass('badge-danger')
	//  		}
	//  		$('#ticket_table').DataTable().ajax.reload();
	//  	}else{
	//  		$('#message_cnt').html('You have '+data+' unread messages');
	//  		if($('.badge').hasClass('badge-danger'))
	//  		{
	//  			$('.badge').removeClass('badge-danger')
	//  		}
	//  		$('#ticket_table').DataTable().ajax.reload();
	//  	}
	//  }
	// };
// } else {
//   console.log('no EventSource');
// }
	
</script>
 @yield('script')

<!-- App js -->
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@yield('script-bottom')

