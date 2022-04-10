@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Liệt kê Users</h4>
            
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
                            <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                            </th>
                            <th scope="col">Tên user</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Password</th>
                            <th scope="col">Author</th>
                            <th scope="col">Admin</th>
                            <th scope="col">User</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admin as $key => $user)
                        <form action="{{url('/assign-roles')}}" method="POST">
                        @csrf
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>{{ $user->admin_name }}</td>
                            <td>{{ $user->admin_email }} <input type="hidden" name="admin_email" value="{{ $user->admin_email }}"></td>
                            <td>{{ $user->admin_phone }}</td>
                            <td>{{ $user->admin_password }}</td>
                            <td><input type="checkbox" name="author_role" {{$user->hasRole('author') ? 'checked' : ''}}></td>
                            <td><input type="checkbox" name="admin_role"  {{$user->hasRole('admin') ? 'checked' : ''}}></td>
                            <td><input type="checkbox" name="user_role"  {{$user->hasRole('user') ? 'checked' : ''}}></td>

                            <td><input type="submit" value="Assign roles" class="btn btn-sm btn-default"></td> 
                        </tr>
                        </form>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="bootstrap-pagination">
                <nav>
                    <ul class="pagination justify-content-center">
                        {!!$admin->links()!!}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection