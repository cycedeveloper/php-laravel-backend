@php
    $temp_name = $name.'-'.rand(100000,10000000);

@endphp

<label for="{{$temp_name}}">{{$label}}</label>   
<p class="max-input-btn mb-0" id="{{$temp_name}}-max">Set max: {{$value}}</p> 
<div class="input-group mb-3">
    <input id="{{$temp_name}}" type="number" class="form-control  @error($name) is-invalid @enderror" name="{{$name}}" value="{{$value}}" required autofocus placeholder="{{$label}}">
</div>
@error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror

<script>
    var temp_name = '{{ $temp_name }}';
    var max = '{{ $value }}';
  $('#'+temp_name+'-max').click( (e) => {
    $('#'+temp_name).val(max);
  } )
</script>

<style>
.max-input-btn {
    text-align: right;
    color: #58d3b6;
    text-decoration: dotted;
    cursor: pointer;
    font-size: 14px;
}
</style>