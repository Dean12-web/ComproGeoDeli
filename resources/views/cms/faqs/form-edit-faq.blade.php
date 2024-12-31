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
                <form enctype="multipart/form-data" action="{{ route('cms.update-faqs', $faqs->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="box-body">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Pertanyaan</label>
                            <input type="text" id="question" name="question" class="form-control"
                                placeholder="Enter ..." value="{{ $faqs->question }}">
                        </div>
                        <div class="form-group">
                            <label>Jawaban</label>
                            <textarea class="form-control" name="answer" id="answer" rows="3" placeholder="Enter ...">{{ $faqs->answer }}</textarea>
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
@stop
