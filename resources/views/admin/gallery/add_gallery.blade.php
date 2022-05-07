@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm thư viện ảnh</h4>
            <form action="{{URL::to('/insert-gallery/'.$pro_id)}}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="row">
                <div class="input-group mb-3">
                    <div class="input-group-prepend"><span class="input-group-text">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" name="file[]" id="file" accept="image/*" multiple class="form-control custom-file-input" required>
                        <label class="custom-file-label">Choose file</label>
                    </div>
                    <input type="submit" name="upload"  value="Tải ảnh" class="btn btn-success">
                </div>
                
            </div>
            <span id="error_gallery"></span>
            </form>

            <form>
                @csrf
            <div class="table-responsive" id="gallery_load"> 
                <?php
                $message= Session::get('message');
                if($message){
                    echo '<span class="text-alert text-danger">'.$message.'</span>';
                    Session::put('message', null);
                }
                ?>
                <input type="hidden" value="{{$pro_id}}" name="pro_id" class="pro_id">
                
            </div>
            </form>
        </div>
    </div>
</div>
@endsection