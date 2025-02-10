@extends('admin-layouts.master')

@section('title', 'CMS Contacts')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Contact
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">Contact</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-xs-6">
                                    @if ($contact->isEmpty())
                                        <a href="{{ route('cms.add-contact') }}"
                                            class="btn btn-success btn-flat btn-social">
                                            <i class="fa fa-plus"></i> Tambah Kontak
                                        </a>
                                    @endif
                                </div>
                                <div class="col-xs-6">
                                    @if (!$contact->isEmpty())
                                        <a href="{{ route('cms.edit-contact', $contact->first()->id) }}" style="float: right" class="btn btn-primary btn-flat btn-social">
                                            <i class="fa fa-plus"></i> Ubah Kontak
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if (session('success'))
                            <div class="callout callout-success">
                                <p> {{ session('success') }}</p>
                            </div>
                        @endif
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Alamat Perusahaan</th>
                                        <th>Nomor Telepon</th>
                                        <th>Email</th>
                                        <th>Instagram</th>
                                        <th>Facebook</th>
                                        <th>Twitter</th>
                                        <th>Whatsapp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($contact as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->address }}</td>
                                            <td>{{ $item->phone_number }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->instagram }}</td>
                                            <td>{{ $item->facebook }}</td>
                                            <td>{{ $item->twitter }}</td>
                                            <td>{{ $item->whatsapp }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="6">Tidak ada data</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
    </div>
@stop
