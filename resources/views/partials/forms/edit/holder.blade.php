<!-- Holder -->
<!-- I will add data types once we chose what we want the values to be-->
<!-- {{ old('holder', ($item->holder) ? $item->holder->format('Y-m-d') : '') }}-->

<div class="form-group{{ $errors->has('holder') ? ' has-error' : '' }}">
    <label for="holder" class="col-md-3 control-label">{{ trans('Additional Caveats') }}</label>
    <div class="input-group col-md-3">
        <div class="input-String" data-provide="string" data-string-format="EEEE"  data-autoclose="true">
            
            <input type="checkbox" id="CNWDI" name="CNWDI" value="val1"> <!--strings-->
            <label for ="val1"> CNWDI </label><br>
            <input type="checkbox" id="NATO" name="NATO" value="val2">
            <label for ="val2"> NATO </label><br>
            <input type="checkbox" id="Other" name="Other" value="val3">
            <label for ="val3"> Other </label><br>

            <!--<input type="checkbox" class="form-control" placeholder="{{ trans('general.string') }}" name="holder" id="va1" value="aa">-->
            <!--<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>-->
            
        </div>
        {!! $errors->first('Holder', '<span class="alert-msg" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i> :message</span>') !!}
    </div>
</div>
    