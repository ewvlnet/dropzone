@props(['model' => '', 'mtype' => '', 'ftype' => '', 'qty' => '', 'colmd' => '8', 'title' => __('Post images')])

@php
    $publishedFilesQty = $model->files->count();
    $totalAllowed = ($qty != '') ? $qty : 5;
    $allowedQty = $totalAllowed - $publishedFilesQty ;
@endphp
<div class="container-fluid">
    <div class="row">
        <div class="col-md-{{$colmd}}">

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{$title}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if($allowedQty > 0)
                            <div class="dropzone dropzone-area dz-clickable"></div>
                        @else
                            {{-- <div class="text-center" style="margin: 0 auto;">
                                <small>{{__('File limit exceeded, delete some file to publish again')}}</small>
                            </div> --}}
                        @endif
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="container-files">
                    @forelse($model->files as $file)
                        <div class="card-body box-profile">
                            @if($file->type == 'image')
                                <img src="{{ url('/storage/'.$file->url) }}"
                                     alt="User profile picture">
                            @else
                                <a href="{{ url('/storage/'.$file->url) }}" target="_blank"><img
                                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/13/DEB_file_format_icon_on_ubuntu.png/64px-DEB_file_format_icon_on_ubuntu.png"
                                            alt="File"></a>
                            @endif
                            <div class="overlay-status">
                                <form method="POST"
                                      action="{{ route('dashboard.files.destroy', $file) }}" class="text-center">
                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                    <button class="btn-del">{{__('Delete')}}</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        {{--<small>{{__('No files')}}</small>--}}
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">
    <style>

        .card-title {
            font-size: 1.4em;
            font-weight: bold;
            color: #333;
        }

        .container-fluid {
            padding: 5px 0;
        }

        .dropzone {
            background: #FFFFCC;
            border-radius: 5px;
            border: 1px dashed rgb(0, 135, 247);
            width: calc(100% - 40px);
            margin: 0 auto;
        }

        a.btn.btn-light-primary {
            display: none !important;
        }

        .error-validation {
            border: 2px solid #F00;
            background-color: rgba(255, 0, 0, 0.14);
        }

        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            border-radius: 5px; /* 5px rounded corners */
            width: calc(100% - 40px);
            margin: 10px auto;
            padding-bottom: 15px;
        }

        .card-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }

        .btn-del {
            background-color: #f44336;
            border: none;
            border-radius: 5px;
            color: white;
            padding: 6px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 0.89em;
        }

        .container-files {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            margin: 10px auto;
        }

        .container-files > * {
            flex-basis: calc(25% - 20px);
        }

        .box-profile {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            border-top: 2px solid #008CBA;
            border-radius: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            background-color: #FFF;
            padding: 30px 5px;
            margin: 10px;
        }

        .box-profile img {
            width: 75px;
            height: 75px;
            border: 3px solid #008CBA;
            background-color: #FFFFCC;
            padding: 2px;
            border-radius: 50%;
        }

        .overlay-status {
            width: calc(100% - 20px);
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            margin: 3px auto;
        }

    </style>
@endpush
@push('js')
    {{-- If you are already loading jquery in your main layout, this is not necessary --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script>
        (function (window, document, $) {
            'use strict';

            Dropzone.autoDiscover = false;
            var myDropzone = new Dropzone('.dropzone', {
                'url': '/dashboard/files/{{$model->id}}/model/{{$mtype}}/type/{{$ftype}}',
                'paramName': 'file',
                @if($ftype == 'file')
                'acceptedFiles': 'image/*,application/pdf,.doc,.docx,.xls,.xlsx,.csv,.tsv,.ppt,.pptx,.pages,.odt,.rtf',
                @else
                'acceptedFiles': 'image/*',
                @endif
                'maxFilesize': 2,
                'maxFiles': {{$allowedQty }},
                'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                dictDefaultMessage: '{{__('Drag and drop the file here...')}}'
            });
            myDropzone.on('error', function (file, res) {
                let msg = res.errors.file[0];
                $('.dz-error-message:last > span').text(msg);
            });

            $('.error-validation').on('blur', function () {
                $(this).removeClass("error-validation");
            });

        })(window, document, jQuery);
    </script>
@endpush
