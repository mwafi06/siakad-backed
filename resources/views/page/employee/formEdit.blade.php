<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">{{ ucfirst($page) ?? 'Page Title' }}</h3>
        <div class="row table-action justify-content-end">
            <div class="col-2 no-padding text-right">
                <a class="btn btn-success btn-sm text-light form-action-save" data-target="#form-data"><i class="fas fa-save"></i>&nbsp;&nbsp;&nbsp;Save</a>
                <a class="btn btn-danger btn-sm text-light form-action-cancel" data-href="{{ url(route('employee')) }}"><i class="fas fa-times"></i>&nbsp;&nbsp;&nbsp;Cancel</a>
            </div>
        </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
        <form class="form-horizontal row" id="form-data" action="{{ route('employee.update') }}" method="post">
            @csrf
            <div class="col-6">
                <div class="form-group row">
                    <label for="guid" class="col-sm-3 col-form-label required">Employee Group</label>
                    <div class="col-sm-9">
                        {!! form_dropdown('guid',$employeeGroup,$data->guid,'class="form-control"') !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label required">Username</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="username" value="{{$data->username}}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="input-group col-sm-9">
                        <input type="password" class="form-control" id="password" name="password" value="">
                        <div class="input-group-append">
                            <span class="input-group-text see-password" data-target="#password"><i class="fas fa-eye"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="re_password" class="col-sm-3 col-form-label">Re Password</label>
                    <div class="input-group col-sm-9">
                        <input type="password" class="form-control" id="re-password" name="re_password" value="">
                        <div class="input-group-append">
                            <span class="input-group-text see-password" data-target="#re-password"><i class="fas fa-eye"></i></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label for="nip" class="col-sm-3 col-form-label required">NIP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control numeric" name="nip" value="{{$data->nip}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="full_name" class="col-sm-3 col-form-label required">Full Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="full_name" value="{{$data->full_name}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="full_name" class="col-sm-3 col-form-label required">Teacher</label>
                    <div class="col-sm-9">
                        <div class="custom-control custom-radio" style="display: inline-block">
                            <input class="custom-control-input" type="radio" id="yes" value="y" name="teacher">
                            <label for="yes" class="custom-control-label">Yes</label>
                        </div>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="custom-control custom-radio" style="display: inline-block">
                            <input class="custom-control-input" type="radio" id="no" value="n" name="teacher" checked>
                            <label for="no" class="custom-control-label">No</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="dob" class="col-sm-3 col-form-label">Date Of Birth</label>
                    <div class="col-sm-9 row pr-0">
                        <div class="col-sm-3">
                            <input type="text" class="form-control numeric" name="date" placeholder="Date" maxlength="2" value="{{ !is_null($data->date_of_birth) ? date('d',strtotime($data->date_of_birth)) : null }}">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control numeric" name="month" placeholder="Month" maxlength="2" value="{{ !is_null($data->date_of_birth) ? date('m',strtotime($data->date_of_birth)) : null }}">
                        </div>
                        <div class="col-sm-6 pr-0">
                            <input type="text" class="form-control numeric" name="year" placeholder="Year" maxlength="4" value="{{ !is_null($data->date_of_birth) ? date('Y',strtotime($data->date_of_birth)) : null }}">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" name="email" value="{{$data->email}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control numeric" name="phone" value="{{$data->phone}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-3 col-form-label">Address</label>
                    <div class="col-sm-9">
                        <textarea name="address" class="form-control" style="resize: vertical">{{$data->address}}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-9 offset-sm-3">
                        <input type="hidden" name="uid" value="{{ $data->uid }}">
                        <button class="btn btn-success btn-sm text-light" type="submit"><i class="fas fa-save"></i>&nbsp;&nbsp;&nbsp;Save</button>
                        <a class="btn btn-danger btn-sm text-light form-action-cancel" data-href="{{ url(route('employee')) }}"><i class="fas fa-times"></i>&nbsp;&nbsp;&nbsp;Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
