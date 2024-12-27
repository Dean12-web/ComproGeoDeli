@extends('admin-layouts.master')

@section('title', 'CMS Service')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tambah Layanan
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                <li class="active"><i class="fa fa-uaser"></i> Tambah Layanan</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-success">
                <!-- /.box-header -->
                <form enctype="multipart/form-data" action="{{ route('cms.update-services', $service->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="box-body">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="Enter ..."
                                value="{{ $service->title }}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Image</label>
                            <input type="file" id="image" name="image" class="form-control"
                                onchange="previewImage()">
                            @if ($service->image)
                                <img src="{{ asset('storage/images/' . $service->image) }}"
                                    class="img-preview img-fluid mb-3" width="30%">
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter ...">{{ $service->description }}</textarea>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right" style="margin-right: 5px">Ubah
                            Data</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <script>
        document.addEventListener('trix-change', function() {
            const trixEditor = document.querySelector('trix-editor');
            const hiddenInput = document.querySelector('#description');

            // Modify Trix output to replace <div> with <p>
            hiddenInput.value = trixEditor.innerHTML.replace(/<div>/g, '<p>').replace(/<\/div>/g, '</p>');
        });

        function previewImage() {
            const image = document.querySelector("#image");
            const imgPreview = document.querySelector(".img-preview");

            imgPreview.style.display = "block";

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@stop
