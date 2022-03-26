<html lang="en">
<head>
    <title>Destruction Official Signature</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<script type="text/javascript">
    var canvas, ctx, flag = false,
        prevX = 0,
        currX = 0,
        prevY = 0,
        currY = 0,
        dot_flag = false;

    var x = "black",
        y = 2;
    
    function init() {
        canvas = document.getElementById('can');
        ctx = canvas.getContext("2d");
        w = canvas.width;
        h = canvas.height;
    
        canvas.addEventListener("mousemove", function (e) {
            findxy('move', e)
        }, false);
        canvas.addEventListener("mousedown", function (e) {
            findxy('down', e)
        }, false);
        canvas.addEventListener("mouseup", function (e) {
            findxy('up', e)
        }, false);
        canvas.addEventListener("mouseout", function (e) {
            findxy('out', e)
        }, false);
    }
    
    function draw() {
        ctx.beginPath();
        ctx.moveTo(prevX, prevY);
        ctx.lineTo(currX, currY);
        ctx.strokeStyle = x;
        ctx.lineWidth = y;
        ctx.stroke();
        ctx.closePath();
    }
    
    function erase() {
        var m = confirm("Want to clear");
        if (m) {
            ctx.clearRect(0, 0, w, h);
            document.getElementById("canvasimg").style.display = "none";
        }
    }
    
    function save() {
        document.getElementById("canvasimg").style.border = "2px solid";
        var dataURL = canvas.toDataURL();
        document.getElementById("canvasimg").val = dataURL;
        document.getElementById("canvasimg").style.display = "inline";
    }
    
    function findxy(res, e) {
        if (res == 'down') {
            prevX = currX;
            prevY = currY;
            currX = e.clientX - canvas.offsetLeft;
            currY = e.clientY - canvas.offsetTop;
    
            flag = true;
            dot_flag = true;
            if (dot_flag) {
                ctx.beginPath();
                ctx.fillStyle = x;
                ctx.fillRect(currX, currY, 2, 2);
                ctx.closePath();
                dot_flag = false;
            }
        }
        if (res == 'up' || res == "out") {
            flag = false;
        }
        if (res == 'move') {
            if (flag) {
                prevX = currX;
                prevY = currY;
                currX = e.clientX - canvas.offsetLeft;
                currY = e.clientY - canvas.offsetTop;
                draw();
            }
        }
    }
    </script>

<body>

<div class="form-group {{ $errors->has((isset($fieldname) ? $fieldname : 'image')) ? 'has-error' : '' }}">
    <label class="col-md-3 control-label" >{{ "Destruction Official Signature" }}</label>
    <div class="col-md-9">
        
        @if($item->signature_path == '')
            <label class="btn btn-default" aria-hidden="true" data-toggle="modal" data-target="#myModal">
                {{ "Sign Off"  }}  
            </label>
            {!! $errors->first('image', '<span class="alert-msg" aria-hidden="true">:message</span>') !!}
        @else
            <img src="/uploads/{{$item->signature_path}}"/>
        @endif

        
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">

    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Destruction Official Signature</h4>
            </div>
            <div class="modal-body">
                <head>
                    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
                    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
                    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
                    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>

                    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">

                    <style>
                        .kbw-signature { width: 500px; height: 180px;}
                        #signaturePad canvas{
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
                                    
                                <form method="POST" >
                                    @csrf
                                    <div class="col-md-12">
                                        <label class="" for="">Signature:</label>
                                        <br/>
                                        <div id="signaturePad" ></div>
                                        <div id="signaturePads" ></div>
                                    
                                        <br/>
                                        <button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>
                                        <textarea id="signature64" name="signature_path" style="display: none" multiple>546456</textarea>
                                    </div>
                                    <br/>
                                </input>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <script type="text/javascript">
                    var signaturePad = $('#signaturePad').signature({syncField: '#signature64', syncFormat: 'PNG'});
                    $('#clear').click(function(e) {
                        e.preventDefault();
                        off.signature('clear');
                        $("#signature64").val('');
                    });

                    var ctx = document.getElementById('signaturePad')
                    var asd = convertCanvasToImage(signaturePad)    

                    function convertCanvasToImage(aaa) {
                        var image = new Image();
                        image.src = aaa.toDataURL("image/png");
                        return image;
                    }

                    //var canvas = document.getElementById('signature64');
                    var dataURL = canvas.toDataURL('image/jpeg');

                    $.ajax({
                        type: "POST",
                        url: "/hardware",
                        data: { 
                            imgBase64: asd
                        }
                    }).done(function(o) {
                        console.log('saved'); 
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