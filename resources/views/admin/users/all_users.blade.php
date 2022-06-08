@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Liệt kê nhân viên</h4>
            
            <div class="table-responsive"> 
                <?php
                $message= Session::get('message');
                if($message){
                    echo '<span class="text-alert text-danger">'.$message.'</span>';
                    Session::put('message', null);
                }
                ?>
                <table class="table table-bordered table-striped verticle-middle">
                    <thead>
                        <tr>
                            
                            <th scope="col">STT</th>
                            <th scope="col">Tên nhân viên</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Password</th>
                            <th scope="col">Admin</th>
                            <th scope="col">Editer</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach ($admin as $key => $user)
                        @php
                            $i++;
                        @endphp
                        <form action="{{url('/assign-roles')}}" method="POST">
                        @csrf
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{ $user->admin_name }}</td>
                            <td>{{ $user->admin_email }} 
                                <input type="hidden" name="admin_email" value="{{ $user->admin_email }}">
                                <input type="hidden" name="admin_id" value="{{ $user->admin_id}}">
                            </td>
                            <td>{{ $user->admin_phone }}</td>
                            <td>{{ $user->admin_password }}</td>
                            <td><input type="checkbox" name="admin_role"  {{$user->hasRole('admin') ? 'checked' : ''}}></td>
                            <td><input type="checkbox" name="editer_role" {{$user->hasRole('editer') ? 'checked' : ''}}></td>

                            <td style="text-align: center">
                                <a class="btn btn-sm btn-success" style="font-weight: 700; font-size:18px" href="{{url('/edit-user-roles/'.$user->admin_id)}}">Sửa</a>
                                <a class="btn btn-sm btn-danger" style="font-weight: 700; font-size:18px" href="{{url('/delete-user-roles/'.$user->admin_id)}}">Xóa</a><br>
                                <input type="submit" value="Phân quyền" class="btn  btn-default" style="font-weight: 700; font-size:18px">
                            </td> 
                        </tr>
                        </form>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $admin->links('admin.paginate_style.my_paginate') }}
        </div>
    </div>
</div>
@endsection