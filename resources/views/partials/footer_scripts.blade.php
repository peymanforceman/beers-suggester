<!-- jQuery 3 -->

<script src="{{URL::asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{URL::asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
@yield('footer')
<!-- iCheck -->
<script src="{{URL::asset('plugins/iCheck/icheck.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{URL::asset('js/adminlte.min.js') }}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
    @if($no_beer_exist)
    $(document).ready(function () {
        update_database();

    });

    @endif

    function update_database() {
        $('#update_db_modal').modal('show');
        var ajaxhttp = new XMLHttpRequest();
        var url = "{{ route('update_beers_request') }}";
        ajaxhttp.open("GET", url, true);
        ajaxhttp.setRequestHeader("content-type", "application/json");
        ajaxhttp.onreadystatechange = function () {
            if (ajaxhttp.readyState == 4 && ajaxhttp.status == 200) {
                //alert( " " + ajaxhttp.responseText);
                jsonParseResult(ajaxhttp.responseText);
            } else {
                console.log('error fetching data from api. please try again in a few seconds.');
                $('#update_db_modal').modal('hide');
            }
        };
        ajaxhttp.send();
    }

    function jsonParseResult(result) {
        var parsedJSON = JSON.parse(result);
        console.log(parsedJSON);
        $('#update_db_modal').modal('hide');
    }


</script>