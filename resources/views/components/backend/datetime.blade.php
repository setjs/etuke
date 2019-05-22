@section('style')
    <link  href="/admins/css/plugins/flatpickr.css" rel="stylesheet">
@append
<input type="text" name="{{$name}}" id="input-{{$name}}" value="{{$value ?? ''}}" class="form-control" required>
@section('script')
    <script src="/admins/js/flatpickr.min.js"></script>
<script>

    $(function () {
        flatpickr("#input-{{$name}}", {
            enableTime: true,
            time_24hr: true,
            dateFormat: "Y-m-d H:i"
        });
    });
</script>
@append