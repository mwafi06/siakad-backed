<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">{{ ucfirst($page) ?? 'Page Title' }}</h3>
        <div class="row table-action justify-content-end">
            <div class="col-3 text-right no-padding">
                @if(mod_access('employee','create'))
                    <a class="btn btn-success btn-sm text-light form-action-add" data-href="{{ route('employee.add') }}"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Add</a>
                @endif
                @if(mod_access('employee','update'))
                    <a class="btn btn-warning btn-sm text-light form-action-edit" data-href="{{ route('employee.edit') }}"><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;&nbsp;Edit</a>
                @endif
                @if(mod_access('employee','delete'))
                    <a class="btn btn-danger btn-sm text-light form-action-delete" data-href="{{ route('employee.delete') }}"><i class="fas fa-trash"></i>&nbsp;&nbsp;&nbsp;Delete</a>
                @endif
            </div>
        </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
        <form action="{{ route('employee') }}" method="GET">
            <div class="row table-action justify-content-end">
                <input type="text" class="form-control col-2 mlr-5px" name="q" placeholder="Search" value="{{ $allGet->q ?? null }}">
                <button class="btn btn-primary mlr-5px"><i class="fas fa-search"></i></button>
                <a class="btn btn-primary btn-refresh" href="{{ route('employee',isset($allGet) ? (array)$allGet : array()) }}"><i class="fas fa-sync"></i></a>
            </div>
        </form>
    </div>
</div>
@if(isset($data) && $data->isNotEmpty())
    <div class="card card-primary">
        <div class="box-body no-padding">
            <table class="table table-bordered table-striped no-margin">
                <thead>
                <tr>
                    <th width="50px"></th>
                    <th width="50px" class="text-center">#</th>
                    <th>NIP</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Employee Group</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Teacher</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data->items() as $key => $value):?>
                <tr>
                    <td align="center">
                        <div class="icheck-primary d-inline">
                            <input type="checkbox" id="checkbox-table-{{ $value->uid }}" data-id="{{ $value->uid }}" class="checkbox-table">
                            <label for="checkbox-table-{{ $value->uid }}"></label>
                        </div>
                    </td>
                    <td align="center">{{ $key+$data->firstItem() }}</td>
                    <td>{{ $value->nip }}</td>
                    <td>{{ $value->full_name }}</td>
                    <td>{{ $value->username }}</td>
                    <td>{{ $value->employee_group_name }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->phone }}</td>
                    <td>{{ $value->is_teacher == 'y' ? 'Yes' : 'No' }}</td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} entries</div>
        </div>
        <div class="col-sm-6">
            {!! $data->links() !!}
        </div>
    </div>
@else
    <div class="alert alert-danger"><strong>No Data Provided</strong></div>
@endif
