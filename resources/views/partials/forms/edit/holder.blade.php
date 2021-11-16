<!-- Holder -->
<div class="form-group{{ $errors->has('Holder') ? ' has-error' : '' }}">
    <label for="holder" class="col-md-3 control-label">{{ trans('Holder') }}</label>
    <div class="input-group col-md-3">
        <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd"  data-autoclose="true">
            <input type="text" class="form-control" placeholder="{{ trans('general.select_date') }}" name="Holder" id="Holder" value="{{ old('Holder', ($item->Holder) ? $item->Holder->format('Y-m-d') : '') }}">
            <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
        </div>
        {!! $errors->first('Holder', '<span class="alert-msg" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i> :message</span>') !!}
    </div>
</div>
    