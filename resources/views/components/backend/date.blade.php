@section('style')
    <link  href="/admins/css/datepicker.css" rel="stylesheet">
@append
<input type="text" name="{{$name}}" autocomplete="off" id="input-{{$name}}" value="{{$value ?? ''}}" class="form-control" required>
@section('script')
    <script src="/admins/js/libs/datepicker.js"></script>
    <script src="/admins/js/libs/datepicker.zh.js"></script>
<script>

    $(function () {
        $('#input-{{$name}}').fdatepicker({
            format: 'yyyy-mm-dd',
            changeYear: true,
            startDate:new Date(), //只要加上此代码即可
            onDateSet:function(){
                console.log(this);
            }
        });
    });
</script>
@append