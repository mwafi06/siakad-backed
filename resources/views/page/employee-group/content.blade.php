<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">{{ ucfirst($page) ?? 'Page Title' }}</h3>
        <div class="row table-action justify-content-end">
            <div class="col-3 text-right no-padding">
                @if(mod_access('employee','create'))
                    <a class="btn btn-success btn-sm text-light form-action-add" data-href="{{ route('employee-group.add') }}"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Add</a>
                @endif
                @if(mod_access('employee','update'))
                    <a class="btn btn-warning btn-sm text-light form-action-edit" data-href="{{ route('employee-group.edit') }}"><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;&nbsp;Edit</a>
                @endif
                @if(mod_access('employee','delete'))
                        <a class="btn btn-danger btn-sm text-light form-action-delete" data-href="{{ route('employee-group.delete') }}"><i class="fas fa-trash"></i>&nbsp;&nbsp;&nbsp;Delete</a>
                    @endif
            </div>
        </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
        <form action="{{ route('employee-group') }}" method="GET">
            <div class="row table-action justify-content-end">
                <input type="text" class="form-control col-2 mlr-5px" name="q" placeholder="Search" value="{{ $allGet->q ?? null }}">
                <button class="btn btn-primary mlr-5px"><i class="fas fa-search"></i></button>
                <a class="btn btn-primary btn-refresh" href="{{ route('employee-group',isset($allGet) ? (array)$allGet : array()) }}"><i class="fas fa-sync"></i></a>
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
                    <th rowspan="2" width="50px"></th>
                    <th rowspan="2" width="50px" class="text-center">#</th>
                    <th rowspan="2" class="text-center">Group Name</th>
                    <th rowspan="2" class="text-center">Total User</th>
                    <th colspan="4" class="text-center">Module</th>
                </tr>
                <tr>
                    <th class="text-center">view</th>
                    <th class="text-center">create</th>
                    <th class="text-center">edit</th>
                    <th class="text-center">delete</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data->items() as $key => $value):?>
                <tr>
                    <td align="center">
                        <div class="icheck-primary d-inline">
                            <input type="checkbox" id="checkbox-table-{{ $value->guid }}" data-id="{{ $value->guid }}" class="checkbox-table">
                            <label for="checkbox-table-{{ $value->guid }}"></label>
                        </div>
                    </td>
                    <td align="center"><?php echo $key+$data->firstItem()?></td>
                    <td>{{$value->name}}</td>
                    <td>{{$value->total_user}}</td>
                    <td>{{count(explode(',',$value->read))}}</td>
                    <td>{{count(explode(',',$value->create))}}</td>
                    <td>{{count(explode(',',$value->update))}}</td>
                    <td>{{count(explode(',',$value->delete))}}</td>
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
@section('customJs')
    <script type="text/javascript">
        $(function(){
            var role_view 	= [""];
            var role_create = [""];
            var role_alter 	= [""];
            var role_drop 	= [""];

            $.each(role_view, function(i,v){
                $('#view-'+v).prop('checked', true);
            });
            $.each(role_create, function(i,v){
                $('#view-'+v).prop('checked', true);
                $('#create-'+v).prop('checked', true);
            });
            $.each(role_alter, function(i,v){
                $('#view-'+v).prop('checked', true);
                $('#edit-'+v).prop('checked', true);
            });
            $.each(role_drop, function(i,v){
                $('#view-'+v).prop('checked', true);
                $('#delete-'+v).prop('checked', true);
            });

            $('input:checkbox').click(function(){
                var value = $(this).val();
                if($(this).attr('name') == 'create[]' || $(this).attr('name') == 'edit[]' || $(this).attr('name') == 'delete[]'){
                    if(!$('#view-'+value).is(':checked')){
                        $('#view-'+value).prop('checked', true);
                    }
                }
                if($(this).attr('name') == 'view[]'){
                    if(!$(this).is(':checked')){
                        $('#create-'+value).prop('checked', false);
                        $('#edit-'+value).prop('checked', false);
                        $('#delete-'+value).prop('checked', false);
                    }
                }
            });
        });
    </script>
@endsection
