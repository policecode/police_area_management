<select id="{{$id}}" name="{{$name}}" 
    class="form-select @error($name) is-invalid @enderror"
    style="width: 100%">
    <option value="0">{{$title_option}}</option>
    @foreach ($list_option as $t)
        <option value="{{$t['key']}}" @if ($t['key'] == (old($name)??$value_current)) selected @endif>{{$t['value']}}</option>
    @endforeach
</select>
@error($name)
    <div class="invalid-feedback">
        {{$message}}
    </div>
@enderror



<script type="text/javascript">
    $(document).ready(function() {
        $('#{{$id}}').select2({
            theme: "classic"
        });
    });
</script>