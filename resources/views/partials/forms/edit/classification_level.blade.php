<?php
$array = array(
    # "dbValue" => "select box string"
    "topSecret" => "Top Secret",
    "secret" => "Secret",
    "confidential" => "Confidential",
    "controlledUnclassifiedInformation" => "Controlled Unclassified Information",
    "unclassified" => "Unclassified",
);
?>

<!-- Classification Level -->
<div class="form-group {{ $errors->has('classification_level') ? ' has-error' : '' }}">
    <label for="classification_level" class="col-md-3 control-label">{{ trans('admin/hardware/form.classification_level') }}</label>
    <div class="col-md-7 col-sm-11">
    {{ Form::select('classificationlevel', $array , old(), array('class'=>'select2', 'style'=>'width:100%','id'=>'classificationlevel', 'aria-label'=>'classificationlevel')) }}
        {!! $errors->first('classificationlevel', '<span class="alert-msg" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i> :message</span>') !!}
    </div>
</div>

@if ($errors->any())
     @foreach ($errors->all() as $error)
         <div>{{$error}}</div>
     @endforeach
 @endif
