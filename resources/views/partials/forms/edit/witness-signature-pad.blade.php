<html lang="en">
<head>
    <title>Destruction Witness Signature</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="form-group {{ $errors->has((isset($fieldname) ? $fieldname : 'image')) ? 'has-error' : '' }}">
    <label class="col-md-3 control-label" >{{ "Destruction Witness Signature" }}</label>
    <div class="col-md-9">
        
        @if($item->witness_signature_path == '')
            <label class="btn btn-default" aria-hidden="true" data-toggle="modal" data-target="#myModals">
                {{ "Sign Off"  }}  
            </label>
            {!! $errors->first('image', '<span class="alert-msg" aria-hidden="true">:message</span>') !!}
        @else
            <img src="/uploads/{{$item->witness_signature_path}}"/>
        @endif

        
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModals" role="dialog">

    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Destruction Witness Signature</h4>
            </div>
            <div class="modal-body">
                <head>
                    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
                    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
                    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
                    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
                
                    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
                    
                    <style>
                        .kbw-witness { 
                            width: 500px; 
                            height: 180px;
                            display: inline-block;
	                        border: 1px solid #a0a0a0;
	                        -ms-touch-action: none;
                        }
                        #witnessPad canvas{
                        width: 500px !important;
                        height: 180px;
                        }
                    </style> 
                </head>
                <body class="bg-dark">
                <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3 mt-5">
                        <div class="card">
                            <div class="card-header">
                                <h5>I certify the item was destroyed in accordance with applicable security policies and procedures.</h5>
                            </div>
                            <div class="card-body">
                                    
                                    <form method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-12">
                                            <label class="" for="">Signature:</label>
                                            <br/>
                                            <div id="witnessPad" ></div>
                                            
                                            <br/>
                                            <button id="witClear" class="btn btn-danger btn-sm">Clear Signature</button>
                                            <textarea id="witness64" name="witness_signature_path" style="display: none" multiple></textarea>
                                        </div> 
                                        <br/>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <script type="text/javascript">
                    var witnessPad = $('#witnessPad').signature({syncField: '#witness64', syncFormat: 'PNG'});
                    $('#witClear').click(function(e) {
                        e.preventDefault();
                        witnessPad.signature('witClear');
                        $("#witness64").val('');
                    });
                </script>
                </body>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>