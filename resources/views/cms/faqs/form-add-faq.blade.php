@extends('admin-layouts.master')

@section('title', 'CMS Tambah Faq')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tambah Faq
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                <li class="active"><i class="fa fa-uaser"></i> Tambah Faq</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-success">
                <!-- /.box-header -->
                <form enctype="multipart/form-data" action="{{ route('cms.store-faqs') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Pertanyaan</label>
                            <input type="text" id="question" name="question" class="form-control"
                                placeholder="Enter ...">
                        </div>
                        <div class="form-group">
                            <label>Jawaban</label>
                            <textarea class="form-control" name="answer" id="answer" rows="3" placeholder="Enter ..."></textarea>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right" style="margin-right: 5px">Tambah
                            Data</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <script>
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
