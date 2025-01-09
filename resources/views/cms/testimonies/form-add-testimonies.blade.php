@extends('admin-layouts.master')

@section('title', 'CMS Add Testimony')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tambah Testimony
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                <li class="active"><i class="fa fa-uaser"></i> Tambah Testimony</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-success">
                <!-- /.box-header -->
                <form enctype="multipart/form-data" id="testimony-form">
                    @csrf
                    <div class="box-body">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" id="client_name" name="client_name" class="form-control"
                                placeholder="Enter ...">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" id="client_email" name="client_email" class="form-control"
                                placeholder="Enter ...">
                        </div>
                        <div class="form-group">
                            <label>Testimonial</label>
                            <textarea class="form-control" name="testimonial" id="testimonial" rows="3" placeholder="Enter ..."></textarea>
                        </div>
                        <div class="form-group">
                            <label>Photo</label>
                            <input type="file" id="client_photo" name="client_photo" class="form-control"
                                onchange="previewImage()">
                            <img class="img-preview img-fluid mb-3" width="30%">
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
        console.log('{{ csrf_token() }}')
        document.getElementById('testimony-form').addEventListener('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            fetch("{{ route('store-testimony') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.success);
                        window.location.href = "{{ route('cms.testimony') }}"; 
                        
                    } else if (data.error) {
                        alert(data.error);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Something went wrong. Please try again.");
                });
        });

        function previewImage() {
            const image = document.querySelector("#client_photo");
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
